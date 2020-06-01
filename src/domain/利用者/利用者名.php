<?php
namespace domain\利用者;

class 利用者名 {
    private string $_name;

    function __construct(string $_name) { $this->_name = $_name; }
    public static function create(string $_name) : 利用者名 {
        if (mb_strlen($_name, 'UTF-8') > 10)
            throw new \Exception("利用者名:10文字以下でなければなりません。:" . $_name);

        return new 利用者名($_name);
    }
    public function equals($_name) : bool {

        if (($_name instanceof 利用者名) == false)
            return false;

        return $this == $_name; 
    }
    public function __set($name, $value) {
        throw new \Exception('利用者名:許可していません。: ' . $name);
    }
    public function __get($name) {
        switch ($name) {
            case "氏名": return $this->_name;
            default: throw new \Exception('利用者名:公開していません。: ' . $name);
        }
    }
}
