<?php
    require_once '/db/setup.php';
   
    $id=$_GET["id"];
    $result=$qh->runQuery("SELECT * from products where id=$id;");
    if(mysqli_num_rows($result)===0)
    {
        header("location: error.php?error='unknown_id'");
    }
    $row= mysqli_fetch_array($result);
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
        <title><?php echo $row["name"];?></title>
    </head>
    <body>
    <div class="container-fluid text-center">
            <?php 
                include_once 'header.php';
            ?>
            <div class="row spacing">
                <div class="col-md-6">
                    <img src="images/cookie.jpg" alt="collar" width="750px" height='500px'>
                </div>
                <div class='col-md-3 col-md-offset-3 box'>
                    hey
                </div>
            </div>
            <?php
                include_once 'footer.php';
            ?>
        </div>
        <script>
            
        </script>
    </body>
</html>