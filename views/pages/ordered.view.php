<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <?php require 'views/layout/head.php'; ?>
    <title>Order Success</title>
</head>
<body>
<div class="container-fluid text-center">
        <?php 
            include_once 'views/layout/header.php';
        ?>
        <div class="row page-heading">
            <h1>Ordered!</h1>
            <hr/>
        </div>
        <div class="row spacing spacing-after content">
            <h3>Your order has been successful!</h3>
            <i class="fa fa-check" aria-hidden="true"></i>
        </div>
    </div>
    <?php
        include_once 'views/layout/footer.php';
    ?>
    <script>
        
        $(function(){
            $("#home").removeClass("active");
            $("#menu").removeClass("active");
            $("#gallery").removeClass("active");
            $("#contact").removeClass("active");

            $(".circle").css("display","none");
        });
        
    </script>
</body>
</html>


?>