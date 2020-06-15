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
    <title>Events - York Colleges Guild</title>
    <script src="gallaria/galleria.js"></script>
    <link rel="stylesheet" href="styles/galleriaStyle.css" type="text/css">
</head>
<body>

<?php include ('componants/standardPageTop.php'); ?>

<section id="pagetitle">
    <div class="container pt-3 pb-3">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-12 col-md-6">
                <div class="pagetitle">
                    Events
                </div>
            </div>
        </div>
    </div>
</section>

<section id="welcome">
    <div class="container">
        <div class="row">
            <iframe src="https://calendar.google.com/calendar/b/3/embed?height=600&amp;wkst=2&amp;bgcolor=%23E4C441&amp;ctz=Europe%2FLondon&amp;src=YWRtaW5AeWNnLm9yZy51aw&amp;color=%2322AA99&amp;mode=AGENDA&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showDate=1&amp;showNav=1" style="border:solid 1px #777" height="300" width="100%" frameborder="0" scrolling="no"></iframe>
            <iframe src="https://calendar.google.com/calendar/b/3/embed?height=600&amp;wkst=2&amp;bgcolor=%23E4C441&amp;ctz=Europe%2FLondon&amp;src=YWRtaW5AeWNnLm9yZy51aw&amp;color=%2322AA99&amp;mode=WEEK&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showDate=1&amp;showNav=1" style="border:solid 1px #777" height="800" width="100%" frameborder="0" scrolling="no"></iframe>
        </div>
    </div>
</section>
</body>
</html>