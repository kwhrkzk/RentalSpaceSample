<?php
require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../../container.php";

use PHPUnit\Framework\TestCase;
use app\利用者\I会議室を予約する;
use domain\予約内容\予約内容;
use domain\予約内容\予約内容ID;
use domain\予約内容\予約受付日;
use domain\予約内容\貸与期間;
use domain\会議室\料金;
use domain\会議室\会議室ID;
use domain\利用者\利用者ID;
use infra\予約内容Repository;

class ログインするTest extends TestCase {
    private I会議室を予約する $会議室を予約する;

    protected function setUp() : void {
        $container = getContainer();
        $this->会議室を予約する = $container->get('I会議室を予約する');
    }

    protected function tearDown() : void {
    }

    public function test会議室を予約する予約() {
        $ret = $this->会議室を予約する->予約(
            予約受付日::createString("2020-05-30")
            , 貸与期間::createString("2020-06-01 13:00:00", "2020-06-01 17:00:00")
            , 会議室ID::create(1)
            , 利用者ID::create(1));

        if ($ret != "")
            var_dump($ret);

        $this->assertEquals("", $ret);
    }
}