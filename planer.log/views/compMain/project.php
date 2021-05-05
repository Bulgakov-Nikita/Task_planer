<?php
	//вывод проектов
	$q = new Query();
	$projects = $q->select('*', 'projects');
	$groups = $q->select('*', 'groups');
	$res = $q->select('*', 'tasks');
	$type_task = $q->select('*', 'type_task');

	//Получаем группы, для показа их в списке, чтобы переместить задачу
	$strOp = "<option value='null'>----</option>";
	while($gp = $groups->fetch_assoc()){
		if($gp['created_by'] == $_COOKIE['id']){
			$strOp .= "<option value='".$gp['id']."'>".$gp['name']."</option>";
		}
	}
	//Получаем проекты, для показа их в списке, чтобы переместить задачу
	$strOp2 = "<option value='null'>----</option>";
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
	$projects->data_seek(0);//Чтоб можно было использовать фетч_ассокк() ещё много раз
	while($pr = $projects->fetch_assoc()){
		if($pr['created_by'] == $_COOKIE['id']){
			echo "<div class='col col_p'>
			<!-- Заголовок -->
				<div class='text'>
					<p> ";
			//project name:
			echo $pr['name']."<br/>";

			//
			echo "<button id='muBth'><img class='item' src='Img/free-icon-three-dots-more-indicator-60969.png' alt=''></button>
					<!-- менюшка редактирования группы -->
					<div id='menuAdd'>
					<p id='p'>Редактирование</p>
					<button id='muBth' class='bt_cc' style='display: block;'>Изменить</button>
					<div id='menuAdd'>
						<button id='muBth' class='bt_cc'>Название</button>
						<div id='menuAdd'>
							<form action='/main/edit' method='get'>
								<input name='atr' value='name' style='display: none;'>
								<input name='type_bt' value='projects' style='display: none;'>
								<input type='text' name='data'>
								<button name='id' value='".$pr['id']."'>Изменить</button>
							</form>
						</div>
						<button id='muBth' class='bt_cc' style='display: block;'>Описание</button>
						<div id='menuAdd'>
							<form action='/main/edit' method='get'>
								<input name='atr' value='description' style='display: none;'>
								<input name='type_bt' value='projects' style='display: none;'>
								<textarea type='text' name='data'></textarea>
								<button name='id' value='".$pr['id']."'>Изменить</button>
							</form>
						</div>
						<button id='muBth' class='bt_cc' style='display: block;'>Дату начала</button>
						<div id='menuAdd'>
							<form action='/main/edit' method='get'>
								<input name='atr' value='date_begin' style='display: none;'>
								<input name='type_bt' value='projects' style='display: none;'>
								<input type='text' name='data'>
								<button name='id' value='".$pr['id']."'>Изменить</button>
							</form>
						</div>
						<button id='muBth' class='bt_cc' style='display: block;'>Дату конца</button>
						<div id='menuAdd'>
							<form action='/main/edit' method='get'>
								<input name='atr' value='date_end' style='display: none;'>
								<input name='type_bt' value='projects' style='display: none;'>
								<input type='text' name='data'>
								<button name='id' value='".$pr['id']."'>Изменить</button>
							</form>
						</div>
						</div>
						<form action='/main/delete' method='get'>
							<input type='text' name='type_bt' style='display: none;' value='projects'><br/>
							<button name='del' value='$pr[id]' style='width: 150px;'>delete</button>
						</form><br/>
						<button id='muBth' class='bt_cc'>Инфа</button>
						<div id='menuAdd'>
							Тут вся показывается иформация
						</div>
					</div>

					<button id='muBth'><img class='item-img' src='Img/add.png'></button>
					<!-- менюшка добавления задачи -->
					<div id='menuAdd'>
					    <button id='muBth'>Группу</button>
					    <!-- Меню для кнопки группу -->
					    <div id='menuAdd'>
					        <form action = 'main/add/' method = 'get'>
                                Название группы:
                                <textarea name='name' id='tex'></textarea>
                                Описание:
                                <textarea name='desc' id='tex'></textarea>
                                Дата начала:
                                <input type='date' name='date_b'>
                                Дата завершения:
                                <input type='date' name='date_e'>
                                <input type='text' value='".$pr['id']."' name='project' style='display:none;'>
                                <button name='type_bt' value='groups'>Добавить</button>
                            </form>
                        </div>
					    <br/>
					    <button id='muBth'>Задачу</button>
					    <!-- Меню для кнопнки задачу -->
					    <div id='menuAdd'>
					        <form action = 'main/add/' method = 'get'>
                                Название задачи:
                                <textarea name='name' id='tex'></textarea>
                                Описание:
                                <textarea name='desc' id='tex'></textarea>
                                Дата начала:
                                <input type='date' name='date_b'>
                                Дата завершения:
                                <input type='date' name='date_e'>
                                <input name='group' value='null' style='display:none;'>
                                <input name='project' value='".$pr['id']."' style='display:none;'>
                                Тип:
						        <select name='type_task'>".$strOp3."</select>
                                <button name='type_bt' value='tasks'>Добавить</button>
					        </form>
                        </div>
					</div>
					</p>
				</div>
				<!-- Задачи показываются в этом блоке -->
				<div style='border-top: 5px solid #000000;padding: 5px;'>";
			//Вывод задач без грппы, но в проекте
			$res->data_seek(0);
			while($row = $res->fetch_assoc()){//И выводим задачи этой группы
				if($row['created_by'] == $_COOKIE['id'] && $row["groups_id"] == '' && $row['projects_id'] == $pr['id']){
					include 'views/compMain/viewTask.php';
				}
			}
			$res->data_seek(0);//Чтоб можно было использовать фетч_ассокк() ещё много раз
			//вывод групп с задачами
			$groups->data_seek(0);
			while ($group = $groups->fetch_assoc()) {//
				$g = $group['id'];
				$p = $pr['id'];
				$p1 = $pr['id'];
				if ($group['created_by'] == $_COOKIE['id'] && $group['projects_id'] == $pr['id']) {//Если группа совподает с юзером
					include 'views/compMain/group.php';
				}
			}
			//$group->data_seek(0);//Чтоб можно было использовать фетч_ассокк() ещё много раз

			echo "</div>
			</div>";
		}
	}
?>