<?php
    class c_reg extends controller{
        public function view(){
            $this->view->generete("reg.php", "temp_main.php");
        }
        //Регистрация
        public function reg(){
            $n = 'm_'.$_POST['type_bt'];
            require_once 'models/'.$n.'.php';
            $obj = new $n();
            $obj->add();
            //после 10 строки кода, код не должен тут исполнятся, но если исполниться то скорее всего это ошибка
            echo "404";
        }
    }
