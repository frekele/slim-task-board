<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

include_once('app/controllers/UserController.php');
include_once('app/controllers/BoardController.php');
include_once('app/controllers/ColumnController.php');
include_once('app/controllers/TaskController.php');
require './vendor/autoload.php';

$config = [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

    ],
];

$app = new \Slim\App($config);

//User
$app->post('/sign-in', 'UserController:authenticate');
$app->post('/sign-up', 'UserController:insert');
$app->post('/validate-token', 'UserController:validateTokenAndFindUser');

//Board
$app->group('/board', function () use ($app) {
    $app->post('', 'BoardController:insert');
    $app->put('/{id}', 'BoardController:update');
    $app->delete('/{id}', 'BoardController:delete');
    $app->get('', 'BoardController:findAll');
    $app->get('/{id}', 'BoardController:findById');
})->add('UserController:tokenValidate');


//Column
$app->group('/column', function () use ($app) {
    $app->post('', 'ColumnController:insert');
    $app->put('/{id}', 'ColumnController:update');
    $app->delete('/{id}', 'ColumnController:delete');
    $app->get('', 'ColumnController:findAll');
    $app->get('/{id}', 'ColumnController:findById');
    $app->get('/board/{boardId}', 'ColumnController:findByBoardId');
})->add('UserController:tokenValidate');


//Task
$app->group('/task', function () use ($app) {
    $app->post('', 'TaskController:insert');
    $app->put('/{id}', 'TaskController:update');
    $app->delete('/{id}', 'TaskController:delete');
    $app->get('', 'TaskController:findAll');
    $app->get('/{id}', 'TaskController:findById');
    $app->get('/column/{columnId}', 'TaskController:findByColumnId');
    $app->get('/assigned-user/{assignedUserId}', 'TaskController:findByAssignedUserId');
})->add('UserController:tokenValidate');


$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS, HEAD');
});


$app->run();