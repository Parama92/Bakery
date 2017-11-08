<?php

    require_once 'Connection.php';
    require_once 'App.php';
    require_once 'QueryHandler.php';
    require_once 'IdGen.php';
    require_once "cookies/UpdateUser.php";
    require_once "cookies/CookieHandler.php";
    require_once "cookies/NewCookieHandler.php";
    require_once "cookies/DisabledCookieHandler.php";
    require_once "cookies/OldCookieHandler.php";

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

    $cookie=CookieHandler::getInstance();
    
    $cookie->doEssentials();

?>

