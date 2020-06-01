<?php
namespace domain\会議室;

class 貸与可能期間至 {
    private int $_hour;

    function __construct(int $_hour) { $this->_hour = $_hour; }
    public static function create(int $_hour) : 貸与可能期間至 {
        if ($_hour < 0 || $_hour > 23)
            throw new \Exception("貸与可能期間至:0から23の数値のみ有効です。");

        return new 貸与可能期間至($_hour);
    }
    public function 年月日(\DateTime $_date) : \DateTime {
        $tmp = clone $_date;
        $tmp = $tmp->setTime($this->_hour, 0, 0);// 24を入れると次の日になる.
        return $tmp;
    }
    public function equals($_hour) : bool {

        if (($_hour instanceof 貸与可能期間至) == false)
            return false;

        return $this == $_hour; 
    }
    public function __set($name, $value) {
        throw new \Exception('貸与可能期間至:許可していません。: ' . $name);
    }
    public function __get($name) {
        switch ($name) {
            case "時間": return $this->_hour;
            case "時分": return str_pad($this->_hour, 2, 0, STR_PAD_LEFT) . ":00";
            default: throw new \Exception('貸与可能期間至:公開していません。: ' . $name);
        }
    }
}
