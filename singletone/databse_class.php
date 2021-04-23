<?php
    class DB {
        private static $database;
        private function __constructor() {
        }

        public static function connect($host, $username, $password, $db) {
            if (!self::$database) {
                self::$database = new DB();
                // подключение к бд
            } else {
                self::$database->disconnect();
                // здесь сначала выполняется disconnect, а потом новое подключение
            }
            echo "connect successful<br>";
            return self::$database;
        }

        public function disconnect() {
            // отключение от БД
            echo "disconnect successful<br>";
        }

        public function select($table, $data) {
            // выполнение селекта
        }

        public function insert($table, $data) {
            // инсерт
            echo "insert successful<br>";
        }

        public function update($table, $data) {
            // апдейт
        }

        public function delete($table, $data) {
            // делит
        }

    }

    $myDB = DB::connect('localhost', 'root', '', 'Journal');
    $myDB->insert('students', 'Иванов КПИ-2020 2021-04-12');
    $myDB->disconnect();