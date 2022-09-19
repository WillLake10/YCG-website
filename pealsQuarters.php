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

<?php include('componants/standardPageTop.php'); ?>

<section id="pagetitle">
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-12 col-md-6">
                <div class="pagetitle">
                    Peals and Quarters
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <p">This is a record of the peals and quarter peals rung by members of the York Colleges
                Guild. This list is by no means complete, but we try to keep it as up to date as possible.</p>
        </div>
        <div class="row pt-3">
            <p>Records are displayed in academic year from September 1st to August 31st</p>
        </div>
        <div class="row pt-3">
            <p">To see an all-time summary of YCG ringing <a href="pealsSummary.php">click here</a>
            </p>

        </div>
    </div>
    <div class="container pb-3">
        <div class="row pt-3 text-center">
            <?php
            $url = 'peals/lastEdit.json'; // path to your JSON file
            $data = file_get_contents($url); // put the contents of the file into a variable
            $data = json_decode($data);
            echo "<p>Last Update: $data->time</p>"
            ?>
        </div>
    </div>
</section>

<script src="scripts/pealNav.js" type="text/javascript"></script>

<?php include('componants/recentPeals.php'); ?>

<?php include('componants/peals.php'); ?>

</body>
</html>