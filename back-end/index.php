<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

include_once('./app/controllers/UserController.php');
include_once('./app/controllers/BoardController.php');
include_once('./app/controllers/ColumnController.php');
include_once('./app/controllers/TaskController.php');
require './vendor/autoload.php';

$app = new \Slim\App;

//User
$app->post('/auth', 'UserController:authenticate');
$app->post('/user', 'UserController:insert');


//Board
$app->group('/board', function () use ($app) {
    $app->get('', 'BoardController:findAll');
    $app->post('', 'BoardController:insert');

    $app->get('/{id}', 'BoardController:findById');
    $app->put('/{id}', 'BoardController:update');
    $app->delete('/{id}', 'BoardController:delete');
})->add('UserController:tokenValidate');


//Column
$app->group('/task', function () use ($app) {
    $app->get('', 'ColumnController:findAll');
    $app->post('', 'ColumnController:insert');

    $app->get('/{id}', 'ColumnController:findById');
    $app->put('/{id}', 'ColumnController:update');
    $app->delete('/{id}', 'ColumnController:delete');
})->add('UserController:tokenValidate');


//Task
$app->group('/task', function () use ($app) {
    $app->get('', 'TaskController:findAll');
    $app->post('', 'TaskController:insert');

    $app->get('/{id}', 'TaskController:findById');
    $app->put('/{id}', 'TaskController:update');
    $app->delete('/{id}', 'TaskController:delete');
})->add('UserController:tokenValidate');


$app->run();