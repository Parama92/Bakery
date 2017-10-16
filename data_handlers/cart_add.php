<?php
    require_once '../db/functions.php';
    
    $val=$_GET["value"];
    $params= explode(".", $val);
    $pid=$params[0];
    if($params[1]==0)
    {
        $fid=10;
    }
    else
    {
        $fid_result=App::get('database')->runQuery("SELECT feature_id as fid FROM `products_features` where product_id='{$pid}' and cost='{$params[1]}'");
        $row=$fid_result[0];
        $fid=$row['fid'];
    }
    add_to_cart($pid,$fid);
    echo 'Success';
?>
