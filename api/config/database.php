<?php
require_once("../../vendor/danielmewes/php-rql/rdb/rdb.php");

class Database {

    private $host = "localhost";
    private $port = 28015;

    public function getAccount($username) {
        try {
            $conn = r\connect($this->host, $this->port);
            $conn->useDb("server");
        } catch (Exception $e) {
            $conn->close();
            throw new Exception($e);
//            return $e;
        }
//        $data = r\tableList()->run($conn);
        $data = r\table("accounts")->get($username)->run($conn);
        $conn->close();
        return $data;
    }

    public function getDevice($deviceID, $houseID) {
        try {
            $conn = r\connect($this->host, $this->port);
            $conn->useDb($houseID);
         } catch (Exception $e) {
            $conn->close();
            return $e;
        }
        $data = r\table("devices")->get($deviceID)->run($conn);
        $conn->close();
        return $data;
    }

    public function setDeviceAlias($deviceID, $houseID, $newName) {
        try {
            $conn = r\connect($this->host, $this->port);
            $conn->useDb($houseID);
            $data = r\table("devices")->get($deviceID)->update(array("deviceAlias" => $newName))->run($conn);
         } catch (Exception $e) {
            $conn->close();
            throw new Exception($e);
//            return $e;
        }
        $conn->close();
        return true;
    }
}

//$db = new Database();
//foreach ($db->getDevice("admin") as $table) { var_dump($table); }
//echo json_encode($db->setDeviceAlias('626fc4a6-d07a-4de7-ae2c-4aae83d2e039', 'SmartHomeDB', 'MyAlias'));
?>
