<?php
    require_once 'db.php';
    require_once 'core/model.php';
    require_once 'core/controller.php';
    require_once 'core/view.php';

    //Добавить конфиг с параметрами БД!!!!
    //requre_once 'config.php';

    class Router {
        public function run() {
            //connect on DB
            $sql = DB::getDB();
            $sql->connect("localhost", "root", "", "tasks_db", "3306");

            //по умолчанию контроллер и экшн
            $controller_name = "main";
            $action_name = "view";

            //получаем "ури"
            $uri = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

            // получаем имя контроллера
            if ( !empty($uri[1]) ){	
                $controller_name = $uri[1];
            }
            
            // получаем имя экшена
            if ( !empty($uri[2]) ){
                $action_name = $uri[2];
            }

            //префикс к названию контроллера
            $controller_name = "c_".$controller_name;

            // подцепляем(подключаем) файл с классом контроллера
            $controller_file = strtolower($controller_name).'.php';
            $controller_path = "controllers/".$controller_file;
            if(file_exists($controller_path)){
                //Подключаем класс контроллера, чтобы потом создать его
                include $controller_path;
            }else{
                //Если не подключился, то ошибка
                echo "404 Ponel? asss";
            }

            // создаем контроллер
            $controller = new $controller_name();
            //$action = $action_name;
            
            if(method_exists($controller, $action_name)){
                // вызываем действие контроллера
                $controller->$action_name();
            }else{
                //Если не создался, то ошибка
                echo "404 Ponel? dddd";
            }
        }
    }

