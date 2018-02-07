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
                <!-- <div class="bg"></div> -->
                <div class="row page-heading">
                    <h1>Our Menu</h1>
                    <hr/>
                </div>
                <div class="spacing content">
                    <!--choosing the grid to place the products-->
                    <div class="flex_container">
                        <div id="message-box" class="hide-it">
                            <span id="fill"></span>
                        </div>
                        <?php foreach($result as $row) : ?>
                            <div class="flex_box">
                                <div class="thumbnail">
                                    <img class="img" src="<?php echo file_exists('./images/'.$row["name"].'.jpg')?'./images/'.$row["name"].'.jpg':(file_exists('./images/'.$row["name"].'.jpeg')?'./images/'.$row["name"].'.jpeg':(file_exists('./images/'.$row["name"].'.png')?"./images/".$row['name'].".png":"")); ?>">
                                    <span class="heart"><i class="fa fa-heart" aria-hidden="true"></i><i class="fa fa-heart-o like" data-hidden="<?php echo in_array($row["name"],$fav)?"show":"hide"; ?>" aria-hidden="true"></i></span>
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
                                        <button class="btn btn-block add">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
        <?php
            include_once 'views/layout/footer.php';
        ?>
        <script>
            $(function(){
                $("#menu").addClass("active");
                $("#home").removeClass("active");
                $("#gallery").removeClass("active");
                $("#contact").removeClass("active");
            });
        </script>
    </body>
</html>
