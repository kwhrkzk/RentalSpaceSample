<?php
namespace impl\利用者;

require_once __DIR__ . "/../../vendor/autoload.php";

use app\利用者\I会議室を検索する;
use domain\会議室\住所;
use domain\会議室\会議室;
use infra\会議室Repository;

class 会議室を検索する implements I会議室を検索する {
    private 会議室Repository $会議室Repository;

    function __construct(会議室Repository $会議室Repository) { 
        $this->会議室Repository = $会議室Repository;
    }

    public function 検索() : array/* 会議室 */ {
        return $this->会議室Repository->all();
    }
}