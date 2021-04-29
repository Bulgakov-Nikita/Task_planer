<?php 

function my_autoloader($class) {
    $directorys = array ('Task_planer/',
    'Task_planer/planer.log/',
    'Task_planer/projects/',
    'Task_planer/projects/public/',
    'Task_planer/planer.log/controllers/'/
    'Task_planer/planer.log/models',
    'Task_planer/planer.log/view',
    'Task_planer/planer.log/models/autoloader',
    'Task_planer/planer.log/models/users'
);
    if(file_exists($class. '.php')){
        include $class . ".php";
        return;
    }
    else {
        foreach($directorys as $directory)
        {
            if(file_exists($directory.$class . '.php'))
            {
                include ($directory.$class . '.php');
                return;
            }   
        }
    } 
}
spl_autoload_register("my_autoloader");
