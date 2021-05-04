<?php
    //НЕ ТРОГАТЬ, ВРОДЕ ВСЁ ДО КОНЦА ТУТ РЕАЛИЗОВАНО
    class DB {
        private static $database;
        private function __constructor() {
        }

        public static function getDB() {
            if (!self::$database) {
                self::$database = new DB();
            }
            return self::$database;
        }

        public $sql;

        public function connect($host, $username, $password, $db, $port) {
            if (!$this->sql) {
                $this->sql = new mysqli($host, $username, $password, $db, $port);
            }
            //echo "connect successful<br>";
        }

        public function disconnect() {
            $this->sql->close();
            //echo "disconnect successful<br>";
        }
    }

    //ДОДЕЛАТЬ КЛАСС ЗАПРОС(Query), В НЁМ ТОЛЬКО РАБОТАЕТ МЕТОД ИНСЁРТ!!!!
    class Query{
        /**
         *Эта функция формирует запросы для вставки записей в таблицы: tasks, groups, projects, periods, task_action
         * Проверяется, есть ли пустые поля.
         * Пример
         * $a = new Query();
         * echo $a->insertTasks(Array(
         *   'name' => 'Ivan',
         *   'projects_id' => '2'
         * ), "tasks");
         *
         * Сначала создаём объект класса - $a, после вызывает echo, где обращаемся к функции insertTasks,
         * после записывает в таблицу tasks в поле 'name' - Иван, а в поле 'projects_id' - 2
         * @param array $arr
         * @param $name
         * @return string - результат запроса
         */
        public function insertTasks($arr = [], $name){
            $arrS = [];//
            $ins = "INSERT INTO `$name` VALUE (null, '";

            //массивы атрибутов
            $tasks = ["name", "description", "type_task_id", "groups_id", "projects_id", "data_begin",
                "data_end", "parent_id", "created_at", "created_by", "updated_at", "updated_by", "deleted_at", "deleted_by", "active", "lock"];
            $groups = ["name", "date_begin", "date_end", "description", "projects_id", "created_at",
                "created_by", "updated_at","updated_by", "deleted_at","deleted_by", "active", "lock"];
            $projects = ["name", "date_begin", "date_end", "description", "created_at", "created_by", "updated_at",
                "updated_by", "deleted_at", "deleted_by","active", "lock"];
            $periods = ["tasks_id","interval", "type_interval_id"];
            $task_action = ["tasks_id", "action_id", "sort"];
            $users = ["id", "name", "password"];
                            
            //перебирает названия атрибутов в массиве конкретной таблицы
            for($i = 0; $i < count($$name); $i++){
                //перебирает эллементы в ассоциативном массиве
                foreach($arr as $key => $val){
                    //проверка, есть ли в ассоциативном массиве атрибут
                    if($$name[$i] == $key){
                        //если есть, то записываем его значение 
                        $arrS[$$name[$i]] = $val;
                        break;
                    }else{
                        //иначе присваеваем null. т.к его не указал 'пользователь'
                        $arrS[$$name[$i]] = "null";
                    }
                }
                //проверка, если этот элелемент последний, то добавляем к нему всё то, что нужно для sql(закрытие запроса)
                if($i != 0 && $arrS[$$name[$i]] != "null" && ($arrS[$$name[$i]] != "false" && $arrS[$$name[$i]] != "true")){
                    $ins .= "'";
                }
                if($i == count($$name) - 1){
                    $ins .= $arrS[$$name[$i]].");";
                }else{
                    if($arrS[$$name[$i]] != "null" && ($arrS[$$name[$i]] !== 'false' && $arrS[$$name[$i]] !== "true")){
                        $ins .= $arrS[$$name[$i]]."', ";
                    }else{
                        $ins .= $arrS[$$name[$i]].", ";
                    }
                }
            }
            $qa = DB::getDB();
            $qa->sql->query($ins);
            // var_dump($ins);
            // die();
            //echo 'insert';
        }

        //$res - хранит готовый SQL запрос
        private $res;
        //Этот метод выполняет запрос
        public function exec(){
            $qaa = DB::getDB();
            $this->res[strlen($this->res) - 1] = ';';
            return $qaa->sql->query($this->res);
        }
        
        //Присваеваем таблицу, в которой надо что-то удалить
        //В БУДУЩЕМ ИЗМЕНИТЬ!!!!!
        public function delete($table_name, $id){
            $this->res = "DELETE FROM `$table_name` WHERE id = $id;";
            //return $this->res;
            $su = DB::getDB();
            $su->sql->query($this->res);
            // var_dump($this->res);
            // die();
        }
        //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        //Создаёт запрос и возвращает его значение
        public function select($atr, $name){
            $this->res = "SELECT $atr FROM `$name` ";
            $qa = DB::getDB();
            $data = $qa->sql->query($this->res);
            return $data;
        }
        public function update($name, $atr, $data, $cond){
			$this->res = "UPDATE `$name` SET `$atr` = '$data' WHERE $cond";
            $qa = DB::getDB();
            $d = $qa->sql->query($this->res);
            return $d;
        }
    }
