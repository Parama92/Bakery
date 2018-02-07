<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php require 'views/layout/head.php'; ?>
        <title>Gallery</title>
    </head>
    <body>
    <div class="container-fluid text-center">
            <?php 
                include_once 'views/layout/header.php';
            ?>
            <div id="wall">
                <div class="row page-heading">
                    <h1>Gallery</h1>
                    <hr/>
                </div>
                <div class="spacing content">
                <div class="col-container">
                        <div class="gallery-img">
                            <img src="<?php echo $images[0]; ?>" alt="image" width="100%;">
                            <div class="img-caption"><span>caption</span></div>
                        </div>
                        <?php for($i=0; $i<3; $i++) {?>
                            <div class="column">
                            <?php for($img=($i*$rows)+1; $img<=(($i+1)*$rows); $img++)
                                {
                                    if(isset($images[$img]))
                                    {?>
                                        <div class="gallery-img not-mobile">
                                            <img src="<?php echo $images[$img];?>" alt="image" width="100%;">
                                            <div class="img-caption"><?php $getName=explode('/', (strtok($images[$img], '.'))); echo preg_replace('/(\(recommended\))|(?<!\()\d/i','',$getName[3]); ?></div>
                                            <!-- <?php  //if(preg_match("/recom/i", $images[$img])){ ?>
                                                <i data-toggle="tooltip" title="Recommended!" class="fa fa-snowflake-o" aria-hidden="true"></i>
                                            <?php //}?> -->
                                        </div>
                                <?php }
                                }?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
            include_once 'views/layout/footer.php';
        ?>
        <script>
            
            $(function(){
                $("#home").removeClass("active");
                $("#menu").removeClass("active");
                $("#gallery").addClass("active");
                $("#contact").removeClass("active");

                if($(window).width()<600){
                    $('.gallery-img').removeClass("not-mobile");
                    console.log('mobile');
                }
                else
                {
                    $('.gallery-img').addClass("not-mobile");
                    console.log('not mobile');
                }

                $(".img-caption").each(function(){
                    let left=(100-$(this).innerWidth()/$(this).siblings("img").innerWidth()*100)/2
                    $(this).css("left",left+"%");
                });
                
            });
            
        </script>
    </body>
</html>
