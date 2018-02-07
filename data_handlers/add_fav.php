<?php

    $product=$_GET['prod'];
    require_once '../db/functions.php';
    addFav($product);
    echo "success";
   
?>