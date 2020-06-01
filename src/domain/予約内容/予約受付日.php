<?php
namespace domain\予約内容;

class 予約受付日 {
    private \DateTime $_date;

    function __construct(\DateTime $_date) { $this->_date = $_date; }
    public static function create(\DateTime $_date) : 予約受付日 {
        $tmp = clone $_date;
        $tmp = $tmp->setTime(0,0,0);
        return new 予約受付日($tmp);
    }
    public static function createString(string $_date) : 予約受付日 {
        $tmp = new \DateTime($_date);
        return new 予約受付日($tmp);
    }
    public static function 今日() : 予約受付日 {
        return 予約受付日::create(new \DateTime("NOW"));
    }
    public function equals($_date) : bool {

        if (($_date instanceof 予約受付日) == false)
            return false;

        return $this == $_date; 
    }
    public function __set($name, $value) {
        throw new \Exception('予約受付日:許可していません。: ' . $name);
    }
    public function __get($name) {
        switch ($name) {
            case "date": return $this->_date;
            case "Ymd": return $this->_date->format("Y-m-d");
            default: throw new \Exception('予約受付日:公開していません。: ' . $name);
        }
    }
}
