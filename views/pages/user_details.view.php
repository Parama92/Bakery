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
                <h1>Enter Your Details</h1>
                <hr/>
            </div>
            <div class="row spacing spacing-after content">
                <?php if(!isset($_SESSION["cart_total"])) {?>
                    <p>Nothing to see here!</p>
                <?php }else{ ?>
                    <!-- <div class="col-sm-6 col-xs-8" id="amt-container">
                        <div class="row">
                            <p id="cart-total">Your amount has come to: Rs.<?php echo $_POST['cart_total'] ?></p>
                        </div>
                        <!-- <div class="grid row">
                            <?php //foreach($products as $product){?>
                                <!-- <img src="<?php //echo file_exists('./images/'.$product.'.jpg')?'./images/'.$product.'.jpg':(file_exists('./images/'.$product.'.jpeg')?'./images/'.$product.'.jpeg':'./images/'.$product.'.png'); ?>">  
                            <?php //}?>
                        </div> 
                    </div> -->
                    <div class="col-xs-8 col-xs-offset-2" id="user-details">
                        <h3 class="text-center">Let us deliver to your doorstep:</h3>
                        <form  id="form" action="send_mail.php" method="post">
                            <div class="form-group">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Tell us your name!" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" pattern="[0-9]{10,13}" name="phone" id="phone" class="form-control" placeholder="Enter your phone number" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="notes" id="notes" placeholder="Add some notes for us?"></textarea>
                            </div>
                            <input type="hidden" name="amnt" value=<?php echo $_SESSION["cart_total"];?>>
                            <button type="submit" class="btn" id="order">Order!</button>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
            include_once 'views/layout/footer.php';
        ?>
        <script>
            document.getElementById("form").reset();
            $(function(){
                $("#home").removeClass("active");
                $("#menu").removeClass("active");
                $("#gallery").removeClass("active");
                $("#contact").removeClass("active");

            });
            
        </script>
    </body>
</html>
