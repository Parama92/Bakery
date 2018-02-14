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
                <h1>Your Cart</h1>
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
                            <div class="row spacing item spacing-after">
                                <div class="col-sm-3 col-xs-5 prod-name"><?php echo $cart_item["item"]; ?></div>
                                <div class="col-sm-3 col-xs-2">Rs. <span class="cost"><?php echo $cart_item["cost"]; ?></cart></div>
                                <div class="col-sm-3 col-xs-3 quant">
                                    <button class="plus btn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                    <span><?php echo $cart_item["quantity"]; ?></span>
                                    <button class="minus btn"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                </div>
                                <div class="col-sm-2 hidden-xs">
                                    <button class="remove btn btn-block">Remove</button>
                                </div>
                                <input type="hidden" value="<?=$cart_item["cid"];?>">
                            </div>
                <?php
                            //$sum=$cart_item["cost"]*$cart_item["quantity"];
                        }
                ?>
                    <hr/>
                    <form method="POST" action="user_details.php" id="checkout">
                        <div class="row spacing spacing-after">
                            <div class="spacing col-xs-3 col-xs-offset-1 col-sm-11 col-sm-offset-1">
                                <p>
                                    <?php echo "Cart Total :  Rs. <span id='sum'>$sum</span>"; ?>
                                </p>
                            </div>
                            <!-- <input type="hidden" id="products" name="products"> -->
                            <input type="hidden" id="cart_total" name="cart_total">
                            <div class="col-xs-3 col-xs-offset-2 col-sm-11 col-sm-offset-1">
                                <button type="submit" id="submit" class="btn btn-lg">Proceed to checkout</button>
                            </div>
                        </div>
                    </form>
                <?php
                    }
                    if(isset($fav) && count($fav)>0)
                    {
                ?>
                        <div class="row" id="fav_div">
                            <button id="fav" class="btn btn-lg spacing-after">Forgot something?</button>
                            <div id="fav_list">
                                    <?php  foreach($fav as $product) { ?>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <img src="<?php echo file_exists('./images/'.$product.'.jpg')?'./images/'.$product.'.jpg':(file_exists('./images/'.$product.'.jpeg')?'./images/'.$product.'.jpeg':'./images/'.$product.'.png'); ?>">
                                            </div>
                                            <div class="col-sm-6">                            
                                                <p><?php echo $product; ?></p>
                                            </div>            
                                        </div>
                                    <?php
                                    }?>
                                </ul>
                            </div>
                        </div>
                <?php
                    }
                ?>
            </div>
        </div>
        <?php include_once 'views/layout/footer.php'; ?>
        <script>
            $(function(){
                $("#submit").click(function(e){
                    var total=$("#sum").text();
                    $("#cart_total").val(total);
                });
                $(".circle").css("display","none");
            });
        </script>
    </body>
</html>
