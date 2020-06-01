<?php
namespace ui\controllers;

require __DIR__ . '/../../vendor/autoload.php';

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;
use app\利用者\I会議室を予約する;
use domain\会議室\会議室ID;
use domain\利用者\利用者ID;
use infra\会議室Repository;
use domain\予約内容\貸与期間;
use domain\予約内容\貸与期間自;
use domain\予約内容\貸与期間至;
use domain\予約内容\予約受付日;

class 会議室詳細Controller
{
    private PhpRenderer $renderer;
    private I会議室を予約する $会議室を予約する;
    private 会議室Repository $会議室Repository;

    public function __construct(ContainerInterface $container) {
        $this->renderer = $container->get("PhpRenderer");
        $this->会議室を予約する = $container->get("I会議室を予約する");
        $this->会議室Repository = $container->get("会議室Repository");
    }

    public function show(Request $request, Response $response, $args) {

        if (array_key_exists("利用者ID", $_SESSION) == false)
            return $this->renderer->render($response, "ログイン.php", $args);

        if (array_key_exists("id", $args) == false)
            return $this->errorResponse($response, 'idの指定が必要です。');

        try {
            $args["会議室"] = $this->会議室Repository->first(会議室ID::create($args["id"]));
        } catch(\Exception $ex) {
            return $this->errorResponse($response, $ex->getMessage());
        }

        return $this->renderer->render($response, "会議室詳細.php", $args);
    }

    public function submit(Request $request, Response $response, $args) {

        if (array_key_exists("利用者ID", $_SESSION) == false)
            return $this->renderer->render($response, "ログイン.php", $args);

        if (array_key_exists("貸与期間自日付", $_POST) == false)
            return $this->errorResponse($response, "貸与期間自日付が設定されていません。");
        if (array_key_exists("貸与期間自時間", $_POST) == false)
            return $this->errorResponse($response, "貸与期間自時間が設定されていません。");
        if (array_key_exists("貸与期間至日付", $_POST) == false)
            return $this->errorResponse($response, "貸与期間至日付が設定されていません。");
        if (array_key_exists("貸与期間至時間", $_POST) == false)
            return $this->errorResponse($response, "貸与期間至時間が設定されていません。");
        if (array_key_exists("会議室ID", $_POST) == false)
            return $this->errorResponse($response, "会議室IDが設定されていません。");

        try {
            $貸与期間 = 貸与期間::create(
                貸与期間自::create(\DateTime::createFromFormat("Y年m月d日 H:i", $_POST["貸与期間自日付"] . " " . $_POST["貸与期間自時間"]))
                , 貸与期間至::create(\DateTime::createFromFormat("Y年m月d日 H:i", $_POST["貸与期間至日付"] . " " . $_POST["貸与期間至時間"]))
            );
        } catch (\Exception $ex) {
            return $this->errorResponse($response, $ex->getMessage());
        }

        $利用者ID = 利用者ID::create($_SESSION["利用者ID"]);
        $会議室ID = 会議室ID::create($_POST["会議室ID"]);

        $str = $this->会議室を予約する->予約(予約受付日::今日(), $貸与期間, $会議室ID, $利用者ID);

        if ($str != null) {
            try {
                $_POST["会議室"] = $this->会議室Repository->first($会議室ID);
            } catch(\Exception $ex) {
                return $this->errorResponse($response, $ex->getMessage());
            }
            $_POST["エラーメッセージ"] = $str;
            return $this->renderer->render($response, "会議室詳細.php", $_POST);
        } else {
            return $response->withHeader('Location', '/list')->withStatus(302);
        }
    }

    function errorResponse(Response $response, string $message) {
        $response = $response->withStatus(400);
        $body = $response->getBody();
        $body->write($message);
        return $response;
    }
}