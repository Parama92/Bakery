<?php
    
    require_once 'setup.php';
    function dropdown_list($id)
    {
        $data=array($id);
        $dd_result=App::get('database')->runQuery("SELECT name as cat,cost FROM products_features pf inner join features f on pf.feature_id=f.id where product_id =? order by cost",$data);
        
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
            //handle error somehow.
        }
        
        $cart_check=App::get('database')->runQuery("SELECT id,quantity FROM cart WHERE product_id=? AND feature_id=? AND user_data=?;",array($pid,$fid,$user_data));
        if(count($cart_check)==0)
        {
            App::get('database')->runQuery("INSERT INTO cart (product_id,feature_id,user_data,expired) VALUES (?,?,?,?);",array($pid,$fid,$user_data,$expired));
        }
        else
        {
            $row= $cart_check[0];
            App::get('database')->runQuery("UPDATE cart SET quantity=".($row['quantity']+1)." WHERE id={$row['id']};");
        }
    }
    
    function change_cart($cid,$quant) 
    {
        $cart_search=App::get('database')->runQuery("SELECT id FROM cart WHERE id=?;",array($cid));
        
        if(count($cart_search)==0)
        {
            header("location: ../error.php?error='unknown'");
        }
        else
        {
            if($quant==0)
                App::get('database')->runQuery("DELETE FROM cart WHERE id=?;",array($cid));
            else
            {
                App::get('database')->runQuery("UPDATE cart SET quantity=? WHERE id=?;",array($quant,$cid));
            }
        }
    }
    
?>
