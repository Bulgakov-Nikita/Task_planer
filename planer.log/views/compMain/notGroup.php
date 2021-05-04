<div class="col">
	<!-- Заголовок -->
	<div class="text">
		<p> 
			Просто задачи(без групп) 
			<button id="muBth"><img class="item-img" src="Img/add.png"></button>
		</p>
		<!-- менюшка добавления задачи -->
		<div id="menuAdd">
			<p id="ppp">Добавить задачу</p>
			<div><form action="/main/add" method="get">
				<textarea name="name" id="tex">Название задачи</textarea>
				<textarea name='desc' id="tex">Описание</textarea>
				<input name='group' value='null' style='display:none;'>
				<input name='project' value='null' style='display:none;'>
				<?php
					$q = new Query();
					$type_task = $q->select('*', 'type_task');
					//Получаем type task, для показа их в списке, чтобы переместить задачу
					$strOp3 = "";
					while($tt = $type_task->fetch_assoc()){
						//if($tt['created_by'] == $_COOKIE['id']){
							$strOp3 .= "<option value='".$tt['id']."'>".$tt['name']."</option>";
						//}
					}

					echo "
						<br/>
						Тип:
						<select name='type_task'>".$strOp3."</select>
					";
				?>
				Дата начала:
				<input type="date" name="date_b"><br/>
				Дата конца:
				<input type="date" name="date_e"><br/>
				<button name="type_bt" value="tasks">Добавить</button>
			</form></div>
		</div>
	</div>
	<!-- Задачи показываются в этом блоке -->
	<div style="border-top: 5px solid #000000;padding: 5px;">
		<!-- Тут вывод задач без групп и проектов -->
		<?php
			//вывод задач без групп и проектов
			$q = new Query();
			$res = $q->select('*', 'tasks');
			$groups = $q->select('*', 'groups');
			$projects = $q->select('*', 'projects');

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

			while($row = $res->fetch_assoc()){//И выводим задачи этой группы
				if($row['created_by'] == $_COOKIE['id'] && $row["groups_id"] == '' && $row['projects_id'] == ''){
					include 'views/compMain/viewTask.php';
				}
			}
		?>
	</div>
</div>