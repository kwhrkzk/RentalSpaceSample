<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use PHPUnit\Framework\TestCase;
use domain\予約内容\貸与期間;
use domain\予約内容\貸与期間自;
use domain\予約内容\貸与期間至;

class 貸与期間Test extends TestCase {
    protected function setUp() : void {
    }

    protected function tearDown() : void {
    }

    public function test貸与期間期間を１時間間隔のdate配列にする() {
        $a = 貸与期間::createString("2020-05-31 10:00:00", "2020-05-31 18:00:00");
        $arr = $a->期間を１時間間隔のdate配列にする();
        var_dump($arr);
        $this->assertTrue(false);
    }
}
