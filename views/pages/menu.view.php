<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php require 'views/layout/head.php'; ?>
        <title>Menu</title>
    </head>
    <body>
        <div class="container-fluid text-center">
            <?php 
                include_once 'views/layout/header.php';
            ?>
            <div class="menu">
                <div class="bg"></div>
                <div class="row page-heading">
                    <h1>OUR MENU</h1>
                    <hr/>
                </div>
                <div class="spacing">
                    <!--choosing the grid to place the products-->
                    <div class="flex_container col-lg-8 col-lg-offset-2">
                        <!-- <div id="added-to-cart" class="hide-it">
                            <span id="fill"></span>
                        </div> -->
                        <?php foreach($result as $row) : ?>
                            <div class="flex_box">
                                <a href="prod.php?id=<?php echo $row["id"]; ?>">
                                    <div class="thumbnail">
                                        <div class="caption">
                                            <p><?php echo $row["name"]; ?></p><!--prints product name-->
                                            <p>
                                                <?php
                                                    if($row["cost"]==0)//checks whether current product has subcategories
                                                    {
                                                        $list=dropdown_list($row["id"]);//returns a list of subcategories and their cost
                                                ?>
                                                        <select class="form-control menu" name="list">
                                                            <?php foreach($list as $item): //to print dropdown list ?>
                                                                <option value="<?php echo "{$row['id']}.{$item['cost']}";?>"><?php echo $item["cat"]."    Rs.".$item["cost"]; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                <?php 
                                                    }
                                                    else//prints items which do not have subcategories
                                                    {
                                                ?>
                                                        <input type="hidden" value="<?php echo "{$row['id']}."."0";?>">
                                                <?php
                                                        echo "Rs. ".$row["cost"];
                                                    }
                                                ?>
                                            </p>
                                            <button class="btn btn-danger btn-block add">Add to cart</button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
            <?php
                include_once 'views/layout/footer.php';
            ?>
        </div>
        <script src="public/script.js"></script>
        <script>
            $("#menu").addClass("active");
            $("#home").removeClass("active");
            $("#gallery").removeClass("active");
            $("#contact").removeClass("active");
        </script>
    </body>
</html>
