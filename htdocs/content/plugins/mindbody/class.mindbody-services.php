<?php

/*
 * This class implements a custom wordpress data type for a product
 * When the plugin is first installed, it needs to reach out to the MB API
 * and grab all the current products. 
 * TODO: interface with Mindbody API to update products on their end.
 */
class Mindbody_Products {

	private static $initiated = false;
	
	
	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}

	/**
	 * Initializes WordPress hooks
	 */
	private static function init_hooks() {
                self::$initiated = true;
                self::create_post_product();
                self::post_meta_boxes_setup();
                add_action( 'save_post', array('Mindbody_Products', 'save_post_class_meta'), 10, 2 );
                add_action( 'after_setup_theme', array('Mindbody_Products', 'create_theme_support'), 2);
                add_filter( 'post_updated_messages', array('Mindbody_Products','custom_post_messages'));
		
	}
        
        /* Save the meta box's post metadata. 
         * All post_class_meta data will have the prefix mb_
         * This means we can loop through POST and save those things
         *          
         */
        public static function save_post_class_meta( $post_id, $post ) {

            /* Verify the nonce before proceeding. */
            if ( !isset( $_POST['mb_product_class_nonce'] ) || !wp_verify_nonce( $_POST['mb_product_class_nonce'], basename( __FILE__ ) ) )
              return $post_id;
            $post_type = get_post_type_object( $post->post_type );
            if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
              return $post_id;
          
            //We want to loop through the POST object and save things
            foreach( $_POST as $key => $value ) {
                if (substr($key, 0,3)=='mb_'){ //we've found meta data
                      $new_meta_value = sanitize_text_field($value);
                      $meta_key = $key;

                      /* Get the meta value of the custom field key. */
                      $meta_value = get_post_meta( $post_id, $meta_key, true );

                      /* If a new meta value was added and there was no previous value, add it. */
                      if ( $new_meta_value && '' == $meta_value )
                        add_post_meta( $post_id, $meta_key, $new_meta_value, true );

                      /* If the new meta value does not match the old value, update it. */
                      elseif ( $new_meta_value && $new_meta_value != $meta_value )
                        update_post_meta( $post_id, $meta_key, $new_meta_value );

                      /* If there is no new meta value but an old value exists, delete it. */
                      elseif ( '' == $new_meta_value && $meta_value )
                        delete_post_meta( $post_id, $meta_key, $meta_value );
                }
            } 
        }
        
        /* Anything that needs to be added via the add_theme_support
         * function should go here
         * TODO: figure out from themosis whether the theme dependency can be
         * avoided. Right now we have to go into the framework and set this 
         */
        private static function create_theme_support(){
            add_theme_support( 'post-thumbnails', array('mb_product') ); 
        }
        
        private static function create_post_product() {
            $labels = array(
            'name'               => _x( 'Products', 'post type general name' ),
            'singular_name'      => _x( 'Product', 'post type singular name' ),
            'add_new'            => _x( 'Add New', 'book' ),
            'add_new_item'       => __( 'Add New Product' ),
            'edit_item'          => __( 'Edit Product' ),
            'new_item'           => __( 'New Product' ),
            'all_items'          => __( 'All Products' ),
            'view_item'          => __( 'View Product' ),
            'search_items'       => __( 'Search Products' ),
            'not_found'          => __( 'No Mindbody products found' ),
            'not_found_in_trash' => __( 'No Mindbody products found in the Trash' ), 
            'parent_item_colon'  => '',
            'menu_name'          => 'Mindbody Products'
          );
          $args = array(
            'labels'        => $labels,
            'description'   => 'Holds our products and product specific data',
            'public'        => true,
            'menu_position' => 5,
            'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ), //Depending on your theme, you may have to add this in an additional location in the theme
            'has_archive'   => true,
          );
            register_post_type( 'mb_product', $args ); 
      }
      
      public static function custom_post_messages( $messages ) {
        global $post, $post_ID;
        $messages['product'] = array(
          0 => '', 
          1 => sprintf( __('Product updated. <a href="%s">View product</a>'), esc_url( get_permalink($post_ID) ) ),
          2 => __('Custom field updated.'),
          3 => __('Custom field deleted.'),
          4 => __('Product updated.'),
          5 => isset($_GET['revision']) ? sprintf( __('Product restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
          6 => sprintf( __('Product published. <a href="%s">View product</a>'), esc_url( get_permalink($post_ID) ) ),
          7 => __('Product saved.'),
          8 => sprintf( __('Product submitted. <a target="_blank" href="%s">Preview product</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
          9 => sprintf( __('Product scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview product</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
          10 => sprintf( __('Product draft updated. <a target="_blank" href="%s">Preview product</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        );
        return $messages;
      }
      
    /* Meta box setup function. */
    public static function post_meta_boxes_setup() {

      /* Add meta boxes on the 'add_meta_boxes' hook. */
      add_action( 'add_meta_boxes', array('Mindbody_Products', 'add_post_meta_boxes'));
    }
    
    /* Create one or more meta boxes to be displayed on the post editor screen. */
    public static function add_post_meta_boxes() {

      add_meta_box(
        'product-fields',      // Unique ID
        'Mindbody Product Fields',    // Title
        array('Mindbody_Products', 'product_fields_meta_box'),   // Callback function
        'mb_product',         // Admin page (or post type)
        'normal',         // Context
        'default'         // Priority
      );
    }
    
    /* Callback function to print meta boxes HTML */
    public static function product_fields_meta_box($object, $box) {
        wp_nonce_field( basename( __FILE__ ), 'mb_product_class_nonce' ); 
        
        /*
         *  <Price>decimal</Price>
            <TaxIncluded>decimal</TaxIncluded>
            <TaxRate>decimal</TaxRate>
            <Action>None or Added or Updated or Failed or Removed</Action>
            <ID>string</ID>
            <GroupID>int</GroupID>
            <Name>string</Name>
            <OnlinePrice>decimal</OnlinePrice>
            <ShortDesc>string</ShortDesc>
            <LongDesc>string</LongDesc>
            <Color xsi:nil="true" />
            <Size xsi:nil="true" />
         */
        
    ?>
       
        <p>
          <label for="mb_price"><?php _e( "Price", 'example' ); ?></label>
          <br />
          <input class="widefat" type="text" name="mb_price" id="mb_price" value="<?php echo esc_attr( get_post_meta( $object->ID, 'mb_price', true ) ); ?>" size="30" />
        </p>
        
        <p>
          <label for="mb_online_price"><?php _e( "Online Price", 'example' ); ?></label>
          <br />
          <input class="widefat" type="text" name="mb_online_price" id="mb_online_price" value="<?php echo esc_attr( get_post_meta( $object->ID, 'mb_online_price', true ) ); ?>" size="30" />
        </p>
        
        <p>
          <label for="mb_tax_rate"><?php _e( "Tax Rate", 'example' ); ?></label>
          <br />
          <input class="widefat" type="text" name="mb_tax_rate" id="mb_tax_rate" value="<?php echo esc_attr( get_post_meta( $object->ID, 'mb_tax_rate', true ) ); ?>" size="30" />
        </p>
        
        <p>
          <label for="mb_id"><?php _e( "Mindbody Product ID", 'example' ); ?></label>
          <br />
          <input class="widefat" type="text" name="mb_id" id="mb_id" value="<?php echo esc_attr( get_post_meta( $object->ID, 'mb_id', true ) ); ?>" readonly />
        </p>

    <?php
    }
    
    /*
     * This function is used to manually refresh our products list from the
     * Mindbody API.
     */
    public static function update_products(){
        //Get Credentials
        //TODO: Move this somewhere??
        $options = get_option('mb_cred');
        $sourcename = $options['mb_sourcename']; 
        $password = $options['mb_password']; ; 
        $siteID = $options['mb_siteid']; 

        // initialize default credentials
        $creds = new SourceCredentials($sourcename, $password, array($siteID));
        

        $classService = new MBSaleService(false);
        $classService->SetDefaultCredentials($creds);

        $result = $classService->GetProducts();
        $products = toArray($result->GetProductsResult->Products->Product);
        
        //Parse this data and either add it or update it
        foreach($products as $product){
            //var_dump($product); 
            self::insert_update($product);
        }
        
        header('Content-type: application/json');
        echo json_encode($products);
    }
    
    private static function insert_update($product){
        // Create post object
        $my_product = array(
          'post_title'    => isset($product->Name) ? $product->Name : '',
          'post_type'     => 'mb_product',
          'post_content'  => isset($product->LongDesc) ? $product->LongDesc : '',
          'post_excerpt'  => isset($product->ShortDesc) ? $product->ShortDesc : '',
          'post_status'   => 'draft',
        );

        //Check the lookup table for this product ID
        global $wpdb;
        $table_name = "mindbody_lookup";
        $table = $wpdb->prefix.$table_name;
        $prod_count = $wpdb->get_var( "SELECT COUNT(*)  FROM ". $table ." WHERE id = ".$product->ID);
        
        if ($prod_count == 0){
            // Insert the post into the database
            $this_post_id = wp_insert_post( $my_product );
            
            //Insert ID and post ID into lookup table
            $wpdb->insert( $table, array( 
		'id' => $product->ID, 
		'post_id' => $this_post_id 
                ), 
                array( 
                        '%d', 
                        '%d' 
                )  );

            //Add Meta
            // Add or Update the meta field in the database.
            if (isset($product->OnlinePrice)){
                if ( ! update_post_meta ($this_post_id, 
                    'mb_online_price', $product->OnlinePrice) ) { 
                    add_post_meta($this_post_id, 'mb_online_price', $product->OnlinePrice, true );	
                }   
            }

            if (isset($product->Price)){
                if ( ! update_post_meta ($this_post_id, 
                    'mb_price', $product->Price) ) { 
                    add_post_meta($this_post_id, 'mb_price', $product->Price, true );	
                }   
            }

            if (isset($product->ID)){
                if ( ! update_post_meta ($this_post_id, 
                    'mb_id', $product->ID) ) { 
                    add_post_meta($this_post_id, 'mb_id', $product->ID, true );	
                }   
            }
        }
        
        
        
    }
}