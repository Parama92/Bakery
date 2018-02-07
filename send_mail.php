<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    // require ("PHPMailer_5.2.4/class.phpmailer.php");
    require './PHPMailer-master/src/PHPMailer.php';
    require './PHPMailer-master/src/Exception.php';
    require './PHPMailer-master/src/SMTP.php';

    $config=require_once "db/mailconfig.php";
    require_once "db/functions.php";
    
    $mail= new PHPMailer();


    if(isset($_POST['amnt']))
    {
        $error=saveDetails($_POST['name'],$_POST['phone'],$_POST['amnt'],$_POST['notes'],$config,$mail);
        if(trim($error)=='')
        {
            unset($_SESSION["cart_total"]);
            require_once "views/pages/ordered.view.php";
        }
        else
        {
            require_once "views/pages/error.view.php";
        }
    }
    else
    {
        $error=enquire($_GET['name'],$_GET['email'],$_GET['message'],$config, $mail);
        if(trim($error)=='')
            echo "";
        else
            echo $error;
    }

?>