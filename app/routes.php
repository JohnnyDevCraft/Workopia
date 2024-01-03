<?php

global $router;

$router->Get('/', 'controllers/home.php');

$router->Get('/listings', 'controllers/listings/index.php');

$router->Get('/listings/create', 'controllers/listings/create.php');

$router->Get('404', 'controllers/error/404.php');