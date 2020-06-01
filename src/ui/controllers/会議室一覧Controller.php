<?php
namespace ui\controllers;

require __DIR__ . '/../../vendor/autoload.php';

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;
use app\利用者\I会議室を検索する;

class 会議室一覧Controller
{
    private PhpRenderer $renderer;
    private I会議室を検索する $会議室を検索する;

    public function __construct(ContainerInterface $container) {
        
        $this->renderer = $container->get("PhpRenderer");
        $this->会議室を検索する = $container->get("I会議室を検索する");
    }

    public function __invoke(Request $request, Response $response, $args) {

        if (array_key_exists("利用者ID", $_SESSION) == false)
            return $this->renderer->render($response, "ログイン.php", $args);

        $会議室一覧 = $this->会議室を検索する->検索();
        $args["会議室一覧"] = $会議室一覧;

        return $this->renderer->render($response, "会議室一覧.php", $args);
    }
}