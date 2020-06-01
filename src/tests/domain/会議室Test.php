<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use PHPUnit\Framework\TestCase;
use domain\会議室\会議室;
use domain\会議室\会議室ID;
use domain\会議室\会議室名;
use domain\会議室\収容人数;
use domain\会議室\住所;
use domain\会議室\料金;
use domain\会議室\貸与可能期間;
use domain\予約内容\貸与期間;

class 会議室Test extends TestCase {
    protected function setUp() : void {
    }

    protected function tearDown() : void {
    }

    // public function test会議室貸与可能期間内か() {
    //     $会議室 = new 会議室(
    //         会議室ID::create(1),
    //         会議室名::create("会議室A"),
    //         収容人数::create(10),
    //         住所::create("会議室Aの住所"),
    //         料金::create(5000),
    //         [貸与可能期間::createInt(0, 23)]
    //     );

    //     $ret = $会議室->貸与可能期間内か(貸与期間::createString("2020-05-30 24:00:00", "2020-05-31 23:00:00"));
    //     $this->assertTrue($ret);
    // }

    // public function test会議室貸与可能期間内か2() {
    //     $会議室 = new 会議室(
    //         会議室ID::create(1),
    //         会議室名::create("会議室A"),
    //         収容人数::create(10),
    //         住所::create("会議室Aの住所"),
    //         料金::create(5000),
    //         [貸与可能期間::createInt(0, 23)]
    //     );

    //     $ret = $会議室->貸与可能期間内か(貸与期間::createString("2020-05-31 00:00:00", "2020-05-31 24:00:00"));
    //     $this->assertFalse($ret);
    // }

    public function test会議室貸与可能期間内か3() {
        $会議室 = new 会議室(
            会議室ID::create(1),
            会議室名::create("会議室A"),
            収容人数::create(10),
            住所::create("会議室Aの住所"),
            料金::create(5000),
            [貸与可能期間::createInt(9, 12)
            , 貸与可能期間::createInt(13, 18)]
        );

        $ret = $会議室->貸与可能期間内か(貸与期間::createString("2020-05-31 09:00:00", "2020-05-31 12:00:00"));
        $this->assertTrue($ret);
    }

    public function test会議室貸与可能期間内か4() {
        $会議室 = new 会議室(
            会議室ID::create(1),
            会議室名::create("会議室A"),
            収容人数::create(10),
            住所::create("会議室Aの住所"),
            料金::create(5000),
            [貸与可能期間::createInt(9, 12)
            , 貸与可能期間::createInt(13, 18)]
        );

        $ret = $会議室->貸与可能期間内か(貸与期間::createString("2020-05-31 09:00:00", "2020-05-31 18:00:00"));
        $this->assertFalse($ret);
    }
}
