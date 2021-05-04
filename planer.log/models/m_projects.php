<?php
    //ДО КОНЦА РЕАЛИЗОВАТЬ ЭТОТ КЛАСС
    class m_projects extends model{
        public function add(){
            $sql = new Query();
            $sql->insertTasks(
                Array(
                    'name' => $_GET['name'],
                    'description' => $_GET['desc'],
                    'date_begin' => $_GET['date_b'],
                    'date_end' => $_GET['date_e'],
                    'created_at' => 123,
                    'created_by' => $_COOKIE['id'],
                    'active' => "true"
                ),
                "projects"
            );
        }
        public function edit(){
            $sql = new Query();
            $sql->update('projects', $_GET['atr'], $_GET['data'], "projects.id = ".$_GET['id']);
        }
        public function delete(){
            $sql = new Query();
            $sql->delete('projects', $_GET['del']);
        }
        //для проекта
        public function get_info(){
            $sql = new Query();
            return $sql->select('*', 'projects');
        }
    }
