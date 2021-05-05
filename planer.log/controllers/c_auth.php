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
        //выход из аккаунта
        public function logout() {
            unset($_COOKIE['login']);
            unset($_COOKIE['password']);
            unset($_COOKIE['id']);
            setcookie("login", null, -1, "/");
            setcookie("password", null, -1, "/");
            setcookie("id", null, -1, "/");
        
            echo "<script>document.location.replace('/');</script>";
        }
    }
