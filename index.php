<!DOCTYPE html>
<!--
Website: York Colleges Guild
Type: PHP
Page: Home
Created: 19th April 2020
Last modified: 29th October 2022
Author: Will Lake
-->
<html lang="en">
<head>
    <meta name="KEYWORDS"
          content="YCG, York Colleges Guild, York, University, Uni, York Uni Ringers, YUSCR, York University Society of Change Ringers, Ringing, Bell, Ringers, Ringing, Pub, Beer, St Lawrence, Spurriergate, York Minster, York Bell Ringers, Heslington Church, Alcuin College, Constantine College, Derwent College, Goodricke College, Halifax College, James College, Langwith College, Vanbrugh College, handbell">
    <?php include('componants/head.html'); ?>
    <title>YCG</title>
    <link rel="stylesheet" href="styles/peal.css" type="text/css">

    <script src="cronJobs/calender.js?random=<?= time() ?>" type="text/javascript"></script>
</head>
<body>

<?php include('componants/standardPageTop.php'); ?>


<?php //include('componants/banner.html'); ?>

<section id="pagetitle">
    <div class="container pt-3 pb-3">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-12 col-md-6">
                <div class="pagetitle">
                    YCG<br>
                    York Colleges Guild
                </div>
            </div>
        </div>
    </div>
</section>

<section id="welcome">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="head_title">
                    Welcome to <span class="text-ycgGreen">YCG</span>
                </div>
                <p>The York Colleges Guild is a friendly group of bellringing students from the University
                    of York and York St Johns who ring the bells at churches across York.</p>
                <p>We hold weekly practices of tower bells and semi-regular hand-bell practices. We also
                    have a variety of weekly socials, on campus and in the city itself. In recent weeks,
                    these have included film nights, Mario Kart, and the annual scavenger hunt. Impromptu
                    socials also seem to happen quite frequently, where we usually have a catch-up over a
                    pint at one of the student bars on campus. See events page for more info on these (apart
                    from the impromptu socials - it's in the name ;)</p>
                <p>If you would like to join us or are visiting York from another university for a few days
                    please drop us a message so we can get you involved!</p>
            </div>
            <div class="col-md-6">
                <img src="images/index/members.jpeg" class="img-fluid mx-auto d-block">
                <br>
            </div>
        </div>
    </div>
</section>

<?php include('componants/splitterFull.html'); ?>
<br>

<section id="thisWeekPractice">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="head_title text-ycgGreen">
                    Next practice:
                </div>
            </div>
            <div class="col-md-6">
                <div class="head_title" style="font-size: 15pt; line-height: 15px">
                    <?php include('componants/nextPractice.php'); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('componants/splitterFull.html'); ?>
<br>
<section id="thisWeekSocial">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="head_title text-ycgGreen">
                    Next social:
                </div>
            </div>
            <div class="col-md-6">
                <div class="head_title" style="font-size: 15pt; line-height: 15px">
                    <?php include('componants/nextSocial.php'); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('componants/splitterFull.html'); ?>

<?php include('componants/recentPeals.php'); ?>

</body>
</html>