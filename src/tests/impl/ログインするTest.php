<?php
require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../../container.php";

use PHPUnit\Framework\TestCase;
use domain\利用者\利用者ID;
use app\利用者\Iログインする;
use impl\利用者\ログインする;

class ログインするTest extends TestCase {
    private Iログインする $ログインする;

    protected function setUp() : void {
        $container = getContainer();
        $this->ログインする = $container->get('Iログインする');
    }

    protected function tearDown() : void {
    }

    public function testログインするログイン() {
        $b = $this->ログインする->ログイン(利用者ID::create(1));
        $this->assertTrue($b);
    }
}