<?php
require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../../container.php";

use PHPUnit\Framework\TestCase;
use domain\会議室\会議室;
use domain\会議室\会議室ID;
use infra\会議室Repository;

class 会議室RepositoryTest extends TestCase {
    private 会議室Repository $会議室Repository;

    protected function setUp() : void {
        $container = getContainer();
        $this->会議室Repository = $container->get('会議室Repository');
    }

    protected function tearDown() : void {
    }

    public function test会議室Repositoryall() {
        $a = $this->会議室Repository->all();
        $this->assertCount(3, $a);
    }

    public function test会議室Repositoryfirst() {
        $a = $this->会議室Repository->first(会議室ID::create(1));
        $this->assertEquals("会議室A", $a->名称);
    }
}