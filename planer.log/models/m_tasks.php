<?php
    //ДО КОНЦА РЕАЛИЗОВАТЬ ЭТОТ КЛАСС
    class m_tasks extends model{
        public function add(){
            $sql = new Query();
            $sql->insertTasks(
                Array(
                    'name' => $_GET['name'],
                    'groups_id' => $_GET['group'],
                    'projects_id' => $_GET['project'],
                    'description' => $_GET['desc'],
                    'data_begin' => $_GET['date_b'],
                    'data_end' => $_GET['date_e'],
                    'type_task_id' => $_GET['type_task'],
                    'created_at' => 123,
                    'created_by' => $_COOKIE['id'],
                    'active' => "true"
                ),
                "tasks"
            );
        }
        public function edit(){
            $sql = new Query();
            $sql->update('tasks', $_GET['atr'], $_GET['data'], "tasks.id = ".$_GET['id']);
        }
        public function delete(){
            $sql = new Query();
            $sql->delete('tasks', $_GET['del']);
        }
        // для задачи
        public function get_info(){
            $sql = new Query();
            return $sql->select('*', 'tasks');
        }
    }
