<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php require 'views/layout/head.php'; ?>
        <title>Errors</title>
    </head>
    <body>
    <div class="container-fluid text-center">
        <?php 
            include_once 'views/layout/header.php';
        ?>
        <div class="row content">
            <p>Oops! You have encountered an error!</p>
            <p><?php echo $error?></p>
        </div>
    </div>
    <?php
        include_once 'views/layout/footer.php';
    ?>
    </body>
</html>
