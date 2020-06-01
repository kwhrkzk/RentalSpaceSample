<?php
namespace domain\会議室;

class 収容人数 {
    private ?int $_people;

    function __construct(?int $_people) { $this->_people = $_people; }
    public static function create(?int $_people) : 収容人数 {
        return new 収容人数($_people);
    }
    public function equals($_people) : bool {

        if (($_people instanceof 収容人数) == false)
            return false;

        return $this == $_people; 
    }
    public function __set($name, $value) {
        throw new \Exception('収容人数:許可していません。: ' . $name);
    }
    public function __get($name) {
        switch ($name) {
            case "人数": return isset($this->_people) ? $this->_people : null;
            default: throw new \Exception('収容人数:公開していません。: ' . $name);
        }
    }
}
