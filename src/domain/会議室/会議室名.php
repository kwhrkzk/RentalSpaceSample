<?php
namespace domain\会議室;

class 会議室名 {
    private string $_name;

    function __construct(string $_name) { $this->_name = $_name; }
    public static function create(string $_name) : 会議室名 {
        if (mb_strlen($_name, 'UTF-8') > 30)
            throw new \Exception("会議室名:30文字以下でなければなりません。:" . $_name);

        return new 会議室名($_name);
    }
    public function equals($_name) : bool {

        if (($_name instanceof 会議室名) == false)
            return false;

        return $this == $_name; 
    }
    public function __set($name, $value) {
        throw new \Exception('会議室名:許可していません。: ' . $name);
    }
    public function __get($name) {
        switch ($name) {
            case "名称": return $this->_name;
            default: throw new \Exception('会議室名:公開していません。: ' . $name);
        }
    }
}
