<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use PHPUnit\Framework\TestCase;
use domain\会議室\会議室;
use infra\会議室Factory;

class 会議室FactoryTest extends TestCase {
    private 会議室Factory $会議室Factory;

    protected function setUp() : void {
        $this->会議室Factory = new 会議室Factory();
    }

    protected function tearDown() : void {
    }

    public function test会議室Factorycreate() {
        $a = $this->会議室Factory->create2(1, "会議室名称", 2, "住所", 1200, [[9,11], [13,17]]);
        $arr = $a->貸与可能期間一覧(new \DateTime("2020-05-28"));
        $tmp = array_shift($arr);
        $this->assertEquals("2020-05-28 09:00～2020-05-28 12:00", $tmp);
    }
}