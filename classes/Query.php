<?php

    class Query{

        /**
         *Эта функция формирует запросы для вставки записей в таблицы: tasks, groups, projects, periods, task_action
         * Проверяется, есть ли пустые поля.
         * Пример
         * $a = new Query();
        echo $a->insertTasks(Array(
        'name' => 'Ivan',
        'projects_id' => '2'
        ), "tasks");
         *
         * Сначала создаём объект класса - $a, после вызывает echo, где обращаемся к функции insertTasks,
         * после записывает в таблицу tasks в поле 'name' - Иван, а в поле 'projects_id' - 2
         * @param array $arr
         * @param $name
         * @return string - результат хапроса
         */
        public function insertTasks($arr = [], $name){
            //$q = DB::create();
            $arrS = [];//
            $ins = "Insert into $name value (null, '";

            //массивы атрибутов
            $tasks = ["name", "description", "type_task_id", "complite", "groups_id", "projects_id", "data_begin",
                "data_end", "parent_id", "created_at", "created_by", "updated_at", "updated_by", "deleted_at", "deleted_by", "active", "lock"];
            $groups = ["name", "date_begin", "date_end", "description", "complite", "projects_id", "created_at",
                "created_by", "updated_at","updated_by", "deleted_at","deleted_by", "active", "lock"];
            $projects = ["name", "date_begin", "date_end", "description", "complite", "created_at", "created_at", "updated_at",
                "updated_by", "deleted_at", "deleted_by","active", "lock"];
            $periods = ["tasks_id","interval", "type_interval_id"];
            $task_action = ["tasks_id", "action_id", "sort"];
                            
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
                if($i == count($$name) - 1){
                    $ins .= $arrS[$$name[$i]]."');";
                }else{
                    $ins .= $arrS[$$name[$i]]."', '";
                }
            }
            return $ins;
            //$q->qwery($ins)
        }
        

    }
