<?php
namespace app\利用者;

require_once __DIR__ . "/../../vendor/autoload.php";

use domain\利用者\利用者ID;

interface Iログインする {
    public function ログイン(利用者ID $_利用者ID) : bool;
}