<?php 

function my_autoloader($class) {
    $directorys = array (
    'planer.log/',
    'projects/',
    'projects/public/',
    'planer.log/controllers/',
    'planer.log/models',
    'planer.log/view',
    'planer.log/models/autoloader',
    'planer.log/models/users'
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
