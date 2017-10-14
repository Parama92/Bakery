<?php
    
    //require_once 'db/setup.php';
    function dropdown_list($id)
    {
        $dd_result=App::get('database')->runQuery("SELECT name as cat,cost FROM products_features pf inner join features f on pf.feature_id=f.id where product_id ='{$id}' order by cost");
        
        return $dd_result;
    }
    
    function add_to_cart($pid, $fid)
    {
        if(isset($_COOKIE['id']))
        {
            $user_data=$_COOKIE['id'];
            $expired='false';
        }
        elseif(isset($_SESSION["user_id"]))
        {
            $user_data=$_SESSION["user_id"];
            $expired='true';
        }
        else
        {
            header("location: error.php?error='db'");
        }
        $cart_qh= new QueryHandler(getConn());
        $cart_check=$cart_qh->runQuery("SELECT id,quantity FROM cart WHERE product_id={$pid} AND feature_id={$fid} AND user_data='{$user_data}';");
        if(mysqli_num_rows($cart_check)==0)
        {
            $cart_result=$cart_qh->runQuery("INSERT INTO cart (product_id,feature_id,user_data,expired) VALUES ('{$pid}','{$fid}','{$user_data}','$expired');");
        }
        else
        {
            $row= mysqli_fetch_array($cart_check);
            $cart_result=$cart_qh->runQuery("UPDATE cart SET quantity=".($row['quantity']+1)." WHERE id={$row['id']};");
        }
    }
    
    function remove_from_cart($cid) 
    {
        $cart_qh= new QueryHandler(getConn());
        $cart_search=$cart_qh->runQuery("SELECT id FROM cart WHERE id=$cid;");
        if(mysqli_num_rows($cart_search)==0)
        {
            header("location: error.php?error='unknown'");
        }
        else
        {
            $cart_qh->runQuery("DELETE FROM cart WHERE id=$cid;");
        }
    }
?>
