<?php 

    $dirname = "images/gallery/";
    $images = glob($dirname."*.*");

    // foreach($images as $image) {
    //     echo '<img src="'.$image.'" /><br />';
    // }

    require "views/pages/gallery.view.php";

?>