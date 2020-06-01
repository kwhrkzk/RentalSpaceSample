<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use PHPUnit\Framework\TestCase;
use domain\会議室\貸与可能期間自;
use domain\会議室\貸与可能期間至;

class 貸与可能期間自Test extends TestCase {
    protected function setUp() : void {
    }

    protected function tearDown() : void {
    }

    public function test貸与可能期間自create() {
        $a = 貸与可能期間自::create(0);
        $this->assertEquals(0, $a->時間);
    }

    public function test貸与可能期間自equals() {
        $a = 貸与可能期間自::create(0);
        $b = 貸与可能期間自::create(0);
        $this->assertTrue($a->equals($b));
    }

    public function test貸与可能期間自notEquals() {
        $a = 貸与可能期間自::create(0);
        $b = 貸与可能期間自::create(1);
        $this->assertFalse($a->equals($b));
    }

    public function test貸与可能期間自年月日() {
        $a = 貸与可能期間自::create(0);
        $tmp = $a->年月日(new DateTime("2020-05-27 18:01:23"));
        $this->assertEquals("2020-05-27 00:00:00", $tmp->format("Y-m-d H:i:s"));
    }

    public function test貸与可能期間至年月日() {
        $a = 貸与可能期間至::create(23);
        $tmp = $a->年月日(new DateTime("2020-05-27 18:01:23"));
        $this->assertEquals("2020-05-28 00:00:00", $tmp->format("Y-m-d H:i:s"));
    }
}