<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../container.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;

session_start();

AppFactory::setContainer(getContainer());
$app = AppFactory::create();

$app->redirect("/", "/login");

$app->get('/login', 'ui\controllers\ログインController');
$app->get('/login/{id}', 'ui\controllers\ログインController');
$app->get('/list', 'ui\controllers\会議室一覧Controller');
$app->get('/space', 'ui\controllers\会議室詳細Controller'.':show');
$app->get('/space/{id}', 'ui\controllers\会議室詳細Controller'.':show');
$app->post('/space', 'ui\controllers\会議室詳細Controller'.':submit');

$app->run();