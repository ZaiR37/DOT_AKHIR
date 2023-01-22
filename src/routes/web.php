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

$router->group(['prefix' => 'api/v1/books'], function() use ($router){
    $router->get('/', ['uses' => 'BookController@index']);
	$router->post('/', ['uses' => 'BookController@store']);
    $router->get('/kategori/{nama_kategori}', ['uses' => 'BookController@show_kategori']);
	$router->get('/{id}', ['uses' => 'BookController@show_id']);
	$router->delete('/{id}', ['uses' => 'BookController@destroy']);
	$router->put('/{id}', ['uses' => 'BookController@update']);
});

$router->group(['prefix' => 'api/v1/users'], function() use ($router){
    $router->get('/', ['uses' => 'UserController@index']);
	$router->post('/', ['uses' => 'UserController@store']);
	$router->get('/{id}', ['uses' => 'UserController@show_id']);
	$router->put('/{id}', ['uses' => 'UserController@update']);
	$router->delete('/{id}', ['uses' => 'UserController@destroy']);
});

$router->group(['prefix' => 'api/v1/history'], function() use ($router){
    $router->get('/', ['uses' => 'LogPeminjamanController@index']);
	$router->post('/', ['uses' => 'LogPeminjamanController@store']);
    $router->get('/detail', ['uses' => 'LogPeminjamanController@detail']);
    $router->get('/detail/{id}', ['uses' => 'LogPeminjamanController@detail_id']);
	$router->get('/{id}', ['uses' => 'LogPeminjamanController@show_id']);
	$router->put('/{id}', ['uses' => 'LogPeminjamanController@update']);
	$router->delete('/{id}', ['uses' => 'LogPeminjamanController@destroy']);
});