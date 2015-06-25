<?php
   /*
   Plugin Name: Layer Editor
   Plugin URI: http://amylashley.net
   Description: a plugin to add advanced html blocks to a page
   Version: 0.1.1
   Author: Amy Lashley
   Author URI: http://amylashley.net
   License: GPL2
   */

/*************WPALCHEMY META BOXES***************************/

include_once plugin_dir_path( __FILE__ ).'wpalchemy/MetaBox.php';   
include_once plugin_dir_path( __FILE__ ).'wpalchemy/MediaAccess.php';


 $wpalchemy_media_access = new WPAlchemy_MediaAccess();

  $npp_content_blocks = new WPAlchemy_MetaBox(array(
    'id' => '_npp_custom_content_meta',
    'title' => 'NPP Custom Content Blocks',
    'template' => plugin_dir_path( __FILE__ ). 'content-template.php',
    'init_action' => 'kia_metabox_init', 
    'save_filter' => 'kia_repeating_save_filter',
    /*'view' => WPALCHEMY_VIEW_START_CLOSED,*/
  ));





/* 
 * Sanitize the input similar to post_content
 * @param array $meta - all data from metabox
 * @param int $post_id
 * @return array
 */
function kia_repeating_save_filter( $meta, $post_id ){

  if ( is_array( $meta ) && ! empty( $meta ) ){

    array_walk( $meta, function ( &$item, $key ) { 
      if( isset( $item['textarea'] ) ){
        $item['textarea'] = sanitize_post_field( 'post_content', $item['textarea'], $post_id, 'db' );
        }

    } );

  }

  return $meta;

}


// important: note the priority of 99, the js needs to be placed after tinymce loads
add_action('admin_print_footer_scripts','my_admin_print_footer_scripts',99);

/* 
 * Enqueue styles and scripts specific to metaboxs
 */
function kia_metabox_init(){
  
  // I prefer to enqueue the styles only on pages that are using the metaboxes
  wp_enqueue_style( 'wpalchemy-metabox', plugin_dir_url( __FILE__ ). 'meta.css');
  
  //Custom styles (non-less)
  wp_enqueue_style( 'layer-editor-styles', plugin_dir_url( __FILE__ ). 'style.css');

  //make sure we enqueue some scripts just in case ( only needed for repeating metaboxes )
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'jquery-ui-core' );
  wp_enqueue_script( 'jquery-ui-widget' );
  wp_enqueue_script( 'jquery-ui-mouse' );
  wp_enqueue_script( 'jquery-ui-sortable' );

  $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
  
  // special script for dealing with repeating textareas- needs to run AFTER all the tinyMCE init scripts, so make 'editor' a requirement
 // wp_enqueue_script( 'kia-metabox', get_stylesheet_directory_uri() . '/metaboxes/kia-metabox' . $suffix . '.js', array( 'jquery', 'word-count', 'editor', 'quicktags', 'wplink', 'wp-fullscreen', 'media-upload' ), '1.1', true );
  wp_enqueue_script( 'kia-metabox', plugin_dir_url( __FILE__ ) . 'kia-metabox.js', array( 'jquery', 'word-count', 'editor', 'quicktags', 'wplink', 'wp-fullscreen', 'media-upload' ), '1.1', true );
  
}

function kia_metabox_scripts(){
  wp_print_scripts('kia-metabox');
}

/* 
 * Recreate the default filters on the_content
 * this will make it much easier to output the meta content with proper/expected formatting
*/
add_filter( 'meta_content', 'wptexturize'        );
add_filter( 'meta_content', 'convert_smilies'    );
add_filter( 'meta_content', 'convert_chars'      );
add_filter( 'meta_content', 'wpautop'            );
add_filter( 'meta_content', 'shortcode_unautop'  );
add_filter( 'meta_content', 'prepend_attachment' );
add_filter( 'meta_content', 'do_shortcode');



/*************END WPALCHEMY META BOXES***************************/


