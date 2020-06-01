<?php
namespace domain\会議室;

class 住所 {
    private string $_name;

    function __construct(string $_name) { $this->_name = $_name; }
    public static function create(string $_name) : 住所 {
        if (mb_strlen($_name, 'UTF-8') > 100)
            throw new \Exception("住所:100文字以下でなければなりません。:" . $_name);

        return new 住所($_name);
    }
    public function equals($_name) : bool {

        if (($_name instanceof 住所) == false)
            return false;

        return $this == $_name; 
    }
    public function __set($name, $value) {
        throw new \Exception('住所:許可していません。: ' . $name);
    }
    public function __get($name) {
        switch ($name) {
            case "名称": return $this->_name;
            default: throw new \Exception('住所:公開していません。: ' . $name);
        }
    }
}
