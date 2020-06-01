<?php
namespace infra;

require_once __DIR__ . "/../vendor/autoload.php";

use Psr\Container\ContainerInterface;
use domain\予約内容\予約内容;
use domain\予約内容\予約内容ID;
use domain\予約内容\予約受付日;
use domain\予約内容\貸与期間;
use domain\会議室\料金;
use domain\会議室\会議室ID;
use domain\利用者\利用者ID;
// use infra\予約内容Factory;

class 予約内容Repository {
    private string $conn;

    public function __construct(string $ConnectionString) { 
        $this->conn = $ConnectionString;
    }

    public function insert(予約受付日 $_予約受付日, 貸与期間 $_貸与期間, 会議室ID $_会議室ID, 利用者ID $_利用者ID, 料金 $_料金) {
        $conn = pg_connect($this->conn);
        $内容 = [
            "会議室id" => $_会議室ID->ID,
            "利用者id" => $_利用者ID->ID,
            "予約受付日" => $_予約受付日->Ymd,
            "貸与期間自" => $_貸与期間->貸与期間自YmdHis,
            "貸与期間至" => $_貸与期間->貸与期間至YmdHis,
            "料金" => $_料金->貸与期間の合計料金($_貸与期間),
            "更新日" => (new \DateTime("NOW"))->format('Y-m-d H:i:s')
        ];
        $ret = pg_insert($conn, "予約内容一覧", $内容);
        if ($ret == false)
            throw new \Exception("予約内容の保存に失敗しました。:" . $内容["料金"]);

        pg_close($conn);
    }

    public function 指定日以降の予約内容を取得する(会議室ID $_会議室ID, \DateTime $_指定日) :  array/* 予約内容 */ {
        $conn = pg_connect($this->conn);
        $ret = pg_query_params(
            $conn
            , 'SELECT "予約内容id", "会議室id", "利用者id", "予約受付日", "貸与期間自", "貸与期間至", "料金", "更新日" FROM public."予約内容一覧" WHERE "会議室id" = $1 and "貸与期間至" > $2'
            , [$_会議室ID->ID, $_指定日->format("Y-m-d H:i:s")]);

        if ($ret == false)
            return [];

        if (pg_num_rows($ret) == 0)
            return [];

        $予約内容一覧 = [];
        foreach(pg_fetch_all($ret) as $item) {
            $予約内容 = new 予約内容(
                予約内容ID::create($item["予約内容id"]),
                会議室ID::create($item["会議室id"]),
                利用者ID::create($item["利用者id"]),
                貸与期間::createString(
                    $item["貸与期間自"],
                    $item["貸与期間至"]
                ),
                予約受付日::createString($item["予約受付日"]),
                料金::create($item["料金"])
            );

            array_push($予約内容一覧, $予約内容);
        }

        pg_close($conn);

        return $予約内容一覧;
    }
}
