<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use PHPUnit\Framework\TestCase;
use domain\会議室\会議室ID;

class 会議室IDTest extends TestCase {
    protected function setUp() : void {
    }

    protected function tearDown() : void {
    }

    public function test会議室IDcreate() {
        $a = 会議室ID::create(1);
        $this->assertEquals(1, $a->ID);
        $this->assertEquals('1', $a->ID文字列);
    }

    public function test会議室IDequals() {
        $a = 会議室ID::create(1);
        $b = 会議室ID::create(1);
        $this->assertTrue($a->equals($b));
    }

    public function test会議室IDnotEquals() {
        $a = 会議室ID::create(1);
        $b = 会議室ID::create(2);
        $this->assertFalse($a->equals($b));
    }
}