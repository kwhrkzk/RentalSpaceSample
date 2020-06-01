<?php
namespace impl\利用者;

require_once __DIR__ . "/../../vendor/autoload.php";

use app\利用者\I会議室を予約可能か;
use domain\予約内容\予約受付日;
use domain\予約内容\貸与期間;
use domain\会議室\会議室;
use domain\利用者\利用者;
use infra\予約内容Repository;

class 会議室を予約可能か implements I会議室を予約可能か {
    private 予約内容Repository $予約内容Repository;

    function __construct(予約内容Repository $予約内容Repository) { 
        $this->予約内容Repository = $予約内容Repository;
    }

    public function 判断(予約受付日 $_予約受付日, 貸与期間 $_貸与期間, 会議室 $_会議室, 利用者 $_利用者) : array/* [bool 成否, string 不可理由] */ {
        $ret = $_貸与期間->以降か($_予約受付日);
        if ($ret == false)
            return [false, "会議室を予約する:予約受付日が貸与期間自より後です。 予約受付日=" . $_予約受付日->Ymd . " 貸与期間=" . $_貸与期間->YmdHis～YmdHis];

        $ret = $_会議室->貸与可能期間内か($_貸与期間);
        if ($ret == false)
            return [false, "会議室を予約する:貸与期間が貸与可能期間内にありません。 貸与期間=" . $_貸与期間->YmdHis～YmdHis];

        $arr = $this->予約内容Repository->指定日以降の予約内容を取得する($_会議室->会議室ID, $_貸与期間->貸与期間自date);

        $予約済貸与期間一覧 = array_map(fn($予約内容) => $予約内容->貸与期間タプル, $arr);
        $貸与期間配列 = $_貸与期間->期間を１時間間隔のdate配列にする();

        $予約済貸与期間一覧に当てはまる = false;
        foreach($貸与期間配列 as $item) {
            $予約済貸与期間一覧に当てはまる = $予約済貸与期間一覧に当てはまる || $this->予約済貸与期間一覧に当てはまるか($item, $予約済貸与期間一覧);
        }

        if ($予約済貸与期間一覧に当てはまる)
            return [false, "指定の貸与期間では既に予約があります。 貸与期間:" . $arr[0]->貸与期間YmdHis～YmdHis . " 指定貸与期間=" . $_貸与期間->YmdHis～YmdHis];

        return [true, ""];
    }

    function 予約済貸与期間一覧に当てはまるか(\DateTime $貸与期間, array/* [from, to] */ $予約済貸与期間一覧) : bool {
        $成否 = false;
        foreach($予約済貸与期間一覧 as $tpl) {
            [$from, $to] = $tpl;
            if ($from <= $貸与期間 && $貸与期間 < $to) {
                $成否 = $成否 || true;// 論理和.
            } else {
                $成否 = $成否 || false;// 論理和.
            }
        }

        return $成否;
    }
}