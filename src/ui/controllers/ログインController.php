<?php
namespace ui\controllers;

require __DIR__ . '/../../vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;
use Slim\Views\PhpRenderer;
use app\利用者\Iログインする;
use domain\利用者\利用者ID;

class ログインController
{
    private PhpRenderer $renderer;
    private Iログインする $ログインする;

    public function __construct(ContainerInterface $container) {
        $this->renderer = $container->get("PhpRenderer");
        $this->ログインする = $container->get("Iログインする");
    }

    public function __invoke(Request $request, Response $response, $args) {

        if (array_key_exists("id", $args) == false)
            return $this->renderer->render($response, "ログイン.php", $args);

        $id = 利用者ID::create($args["id"]);
        $ret = $this->ログインする->ログイン($id);

        if ($ret) {
            $_SESSION["利用者ID"] = $id->ID;
            return $response->withHeader('Location', '/list')->withStatus(302);
        }
        else {
            return $this->renderer->render($response, "ログイン.php", $args);
        }
    }
}