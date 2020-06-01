<?php
namespace domain\予約内容;

require_once __DIR__ . "/../../vendor/autoload.php";

use domain\会議室\会議室ID;
use domain\会議室\料金;
use domain\利用者\利用者ID;

class 予約内容 {
    private 予約内容ID $_予約内容ID;
    private 会議室ID $_会議室ID;
    private 利用者ID $_利用者ID;
    private 貸与期間 $_貸与期間;
    private 予約受付日 $_予約受付日;
    private 料金 $_料金;
    function __construct(
        予約内容ID $_予約内容ID,
        会議室ID $_会議室ID,
        利用者ID $_利用者ID,
        貸与期間 $_貸与期間,
        予約受付日 $_予約受付日,
        料金 $_料金
        ) {
            $this->_予約内容ID = $_予約内容ID;
            $this->_会議室ID = $_会議室ID;
            $this->_利用者ID = $_利用者ID;
            $this->_貸与期間 = $_貸与期間;
            $this->_予約受付日 = $_予約受付日;
            $this->_料金 = $_料金;
    }
    public function equals($_予約内容) : bool {

        if (($_予約内容 instanceof 予約内容) == false)
            return false;

        return $this == $_予約内容;
    }
    public function __set($name, $value) {
        throw new \Exception('予約内容:許可していません。: ' . $name);
    }
    public function __get($name) {
        switch ($name) {
            case "貸与期間タプル": return $this->_貸与期間->タプル;
            case "貸与期間YmdHis～YmdHis": return $this->_貸与期間->YmdHis～YmdHis;
            default: throw new \Exception('予約内容:公開していません。: ' . $name);
        }
    }
}
