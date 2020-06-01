<?php
namespace domain\利用者;

class 利用者ID {
    private int $_id;

    function __construct(int $_id) { $this->_id = $_id; }
    public static function create(int $_id) : 利用者ID {
        return new 利用者ID($_id);
    }
    public function equals($_id) : bool {

        if (($_id instanceof 利用者ID) == false)
            return false;

        return $this == $_id; 
    }
    public function __set($name, $value) {
        throw new \Exception('利用者ID:許可していません。: ' . $name);
    }
    public function __get($name) {
        switch ($name) {
            case "ID": return $this->_id;
            case "ID文字列": return (string)$this->_id;
            default: throw new \Exception('利用者ID:公開していません。: ' . $name);
        }
    }
}
