<!DOCTYPE html>
<!--
Website: York Colleges Guild
Type: PHP
Page: Quotes
Created: 22nd April 2020
Last modified: 7th March 2023
Author: Will Lake
-->
<html lang="en">
<head>
    <?php include ('../componants/head.html'); ?>
    <title>Quotes - York Colleges Guild</title>
    <link rel="stylesheet" href="/main/styles/quotes.css" type="text/css">
</head>
<body>

<?php include ('standardPageTop.php'); ?>

<section id="pagetitle">
    <div class="container pt-3 pb-3">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-12 col-md-6">
                <div class="pagetitle">
                    Dinner Day 2017
                </div>
            </div>
        </div>
    </div>
</section>

<section id="quotes">
    <div class="container">
        <?php
        $page =
                $path = '../gallery/20';

                $files = scandir($path);
                $files = array_diff($files, array('.', '..'));
        ?>
        <?php include ('displayImages.php'); ?>

    </div>
</section>

</body>
</html>