<?php 
    //ДО КОНЦА РЕАЛИЗОВАТЬ ЭТОТ КЛАСС
    class m_users extends model{
        //этот метод добавления(регистрации) пользователей
        public function add(){
            $q = new Query();
            $res = $q->select("*", "users");
            $arr1 = [];
            $i = 0;
            while($row = $res->fetch_assoc()){
                $arr1[$i] = [$row['id'], $row['name'], $row['password']];
                $i++;
            }

            $cnt = $i;
            $i = 0;
            for($i = 0; $i < $cnt; $i++){
                if($arr1[$i][1] == $_POST["login"] && $arr1[$i][2] == $_POST["password"]){
                    //если совпало, то сохраняем данные в куки и переходим на главный view
                    echo "<script>document.location.replace('http://planer.log/reg/');</script>";
                }
            }
            //НЕХОЧЕТ РАБОТАТЬ ЧЕРЕЗ insertTasks!!!!!!!!! В БУДУЩЕМ ДОДЕЛАТЬ!!!!!!
            $ass = DB::getDB();
            $ass->sql->query("INSERT INTO users VALUES (null, '".$_POST['login']."', '".$_POST['password']."');");
            // var_dump("INSERT INTO users VALUES (null, '".$_POST['login']."', '".$_POST['password']."');");
            // die();
            // $q->insertTasks(
            //     Array(
            //         'name' => $_POST['login'],
            //         'password' => $_POST['password']
            //     ),
            //     "users"
            // );
            setcookie("id", $arr1[count($arr1) - 1][0] + 1, time()+60*60*24, "/");
            setcookie("login", $_POST['login'], time()+60*60*24, "/");
            setcookie("password", $_POST['password'], time()+60*60*24, "/");
            //Иначе авторизовываемся заного, переходом на этот же view
            echo "<script>document.location.replace('http://planer.log/');</script>";
        }
        public function edit(){
            $t = new Query();
            $t->update('users', 'name', $_POST['login'], 'id='.$_COOKIE['id']);
            $t->update('users', 'password', $_POST['password'], 'id='.$_COOKIE['id']);
            setcookie("login", $_POST['login'], time()+60*60*24, "/");
            setcookie("password", $_POST['password'], time()+60*60*24, "/");
            echo "<script>document.location.replace('http://planer.log/');</script>";
        }
        public function delete(){
        }
        public function get_info(){
        }
        //метод авторизации пользователей
        public function auth(){
            //NOT WORKING:
            $q = new Query();
            $q->select("*", "users");
            $res = $q->exec();
            $arr1 = [];
            $i = 0;
            while($row = $res->fetch_assoc()){
                $arr1[$i] = [$row['id'], $row['name'], $row['password']];
                $i++;
            }

            $cnt = $i;
            $i = 0;
            for($i = 0; $i < $cnt; $i++){
                if($arr1[$i][1] == $_POST['login'] && $arr1[$i][2] == $_POST['password']){
                    //если совпало, то сохраняем данные в куки и переходим на главный view
                    setcookie("id", $arr1[$i][0], time()+60*60*24, "/");
                    setcookie("login", $arr1[$i][1], time()+60*60*24, "/");
                    setcookie("password", $arr1[$i][2], time()+60*60*24, "/");
                    echo "<script>document.location.replace('http://planer.log/');</script>";
                }
            }
            //Иначе авторизовываемся заного, переходом на этот же view
            echo "<script>document.location.replace('http://planer.log/auth/');</script>";
        }
    }
