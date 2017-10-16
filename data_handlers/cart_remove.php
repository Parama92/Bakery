<?php
    require_once "../db/functions.php";

    $info=$_GET['info'];

    list($cid,$sum)=explode('.',$info);
    
    remove_from_cart($cid);
   
    echo $sum;

?>