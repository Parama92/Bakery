<?php
    require_once 'db/setup.php';
    require_once 'db/functions.php';
    
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
        <title>Menu</title>
    </head>
    <body>
        <div class="container-fluid text-center">
            <?php 
                include_once 'header.php';
            ?>
            <div class="menu">
                <div class="bg"></div>
                <div class="row page-heading">
                    <h1>OUR MENU</h1>
                    <hr/>
                </div>
                <div class="row spacing">
                    <!--choosing the grid to place the products-->
                    <div class="col-md-offset-2 col-md-8 col-s-12">
                        <div id="added-to-cart" class="hide-it">
                            <span id="fill"></span>
                        </div>
                        <?php
                            $result=$qh->runQuery("SELECT * from products;");
                            $index=0;
                            while($row= mysqli_fetch_array($result)){
                                if($index%3==0)//condition to check if 3 products have been placed. If so, the new product is placed in the next row
                                {
                                    $start_div="<div class='row'>\n";
                                    if($index!=0)
                                        echo "</div>\n";
                                }
                                else
                                {
                                    $start_div="";
                                }
                                echo $start_div;
                        ?>
                                <div class="col-md-4 col-s-6">
                                    <a href="prod.php?id=<?php echo $row["id"]; ?>"><div class="thumbnail">
                                        <div class="caption">
                                            <p><?php echo $row["name"]; ?></p><!--prints product name-->
                                            <p>
                                                <?php
                                                    if($row["cost"]==0)//checks whether current product has subcategories
                                                    {
                                                       $list=dropdown_list($row["id"]);//returns a list of subcategories and their cost
                                                ?>
                                                    <select class="form-control" name="list">
                                                <?php
                                                       while($item= mysqli_fetch_array($list))
                                                       {    //to print dropdown list
                                                ?>
                                                        <option value="<?php echo "{$row['id']}.{$item['cost']}";?>"><?php echo $item["cat"]."    Rs.".$item["cost"]; ?></option>
                                                <?php  } ?>
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
                                            <button class="btn btn-danger btn-block">Add to cart</button>
                                        </div>
                                    </div></a>
                                </div>
                        <?php
                                //echo (($index-1)%3==0)?"</div>\n":"";
                                $index++;
                                    }
                                echo "</div>";
                        ?>
                    </div>
                </div>
            </div>
            <?php
                include_once 'footer.php';
            ?>
        </div>
        <script>
            $(document).on('click', 'button', function(e){
                e.preventDefault();
                e.stopImmediatePropagation();
                return false;
            });
            $(document).on('click', 'select', function(e1){
                e1.preventDefault();
                e1.stopImmediatePropagation();
                return false;
            });
            $(function(){
                $("#menu").addClass("active");
                $("#home").removeClass("active");
                $("#gallery").removeClass("active");
                $("#contact").removeClass("active");
               
                $('.btn-danger').click(function(){
                    
                    var val,text,node;
                    var prod=$(this).prev().prev().text();
                    if($(this).prev().has('select').length!==0)
                    {
                        node=$(this).prev().children('select');
                        val=node.val();
                        text=": "+node.children(":selected").text();
                    }
                    else{
                        val= $(this).prev().children('input').val();
                        text=$(this).prev().text();
                    }
                    text=prod+" "+text.trim();
                    console.log(text);
                   /* $("#fill").text(text);
                    $("#added-to-cart").slideDown(1000);
                    setTimeout(function(){
                        $("#added-to-cart").slideUp(1000);
                    },2000);*/
                    console.log(val);
                    $.ajax({
                        type:"GET",
                        url:"data_handler.php",
                        data: 'value=' +val,
                        success: function(msg)
                        {
                            console.log(msg);
                        }
                    });
                });
            });
           
        </script>
    </body>
</html>
