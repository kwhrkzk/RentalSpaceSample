<?php
namespace domain\会議室;

class 会議室ID {
    private int $_id;

    function __construct(int $_id) { $this->_id = $_id; }
    public static function create(int $_id) : 会議室ID {
        return new 会議室ID($_id);
    }
    public function equals($_id) : bool {

        if (($_id instanceof 会議室ID) == false)
            return false;

        return $this == $_id; 
    }
    public function __set($name, $value) {
        throw new \Exception('会議室ID:許可していません。: ' . $name);
    }
    public function __get($name) {
        switch ($name) {
            case "ID": return $this->_id;
            case "ID文字列": return (string)$this->_id;
            default: throw new \Exception('会議室ID:公開していません。: ' . $name);
        }
    }
}
