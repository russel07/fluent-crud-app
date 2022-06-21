<?php

/**
 * @var $router FluentCrud\App\Http\Router
 */

$router->get('/welcome', 'WelcomeController@index');

$router->get('authors', 'AuthorController@index');
