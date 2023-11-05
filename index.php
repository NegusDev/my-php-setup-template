<?php
require_once 'src/require.php';
use controllers\pagesController;
use core\Router;



Router::get('/',pagesController::class.'@index');

Router::get('/home',pagesController::class.'@home');

Router::get('/about', 'about page');


Router::addNotFoundHandler(function () {
    echo 'Not Found';
});



Router::run();