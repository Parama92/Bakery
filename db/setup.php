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
    
    App::bind('config',require 'config.php');
    
    $conn=Connection::make(App::get('config'));

    App::bind('database', new QueryHandler($conn));

    if(!isset($_SESSION["user_id"]))
    {
        $cookie=CookieHandler::getInstance();
        
        $cookie->doEssentials();
    }
?>

