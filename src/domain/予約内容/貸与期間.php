<?php
namespace domain\予約内容;

require_once __DIR__ . "/../../vendor/autoload.php";

class 貸与期間 {
    private 貸与期間自 $_貸与期間自;
    private 貸与期間至 $_貸与期間至;

    function __construct(貸与期間自 $_貸与期間自, 貸与期間至 $_貸与期間至) { 
        $this->_貸与期間自 = $_貸与期間自;
        $this->_貸与期間至 = $_貸与期間至;
    }
    public static function create(貸与期間自 $_貸与期間自, 貸与期間至 $_貸与期間至) : 貸与期間 {

        if ($_貸与期間自->date >= $_貸与期間至->date)
            throw new \Exception("貸与期間:貸与期間自の方が貸与期間至より後です。 貸与期間自=" . $_貸与期間自->YmdHis . " 貸与期間至=" . $_貸与期間至->YmdHis);
        return new 貸与期間($_貸与期間自, $_貸与期間至);
    }
    public static function createString(string $_貸与期間自, string $_貸与期間至) : 貸与期間 {
        $貸与期間自 = 貸与期間自::createString($_貸与期間自);
        $貸与期間至 = 貸与期間至::createString($_貸与期間至);
        return 貸与期間::create($貸与期間自, $貸与期間至);
    }
    public function 以降か(予約受付日 $_予約受付日) {
        return $_予約受付日->date <= $this->貸与期間自date;
    }
    public function 貸与期間の時間() : int {
        $interval = $this->貸与期間至date->diff($this->貸与期間自date);
        return ($interval->d * 24) + $interval->h;
    }

    public function 期間を１時間間隔のdate配列にする() : array/* \DateTime */ {
        $間隔回数 = $this->貸与期間の時間();

        $date配列 = [clone $this->貸与期間自date];
        for ($count = 1; $count < $間隔回数; $count++) {
            $tmp = clone $this->貸与期間自date;
            $x = new \DateInterval("PT".$count."H");
            array_push($date配列, $tmp->add($x));
        }

        return $date配列;
    }
    public function equals($_貸与期間) : bool {

        if (($_貸与期間 instanceof 貸与期間) == false)
            return false;

        return $this == $_貸与期間; 
    }
    public function __set($name, $value) {
        throw new \Exception('貸与期間:許可していません。: ' . $name);
    }
    public function __get($name) {
        switch ($name) {
            case "タプル": return [$this->貸与期間自date, $this->貸与期間至date];
            case "貸与期間自date": return $this->_貸与期間自->date;
            case "貸与期間至date": return $this->_貸与期間至->date;
            case "貸与期間自YmdHis": return $this->_貸与期間自->YmdHis;
            case "貸与期間至YmdHis": return $this->_貸与期間至->YmdHis;
            case "YmdHis～YmdHis": return $this->_貸与期間自->YmdHis . "～" . $this->_貸与期間至->YmdHis;
            default: throw new \Exception('貸与期間:公開していません。: ' . $name);
        }
    }
}
