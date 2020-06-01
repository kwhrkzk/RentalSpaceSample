<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use PHPUnit\Framework\TestCase;
use domain\会議室\貸与可能期間;
use domain\会議室\貸与可能期間自;
use domain\会議室\貸与可能期間至;

class 貸与可能期間Test extends TestCase {
    protected function setUp() : void {
    }

    protected function tearDown() : void {
    }

    public function test貸与可能期間create() {
        $a = 貸与可能期間::createInt(0, 23);
        [$from, $to] = $a->貸与可能期間DateTime(new \DateTime("2020-05-27"));
        $this->assertEquals("2020-05-27 00:00:00", $from->format("Y-m-d H:i:s"));
        $this->assertEquals("2020-05-28 00:00:00", $to->format("Y-m-d H:i:s"));
    }

    public function test貸与可能期間equals() {
        $a = 貸与可能期間::createInt(0, 12);
        $b = 貸与可能期間::createInt(0, 12);
        $this->assertTrue($a->equals($b));
    }

    public function test貸与可能期間notEquals() {
        $a = 貸与可能期間::createInt(0, 12);
        $b = 貸与可能期間::createInt(0, 13);
        $this->assertFalse($a->equals($b));
    }
}
