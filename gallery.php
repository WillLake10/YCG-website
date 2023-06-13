<!DOCTYPE html>
<!--
Website: York Colleges Guild
Type: PHP
Page: Gallary
Created: 18th June 2020
Last modified: 18th June 2020
Author: Will Lake
-->
<html lang="en">
<head>
    <?php include('componants/head.html'); ?>

    <link rel="stylesheet" href="styles/gallery.css">

    <title>Gallery - York Colleges Guild</title>
</head>
<body>

<?php include('componants/standardPageTop.php'); ?>

<section id="pagetitle" style="background-color: #ffffff">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-12 col-md-6">
            <div class="pagetitle">
                Gallery
            </div>
        </div>
    </div>
</section>

<br>

<section id="gallary" class="mbr-gallery mbr-slider-carousel cid-ruuHhHl8AI">
    <div class="container">
        <div class="row">
        <?php
        //        $path = '../gallery';
        //
        //        $files = scandir($path);
        //        $files = array_diff($files, array('.', '..'));

        $url = 'data/galleryData.json'; // path to your JSON file
        $data = file_get_contents($url); // put the contents of the file into a variable
        $titles = array_reverse(json_decode($data));
        foreach ($titles as $t) {
            echo "<div class=\"col-md-3 col-sm-6\">";
            echo "<div class='galleryThumbnail'>";
            echo "<a href='/main/gallery/$t->folderName.php'>";
            echo "<img src='../gallery/$t->folderName/$t->thumbnail' alt='../gallery/$t->folderName/$t->thumbnail' class=''>";
            echo "</a>";
            echo "<p>$t->displayName</p>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</section>

</body>
</html>