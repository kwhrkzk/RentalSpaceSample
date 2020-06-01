<?php
namespace domain\利用者;

require_once __DIR__ . "/../../vendor/autoload.php";

use domain\利用者\利用者ID;

class 利用者 {
    private 利用者ID $_利用者ID;
    private 利用者名 $_利用者名;
    function __construct(
        利用者ID $_利用者ID,
        利用者名 $_利用者名
        ) {
            $this->_利用者ID = $_利用者ID; 
            $this->_利用者名 = $_利用者名; 
    }
    public static function create(int $_利用者ID, string $_利用者名) : 利用者 {
        return new 利用者(利用者ID::create($_利用者ID), 利用者名::create($_利用者名));
    }
    public function equals($_利用者) : bool {

        if (($_利用者 instanceof 利用者) == false)
            return false;

        return $this == $_利用者;
    }
    public function __set($name, $value) {
        throw new \Exception('利用者:許可していません。: ' . $name);
    }
    public function __get($name) {
        switch ($name) {
            case "氏名": return $this->_利用者名->氏名;
            default: throw new \Exception('利用者:公開していません。: ' . $name);
        }
    }
}
