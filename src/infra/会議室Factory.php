<?php
namespace infra;

require_once __DIR__ . "/../vendor/autoload.php";

use domain\会議室\会議室;
use domain\会議室\会議室ID;
use domain\会議室\会議室名;
use domain\会議室\収容人数;
use domain\会議室\住所;
use domain\会議室\料金;
use domain\会議室\貸与可能期間;

class 会議室Factory {
    function __construct() { 
    }

    public function create(
        会議室ID $_会議室ID,
        会議室名 $_会議室名,
        収容人数 $_収容人数,
        住所 $_住所,
        料金 $_料金,
        array/* 貸与可能期間 */ $_貸与可能期間一覧
    ) : 会議室 {
        return new 会議室($_会議室ID, $_会議室名, $_収容人数, $_住所, $_料金, $_貸与可能期間一覧);
    }

    public function create2(
        int $_会議室ID,
        string $_会議室名,
        ?int $_収容人数,
        string $_住所,
        int $_料金,
        array/* [int, int] */ $_貸与可能期間一覧
    ) : 会議室 {
        $tmp = array_map(
            [$this, "貸与可能期間作成"]
            , $_貸与可能期間一覧
        );
        return new 会議室(
            会議室ID::create($_会議室ID),
            会議室名::create($_会議室名),
            収容人数::create($_収容人数),
            住所::create($_住所),
            料金::create($_料金),
            $tmp
        );
    }

    function 貸与可能期間作成(array $tpl) : 貸与可能期間 {
        [$x, $y] = $tpl;
        return 貸与可能期間::createInt($x, $y);
    }
}
