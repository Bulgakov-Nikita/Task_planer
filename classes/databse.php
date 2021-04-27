<?php
class DB {
    private static $database;
    private function __constructor() {
    }

    public static function create() {
        if (!self::$database) {
            self::$database = new DB();
        }
        return self::$database;
    }

    public $sql;

    public function connect($host, $username, $password, $db, $port) {
        if (!$this->sql) {
            $this->sql = new mysqli($host, $username, $password, $db, $port);
        } else {
            $this->disconnect();
            $this->sql = new mysqli($host, $username, $password, $db, $port);
        }
        echo "connect successful<br>";
    }

    public function disconnect() {
        $this->sql->close();
        echo "disconnect successful<br>";
    }

    public function select($data) {
        $res = $this->sql->query($data);
        while ($row = $res->fetch_assoc()) {
            echo $row['id'].'<br>';
        }
    }

    public function insert($data) {
        // инсерт
    }

    public function update($data) {
        // апдейт
    }

    public function delete($data) {
        // делит
    }
}

$mysql = DB::create();
$mysql->connect('localhost', 'root', '12345', 'tasks', '3306');
$mysql->connect('localhost', 'root', '12345', 'foo', '3306');
$mysql->select('select * from test');
$mysql->disconnect();