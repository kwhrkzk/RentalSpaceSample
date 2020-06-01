<?php
namespace domain\会議室;

require_once __DIR__ . "/../../vendor/autoload.php";

use domain\予約内容\貸与期間;

class 会議室 {
    private 会議室ID $_会議室ID;
    private 会議室名 $_会議室名;
    private ?収容人数 $_収容人数;
    private 住所 $_住所;
    private 料金 $_料金;
    private array/* 貸与可能期間 */ $_貸与可能期間一覧;

    function __construct(
        会議室ID $_会議室ID,
        会議室名 $_会議室名,
        収容人数 $_収容人数,
        住所 $_住所,
        料金 $_料金,
        array $_貸与可能期間一覧
        ) {
            $this->_会議室ID = $_会議室ID;
            $this->_会議室名 = $_会議室名;
            $this->_収容人数 = $_収容人数;
            $this->_住所 = $_住所;
            $this->_料金 = $_料金;
            $this->_貸与可能期間一覧 = $_貸与可能期間一覧; 
    }
    public function 貸与可能期間内か(貸与期間 $_貸与期間) : bool {
        $貸与可能期間一覧 = array_merge($this->貸与可能期間一覧($_貸与期間->貸与期間自date), $this->貸与可能期間一覧($_貸与期間->貸与期間至date));
        $貸与可能期間一覧 = array_values($貸与可能期間一覧);
        $貸与期間配列 = $_貸与期間->期間を１時間間隔のdate配列にする();

        foreach ($貸与期間配列 as $貸与期間) {
            $ret = $this->_貸与可能期間内か($貸与期間, $貸与可能期間一覧);
            if ($ret == false)
                return false;
        }
        return true;
    }

    // 貸与可能期間一覧内に貸与期間が一つでも入っていればよい.
    function _貸与可能期間内か(\DateTime $貸与期間, array/* [from, to] */ $貸与可能期間一覧) : bool {
        $成否 = false;
        foreach($貸与可能期間一覧 as $tpl) {
            [$貸与可能期間自, $貸与可能期間至] = $tpl;
            if ($貸与可能期間自 <= $貸与期間 && $貸与期間 < $貸与可能期間至) {
                $成否 = $成否 || true;// 論理和.
            } else {
                $成否 = $成否 || false;// 論理和.
            }
        }

        return $成否;
    }

    public function 貸与可能期間一覧(\DateTime $_date) : array/* [\DateTime, \DateTime] */ {
        return array_map(fn($_貸与可能期間) => $_貸与可能期間->貸与可能期間DateTime($_date), $this->_貸与可能期間一覧);
    }
    public function equals($_会議室) : bool {

        if (($_会議室 instanceof 会議室) == false)
            return false;

        return $this == $_会議室;
    }
    public function __set($name, $value) {
        throw new \Exception('会議室:許可していません。: ' . $name);
    }
    public function __get($name) {
        switch ($name) {
            case "ID": return $this->_会議室ID->ID;
            case "ID文字列": return $this->_会議室ID->ID文字列;
            case "会議室ID": return $this->_会議室ID;
            case "名称": return $this->_会議室名->名称;
            case "人数": return $this->_収容人数->人数;
            case "住所": return $this->_住所->名称;
            case "料金単価": return $this->_料金;
            case "貸与可能期間一覧文字列カンマ区切り": return $this->貸与可能期間一覧カンマ区切り();
            default: throw new \Exception('会議室:公開していません。: ' . $name);
        }
    }
    function 貸与可能期間一覧カンマ区切り() {
        $arr = array_map([$this, "_貸与可能期間一覧カンマ区切り"], $this->_貸与可能期間一覧);
        return array_reduce($arr, fn($a,$b) => $a . "," . $b);
    }
    function _貸与可能期間一覧カンマ区切り(貸与可能期間 $_貸与可能期間) {
        return $_貸与可能期間->時分ハイフン時分;
    }
}
