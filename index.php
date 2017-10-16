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
        <?php require 'views/layout/head.php'; ?> 
        <title>#Baked</title>
    </head>
    <body>
        <div class="container-fluid text-center">
            <?php 
                include_once 'views/layout/header.php';
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
                include_once 'views/layout/footer.php';
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
