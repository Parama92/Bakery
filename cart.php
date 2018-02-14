<?php
    require_once 'db/setup.php';

    if(isset($_SESSION["user_id"]))
    {
        $user_id=$_SESSION["user_id"];
        $cart_display=App::get('database')->runQuery("select c.id as cid, p.name as item, ifnull(pf.cost,p.cost) as cost, quantity from cart c inner join products p on c.product_id=p.id inner join features f on f.id=c.feature_id left join products_features pf on pf.product_id=p.id AND pf.feature_id=f.id WHERE user_data=?",array($user_id));
    }

    if(count($cart_display)!==0)
    {
        $items=array_column($cart_display,'item');
        $fav=App::get('database')->runQuery("SELECT favourite from user_favourites WHERE user_id=?;",array($_SESSION["user_id"]));
        
        $fav = array_filter(array_column($fav, 'favourite'),function($item) use ($items){
            return !in_array($item, $items);
        });
    }
    
    require "views/pages/cart.view.php";
?>

