<?php
    require_once 'db/setup.php';
    
    $id_gen=new IdGen();
    $user_id=$id_gen->getId();
    if(!isset($_COOKIE["id"]))
    {
        $cookie_id="c".$user_id;
        setcookie("id", $cookie_id, time()+3600*24*60);
        $_SESSION["user_id"]=$cookie_id;
    }
    elseif(isset($_COOKIE["id"]))
    {
        $_SESSION["user_id"]=$_COOKIE["id"];
    }
    else
    {
        $_SESSION["user_id"]="u".$user_id;
    }
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        
        <!--jQuery library-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


        <!--Latest compiled and minified JavaScript--> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <!--Google font-->
        <link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
        
        <!--font awesome-->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        
        <link href="style/style.css" rel="stylesheet" type="text/css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>#Baked</title>
    </head>
    <body>
    <div class="container-fluid text-center">
            <?php 
                include_once 'header.php';
            ?>
            <div class="photo">
                <div class="welcome-box">
                    <h1>Welcome</h1>
                    <hr>
                    <p>This is a paragraph. 
                        Double-click to edit. 
                        This is a great place for you to add a greeting or a short introduction about your bakery.
                        This is a paragraph. Double-click to edit. 
                        This is a great place for you to add a greeting or a short introduction about your bakery.
                    </p>
                </div>
            </div>
            <?php
                include_once 'footer.php';
            ?>
        </div>
        <script>
            
            $(function(){
                $("#home").addClass("active");
                $("#menu").removeClass("active");
                $("#gallery").removeClass("active");
                $("#contact").removeClass("active");
            });
            
        </script>
    </body>
</html>
