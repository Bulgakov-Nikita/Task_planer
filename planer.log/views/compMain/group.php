<?php
	//Отвкрывающие теги для группы и открывающий тег для загаловка
	echo "<div class='col'>
	<!-- Заголовок -->
		<div class='text'>
			<p> ";
	
	//Вывод названия группы
	echo $group['name']."<br/>";//то выводим эту группу

	//Тут "создаются" кнопки и ихние менюшки
	echo "
		<button id='muBth' style='display: inline-block;'><img class='item' src='Img/free-icon-three-dots-more-indicator-60969.png' alt=''></button>
			<!-- менюшка редактирования группы -->
			<div id='menuAdd'>
				<!-- Кнопка измененить и её менюшка -->
				<button id='muBth' class='bt_cc' style='display: block;'>Изменить</button>
				<div id='menuAdd'>

					<!-- Кнопка Название и её менюшка -->
					<button id='muBth' class='bt_cc'>Название</button>
					<div id='menuAdd'>
						<form action='/main/edit' method='get'>
							<input name='atr' value='name' style='display: none;'>
							<input name='type_bt' value='groups' style='display: none;'>
							<input type='text' name='data'>
							<button name='id' value='".$g."'>Изменить</button>
						</form>
					</div>
					
					<!-- Кнопка Описание и её менюшка -->
					<button id='muBth' class='bt_cc' style='display: block;'>Описание</button>
					<div id='menuAdd'>
						<form action='/main/edit' method='get'>
							<input name='atr' value='description' style='display: none;'>
							<input name='type_bt' value='groups' style='display: none;'>
							<textarea type='text' name='data'></textarea>
							<button name='id' value='".$g."'>Изменить</button>
						</form>
					</div>

					<!-- Кнопка Дата начала и её менюшка -->
					<button id='muBth' class='bt_cc' style='display: block;'>Дату начала</button>
					<div id='menuAdd'>
						<form action='/main/edit' method='get'>
							<input name='atr' value='date_begin' style='display: none;'>
							<input name='type_bt' value='groups' style='display: none;'>
							<input type='text' name='data'>
							<button name='id' value='".$g."'>Изменить</button>
						</form>
					</div>

					<!-- Кнопка Дата конца и её менюшка -->
					<button id='muBth' class='bt_cc' style='display: block;'>Дату конца</button>
					<div id='menuAdd'>
						<form action='/main/edit' method='get'>
							<input name='atr' value='date_end' style='display: none;'>
							<input name='type_bt' value='groups' style='display: none;'>
							<input type='text' name='data'>
							<button name='id' value='".$g."'>Изменить</button>
						</form>
					</div>
				</div>

				<!-- Кнопка переместить и её менюшка -->
				<button id='muBth' class='bt_cc' style='display: block;'>Переместить</button>
				<div id='menuAdd'>
					<form action='/main/edit' method='get'>
						<input name='atr' value='projects_id' style='display: none;'>
						<input name='type_bt' value='groups' style='display: none;'>
						<select name='data'>
							".$strOp2."
						</select>
						<button name='id' value='".$g."'>переместить</button>
					</form>
				</div>

				<!-- Кнопка удалить -->
				<form action='/main/delete' method='get'>
					<input type='text' name='type_bt' style='display: none;' value='groups'><br/>
					<button name='del' value='".$g."' style='width: 150px;'>delete</button>
				</form><br/>

				<!-- Кнопка Инфа и её менюшка -->
				<button id='muBth' class='bt_cc' name='".$g.'-'."groups'>Инфа</button>
				<div id='menuAdd'>
					<!-- info -->
				</div>
			</div>    
			<!-- КОНЕЦ менюшки редактирования группы -->

			<!-- Кнопка '+' и её менюшка -->
			<button id='muBth' style='display: inline-block;'><img class='item-img' src='Img/add.png'></button>
			<!-- менюшка добавления задачи -->
			<div id='menuAdd'>
				<form action='/main/add' method='get'>
					Название задачи:<br/>
					<textarea name='name' id='tex'></textarea>
					<br/>
					Описание:<br/>
					<textarea name='desc' id='tex'></textarea>
					<br/>
					<input name='group' value='".$g."' style='display:none;'>
					<input name='project' value='".$p1."' style='display:none;'>
					<br/>
					Тип:<br/>
					<select name='type_task'>".$strOp3."</select>
					<br/>
					Дата начала:<br/>
					<input type='date' name='date_b'><br/>
					Дата конца:<br/>
					<input type='date' name='date_e'><br/>
					<button name='type_bt' value='tasks'>Добавить</button>
				</form>
			</div>
			<!-- КОНЕЦ менюшки для кнопки '+' -->
		</p>
	</div>
	<!-- Задачи показываются в этом блоке -->
	<div style='border-top: 5px solid #000000;padding: 5px;'>";

	//Вывод задач в грппе:
	while($row = $tasks->fetch_assoc()){//И выводим задачи этой группы
		if($row['created_by'] == $_COOKIE['id'] && $row["groups_id"] == $g && $row['projects_id'] == $p){
			include 'views/compMain/viewTask.php';
		}
	}
	
	echo "
	</div>
	<!-- КОНЕЦ Задачи показываются в этом блоке -->
	</div>";

	//На ЧС:
	$tasks->data_seek(0);//Чтоб можно было использовать фетч_ассокк() ещё много раз
	// $groups->data_seek(0);//Чтоб можно было использовать фетч_ассокк() ещё много раз
	// $projects->data_seek(0);//Чтоб можно было использовать фетч_ассокк() ещё много раз
?>