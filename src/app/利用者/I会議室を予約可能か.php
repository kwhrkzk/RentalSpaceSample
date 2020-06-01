<?php
namespace app\利用者;

require_once __DIR__ . "/../../vendor/autoload.php";

use domain\予約内容\予約受付日;
use domain\予約内容\貸与期間;
use domain\会議室\会議室;
use domain\利用者\利用者;

interface I会議室を予約可能か {
    public function 判断(予約受付日 $_予約受付日, 貸与期間 $_貸与期間, 会議室 $_会議室, 利用者 $_利用者) : array/* [bool 成否, string 不可理由] */;
}