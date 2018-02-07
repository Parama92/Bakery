<?php
    require_once 'db/setup.php';
    
    function dropdown_list($id)
    {
        $data=array($id);
        $dd_result=App::get('database')->runQuery("SELECT name as cat,cost FROM products_features pf inner join features f on pf.feature_id=f.id where product_id =? order by cost",$data);
        
        return $dd_result;
    }
    $result=App::get('database')->runQuery("SELECT * from products ORDER BY category_id ASC;");
    
    $fav=App::get('database')->runQuery("SELECT favourite from user_favourites WHERE user_id=?;",array($_SESSION["user_id"]));
    $fav=array_column($fav,'favourite');
    
    require 'views/pages/menu.view.php';

?>
