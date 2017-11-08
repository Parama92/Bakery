<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php require 'views/layout/head.php'; ?>
        <title>Gallery</title>
    </head>
    <body>
    <div class="container-fluid text-center">
            <?php 
                include_once 'views/layout/header.php';
            ?>
            <div id="wall">
                <div class="row page-heading">
                    <h1>GALLERY</h1>
                    <hr/>
                </div>
                <div class="spacing content">
                    <div class="flex_container">
                        <?php foreach($images as $image) { ?>    
                            <a class="gallery_img" href="<?php echo $image; ?>">
                                <div class="flex_box" style="background-image:url('<?php echo $image; ?>');"></div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
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
                $("#gallery").addClass("active");
                $("#contact").removeClass("active");
            });
            
        </script>
    </body>
</html>
