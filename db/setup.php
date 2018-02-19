<?php

    if(file_exists("vendor/autoload.php")){
        require_once "vendor/autoload.php";
    }
    else
    {
        require_once "../vendor/autoload.php";
    }

    session_start();

    $now=time();
    
    if(isset($_SESSION["discard_after"]) && ($now>$_SESSION["discard_after"]))
    {
        session_destroy();
        header("Location: index.php");
    }
    
    $_SESSION['discard_after']=$now+3600*5;

    if(!isset($_SESSION["user_id"]))
    {
        $cookie=CookieHandler::getInstance();
        
        $cookie->doEssentials();
    }

    App::bind('config',require 'config.php');
    
    $conn=Connection::make(App::get('config'));

    App::bind('database', new QueryHandler($conn));

    App::bind('cart', new Cart(App::get('database')));

    App::bind('favourite', new Favourite(App::get('database')));

?>

