<?php
$q = new Query();
$type = $q->select('*', 'type_task');
//Я знаю что это не выгодно по скорости вывода информации, но времени нет делать по другому
while($tt = $type->fetch_assoc()){
	if($row['type_task_id'] == $tt['id']){
		echo "
		<!-- Задача -->
		<div id='task_style' style='border:1px solid #000000;'>
			<!-- мини инфа о задаче -->
			<div style='display: inline-block;'>
				<p id='nameTask'>".$row['name'].' - Тип: '.$tt['name'].' - '.$row['active']."</p>
				".$row['description'].'<br/>Начало: '.$row['data_begin'].'<br/>Конец:  '.$row['data_end']."
			</div>
			<!-- КОНЕЦ мини инфы о задаче -->

			<!-- кнопка '...' и её менюшка -->
			<button id='muBth' class='bt_cc' style='float: none;'>...</button>
			<div id='menuAdd'>

				<!-- Кнопка Изменить и её менюшка -->
				<button id='muBth' class='bt_cc' style='display: block;'>Изменить</button>
				<div id='menuAdd'>
					<!-- Кнопка Название и её менюшка -->
					<button id='muBth' class='bt_cc'>Название</button>
					<div id='menuAdd'>
						<form action='/main/edit' method='get'>
							<input name='atr' value='name' style='display: none;'>
							<input name='type_bt' value='tasks' style='display: none;'>
							<input type='text' name='data'>
							<button name='id' value='".$row['id']."'>Изменить</button>
						</form>
					</div>

					<!-- Кнопка Описание и её менюшка -->
					<button id='muBth' class='bt_cc' style='display: block;'>Описание</button>
					<div id='menuAdd'>
						<form action='/main/edit' method='get'>
							<input name='atr' value='description' style='display: none;'>
							<input name='type_bt' value='tasks' style='display: none;'>
							<textarea type='text' name='data'></textarea>
							<button name='id' value='".$row['id']."'>Изменить</button>
						</form>
					</div>

					<!-- Кнопка Дата начала и её менюшка -->
					<button id='muBth' class='bt_cc' style='display: block;'>Дату начала</button>
					<div id='menuAdd'>
						<form action='/main/edit' method='get'>
							<input name='atr' value='data_begin' style='display: none;'>
							<input name='type_bt' value='tasks' style='display: none;'>
							<input type='text' name='data'>
							<button name='id' value='".$row['id']."'>Изменить</button>
						</form>
					</div>

					<!-- Кнопка Дата конца и её менюшка -->
					<button id='muBth' class='bt_cc' style='display: block;'>Дату конца</button>
					<div id='menuAdd'>
						<form action='/main/edit' method='get'>
							<input name='atr' value='data_end' style='display: none;'>
							<input name='type_bt' value='tasks' style='display: none;'>
							<input type='text' name='data'>
							<button name='id' value='".$row['id']."'>Изменить</button>
						</form>
					</div>
				</div>
				<!-- КОНЕЦ менюшки для кнопки Изменить -->

				<!-- Кнопка Переместить и её менюшка -->
				<button id='muBth' class='bt_cc' style='display: block;'>Переместить</button>
				<div id='menuAdd'>
					<!-- Кнопка В группу и её менюшка -->
					<button id='muBth' class='bt_cc' style='display: block;'>В группу</button>
					<div id='menuAdd'>
						<form action='/main/edit' method='get'>
							<input name='atr' value='groups_id' style='display: none;'>
							<input name='type_bt' value='tasks' style='display: none;'>
							<select name='data'>
								".$strOp."
							</select>

							<button name='id' value='".$row['id']."'>переместить</button>
						</form>
					</div>

					<!-- Кнопка В проект и её менюшка -->
					<button id='muBth' class='bt_cc' style='display: block;'>В проект</button>
					<div id='menuAdd'>
						<form action='/main/edit' method='get'>
							<input name='atr' value='projects_id' style='display: none;'>
							<input name='type_bt' value='tasks' style='display: none;'>
							<select name='data'>
								".$strOp2."
							</select>
							<button name='id' value='".$row['id']."'>переместить</button>
						</form>
					</div>
				</div>

				<!-- Кнопка удалить -->
				<form action='/main/delete' method='get'>
					<input type='text' name='type_bt' style='display: none;' value='tasks'><br/>
					<button name='del' value='$row[id]' style='width: 150px;'>delete</button>
				</form><br/>

				<!-- Кнопка Инфа и её менюшка -->
				<button id='muBth' class='bt_cc' name='".$row['id'].'-tasks'."'>Инфа</button>
				<div id='menuAdd' style='color:black;'>
					<!-- info -->
				</div>
			</div>
			<!-- КОНЕЦ менюшки для кнопки '...' -->
		</div>
		<!-- КОНЕЦ Задачи -->";
	}
}
?>