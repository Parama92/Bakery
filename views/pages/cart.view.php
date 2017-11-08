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
            <div class="content">
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
                            <div class="row spacing item">
                                <div class="col-sm-3"><?php echo $cart_item["item"]; ?></div>
                                <div class="col-sm-3"><?php echo $cart_item["feature"]; ?></div>
                                <div class="col-sm-2 cost"><?php echo $cart_item["cost"]; ?></div>
                                <div class="col-sm-2 quant">
                                    <button class="plus btn btn-danger"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                    <span><?php echo $cart_item["quantity"]; ?></span>
                                    <button class="minus btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                </div>
                                <div class="col-sm-2">
                                    <button class="remove btn btn-block btn-danger">Remove</button>
                                </div>
                                <input type="hidden" value="<?=$cart_item["cid"];?>">
                            </div>
                <?php
                            //$sum=$cart_item["cost"]*$cart_item["quantity"];
                        }
                ?>
                    <hr/>
                    <form method="POST" action="user_details.php" id="checkout">
                        <div class="row spacing">
                            <p>
                                <?php echo "Cart Total :  Rs. <span id='sum'>$sum</span>"; ?>
                            </p>
                        </div>
                        <input type="hidden" id="cart_total" name="cart_total">
                        <div class="row spacing-after">
                            <button type="submit" id="submit" class="btn btn-danger btn-lg">Proceed to checkout</button>
                        </div>
                    </form>
                <?php
                    }
                ?>
            </div>
        </div>
        <?php include_once 'views/layout/footer.php'; ?>
        <script src="public/script.js"></script>
        <script>
            $(function(){
                $("#submit").click(function(e){
                    var total=$("#sum").text();
                    $("#cart_total").val(total);
                });
            });
        </script>
    </body>
</html>
