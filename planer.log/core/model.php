<?php
    //ЧТО ДОЛЖНО БЫТЬ ВО ВСЕХ МОДЕЛЯХ
    abstract class model{
        abstract public function add();
        abstract public function edit();
        abstract public function delete();
        abstract public function get_info();
    }
