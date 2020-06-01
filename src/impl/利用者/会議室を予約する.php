<?php
namespace impl\利用者;

require_once __DIR__ . "/../../vendor/autoload.php";

use app\利用者\I会議室を予約する;
use app\利用者\I会議室を予約可能か;
use domain\予約内容\予約受付日;
use domain\予約内容\貸与期間;
use domain\会議室\会議室ID;
use domain\会議室\料金;
use domain\利用者\利用者ID;
use infra\会議室Repository;
use infra\利用者Repository;
use infra\予約内容Repository;

class 会議室を予約する implements I会議室を予約する {
    private 会議室Repository $会議室Repository;
    private 利用者Repository $利用者Repository;
    private 予約内容Repository $予約内容Repository;
    private I会議室を予約可能か $会議室を予約可能か;

    function __construct(
        会議室Repository $会議室Repository
        , 利用者Repository $利用者Repository
        , 予約内容Repository $予約内容Repository
        , I会議室を予約可能か $会議室を予約可能か
        ) { 
        $this->会議室Repository = $会議室Repository;
        $this->利用者Repository = $利用者Repository;
        $this->予約内容Repository = $予約内容Repository;
        $this->会議室を予約可能か = $会議室を予約可能か;
    }

    public function 予約(予約受付日 $_予約受付日, 貸与期間 $_貸与期間, 会議室ID $_会議室ID, 利用者ID $_利用者ID) : string {
        $利用者 = $this->利用者Repository->first($_利用者ID);
        $会議室 = $this->会議室Repository->first($_会議室ID);
        [$成否, $理由] = $this->会議室を予約可能か->判断($_予約受付日, $_貸与期間, $会議室, $利用者);

        if ($成否 == false)
            return $理由;

        $this->予約内容Repository->insert($_予約受付日, $_貸与期間, $_会議室ID, $_利用者ID, $会議室->料金単価);
        return "";
    }
}