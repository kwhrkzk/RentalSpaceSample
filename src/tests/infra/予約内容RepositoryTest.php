<?php
require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../../container.php";

use PHPUnit\Framework\TestCase;
use domain\予約内容\予約内容;
use domain\予約内容\予約内容ID;
use domain\予約内容\予約受付日;
use domain\予約内容\貸与期間;
use domain\会議室\料金;
use domain\会議室\会議室ID;
use domain\利用者\利用者ID;
use infra\予約内容Repository;

class 予約内容RepositoryTest extends TestCase {
    private 予約内容Repository $予約内容Repository;

    protected function setUp() : void {
        $container = getContainer();
        $this->予約内容Repository = $container->get('予約内容Repository');
    }

    protected function tearDown() : void {
    }

    // public function test予約内容Repositoryinsert() {
    //     $this->予約内容Repository->insert(
    //         予約受付日::createString("2020-05-31")
    //         , 貸与期間::createString("2020-05-31 10:00:00", "2020-05-31 18:00:00")
    //         , 会議室ID::create(1)
    //         , 利用者ID::create(1)
    //         , 料金::create(12345));
    //     $this->assertTrue(true);
    // }

    public function test予約内容Repository指定日以降の予約内容を取得する() {

        $ret = $this->予約内容Repository->指定日以降の予約内容を取得する(
            会議室ID::create(1)
            , new \DateTime("2020-05-31 17:00:00")
        );

        $this->assertCount(1, $ret);
    }
}