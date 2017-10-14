<?php
    require_once '/db/setup.php';
    
    if(isset($_GET['cid']))
    {
        require_once 'db/functions.php';

        $cid=$_GET['cid'];
        remove_from_cart($cid);
    }
    
    if(isset($_SESSION["user_id"]))
    {
        $user_id=$_SESSION["user_id"];
        $cart_display_qh= new QueryHandler(getConn());
        $cart_display_result=$cart_display_qh->runQuery("select c.id as cid, p.name as item, f.name as feature,ifnull(pf.cost,p.cost) as cost, quantity from cart c inner join products p on c.product_id=p.id inner join features f on f.id=c.feature_id left join products_features pf on pf.product_id=p.id AND pf.feature_id=f.id WHERE user_data='$user_id';");
    }
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        
        <!--jQuery library-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


        <!--Latest compiled and minified JavaScript--> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <!--Google font-->
        <link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
        
        <!--font awesome-->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        
        <link href="style/style.css" rel="stylesheet" type="text/css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cart</title>
    </head>
    <body>
    <div class="container-fluid text-center">
        <?php 
            include_once 'header.php';
        ?>
        <div class="row page-heading">
            <h1>YOUR CART</h1>
            <hr/>
        </div>
        <?php
            if(!isset($_SESSION["user_id"]) || mysqli_num_rows($cart_display_result)===0)
            {
                echo "<p>You have an empty cart!</p>";
            }
            else
            {
                $sum=0;
                while($cart_item= mysqli_fetch_array($cart_display_result))
                {
        ?>
                    <div class="row spacing">
                        <div class="col-md-3"><?php echo $cart_item["item"]; ?></div>
                        <div class="col-md-3"><?php echo $cart_item["feature"]; ?></div>
                        <div class="col-md-3"><?php echo $cart_item["cost"]; ?></div>
                        <div class="col-md-1"><?php echo $cart_item["quantity"]; ?></div>
                        <div class="col-md-2">
                            <a href="cart.php?cid=<?php echo $cart_item["cid"]; ?>" class="btn btn-block btn-danger">Remove</a>
                        </div>
                    </div>
        <?php
                    $sum+=$cart_item["cost"]*$cart_item["quantity"];
                }
        ?>
            <hr/>
            <div class="row spacing">
                <p>
                    <?php echo "Cart Total :  Rs. ".$sum; ?>
                </p>
            </div>
            <div class="row spacing-after">
                <a href="#" class="btn btn-danger btn-lg">Proceed to checkout</a>
            </div>
        <?php
            }
        
            include_once 'footer.php';
        ?>
        </div>
        <script>
        </script>
    </body>
</html>

