<?php
    //ДО КОНЦА ДОДЕЛАТЬ ЭТОТ КОНТРОЛЛЕР(КЛАСС)
    class c_main extends controller{
        public function view(){
            $this->view->generete("main.php", "temp_main.php");
        }
        //Динамически добавляет либо задачу, группу или проект
        public function add(){
            if($_GET['date_b'] == ''){
                $_GET['date_b'] = 'null';
            }
            if($_GET['date_e'] == ''){
                $_GET['date_e'] = 'null';
            }
            //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
            $n = 'm_'.$_GET['type_bt'];
            //подключаем модель "для работы этого метода"
            require_once 'models/'.$n.'.php';
            //create model
            $obj = new $n();
            $obj->add();
            //после добавления задачи переходим в главный view
            echo "<script>document.location.replace('http://planer.log/');</script>";
        }
        //Динамическое удаление
        public function delete(){
            $n = 'm_'.$_GET['type_bt'];
            //подключаем модель "для работы этого метода"
            require_once 'models/'.$n.'.php';
            // var_dump(123);
            // die();
            $obj = new $n();
            $obj->delete();
            //после добавления задачи переходим в главный view
            echo "<script>document.location.replace('/');</script>";
        }
        //динамическое изменение
        public function edit(){
            $n = 'm_'.$_GET['type_bt'];
            //подключаем модель "для работы этого метода"
            require_once 'models/'.$n.'.php';
            $obj = new $n();
            $obj->edit();
            //после добавления задачи переходим в главный view
            echo "<script>document.location.replace('/');</script>";
        }
        public function showInfo(){
            # code...
        }
    }
