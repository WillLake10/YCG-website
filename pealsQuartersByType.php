<!DOCTYPE html>
<!--
Website: York Colleges Guild
Type: PHP
Page: Peals and Quarters
Created: 20th April 2020
Last modified: 19th September 2022
Author: Will Lake
-->
<html lang="en">
<head>
    <?php include('componants/head.html'); ?>
    <title>Peals & Quarters - York Colleges Guild</title>
    <link rel="stylesheet" href="styles/peal.css" type="text/css">
</head>
<body>

<?php include('componants/pealsAndQuatersPageTop.php'); ?>

<section id="selector">
    <div class="container pt-3">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="pealsQuarters.php#yearnav">By Date</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">By Type</a>
            </li>
        </ul>
    </div>
</section>

<?php include('componants/recentPeals.php'); ?>

<?php include('componants/pealsByType.php'); ?>

</body>
</html>