<?php

    require_once 'Connection.php';
    require_once 'App.php';
    require_once 'QueryHandler.php';

    session_start();

    $_SESSION['timeout'] = time();
    
    if(($_SESSION['timeout']+60*10)<time())
    {
        session_destroy(); 
        header("Location: index.php");
    }
    /*$session_life = time() - $_SESSION['timeout'];

    if($session_life > $inactive)
    {  
        session_destroy(); 
        header("Location: index.php");     
    }

    $_SESSION['timeout']=time();*/
    

    App::bind('config',require 'config.php');
    
    $conn=Connection::make(App::get('config'));

    App::bind('database', new QueryHandler($conn));
    
    
    class IdGen 
    {
        
        static $id=0;
        private $id_val;
        function __construct() 
        {
            $this->id_val="hb_".self::$id;
            self::$id++;
        }
        function getId()
        {
            return $this->id_val;
        }
    }
?>

