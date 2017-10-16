<?php
    require_once '/db/setup.php';
   
    $id=$_GET["id"];
    $result=App::get('database')->runQuery("SELECT * from products where id=$id;");
    if(count($result)===0)
    {
        header("location: error.php?error='unknown_id'");
    }
    $row= $result[0];
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php require 'views/layout/head.php'; ?>
        <title><?php echo $row["name"];?></title>
    </head>
    <body>
    <div class="container-fluid text-center">
            <?php 
                include_once 'views/layout/header.php';
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
                include_once 'views/layout/footer.php';
            ?>
        </div>
        <script>
            
        </script>
    </body>
</html>
