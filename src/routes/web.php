<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api/books'], function() use ($router){
    $router->get('/', ['uses' => 'BookController@index']);
    $router->get('/kategori/{nama_kategori}', ['uses' => 'BookController@show_kategori']);
	$router->post('/', ['uses' => 'BookController@store']);
	$router->get('/{id}', ['uses' => 'BookController@show_id']);
	$router->delete('/{id}', ['uses' => 'BookController@destroy']);
	$router->put('/{id}', ['uses' => 'BookController@update']);
});