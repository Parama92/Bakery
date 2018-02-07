<?php
    require_once 'db/setup.php';
    
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
        <title>#Baked - Order home made baked goodies</title>
        <meta name="description" content="Hashtag baked is a home based bakery in Kolkata, providing a varity of baked goods like cakes, pastries and cup cakes among others. We are most well known for our brownies. We deliver to your doorstep. Cash on delivery is available.">
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
        </div>
        <?php
            include_once 'views/layout/footer.php';
        ?>
        <script>
            
            $(function(){
                $("#home").addClass("active");
                $("#menu").removeClass("active");
                $("#gallery").removeClass("active");
                $("#contact").removeClass("active");

                $(".circle").css("display","none");
            });
            
        </script>
    </body>
</html>
