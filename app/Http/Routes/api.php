<?php

/**
 * @var $router FluentCrud\App\Http\Router
 */

$router->get('/welcome', 'WelcomeController@index');

$router->prefix('authors')->group(function($router) {
    $router->get('/', 'AuthorController@index');
    $router->post('/', 'AuthorController@store');
    $router->get('/{id}', 'AuthorController@show');
    $router->put('/{id}', 'AuthorController@update');
    $router->delete('/{id}', 'AuthorController@destroy');
});

$router->prefix('books')->group(function($router) {
    $router->get('/', 'BookController@index');
    $router->post('/', 'BookController@store');
    $router->get('/{id}', 'BookController@show');
    $router->put('/{id}', 'BookController@update');
    $router->delete('/{id}', 'BookController@destroy');
});
