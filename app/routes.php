<?php

global $router;

//Home Routes
$router->Get('/', 'HomeController@index');

//Listings Routes
$router->Get('/listings', 'ListingsController@index');
$router->Post('/listings', 'ListingsController@store');
$router->Get('/listings/{id}', 'ListingsController@show' );
$router->Get('/listings/create', 'ListingsController@create');
$router->Delete('/listings/{id}', 'ListingsController@destroy');
$router->Get('/listings/edit/{id}', 'ListingsController@edit');
$router->Put('/listings/{id}', 'ListingsController@update');


//Error Routes
$router->Get('/not-found', 'ErrorController@Error404');


//Auth Routes
$router->Get('/auth/login', 'Authcontroller@login');
$router->Get('/auth/register', 'AuthController@register');
$router->Post('/auth/register', 'AuthController@store');
$router->Post('/auth/login', 'AuthController@attemptLogin');