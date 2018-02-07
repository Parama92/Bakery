<?php

    $product=$_GET['prod'];
    require_once '../db/functions.php';
    removeFav($product);
    echo "success";
   
?>