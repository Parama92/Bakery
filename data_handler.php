<?php
    require_once 'db/functions.php';
    
    $val=$_GET["value"];
    $params= explode(".", $val);
    $pid=$params[0];
    if($params[1]==0)
    {
        $fid=10;
    }
    else
    {
        $fid_qh=new QueryHandler(getConn());
        $fid_result=$fid_qh->runQuery("SELECT feature_id as fid FROM `products_features` where product_id='{$pid}' and cost='{$params[1]}'");
        $row= mysqli_fetch_array($fid_result);
        $fid=$row['fid'];
    }
    add_to_cart($pid,$fid);
    echo 'Success';
?>
