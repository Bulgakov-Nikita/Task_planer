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
            $n = 'm_'.$_GET['type_bt'];
            //подключаем модель "для работы этого метода"
            require_once 'models/'.$n.'.php';
            $obj = new $n();
            //НИЖЕ УЖЕ НЕ РАБОТА КОНТРОЛЛЕРА
            $data = $obj->get_info();
            $data1;
            //В БУДУЩЕМ ПЕРЕДЕЛАТЬ get_info так, чтобы он присылал только одну строчку а не всю таблицу, p.s. либо оставить так как есть, либо это немного переделать не переделывая в каждой модели
            while($r = $data->fetch_assoc()){
                if($r['id'] == $_GET['group']){
                    $data1 = $r;
                    break;
                }
            }
            foreach($data1 as $key => $val){
                switch($key){
                    case 'name':
                        echo "<h4 style='text-decoration: underline;'>$val</h4>";
                    break;
                    case 'description':
                        echo "<h4>Описание</h4><p>$val</p>";
                    break;
                    case 'type_task_id':
                        echo "<p>Тип: $val</p>";
                    break;
                    case 'date_begin':
                        echo "<p>Дата начала: $val</p>";
                    break;
                    case 'date_end':
                        echo "<p>Дата конца: $val</p>";
                    break;
                    case 'data_begin':
                        echo "<p>Дата начала: $val</p>";
                    break;
                    case 'data_end':
                        echo "<p>Дата конца: $val</p>";
                    break;
                    case 'created_by':
                        echo "<p>Создатель: $val</p>";
                    break;
                    default:
                    break;
                }
            }
            //=-=-=-=-=-=copypast
            //после добавления задачи переходим в главный view
            //echo "<script>document.location.replace('/');</script>";
        }
    }
