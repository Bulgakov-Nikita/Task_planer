<div class="navbar"> 
    <?php
        //ЭТО ФАЙЛ С КОНТЕНТОМ ДЛЯ ГЛАВНОЙ СТРАНИЦЫ
        //Аккаунт:
        if(isset($_COOKIE['login'])){
            echo "<p>Аккаунт: ".$_COOKIE['login'].' - '.$_COOKIE['id']."</p><br/>";
            echo "<a id='muBth1' href='/auth/logout'>выход</a><br/>";
        }else{
            echo "<a id='muBth1' href='/auth/'>авториз</a>   ";
            echo "<a id='muBth1' href='/reg/'>регистрация</a>";
        }
    ?>
    <span class="logo">Планировщик</span>
    <div class="plus">
        <!-- Кнопка плюс -->
        <button id="bt_mainMenu">
            <img class = "imgplus" src="Img/add.png" alt="#">
        </button>

        <!-- менюшка показывающаяся при нажатии на "+" -->
        <div id="menu_main">
            <p id="p">Добавить</p>
            <div id="bor">
                <button id="bt_add">Проект</button>
                <div id="addMenu">
                    <form action="/main/add">
                        Название проекта:
                        <input type="text" name="name"><br/>
                        <br/>
                        Описание:
                        <textarea name="desc" id="tex" cols="30" rows="10"></textarea>
                        <br/>
                        Дата начала:
                        <input type="date" name="date_b"><br/>
                        Дата конца:
                        <input type="date" name="date_e"><br/>
                        <button name="type_bt" value="projects">Добавить</button>
                    </form>
                </div>
            </div>
            <div id="bor">
                <button id="bt_add">Группу</button>
                <div id="addMenu">
                    <form action="/main/add">
                        Название группы:
                        <input type="text" name="name"><br/>
                        <?php
                            $q = new Query();
                            $projects = $q->select('*', 'projects');

                            //Получаем проекты, для показа их в списке, чтобы переместить задачу
                            $strOp2 = "<option value='null'>Без проекта</option>";
                            while($pr = $projects->fetch_assoc()){
                                if($pr['created_by'] == $_COOKIE['id']){
                                    $strOp2 .= "<option value='".$pr['id']."'>".$pr['name']."</option>";
                                }
                            }

                            echo "
                                <br/>
                                Проект:
                                <select name='project'>".$strOp2."</select>
                                <br/>
                            ";
                        ?>
                        <br/>
                        Описание:
                        <textarea name="desc" id="tex" cols="30" rows="10"></textarea>
                        <br/>
                        Дата начала:
                        <input type="date" name="date_b"><br/>
                        Дата конца:
                        <input type="date" name="date_e"><br/>
                        <button name="type_bt" value="groups">Добавить</button>
                    </form>
                </div>
            </div>
            <div id="bor">
                <button id="bt_add">Задачу</button>
                <div id="addMenu">
                    <form action="/main/add">
                        Название задачи:
                        <input type="text" name="name"><br/>
                        <?php
                            $q = new Query();
                            $groups = $q->select('*', 'groups');
                            $projects = $q->select('*', 'projects');
                            $type_task = $q->select('*', 'type_task');
                        
                            //Получаем группы, для показа их в списке, чтобы переместить задачу
                            $strOp = "<option value='null'>Без группы</option>";
                            while($gp = $groups->fetch_assoc()){
                                if($gp['created_by'] == $_COOKIE['id']){
                                    $strOp .= "<option value='".$gp['id']."'>".$gp['name']."</option>";
                                }
                            }
                        
                            //Получаем проекты, для показа их в списке, чтобы переместить задачу
                            $strOp2 = "<option value='null'>Без проекта</option>";
                            while($pr = $projects->fetch_assoc()){
                                if($pr['created_by'] == $_COOKIE['id']){
                                    $strOp2 .= "<option value='".$pr['id']."'>".$pr['name']."</option>";
                                }
                            }

                            //Получаем type task, для показа их в списке, чтобы переместить задачу
                            $strOp3 = "";
                            while($tt = $type_task->fetch_assoc()){
                                //if($tt['created_by'] == $_COOKIE['id']){
                                    $strOp3 .= "<option value='".$tt['id']."'>".$tt['name']."</option>";
                                //}
                            }

                            echo "
                                <br/>
                                Группа:
                                <select name='group'>".$strOp."</select>
                                <br/>
                                Проект:
                                <select name='project'>".$strOp2."</select>
                                <br/>
                                Тип:
                                <select name='type_task'>".$strOp3."</select>
                            ";
                        ?>
                        <br/>
                        Описание:
                        <textarea name="desc" id="tex" cols="30" rows="10"></textarea>
                        <br/>
                        Дата начала:
                        <input type="date" name="date_b"><br/>
                        Дата конца:
                        <input type="date" name="date_e"><br/>
                        <button name="type_bt" value="tasks">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>