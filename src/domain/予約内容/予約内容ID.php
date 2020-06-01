<?php
namespace domain\予約内容;

class 予約内容ID {
    private int $_id;

    function __construct(int $_id) { $this->_id = $_id; }
    public static function create(int $_id) : 予約内容ID {
        return new 予約内容ID($_id);
    }
    public function equals($_id) : bool {

        if (($_id instanceof 予約内容ID) == false)
            return false;

        return $this == $_id; 
    }
    public function __set($name, $value) {
        throw new \Exception('予約内容ID:許可していません。: ' . $name);
    }
    public function __get($name) {
        switch ($name) {
            case "ID": return $this->_id;
            case "ID文字列": return (string)$this->_id;
            default: throw new \Exception('予約内容ID:公開していません。: ' . $name);
        }
    }
}
