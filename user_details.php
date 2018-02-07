<?php 
    if(!isset($_SESSION["cart_total"]) && isset($_POST["cart_total"]))
    {
        $_SESSION["cart_total"]=$_POST["cart_total"];
    }

    // if(isset($_POST['products']))
    // {
    //     $products=explode(',',trim($_POST['products'],','));
    // }
    require 'views/pages/user_details.view.php';
?>
