<?php
class c_setting extends controller{
    public function view(){
        $this->view->generete("setting.php", "temp_main.php");
    }
    //редактирование
    public function set(){
        $n = 'm_'.$_POST['type_bt'];
        require_once 'models/'.$n.'.php';
        $obj = new $n();
        $obj->set();
        //после 10 строки кода, код не должен тут исполнятся, но если исполниться то скорее всего это ошибка
        echo "404";
    }
}
