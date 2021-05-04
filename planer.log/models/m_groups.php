<?php
    //ДОКОНЦА РЕАЛИЗОВАТЬ ЭТОТ КЛАСС
    class m_groups extends model{
        public function add(){
            $sql = new Query();
            $sql->insertTasks(
                Array(
                    'name' => $_GET['name'],
                    'projects_id' => $_GET['project'],
                    'description' => $_GET['desc'],
                    'date_begin' => $_GET['date_b'],
                    'date_end' => $_GET['date_e'],
                    'created_at' => 123,
                    'created_by' => $_COOKIE['id'],
                    'active' => "true"
                ),
                "groups"
            );
        }
        public function edit(){
            $sql = new Query();
            $sql->update('groups', $_GET['atr'], $_GET['data'], "groups.id = ".$_GET['id']);
        }
        public function delete(){
            $sql = new Query();
            $sql->delete('groups', $_GET['del']);
        }
        // для группы
        public function get_info(){
            $sql = new Query();
            return $sql->select('*', 'groups');
        }
    }

