<?php
    class view{
        public function generete($content, $temp){
            //$content - вставляется во view из папки views
            include 'views/'.$temp;
        }
    }
