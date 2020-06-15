<!DOCTYPE html>
<!--
Website: York Colleges Guild
Type: PHP
Page: Bob the Badger
Created: 22nd April 2020
Last modified: 22nd April 2020
Author: Will Lake
-->
<html lang="en">
<head>
    <?php include ('componants/head.html'); ?>
    <title>Quotes - York Colleges Guild</title>
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
                    The amazing quotes from <span class="text-ycgGreen">YCG</span> members
                </div>
            </div>
        </div>
    </div>
</section>

<section id="quotes">
    <div class="container">
        <p>Got a quote that you would like to see here? Drop us a message now!</p>
        <?php
            $url = 'data/quotes.json'; // path to your JSON file
            $data = file_get_contents($url); // put the contents of the file into a variable
            $quotes = json_decode($data);
            foreach ($quotes as $quote) {
                echo "<div class=\"row pt-3\"><div class=\"col-12\"";
                foreach ($quote as $line) {
                    if($line[0] === ''){
                        echo "<p><span class=\"quotesExtra\">$line[1]</span></p>";
                    }else{
                        echo "<p><span class=\"quotesName\"> $line[0]: </span>";
                        echo "<span class=\"quotesBody\"> $line[1] </span></p>";
                    }
                }
                echo "</div></div>";

            include ('componants/splitterFull.html');
            }
        ?>
    </div>
</section>

</body>
</html>