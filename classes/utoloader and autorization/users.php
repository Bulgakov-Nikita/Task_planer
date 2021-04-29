<?php

require_once 'planer.log\models\db.php';

use DB;

// Класс для авторизации
class authorization extends DB
{
    // Функцияя для получения данныъх о логине и пароле
    function getUserData()
    {
        if (isset($_POST["login"])) {

            return $login = $_POST["login"];
        } else {
            echo 'Введите логин';
        }
        if (isset($_POST["pass"])) {

            return $pass = $_POST["pass"];
        } else {
            echo 'Введите пароль';
        }
    }

    // Функция для проверки на наличие логина и пароля в базе данных
    function ExistenceСheck($login, $pass)
    {
        $Checked = false;
        $mysql = DB::create();
        $mysql->connect('localhost', 'root', 'lag123', 'tasks', '3306');
        $Check = "select * from users where `login`=$login and pass = $pass;"
        DB::CheckSelect($Check);
        if ($Checked === true) {
            echo "вы вошли"
        } else {
            echo "error"
        }
    }
}

// вузов функций
$input = new authorization;
$input->getUserData();
$input->ExistenceСheck($login, $pass);