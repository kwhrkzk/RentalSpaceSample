<?php
namespace domain\予約内容;

class 貸与期間自 {
    private \DateTime $_date;

    function __construct(\DateTime $_date) { $this->_date = $_date; }
    public static function create(\DateTime $_date) : 貸与期間自 {
        $tmp = clone $_date;
        $tmp = $tmp->setTime($tmp->format('H'),0,0);
        return new 貸与期間自($tmp);
    }
    public static function createString(string $_date) : 貸与期間自 {
        $tmp = new \DateTime($_date);
        return new 貸与期間自($tmp);
    }
    public function equals($_date) : bool {

        if (($_date instanceof 貸与期間自) == false)
            return false;

        return $this == $_date; 
    }
    public function __set($name, $value) {
        throw new \Exception('貸与期間自:許可していません。: ' . $name);
    }
    public function __get($name) {
        switch ($name) {
            case "date": return $this->_date;
            case "YmdHis": return $this->_date->format("Y-m-d H:i:s");
            default: throw new \Exception('貸与期間自:公開していません。: ' . $name);
        }
    }
}
