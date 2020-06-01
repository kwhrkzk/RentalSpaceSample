<?php
namespace infra;

require_once __DIR__ . "/../vendor/autoload.php";

use Psr\Container\ContainerInterface;
use domain\利用者\利用者;
use domain\利用者\利用者ID;
use domain\利用者\利用者名;
use infra\利用者Factory;

class 利用者Repository {
    private string $conn;

    public function __construct(string $ConnectionString) { 
        $this->conn = $ConnectionString;
    }

    public function first(利用者ID $_利用者ID) :  利用者 {
        $conn = pg_connect($this->conn);
        $ret = pg_query_params($conn, 'SELECT "利用者id", "利用者名" FROM "利用者一覧" WHERE "利用者id" = $1;', [$_利用者ID->ID]);
        if ($ret == false)
            throw new \Exception("存在しない利用者IDです。:" . $_利用者ID->ID文字列);

        if (pg_num_rows($ret) == 0)
            throw new \Exception("存在しない利用者IDです。:" . $_利用者ID->ID文字列);

        $利用者 = pg_fetch_object($ret);
        $利用者 = 利用者::create($利用者->利用者id, $利用者->利用者名);

        pg_close($conn);

        return $利用者;
    }
}
