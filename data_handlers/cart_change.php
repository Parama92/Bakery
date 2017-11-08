<?php
    require_once "../db/functions.php";

    $cid=$_GET['cid'];
    $quant=$_GET['quant'];
    
    change_cart($cid,$quant);
   
    echo "done";

?>