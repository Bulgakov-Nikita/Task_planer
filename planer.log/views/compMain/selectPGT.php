<?php
    $q = new Query();
    $tasks = $q->select('*', 'tasks');
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
        $strOp3 .= "<option value='".$tt['id']."'>".$tt['name']."</option>";
    }

    $tasks->data_seek(0);//Чтоб можно было использовать фетч_ассокк() ещё много раз
    $groups->data_seek(0);//Чтоб можно было использовать фетч_ассокк() ещё много раз
    $projects->data_seek(0);//Чтоб можно было использовать фетч_ассокк() ещё много раз
    $type_task->data_seek(0);//Чтоб можно было использовать фетч_ассокк() ещё много раз
?>