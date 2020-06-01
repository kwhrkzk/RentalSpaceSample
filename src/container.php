<?php

require_once __DIR__ . "/vendor/autoload.php";

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use function DI\create;
use function DI\get;
use function DI\factory;
use Slim\Views\PhpRenderer;

function getContainer() {
    $builder = new ContainerBuilder();

    $builder->addDefinitions([
        "PhpRenderer" => function (ContainerInterface $c) {
            return new PhpRenderer(__DIR__ . '/ui/views');
        },
        'Iログインする' => DI\create('impl\利用者\ログインする'),
        'ログインController' => DI\create('ui\controllers\ログインController'),
        "ConnectionString" => "host=postgres port=5432 dbname=rentaldb user=postgres password=post",
        "会議室Factory" => DI\create('infra\会議室Factory'),
        "会議室Repository" => DI\create('infra\会議室Repository')->constructor(DI\get('ConnectionString'), DI\get('会議室Factory')),
        "利用者Repository" => DI\create('infra\利用者Repository')->constructor(DI\get('ConnectionString')),
        "予約内容Repository" => DI\create('infra\予約内容Repository')->constructor(DI\get('ConnectionString')),
        "I会議室を検索する" => DI\create('impl\利用者\会議室を検索する')->constructor(DI\get('会議室Repository')),
        "I会議室を予約可能か" => DI\create('impl\利用者\会議室を予約可能か')->constructor(DI\get('予約内容Repository')),
        "I会議室を予約する" => DI\create('impl\利用者\会議室を予約する')->constructor(DI\get('会議室Repository'), DI\get('利用者Repository'), DI\get('予約内容Repository'), DI\get('I会議室を予約可能か')),
        '会議室一覧Controller' => DI\create('ui\controllers\会議室一覧Controller'),
    ]);

    return $builder->build();
}
