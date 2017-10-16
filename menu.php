<?php
    require_once 'db/setup.php';
    require_once 'db/functions.php';

    $result=App::get('database')->runQuery("SELECT * from products;");
    
    require 'views/pages/menu.view.php';
?>
