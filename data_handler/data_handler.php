<?php
    
    require_once '../db/setup.php';

    $action = $_GET['action'];

    if(isset($_GET['prod'])){
        if(method_exists(App::get('favourite'), $action)){
            App::get('favourite')->$action($_GET['prod']);
            echo 'success';
        }
        else{
            echo 'illegal action attempted';
        }
    }
    else{
        if(method_exists(App::get('cart'), $action)){
            if(isset($_GET['value']) && $action=='addToCart'){
                
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
                App::get('cart')->addToCart($pid, $fid);
                echo 'success';
            }
            elseif(isset($_GET['cid'],$_GET['quant']) && $action=='changeCart'){
                App::get('cart')->changeCart($_GET['cid'], $_GET['quant']);
                echo 'success';
            }
            else{
                echo 'illegal action attempted';
            }
        }
        else{
            echo 'illegal action attempted';
        }
    }

?>