<?php 

    $dirname = "images/gallery/thumbnail/";
    $images = glob($dirname."*.*");
    $rows=count($images)/3;

    // foreach($images as $image) {
    //     echo $image."<br>";
    //     echo preg_match("/recom/i", $image)?"Rec":"";
    //     echo "<br>";
    // }
    require "views/pages/gallery.view.php";

?>