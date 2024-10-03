<?php
require_once 'src/require.php';
use controllers\pagesController;
use controllers\TestController;
use core\Router;


Router::get('/',pagesController::class.'@index');

Router::get('/home',pagesController::class.'@home');

Router::get('/about', 'about page');

Router::get('/students/{id}', function ($params) {
  echo "Student ID: " . $params['id'];
});

Router::get('/courses', TestController::class.'@index');

Router::get('/courses/{id}', function ($params) {
  return (new TestController())->show((int) $params['id']);
});

Router::addNotFoundHandler(function () {
    echo 'Not Found';
});



Router::run();
