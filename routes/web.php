<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('home');
});

	$router->group( [ 'middleware' => [ 'web' ] ], function( $router ) {

		$router->get( '/', [ 'as' => 'home', 'uses' => 'HomeController@getIndex'] );
		$router->get( 'admin', [ 'as' => 'admin', 'uses' => 'AdminController@getIndex' ] );

		$router->get( 'test', [ 'uses' => 'HomeController@getTest'] );

		// User account routes
		\App\Models\User\User::routes();

		// Blog routes
		// \App\Models\Blog\Blog::routes();

        // Catch-all route. This line MUST appear at the very end of this file.
        $router->get( '{all}', 'HomeController@getWildcard' )->where( 'all', '.*' );

	});