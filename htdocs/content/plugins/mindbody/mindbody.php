<?php
/**
 * @package Mindbody
 */
/*
   Plugin Name: Mindbody Product Catalog
   Plugin URI: http://www.github.com/amylashley
   Description: A plugin to manage a Mindbody Product Catalog remotely
   Version: 0.1
   Author: Amy Lashley
   Author URI: http://amylashley.net
   License: GPL2
   */
defined( 'ABSPATH' ) or die( 'Get Outta Here!' );



//Don't expose me! I'm shy..
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'MB_PRODUCTS_VERSION', '0.0.1' );
define( 'MB_PRODUCTS__MINIMUM_WP_VERSION', '3.2' );
define( 'MB_PRODUCTS__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'MB_PRODUCTS__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

register_activation_hook( __FILE__, array( 'Mindbody', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'Mindbody', 'plugin_deactivation' ) );

require_once( MB_PRODUCTS__PLUGIN_DIR . 'class.mindbody.php' );
require_once( MB_PRODUCTS__PLUGIN_DIR . 'class.mindbody-products.php' );

add_action( 'init', array( 'Mindbody', 'init' ) );
add_action( 'init', array( 'Mindbody_Products', 'init' ));

if ( is_admin() ) {
    //Set up the Settings Page
    require_once( MB_PRODUCTS__PLUGIN_DIR . 'class.mindbody-admin.php' );
    add_action( 'init', array( 'Mindbody_Admin', 'init' ) );
}

add_action( 'init', 'mb_script_enqueuer' );

function mb_script_enqueuer() {
   wp_register_script( "mb_script", MB_PRODUCTS__PLUGIN_DIR.'_inc/mb_products.js', array('jquery') );
   wp_localize_script( 'mb_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        

   //wp_enqueue_script( 'jquery' );
   wp_enqueue_script( 'mb_script' );

}

//For AJAX calls
add_action('wp_ajax_UPDATE_PROD', array( 'Mindbody_Products', 'update_products' ));

//Create Database lookup table (if it doesn't exist) during activation
register_activation_hook( __FILE__, array( 'Mindbody', 'create_lookup' ) );








