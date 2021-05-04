<!--Навигация, логотип-->
<?php include 'views/compMain/nav.php'; ?>
<!-- КОНЕЦ - Навигация, логотип-->

<!--Основная часть планировщика-->
<div class="container-fluid">
    <div class="row">
		<!-- Ьез грппа -->
        <?php include 'views/compMain/notGroup.php'; ?>
        <!-- КОНЕЦ Ьез грппа -->
		
		<!-- Вывод групп с задачами, но корторые не в проекте -->
		<?php 
			//вывод групп с задачами:
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
				$strOp3 .= "<option value='".$tt['id']."'>".$tt['name']."</option>";
			}
            $groups->data_seek(0);//Чтоб можно было использовать фетч_ассокк() ещё много раз
			while($group = $groups->fetch_assoc()) {//
                $g = $group['id'];
                $p = '';
                $p1 = 'null';
				if ($group['created_by'] == $_COOKIE['id'] && $group['projects_id'] == '') {//Если группа совподает с юзером
					require 'views/compMain/group.php'; 
				}
			}
		?>
		<!-- КОНЕЦ Вывод групп с задачами, но корторые не в проекте -->
		
		<!-- Вывод проектов с группами и задачами -->
		<?php require 'views/compMain/project.php'; ?>
		<!-- КОНЕЦ Вывод проектов с группами и задачами -->
    </div>
    <!-- КОНЕЦ class="row" -->
</div>
<!-- КОНЕЦ class="container-fluid" -->
<script src="js/js.js"></script>
	
	