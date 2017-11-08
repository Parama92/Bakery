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
            <div class="row spacing spacing-after content">
                <div class="col-sm-6" id="info">
                    <div class="row">
                        <div class="contact-circle"></div>
                    </div>
                    <div class="row">
                        <h3>HOURS</h3>
                        <p>MONDAY to FIRDAY: 10:30-19:00<br/>
                        SATURDAY: 10:30-17:30<br/>
                        CLOSED ON SUNDAYS</p>
                    </div>
                </div>
                <div class="col-sm-6" id="contact-form">
                    <form action="" method="GET">
                        <h3 class="spaceing-after">Enquire:</h3>
                        <div class="form-group spacing">
                            <input type="text" placeholder="Name" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="email" placeholder="Email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea placeholder="Message" name="message" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger">Submit</button>
                    </form>
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
                $("#gallery").removeClass("active");
                $("#contact").addClass("active");

                $('#contact-form').outerHeight($('#info').outerHeight());
            });
            
        </script>
    </body>
</html>
