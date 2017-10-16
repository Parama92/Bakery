<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php require 'views/layout/head.php'; ?>
        <title>Contact</title>
    </head>
    <body>
    <div class="container-fluid text-center">
            <?php 
                include_once 'views/layout/header.php';
            ?>
            <div class="row page-heading">
                <h1>CONTACT US</h1>
                <hr/>
            </div>
            <?php
                include_once 'views/layout/footer.php';
            ?>
        </div>
        <script>
            
            $(function(){
                $("#home").removeClass("active");
                $("#menu").removeClass("active");
                $("#gallery").removeClass("active");
                $("#contact").addClass("active");
            });
            
        </script>
    </body>
</html>
