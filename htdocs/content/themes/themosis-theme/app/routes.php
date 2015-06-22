<?php

/*
 * Define your routes and which views to display
 * depending of the query.
 *
 * Based on WordPress conditional tags from the WordPress Codex
 * http://codex.wordpress.org/Conditional_Tags
 *
 */

Route::get('home', function(){

    return View::make('welcome');

});

Route::get('page', array('test', function(){

    return View::make('pages.test', array('name' => 'Amy'));

}));

// The view composer.
// Use same syntax as for controllers.
View::composer('templates.products', 'MindBodyController@updateProducts');

/*Load Assets*/
// Load a CSS file stored in app/assets/css/screen.css
Asset::add('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', false, '1.0', 'all');
Asset::add('bootstrap', 'css/bootstrap.css', false, '1.0', 'all');
Asset::add('bootstrap-theme', 'css/bootstrap-theme.css', false, '1.0', 'all');
Asset::add('normalize-styles', 'css/normalize.css', false, '1.0', 'all');
Asset::add('main-styles', 'css/main.css', false, '1.0', 'all');

Asset::add('modernizr', 'js/vendor/modernizr-2.8.3.min.js');

/**************************************************************
 * Routes to page templates
 **************************************************************/
/*
 * 'custom-template',
        'general-template',
        'products-template',
        'post-template',
        'post-detail-template',
 */
Route::get('template', array('general-template', function(){

    return View::make('templates.page', array('name' => 'Amy'));

}));
Route::get('template', array('products-template', function(){

    return View::make('templates.products', array('name' => 'Amy'));

}));
Route::get('template', array('post-template', function(){

    return View::make('templates.post', array('name' => 'Amy'));

}));
Route::get('template', array('post-detail-template', function(){

    return View::make('templates.post-detail', array('name' => 'Amy'));

}));