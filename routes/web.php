<?php

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

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    $router->get(
        'catalog', ['uses' => 'CatalogController@index']
    );

    // Cart
    $router->group(['prefix' => 'cart'], function () use ($router) {
        $router->post(
            'add', ['uses' => 'CartController@add']
        );
        $router->post(
            'update', ['uses' => 'CartController@update']
        );
        $router->get(
            'count', ['uses' => 'CartController@count']
        );
        $router->get(
            'content', ['uses' => 'CartController@content']
        );
    });

    // Order
    $router->group(['prefix' => 'order'], function () use ($router) {
        $router->get(
            'create', ['uses' => 'OrderController@create']
        );
    });

    // Token
    $router->group(['prefix' => 'token'], function () use ($router) {
        $router->post(
            'issue', ['uses' => 'TokenController@issue']
        );
    });


});
