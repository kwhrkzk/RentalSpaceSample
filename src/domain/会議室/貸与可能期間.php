<?php
namespace domain\会議室;

require_once __DIR__ . "/../../vendor/autoload.php";

class 貸与可能期間 {
    private 貸与可能期間自 $_貸与可能期間自;
    private 貸与可能期間至 $_貸与可能期間至;

    function __construct(貸与可能期間自 $_貸与可能期間自, 貸与可能期間至 $_貸与可能期間至) { 
        $this->_貸与可能期間自 = $_貸与可能期間自;
        $this->_貸与可能期間至 = $_貸与可能期間至;
    }
    public static function create(貸与可能期間自 $_貸与可能期間自, 貸与可能期間至 $_貸与可能期間至) : 貸与可能期間 {
        return new 貸与可能期間($_貸与可能期間自, $_貸与可能期間至);
    }
    public static function createInt(int $_貸与可能期間自, int $_貸与可能期間至) : 貸与可能期間 {
        return new 貸与可能期間(貸与可能期間自::create($_貸与可能期間自), 貸与可能期間至::create($_貸与可能期間至));
    }
    public function 貸与可能期間DateTime(\DateTime $_date) : array/* [\DateTime, \DateTime] */ {
        $from = $this->_貸与可能期間自->年月日($_date);
        $to = $this->_貸与可能期間至->年月日($_date);
        return [$from, $to];
    }
    public function 貸与可能期間DateTime文字列(\DateTime $_date) : string {
        [$from, $to] = $this->貸与可能期間DateTime($_date);
        return $from->format('Y-m-d H:i') . "～" . $to->format('Y-m-d H:i');
    }
    public function equals($_貸与可能期間) : bool {

        if (($_貸与可能期間 instanceof 貸与可能期間) == false)
            return false;

        return $this == $_貸与可能期間; 
    }
    public function __set($name, $value) {
        throw new \Exception('貸与可能期間:許可していません。: ' . $name);
    }
    public function __get($name) {
        switch ($name) {
            case "時分ハイフン時分": return $this->_貸与可能期間自->時分 . "-" . $this->_貸与可能期間至->時分;
            default: throw new \Exception('貸与可能期間:公開していません。: ' . $name);
        }
    }
}
