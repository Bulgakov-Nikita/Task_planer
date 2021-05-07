<div class="navbar"> 
    <?php
        //ЭТО ФАЙЛ С КОНТЕНТОМ ДЛЯ ГЛАВНОЙ СТРАНИЦЫ
        //Аккаунт:
        if(isset($_COOKIE['login'])){
            echo "<p>Аккаунт: ".$_COOKIE['login'].' - '.$_COOKIE['id']."</p><br/>";
            echo "<a id='muBth1' href='/setting/'>редактировать аккаунт</a><br/>";
            echo "<a id='muBth1' href='/auth/logout'>Выход</a><br/>";
        }else{
            echo "<a id='muBth1' href='/auth/'>авторизация</a>   ";
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