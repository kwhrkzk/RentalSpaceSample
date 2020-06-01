<?php
require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../../container.php";

use PHPUnit\Framework\TestCase;
use domain\利用者\利用者;
use domain\利用者\利用者ID;
use infra\利用者Repository;

class 利用者RepositoryTest extends TestCase {
    private 利用者Repository $利用者Repository;

    protected function setUp() : void {
        $container = getContainer();
        $this->利用者Repository = $container->get('利用者Repository');
    }

    protected function tearDown() : void {
    }

    public function test利用者Repositoryfirst() {
        $a = $this->利用者Repository->first(利用者ID::create(1));
        $this->assertEquals("利用者A", $a->氏名);
    }
}