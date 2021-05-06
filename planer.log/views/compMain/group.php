<?php
	//НУЖНО СДЕЛАТЬ ВЫВОД ЗАДАЧ БЕЗ ГРУПП И ПРОЕКТОВ, ВЫВОД ПРОЕКТОВ
		echo "<div class='col'>
		<!-- Заголовок -->
			<div class='text'>
				<p> ";
		//
		echo $group['name']."<br/>";//то выводим эту группу
		//
		echo "<button id='muBth' style='display: inline-block;'><img class='item' src='Img/free-icon-three-dots-more-indicator-60969.png' alt=''></button>
					<!-- менюшка редактирования группы -->
					<div id='menuAdd'>
						<p id='p'>Редактирование</p>
						<button id='muBth' class='bt_cc' style='display: block;'>Изменить</button>
						<div id='menuAdd'>
							<button id='muBth' class='bt_cc'>Название</button>
							<div id='menuAdd'>
								<form action='/main/edit' method='get'>
									<input name='atr' value='name' style='display: none;'>
									<input name='type_bt' value='groups' style='display: none;'>
									<input type='text' name='data'>
									<button name='id' value='".$group['id']."'>Изменить</button>
								</form>
							</div>
							<button id='muBth' class='bt_cc' style='display: block;'>Описание</button>
							<div id='menuAdd'>
								<form action='/main/edit' method='get'>
									<input name='atr' value='description' style='display: none;'>
									<input name='type_bt' value='groups' style='display: none;'>
									<textarea type='text' name='data'></textarea>
									<button name='id' value='".$group['id']."'>Изменить</button>
								</form>
							</div>
							<button id='muBth' class='bt_cc' style='display: block;'>Дату начала</button>
							<div id='menuAdd'>
								<form action='/main/edit' method='get'>
									<input name='atr' value='date_begin' style='display: none;'>
									<input name='type_bt' value='groups' style='display: none;'>
									<input type='text' name='data'>
									<button name='id' value='".$group['id']."'>Изменить</button>
								</form>
							</div>
							<button id='muBth' class='bt_cc' style='display: block;'>Дату конца</button>
							<div id='menuAdd'>
								<form action='/main/edit' method='get'>
									<input name='atr' value='date_end' style='display: none;'>
									<input name='type_bt' value='groups' style='display: none;'>
									<input type='text' name='data'>
									<button name='id' value='".$group['id']."'>Изменить</button>
								</form>
							</div>
						</div>
						<button id='muBth' class='bt_cc' style='display: block;'>Переместить</button>
						<div id='menuAdd'>
							<form action='/main/edit' method='get'>
								<input name='atr' value='projects_id' style='display: none;'>
								<input name='type_bt' value='groups' style='display: none;'>
								<select name='data'>
									".$strOp2."
								</select>
								<button name='id' value='".$group['id']."'>переместить</button>
							</form>
						</div>
						<form action='/main/delete' method='get'>
							<input type='text' name='type_bt' style='display: none;' value='groups'><br/>
							<button name='del' value='$group[id]' style='width: 150px;'>delete</button>
						</form><br/>
						<button id='muBth' class='bt_cc'>Инфа</button>
						<div id='menuAdd'>
							<script>
								// 1. Создаём новый объект XMLHttpRequest
								var xhr = new XMLHttpRequest();
						
								// 2. Конфигурируем его: GET-запрос на URL 'phones.json'
								xhr.open('GET', '/main/showInfo?type_bt=groups&group=".$group['id']."', false);
						
								// 3. Отсылаем запрос
								xhr.send();
						
								// 4. Если код ответа сервера не 200, то это ошибка
								if (xhr.status != 200) {
									// обработать ошибку
									documen.write( xhr.status + ': ' + xhr.statusText ); // пример вывода: 404: Not Found
								} else {
									// вывести результат
									document.write( xhr.responseText ); // responseText -- текст ответа.
								}
							</script>
						</div>
					</div>    
					<button id='muBth' style='display: inline-block;'><img class='item-img' src='Img/add.png'></button>
					<!-- менюшка добавления задачи -->
					<div id='menuAdd'>
						<!--<p id='ppp'>Добавить название</p>-->
						<div><form action='/main/add' method='get'>
							Название задачи:<br/>
                            <textarea name='name' id='tex'></textarea>
                            <br/>
                            Описание:<br/>
                            <textarea name='desc' id='tex'></textarea>
                            <br/>
							<input name='group' value='".$group['id']."' style='display:none;'>
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
						</form></div>
					</div>
				</p>
			</div>
			<!-- Задачи показываются в этом блоке -->
			<div style='border-top: 5px solid #000000;padding: 5px;'>";

		//Вывод задач в грппе:
		while($row = $res->fetch_assoc()){//И выводим задачи этой группы
			if($row['created_by'] == $_COOKIE['id'] && $row["groups_id"] == $g && $row['projects_id'] == $p){
				include 'views/compMain/viewTask.php';
			}
		}
		$res->data_seek(0);//Чтоб можно было использовать фетч_ассокк() ещё много раз
		
		echo "</div>
		</div>";
?>