function my_admin_print_footer_scripts()
{
    ?>
    <script type="text/javascript">/* <![CDATA[ */

        jQuery(function($)
        {
          
          
          //Script to update text fields linked to selects
          $('select').change(function(){
              $(this).prev().val($(this).val());
            });
         
          //Script to update text fields linked to selects
          $('input:checkbox').change(function(){
            //Get the hidden input json value
            var pages_to_display = [];
            if ($(this).siblings('input:hidden').val() != ''){
                pages_to_display = $.parseJSON($(this).siblings('input:hidden').val());
            }
              if ($(this).is(':checked')) {
                pages_to_display.push($(this).val());
            }
            else {
                pages_to_display.splice($.inArray($(this).val(), pages_to_display),1);
            }
              $(this).siblings('input:hidden').val(JSON.stringify(pages_to_display));
            });
         
         
          /*some crazy js shiz because jquery wont work on our auto-created dom elements*/
         $(document).click(function(event) {
          var className = event.target.className;
          var myName = event.target.name;
          var myValue = event.target.value;
          

         if (className =='r-ex2'){
          $('[name="'+myName+'"]').closest('table').siblings('.no-cols').val(myValue);
          $('[name="'+myName+'"]').closest('table').siblings('.npp-branding-box').css('display','none');
           if (myValue<=4){ 
              $('[name="'+myName+'"]').closest('table').siblings('.npp-user-msg').css('display','none');
              if (myValue == 1){
                $('[name="'+myName+'"]').closest('table').siblings('#customEditor-0').css('display','block');
                $('[name="'+myName+'"]').closest('table').siblings('#customEditor-1').css('display','none');
                $('[name="'+myName+'"]').closest('table').siblings('#customEditor-2').css('display','none');
                $('[name="'+myName+'"]').closest('table').siblings('#customEditor-3').css('display','none');
              } else if (myValue == 2){
                $('[name="'+myName+'"]').closest('table').siblings('#customEditor-0').css('display','block');
                $('[name="'+myName+'"]').closest('table').siblings('#customEditor-1').css('display','block');
                $('[name="'+myName+'"]').closest('table').siblings('#customEditor-2').css('display','none');
                $('[name="'+myName+'"]').closest('table').siblings('#customEditor-3').css('display','none');
              }else if (myValue == 3){
                //console.log("we should be showing 3!!");
                $('[name="'+myName+'"]').closest('table').siblings('#customEditor-0').css('display','block');
                $('[name="'+myName+'"]').closest('table').siblings('#customEditor-1').css('display','block');
                $('[name="'+myName+'"]').closest('table').siblings('#customEditor-2').css('display','block');
                $('[name="'+myName+'"]').closest('table').siblings('#customEditor-3').css('display','none');
              }else if (myValue ==4){
                $('[name="'+myName+'"]').closest('table').siblings('#customEditor-0').css('display','block');
                $('[name="'+myName+'"]').closest('table').siblings('#customEditor-1').css('display','block');
                $('[name="'+myName+'"]').closest('table').siblings('#customEditor-2').css('display','block');
                $('[name="'+myName+'"]').closest('table').siblings('#customEditor-3').css('display','block');
                $('[name="'+myName+'"]').closest('table').siblings('.npp-branding-box').css('display','none');
                $('[name="'+myName+'"]').closest('table').siblings('.choose-slider-box').css('display','none');
                $('[name="'+myName+'"]').closest('table').siblings('.testimonials-box').css('display','none');
              }
           }else{
               switch (myValue) { 
                case '6':
                    $('[name="'+myName+'"]').closest('table').siblings('.npp-user-msg').html("You have selected to show the 'Page Links' component.");
                    $('[name="'+myName+'"]').closest('table').siblings('.npp-branding-box').css('display','none');  
                    $('[name="'+myName+'"]').closest('table').siblings('.testimonials-box').css('display','none');
                    $('[name="'+myName+'"]').closest('table').siblings('.page-links-box').css('display','block');
                break;
                case '7': 
                    $('[name="'+myName+'"]').closest('table').siblings('.npp-user-msg').html("You have selected to show the 'Recent Promotions' component.");
                    $('[name="'+myName+'"]').closest('table').siblings('.npp-branding-box').css('display','none');  
                    $('[name="'+myName+'"]').closest('table').siblings('.testimonials-box').css('display','none');
                    break;
                case '8': //Layer Slider
                    $('[name="'+myName+'"]').closest('table').siblings('.npp-user-msg').html("You have selected to show a Layer Slider.");
                    $('[name="'+myName+'"]').closest('table').siblings('.npp-branding-box').css('display','none');
                    $('[name="'+myName+'"]').closest('table').siblings('.testimonials-box').css('display','none');
                    $('[name="'+myName+'"]').closest('table').siblings('.choose-slider-box').css('display','block');
                    break;
                case '9': 
                    $('[name="'+myName+'"]').closest('table').siblings('.npp-user-msg').html("You have selected to show the 'Icon Definitions' component.");
                    $('[name="'+myName+'"]').closest('table').siblings('.npp-user-msg').css('display','none');
                    $('[name="'+myName+'"]').closest('table').siblings('.npp-branding-box').css('display','none');
                    break;      
                case '10': 
                    $('[name="'+myName+'"]').closest('table').siblings('.npp-user-msg').html("You have selected to show the 'Testimonials' component.");
                    $('[name="'+myName+'"]').closest('table').siblings('.choose-slider-box').css('display','none');
                    $('[name="'+myName+'"]').closest('table').siblings('.npp-branding-box').css('display','none');
                    $('[name="'+myName+'"]').closest('table').siblings('.testimonials-box').css('display','block');
                    break;
                case '11': 
                    $('[name="'+myName+'"]').closest('table').siblings('.npp-user-msg').html("You have selected to show the 'Become a Partner' component.");
                    $('[name="'+myName+'"]').closest('table').siblings('.npp-branding-box').css('display','none');
                    break;
                case '12': 
                    $('[name="'+myName+'"]').closest('table').siblings('.npp-user-msg').html("You have selected to show the 'Single Promotion' component.");
                    $('[name="'+myName+'"]').closest('table').siblings('.single-promo-box').css('display','block');
                    $('[name="'+myName+'"]').closest('table').siblings('.npp-branding-box').css('display','none');
                    break;
                default:
                    //alert('Nobody Wins!');
                }
                  $('[name="'+myName+'"]').closest('table').siblings('#customEditor-0').css('display','none');
                  $('[name="'+myName+'"]').closest('table').siblings('#customEditor-1').css('display','none');
                  $('[name="'+myName+'"]').closest('table').siblings('#customEditor-2').css('display','none');
                  $('[name="'+myName+'"]').closest('table').siblings('#customEditor-3').css('display','none');
                  $('[name="'+myName+'"]').closest('table').siblings('.testimonials-box').css('display','none');
                  $('[name="'+myName+'"]').closest('table').siblings('.npp-user-msg').css('display','block');
           }
         }else {
          //console.log("something else");
         }
        
            
        });  //end event.target stuff
       

          $.each($('.no-cols'), function(index, value){        
             switch ($(this).val()) { 
            case '1':
                  $(this).siblings('#customEditor-0').css('display','block');
                  $(this).siblings('#customEditor-1').css('display','none');
                  $(this).siblings('#customEditor-2').css('display','none');
                  $(this).siblings('#customEditor-3').css('display','none');
              break;
            case '2':
            case '5':
                  $(this).siblings('#customEditor-0').css('display','block');
                  $(this).siblings('#customEditor-1').css('display','block');
                  $(this).siblings('#customEditor-2').css('display','none');
                  $(this).siblings('#customEditor-3').css('display','none');
              break;
            case '3':
                  $(this).siblings('#customEditor-0').css('display','block');
                  $(this).siblings('#customEditor-1').css('display','block');
                  $(this).siblings('#customEditor-2').css('display','block');
                  $(this).siblings('#customEditor-3').css('display','none');
              break;
            case '4':
                  $(this).siblings('#customEditor-0').css('display','block');
                  $(this).siblings('#customEditor-1').css('display','block');
                  $(this).siblings('#customEditor-2').css('display','block');
                  $(this).siblings('#customEditor-3').css('display','block');
               break;
            case '6':
                  $(this).siblings('#customEditor-0').css('display','none');
                  $(this).siblings('#customEditor-1').css('display','none');
                  $(this).siblings('#customEditor-2').css('display','none');
                  $(this).siblings('#customEditor-3').css('display','none');
                  $(this).next().html("You have selected to show the 'Page Links' component.");
                  $(this).siblings('.page-links-box').css('display','block');
              break;
            case '7': 
                  $(this).siblings('#customEditor-0').css('display','none');
                  $(this).siblings('#customEditor-1').css('display','none');
                  $(this).siblings('#customEditor-2').css('display','none');
                  $(this).siblings('#customEditor-3').css('display','none');
                  $(this).next().html("You have selected to show the 'Recent Promotions' component.");
                  $(this).next().css('display','block');
                break;
            case '8': 
                  $(this).siblings('#customEditor-0').css('display','none');
                  $(this).siblings('#customEditor-1').css('display','none');
                  $(this).siblings('#customEditor-2').css('display','none');
                  $(this).siblings('#customEditor-3').css('display','none');
                  $(this).next().html("You have selected to show a Layer Slider.");
                  $(this).siblings('.choose-slider-box').css('display','block');
                break;
            case '9':  //icon definition list
                  $(this).siblings('#customEditor-0').css('display','none');
                  $(this).siblings('#customEditor-1').css('display','none');
                  $(this).siblings('#customEditor-2').css('display','none');
                  $(this).siblings('#customEditor-3').css('display','none');
                  $(this).next().html("You have selected to show the 'Icon Definitions' component.");
                  $(this).next().css('display','block');
                  $(this).siblings('.npp-branding-box').css('display','none');
                break;      
            case '10': 
                  $(this).siblings('#customEditor-0').css('display','none');
                  $(this).siblings('#customEditor-1').css('display','none');
                  $(this).siblings('#customEditor-2').css('display','none');
                  $(this).siblings('#customEditor-3').css('display','none');
                  $(this).next().html("You have selected to show the 'Testimonials' component.");
                  //$(this).next().css('display','none');
                  $(this).siblings('.testimonials-box').css('display','block');
                  
                break;
            case '11': 
                  $(this).siblings('#customEditor-0').css('display','none');
                  $(this).siblings('#customEditor-1').css('display','none');
                  $(this).siblings('#customEditor-2').css('display','none');
                  $(this).siblings('#customEditor-3').css('display','none');
                  $(this).next().html("You have selected to show the 'Become a Partner' component.");
                  $(this).next().css('display','block');
                break;
            case '12': 
                  $(this).siblings('#customEditor-0').css('display','none');
                  $(this).siblings('#customEditor-1').css('display','none');
                  $(this).siblings('#customEditor-2').css('display','none');
                  $(this).siblings('#customEditor-3').css('display','none');
                  $(this).next().html("You have selected to show the 'Single Promotion' component.");
                  //$(this).next().css('display','block');
                  $(this).siblings('.testimonials-box').css('display','none');
                  $(this).siblings('.single-promo-box').css('display','block');
                break;
            default:              
                $(this).siblings('#customEditor-0').css('display','block');
                 $(this).siblings('#customEditor-1').css('display','none');
                  $(this).siblings('#customEditor-2').css('display','none');
                  $(this).siblings('#customEditor-3').css('display','none');
                break;
            }
             
          });
       
           
           
        });
    /* ]]> */</script><?php
}




