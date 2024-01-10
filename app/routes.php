<?php

global $router;

$router->Get('/', 'HomeController@index');
$router->Get('/listings', 'ListingsController@index');
$router->Post('/listings', 'ListingsController@store');
$router->Get('/listing/{id}', 'ListingsController@show' );
$router->Get('/listings/create', 'ListingsController@create');

$router->Get('/not-found', 'ErrorController@Error404');
