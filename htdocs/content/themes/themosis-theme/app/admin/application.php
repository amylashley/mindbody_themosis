<?php

/**
 * application.php - Write your custom code below.
 */

/*Load Assets*/
// Load a CSS file stored in app/assets/css/screen.css
Asset::add('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', false, '1.0', 'all');
Asset::add('bootstrap-styles', 'css/bootstrap.css', false, '1.0', 'all');
Asset::add('bootstrap-theme', 'css/bootstrap-theme.css', false, '1.0', 'all');
Asset::add('normalize-styles', 'css/normalize.css', false, '1.0', 'all');
Asset::add('main-styles', 'css/main.css', false, '1.0', 'all');

//JS files
//Standard Use of enqueue: wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
Asset::add('modernizr-js', 'js/vendor/modernizr-2.8.3.min.js', false, '2.8.3');
Asset::add('plugin-js', 'js/plugins.js', array('jquery'), '1.0', true);
Asset::add('bootstrap-js', 'js/bootstrap.js', false, '1.0', true);
Asset::add('tsiv-main', 'js/main-min.js', array('jquery'), '1.0', true);

//Register Navigation
register_nav_menus( array(
	'footer_left_menu' => 'Footer Left Menu',
        'footer_center_menu' => 'Footer Center Menu',
        'footer_right_menu' => 'Footer Right Menu',
        'footer_fullwidth_menu' => 'Footer Full Width Menu',
        'social_media' => 'Social Media Links'
) );

/*
 * Create Custom Post Types here
 * TODO: do we need to move these out to separate files? Maybe if this gets too long
 */

/*Testimonials*/
PostType::make('testimonials', 'Testimonials', 'Testimonial')->set(array(

    'public'        => true,
    'menu_position' => 20,
    'supports'      => array('title'),
    'rewrite'       => false,
    'query_var'     => false

    ));

$fields = array(
    Field::text('client'),
    Field::text('company'),
    Field::textarea('quote'),
);

// A metabox object is always returned in order to be able to chain methods.
Metabox::make('Testimonial Details', 'testimonials')->set($fields);

/********* END Testimonials ************/

/*Icons*/
PostType::make('icon', 'Icons', 'Icon')->set(array(

    'public'        => true,
    'menu_position' => 20,
    'show_in_nav_menus' => false,
    'supports'      => array('title','editor','thumbnail'),
    'rewrite'       => false,
    'query_var'     => false

    ));


/********* END Icons ************/

/*Staff Bios*/
PostType::make('staff', 'Staff', 'Staff')->set(array(

    'public'        => true,
    'menu_position' => 20,
    'show_in_nav_menus' => false,
    'supports'      => array('title','editor','excerpt', 'thumbnail','page-attributes'),
    'rewrite'       => false,
    'query_var'     => false

    ));


/********* END Icons ************/


/*Promotions*/
/*
 * Right now promotions will just be a post category, but leave this here in 
 * case Mike changes his mind.
 */
/*PostType::make('promotions', 'Promotions', 'Promotion')->set(array(

    'public'        => true,
    'menu_position' => 20,
    'supports'      => array('title', 'editor', 'excerpt', 'thumbnail'),
    'rewrite'       => false,
    'query_var'     => false

    ));

$fields = array(
    Field::text('client'),
    Field::text('company'),
    Field::textarea('quote'),
);

// A metabox object is always returned in order to be able to chain methods.
Metabox::make('P Details', 'testimonials')->set($fields);
*/
/********* END Promotions ************/