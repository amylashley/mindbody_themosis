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
//View::composer('templates.page', 'LayoutController@checkForCustomContent');
//Route::get('page', array('help', 'uses' => 'PagesController@help'));
Route::get('template', array('general-template','uses' => 'LayoutController@setupPage'));
Route::get('template', array('products-template','uses' => 'ProductsController@setupPage'));

Route::get('template', array('post-template', function(){

    return View::make('templates.post', array('name' => 'Amy'));

}));
Route::get('template', array('post-detail-template', function(){

    return View::make('templates.post-detail', array('name' => 'Amy'));

}));
