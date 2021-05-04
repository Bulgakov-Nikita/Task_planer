<?php
    class c_auth extends controller{
        public function view(){
            $this->view->generete("auth.php", "temp_main.php");
        }
        //авторизация
        public function auth(){
            $n = 'm_'.$_POST['type_bt'];
            require_once 'models/'.$n.'.php';
            $obj = new $n();
            $obj->auth();
            //после 10 строки кода, код не должен тут исполнятся, но если исполниться то скорее всего это ошибка
            echo "404";
        }
    }
