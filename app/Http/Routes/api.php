<?php

/**
 * @var $router FluentCrud\App\Http\Router
 */

$router->get('/welcome', 'WelcomeController@index');

$router->prefix('authors')->group(function($router) {
    $router->get('/', 'AuthorController@index');
    $router->post('/', 'AuthorController@store');
    $router->put('/{id}', 'AuthorController@update');
    $router->delete('/{id}', 'AuthorController@destroy');
});
