<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use PHPUnit\Framework\TestCase;
use domain\会議室\会議室名;

class 会議室名Test extends TestCase {
    protected function setUp() : void {
    }

    protected function tearDown() : void {
    }

    public function test会議室名create() {
        $a = 会議室名::create("会議室の名称");
        $this->assertEquals("会議室の名称", $a->名称);
    }

    public function test会議室名equals() {
        $a = 会議室名::create("会議室の名称");
        $b = 会議室名::create("会議室の名称");
        $this->assertTrue($a->equals($b));
    }

    public function test会議室名notEquals() {
        $a = 会議室名::create("会議室の名称");
        $b = 会議室名::create("会議室の名称2");
        $this->assertFalse($a->equals($b));
    }

    public function test会議室名30文字以下() {
        $a = 会議室名::create("０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９");
        $this->assertEquals("０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９", $a->名称);
    }

    public function test会議室名30文字より上() {
        $this->expectExceptionMessage("会議室名:30文字以下でなければなりません。:０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０");
        $a = 会議室名::create("０１２３４５６７８９０１２３４５６７８９０１２３４５６７８９０");
        $this->assertTrue(false);
    }
}