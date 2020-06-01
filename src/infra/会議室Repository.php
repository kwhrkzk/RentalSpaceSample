<?php
namespace infra;

require_once __DIR__ . "/../vendor/autoload.php";

use Psr\Container\ContainerInterface;
use domain\会議室\会議室;
use domain\会議室\会議室ID;
use domain\会議室\会議室名;
use domain\会議室\収容人数;
use domain\会議室\住所;
use domain\会議室\貸与可能期間;
use infra\会議室Factory;

class 会議室Repository {
    private string $conn;
    private 会議室Factory $会議室Factory;

    public function __construct(string $ConnectionString, $会議室Factory) { 
        $this->conn = $ConnectionString;
        $this->会議室Factory = $会議室Factory;
    }

    public function first(会議室ID $_会議室ID) : 会議室 {
        $conn = pg_connect($this->conn);
        $ret = pg_query_params($conn, 'SELECT "会議室id", "会議室名", "住所", "料金", "収容人数" FROM "会議室一覧" WHERE "会議室id" = $1;', [$_会議室ID->ID]);
        if ($ret == false)
            throw new \Exception("存在しない会議室IDです。:" . $_会議室ID->ID文字列);

        if (pg_num_rows($ret) == 0)
            throw new \Exception("存在しない会議室IDです。:" . $_会議室ID->ID文字列);

        $会議室 = pg_fetch_object($ret);

        $ret = pg_query_params($conn, 'SELECT "貸与可能期間自", "貸与可能期間至" FROM "貸与可能期間一覧" WHERE 会議室id = $1 ORDER BY "貸与可能期間自";', [$会議室->会議室id]);
        if ($ret == false)
            throw new \Exception("貸与可能期間一覧が存在しません。:" . $_会議室ID->ID文字列);

        $貸与可能期間一覧 = array_map(fn($x) => [$x["貸与可能期間自"], $x["貸与可能期間至"]], pg_fetch_all($ret));
        $会議室 = $this->会議室Factory->create2(
            $会議室->会議室id,
            $会議室->会議室名,
            $会議室->収容人数,
            $会議室->住所,
            $会議室->料金,
            $貸与可能期間一覧
        );

        pg_close($conn);

        return $会議室;
    }

    public function all() : array/* 会議室 */ {
        $conn = pg_connect($this->conn);
        $ret = pg_query_params($conn, 'SELECT "会議室id", "会議室名", "住所", "料金", "収容人数" FROM "会議室一覧";', []);
        $加工前会議室一覧 = pg_fetch_all($ret);

        $会議室一覧 = [];
        foreach($加工前会議室一覧 as $item) {
            // fwrite(STDERR, print_r($item, TRUE));

            $ret = pg_query_params($conn, 'SELECT "貸与可能期間自", "貸与可能期間至" FROM "貸与可能期間一覧" WHERE 会議室id = $1 ORDER BY "貸与可能期間自";', [$item["会議室id"]]);
            $貸与可能期間一覧 = array_map(fn($x) => [$x["貸与可能期間自"], $x["貸与可能期間至"]], pg_fetch_all($ret));
            $会議室 = $this->会議室Factory->create2(
                $item["会議室id"],
                $item["会議室名"],
                $item["収容人数"],
                $item["住所"],
                $item["料金"],
                $貸与可能期間一覧
            );
            array_push($会議室一覧, $会議室);
        }

        pg_close($conn);

        return $会議室一覧;
    }
}
