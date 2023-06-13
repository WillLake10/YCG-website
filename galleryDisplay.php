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
            function getAddress()
            {
                $protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
                return $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            }

            echo getAddress();
            ?>
        </div>
</section>

</body>
</html>