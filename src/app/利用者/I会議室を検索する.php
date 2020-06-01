<?php
namespace app\利用者;

require_once __DIR__ . "/../../vendor/autoload.php";

interface I会議室を検索する {
    public function 検索() : array/* 会議室 */;
}