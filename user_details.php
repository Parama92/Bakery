<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php require 'views/layout/head.php'; ?>
        <title>Details</title>
    </head>
    <body>
    <div class="container-fluid text-center">
            <?php 
                include_once 'views/layout/header.php';
            ?>
            <div class="row page-heading">
                <h1>ENTER YOUR DETAILS</h1>
                <hr/>
            </div>
            <div class="row spacing spacing-after content">
                <p><?php echo $_POST['cart_total'] ?></p>
            </div>
        </div>
        <?php
            include_once 'views/layout/footer.php';
        ?>
        <script src="public/script.js"></script>
        <script>
            
            $(function(){
                $("#home").removeClass("active");
                $("#menu").removeClass("active");
                $("#gallery").removeClass("active");
                $("#contact").removeClass("active");

            });
            
        </script>
    </body>
</html>
