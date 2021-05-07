<?php
    //Без комментов
echo 123;
die;
    require_once 'router.php';
    $app = new Router();
    $app->run();

