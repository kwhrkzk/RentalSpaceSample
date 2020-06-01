<?php
namespace impl\利用者;

require_once __DIR__ . "/../../vendor/autoload.php";

use app\利用者\Iログインする;
use domain\利用者\利用者ID;

class ログインする implements Iログインする {
    function __construct() { 
    }

    public function ログイン(利用者ID $_利用者ID) : bool
    {
        return true;
    }
}