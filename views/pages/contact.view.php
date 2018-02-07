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
                <h1 id="contact-us">Contact Us</h1>
                <hr/>
            </div>
            <div class="row spacing spacing-after content">
                <div class="col-sm-6 col-xs-8" id="info">
                    <div class="row">
                        <div class="contact-circle" style="background-image:url('./images/contact5.jpg');"></div>
                    </div>
                    <div class="row">
                        <h3>HOURS</h3>
                        <p>MONDAY to FRIDAY: 10:30-19:00<br/>
                        SATURDAY: 10:30-17:30<br/>
                        CLOSED ON SUNDAYS</p>
                    </div>
                </div>
                <div id="message-box" class="hide-it">
                    <span id="fill"></span>
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                </div>
                <div class="col-sm-6 col-xs-8" id="contact-form">
                    <h3 class="spacing-after">Enquire:</h3>
                    <div class="form-group spacing">
                        <input type="text" placeholder="Name" name="name" class="form-control" id="name">
                        <span class="error">Name field cannot be empty!</span>
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="Email" name="email" class="form-control" id="email">
                        <span class="error">Email field cannot be empty!</span>
                    </div>
                    <div class="form-group">
                        <textarea placeholder="Message" name="message" class="form-control" id="message"></textarea>
                        <span class="error">Not enough imformation provided!</span>
                    </div>
                    <div id="error"></div>
                    <button class="btn">Submit</button>
                </div>
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
                $("#contact").addClass("active");

                if($(window).width()>768)
                {
                    $('#contact-form').outerHeight($('#info').outerHeight()*0.8);
                }
                
            });
            
        </script>
    </body>
</html>
