<?php
	while($pr = $projects->fetch_assoc()){
		if($pr['created_by'] == $_COOKIE['id']){
			echo "<div class='col col_p'>
			<!-- Заголовок -->
				<div class='text'>
					<p> ";
			//project name:
			echo $pr['name']."<br/>";

			//Две кнопки и ихние менюшки для проекта
			echo "
			<button id='muBth'><img class='item' src='Img/free-icon-three-dots-more-indicator-60969.png' alt=''></button>
				<!-- менюшка редактирования группы -->
				<div id='menuAdd'>
					<!-- Кнопка Изменить и её менюшка -->
					<button id='muBth' class='bt_cc' style='display: block;'>Изменить</button>
					<div id='menuAdd'>
						<!-- Кнопка Название и её менюшка -->
						<button id='muBth' class='bt_cc'>Название</button>
						<div id='menuAdd'>
							<form action='/main/edit' method='get'>
								<input name='atr' value='name' style='display: none;'>
								<input name='type_bt' value='projects' style='display: none;'>
								<input type='text' name='data'>
								<button name='id' value='".$pr['id']."'>Изменить</button>
							</form>
						</div>

						<!-- Кнопка Описание и её менюшка -->
						<button id='muBth' class='bt_cc' style='display: block;'>Описание</button>
						<div id='menuAdd'>
							<form action='/main/edit' method='get'>
								<input name='atr' value='description' style='display: none;'>
								<input name='type_bt' value='projects' style='display: none;'>
								<textarea type='text' name='data'></textarea>
								<button name='id' value='".$pr['id']."'>Изменить</button>
							</form>
						</div>

						<!-- Кнопка Дату начала и её менюшка -->
						<button id='muBth' class='bt_cc' style='display: block;'>Дату начала</button>
						<div id='menuAdd'>
							<form action='/main/edit' method='get'>
								<input name='atr' value='date_begin' style='display: none;'>
								<input name='type_bt' value='projects' style='display: none;'>
								<input type='text' name='data'>
								<button name='id' value='".$pr['id']."'>Изменить</button>
							</form>
						</div>

						<!-- Кнопка Дату конца и её менюшка -->
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
					<!-- КОНЕЦ менюшки для кнопки Изменить -->

					<!-- Кнопка удалить -->
					<form action='/main/delete' method='get'>
						<input type='text' name='type_bt' style='display: none;' value='projects'><br/>
						<button name='del' value='$pr[id]' style='width: 150px;'>delete</button>
					</form><br/>

					<!-- Кнопка Инфа и её менюшка -->
					<button id='muBth' class='bt_cc' name='".$pr['id']."-projects'>Инфа</button>
					<div id='menuAdd'>
						<!-- info -->
					</div>
				</div>
				<!-- КОНЕЦ менюшки для кнопки '...' -->

				<!-- Кнопка '+' и её менюшка -->
				<button id='muBth'><img class='item-img' src='Img/add.png'></button>
				<div id='menuAdd'>
					<!-- Кнопка Группу и её менюшка -->
					<button id='muBth'>Группу</button>
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

					<!-- Кнопка Задачу и её менюшка -->
					<button id='muBth'>Задачу</button>
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
				<!-- КОНЕЦ менюшки для кнопки '+' -->
				</p>
			</div>
			<!-- Задачи и группы показываются в этом блоке -->
			<div style='border-top: 5px solid #000000;padding: 5px;'>";
			//Вывод задач без грппы, но в проекте
			while($row = $tasks->fetch_assoc()){//И выводим задачи этой группы
				if($row['created_by'] == $_COOKIE['id'] && $row["groups_id"] == '' && $row['projects_id'] == $pr['id']){
					include 'views/compMain/viewTask.php';
				}
			}

			//вывод групп с задачами
			$groups->data_seek(0);
			while ($group = $groups->fetch_assoc()) {//
				$g = $group['id'];	//сравнение с группой для вывода задачи
				$p = $pr['id'];		//сравнение с проектом для вывода задачи
				$p1 = $pr['id'];	//добавление задачи в эту группу и проект
				if ($group['created_by'] == $_COOKIE['id'] && $group['projects_id'] == $pr['id']) {//Если группа совподает с юзером
					include 'views/compMain/group.php';
				}
			}

			echo "
			</div>
			<!-- КОНЕЦ Задачи и группы показываются в этом блоке -->
			</div>";
		}
	}
	//На ЧС:
	$tasks->data_seek(0);//Чтоб можно было использовать фетч_ассокк() ещё много раз
	$groups->data_seek(0);//Чтоб можно было использовать фетч_ассокк() ещё много раз
	$projects->data_seek(0);//Чтоб можно было использовать фетч_ассокк() ещё много раз
?>