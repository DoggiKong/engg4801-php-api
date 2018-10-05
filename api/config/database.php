<?php
require_once("../../vendor/danielmewes/php-rql/rdb/rdb.php");

class Database {

    private $host = "localhost";
    private $port = 28015;

    public function getTest() {
        try {
            $conn = r\connect($host, $port);
            $conn->useDb("house");
        } catch (Exception $e) {
            return $e;
        }
        $data = r\tableList()->run($conn);
        $conn->close();
        return $data;
    }
}
$db = new Database();
foreach ($db->getTest() as $table) { echo $table; }
?>
