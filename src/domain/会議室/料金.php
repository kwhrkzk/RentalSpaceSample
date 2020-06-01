<?php
namespace domain\会議室;

require_once __DIR__ . "/../../vendor/autoload.php";

use domain\予約内容\貸与期間;

class 料金 {
    private int $_yen;

    function __construct(int $_yen) { $this->_yen = $_yen; }
    public static function create(int $_yen) : 料金 {
        return new 料金($_yen);
    }
    public function 貸与期間の合計料金(貸与期間 $_貸与期間) : int {
        return $_貸与期間->貸与期間の時間() * $this->_yen;
    }

    public function equals($_yen) : bool {

        if (($_yen instanceof 料金) == false)
            return false;

        return $this == $_yen; 
    }
    public function __set($name, $value) {
        throw new \Exception('料金:許可していません。: ' . $name);
    }
    public function __get($name) {
        switch ($name) {
            default: throw new \Exception('料金:公開していません。: ' . $name);
        }
    }
}
