<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php require 'views/layout/head.php'; ?>
        <title>Cart</title>
    </head>
    <body>
    <div class="container-fluid text-center">
        <?php 
            include_once 'views/layout/header.php';
        ?>
        <div class="row page-heading">
            <h1>YOUR CART</h1>
            <hr/>
        </div>
        <?php
            if(!isset($_SESSION["user_id"]) || count($cart_display)===0)
            {
                echo "<p>You have an empty cart!</p>";
            }
            else
            {
                $sum=0;
                foreach($cart_display as $cart_item)//while($cart_item= mysqli_fetch_array($cart_display_result))
                {
        ?>
                    <div class="row spacing">
                        <div class="col-md-3"><?php echo $cart_item["item"]; ?></div>
                        <div class="col-md-3"><?php echo $cart_item["feature"]; ?></div>
                        <div class="col-md-3"><?php echo $cart_item["cost"]; ?></div>
                        <div class="col-md-1"><?php echo $cart_item["quantity"]; ?></div>
                        <div class="col-md-2">
                            <button class="remove btn btn-block btn-danger">Remove</button>
                            <input type="hidden" value="<?=$cart_item["cid"].'.'.($cart_item["cost"]*$cart_item["quantity"]);?>">
                        </div>
                    </div>
        <?php
                    $sum+=$cart_item["cost"]*$cart_item["quantity"];
                }
        ?>
            <hr/>
            <div id="checkout">
                <div class="row spacing">
                    <p>
                        <?php echo "Cart Total :  Rs. <span id='sum'>$sum</span>"; ?>
                    </p>
                </div>
                <div class="row spacing-after">
                    <a href="#" class="btn btn-danger btn-lg">Proceed to checkout</a>
                </div>
            </div>
        <?php
            }
        
            include_once 'views/layout/footer.php';
        ?>
        </div>
        <script src="public/script.js"></script>
    </body>
</html>
