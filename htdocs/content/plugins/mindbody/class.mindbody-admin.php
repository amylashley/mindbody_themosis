<?php

class Mindbody_Admin {
	const NONCE = 'mindbody-product-key';

	private static $initiated = false;
	private static $notices = array();

	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
        }
        
        private static function init_hooks(){

            add_action('admin_menu', array('Mindbody_Admin','scheduler_admin_actions')); 
            add_action( 'admin_enqueue_scripts', array( 'Mindbody_Admin', 'load_resources' ) );
            add_filter( 'plugin_action_links_'.plugin_basename( plugin_dir_path( __FILE__ ) . 'mindbody.php'), array( 'Mindbody_Admin', 'admin_plugin_settings_link' ) );
        }        
		
        public static function scheduler_admin_actions() {
            add_options_page(
                'Mindbody Settings', 
                'Mindbody API', 
                'manage_options', 
                'mindbody-config', 
                array('Mindbody_Admin', 'display_page') //this is the way we call static functions
            ); 
        }
        
 
        
        /*
         * If we need to expand from just a single page in the future, we can do it here
         * Right now though we only need the single settings page
         */
        public static function display_page() {
		//if ( !Akismet::get_api_key() || ( isset( $_GET['view'] ) && $_GET['view'] == 'start' ) )
			self::display_start_page();
		/*elseif ( isset( $_GET['view'] ) && $_GET['view'] == 'stats' )
			self::display_stats_page();
		else
			self::display_configuration_page();
                 * 
                 */
	}

        
	public static function display_start_page() {
            self::register_my_settings();
            Mindbody::view( 'start', compact( 'mindbody_user' ) );
            
	}
        
        public static function register_my_settings(){
            
            self::createCredentials();
            self::createUpdater();
            
        }
        
        private static function createCredentials(){
             /*Main Credentials Section*/
            add_settings_section( 'main_section', '', array('Mindbody_Admin', 'section_callback'), 'mindbody-config' ); 
            add_settings_field('mb_sourcename', 'Sourcename', array('Mindbody_Admin', 'display_sourcename') ,'mindbody-config', 'main_section');
            add_settings_field('mb_password', 'Password', array('Mindbody_Admin', 'display_password'), 'mindbody-config', 'main_section');
            add_settings_field('mb_siteid', 'Site ID', array('Mindbody_Admin', 'display_siteid'),'mindbody-config', 'main_section');
            
            register_setting(
                'mindbody-config',
                'mb_sourcename'
            );
            register_setting(
                'mindbody-config',
                'mb_password'
            );
            register_setting(
                'mindbody-config',
                'mb_siteid'
            );
        }
        
        private static function createUpdater(){
             /*Main Credentials Section*/
            add_settings_section( 'update_section', '', array('Mindbody_Admin', 'update_section_callback'), 'mindbody-update' ); 
            add_settings_field('btn_update', 'Update Products', array('Mindbody_Admin', 'display_update_btn') ,'mindbody-update', 'update_section');
           
            register_setting(
                'mindbody-update',
                'btn_update'
            );
           
        }
        
        /*Begin Callback Functions for Settings Page
         */
        
        public static function update_section_callback(){
                echo '<HR><p>If you would like to pull data down from the Mindbody product catalog,'
            . 'please use this update function. </p>';
        }
        
        public static function display_update_btn(){
           echo '<input class="button button-primary update-prod" value="Update Product Catalog">';
       
        }
        
        public static function plugin_options_validate($plugin_options) {  return $plugin_options;}
        
        public static function section_callback() {
            echo '<p>This is where you should add your Mindbody API credentials. If you are unsure '
            . 'about your credentials, please visit the<BR>'
                    . '<a href="https://developers.mindbodyonline.com/"> Mindbody Developer Site</a>. </p>';
        }

        public static function display_sourcename(){
            $options = get_option('mb_cred');
            if (isset($options['mb_sourcename'])){
                echo "<input id='mb_sourcename' class='normal-text code' name='mb_sourcename' size='30' type='text' value='{$options['mb_sourcename']}' />";
       
            }else {
                echo "<input id='mb_sourcename' class='normal-text code' name='mb_sourcename' size='30' type='text' value='' />";
            }
            
        }
        public static function display_password(){
            $options = get_option('mb_cred');
            if (isset($options['mb_password'])){
                echo "<input id='mb_password' class='normal-text code' name='mb_password' size='32' type='password' value='{$options['mb_password']}' />";
       
            }else {
                echo "<input id='mb_password' class='normal-text code' name='mb_password' size='32' type='password' value='' />";
       
            }
            
        }
        public static function display_siteid(){
            $options = get_option('mb_cred');
            if (isset($options['mb_siteid'])){
                echo "<input id='mb_siteid' class='normal-text code' name='mb_siteid' size='10' type='text' value='{$options['mb_siteid']}' />";
       
            }else{
                echo "<input id='mb_siteid' class='normal-text code' name='mb_siteid' size='10' type='text' value='' />";
            }
        }

        /*END Callback functions*/
        
        public static function admin_plugin_settings_link( $links ) { 
         
  		$settings_link = '<a href="'.esc_url( self::get_page_url() ).'">'.__('Settings', 'mindbody').'</a>';
  		array_unshift( $links, $settings_link ); 
  		return $links; 
	}
        
        public static function get_page_url( $page = 'config' ) {

		$args = array( 'page' => 'mindbody-config' );

		if ( $page == 'stats' )
			$args = array( 'page' => 'mindbody-config', 'view' => 'stats' );
		elseif ( $page == 'delete_key' )
			$args = array( 'page' => 'mindbody-config', 'view' => 'start', 'action' => 'delete-key', '_wpnonce' => wp_create_nonce( self::NONCE ) );

		$url = add_query_arg( $args, admin_url( 'options-general.php' ) );

		return $url;
	}
        
        public static function load_resources() {
		global $hook_suffix;

		if ( in_array( $hook_suffix, array(
			'index.php', # dashboard
			'edit-comments.php',
			'comment.php',
			'post.php',
			'settings_page_mindbody-config',
		) ) ) {
			wp_register_style( 'mb_products.css', MB_PRODUCTS__PLUGIN_URL . '_inc/mb_products.css', array(), MB_PRODUCTS_VERSION );
			wp_enqueue_style( 'mb_products.css');

			wp_register_script( 'mb_products.js', MB_PRODUCTS__PLUGIN_URL . '_inc/mb_products.js', array('jquery','postbox'), MB_PRODUCTS_VERSION );
			wp_enqueue_script( 'mb_products.js' );
			/*wp_localize_script( 'mb_products.js', 'WPmb_products', array(
				'comment_author_url_nonce' => wp_create_nonce( 'comment_author_url_nonce' ),
				'strings' => array(
					'Remove this URL' => __( 'Remove this URL' , 'akismet'),
					'Removing...'     => __( 'Removing...' , 'akismet'),
					'URL removed'     => __( 'URL removed' , 'akismet'),
					'(undo)'          => __( '(undo)' , 'akismet'),
					'Re-adding...'    => __( 'Re-adding...' , 'akismet'),
				)
			) );*/
		}
	}
	

	
}