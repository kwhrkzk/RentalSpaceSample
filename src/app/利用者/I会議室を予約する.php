<?php
namespace app\利用者;

require_once __DIR__ . "/../../vendor/autoload.php";

use domain\予約内容\予約受付日;
use domain\予約内容\貸与期間;
use domain\会議室\会議室ID;
use domain\利用者\利用者ID;

interface I会議室を予約する {
    public function 予約(予約受付日 $_予約受付日, 貸与期間 $_貸与期間, 会議室ID $_会議室ID, 利用者ID $_利用者ID) : string;
}