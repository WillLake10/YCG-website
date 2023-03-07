<!DOCTYPE html>
<!--
Website: York Colleges Guild
Type: PHP
Page: Home
Created: 26th April 2020
Last modified: 7th March 2023
Author: Will Lake
-->
<html lang="en">
<head>
    <?php include ('componants/head.html'); ?>
    <title>Committee - York Colleges Guild</title>
    <link rel="stylesheet" href="styles/quotes.css" type="text/css">
</head>
<body>

<?php include ('componants/standardPageTop.php'); ?>

<section id="pagetitle">
    <div class="container pt-3 pb-3">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-12 col-md-6">
                <div class="pagetitle">
                    Past and Present Committee
                </div>
            </div>
        </div>
    </div>
</section>

<section id="Current">
    <div class="container pt-3 pb-3">
        <div class="row">
            <?php
                $url = 'data/committee.json'; // path to your JSON file
                $data = file_get_contents($url); // put the contents of the file into a variable
                $years = json_decode($data);
                foreach ($years as $year) {
                    echo "<div class=\"col-md-6\"><div class=\"head_title\">";
                    echo "$year[0]</div>";
                    foreach ($year as $i => $member) {
                        if ($i > 0) {
                        echo "<p><span class=\"quotesName\"> $member[0]: </span>";
                        echo "<span class=\"quotesBody\"> $member[1] </span></p>";
                        }
                    }
                    echo "</div>";
                }
            ?>
        </div>
    </div>
</section>

</body>
</html>