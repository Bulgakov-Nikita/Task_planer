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
                Название задачи:<br/>
				<textarea name="name" id="tex"></textarea>
                <br/>
                Описание:<br/>
				<textarea name='desc' id="tex"></textarea>
                <br/>
				<input name='group' value='null' style='display:none;'>
				<input name='project' value='null' style='display:none;'>
				<?php
					echo "
						<br/>
						Тип:<br/>
						<select name='type_task'>".$strOp3."</select><br/>
					";
				?>
				Дата начала:<br/>
				<input type="date" name="date_b"><br/>
				Дата конца:<br/>
				<input type="date" name="date_e"><br/>
				<button name="type_bt" value="tasks">Добавить</button>
			</form></div>
		</div>
	</div>
	<!-- Задачи показываются в этом блоке -->
	<div style="border-top: 5px solid #000000;padding: 5px;">
		<!-- Тут вывод задач без групп и проектов -->
		<?php
			while($row = $tasks->fetch_assoc()){//И выводим задачи этой группы
				if($row['created_by'] == $_COOKIE['id'] && $row["groups_id"] == '' && $row['projects_id'] == ''){
					include 'views/compMain/viewTask.php';
				}
			}
			//На ЧС:
			$tasks->data_seek(0);//Чтоб можно было использовать фетч_ассокк() ещё много раз
			$groups->data_seek(0);//Чтоб можно было использовать фетч_ассокк() ещё много раз
			$projects->data_seek(0);//Чтоб можно было использовать фетч_ассокк() ещё много раз
		?>
	</div>
</div>