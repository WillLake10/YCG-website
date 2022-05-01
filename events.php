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
    <?php include('componants/head.html'); ?>
    <title>Events - York Colleges Guild</title>
    <script src="gallaria/galleria.js"></script>
    <link rel="stylesheet" href="styles/galleriaStyle.css" type="text/css">
    <link rel="stylesheet" href="styles/event.css" type="text/css">
    <script src="cronJobs/calender.js?random=<?= time() ?>" type="text/javascript"></script>
    <style>
        .buttonReload {
            background-color: var(--ycgGreen);
            border: 2px solid var(--ycgGreen);
            color: white;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            border-radius: 12px;
            transition-duration: 0.4s;
            cursor: pointer;
            left: 50%;
        }

        .buttonReload:hover {
            background-color: white;
            color: black;
            box-shadow: 0px 4px 8px rgb(51, 51, 51);
            box-shadow: 0px 6px 20px rgba(51, 51, 51, 0.7);
        }

        .vertical-center {
            margin: 0;
            position: absolute;
            left: 50%;
            -ms-transform: translateX(-50%);
            transform: translateX(-50%);
        }
    </style>
</head>
<body>

<?php include('componants/standardPageTop.php'); ?>

<section id="pagetitle">
    <div class="container pt-3 pb-3">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <div class="pagetitle">
                    Events
                </div>
            </div>
            <div class="col-md-4">

            </div>
        </div>
<!--        <div class="pt-3 pb-2" style="text-align: center">-->
<!--            <button class="button buttonReload" onclick="window.open('cronJobs/updateCal.php')">Reload Cal</button>-->
<!--        </div>-->
    </div>
</section>


<section id="events">
    <div class="container pb-5">
        <div class="row">

        </div>
        <div class="row">
            <div class="[ col-xs-12 offset-md-2 col-md-8 ]">
                <ul class="event-list">
                    <?php include('componants/calender.php'); ?>
                </ul>
            </div>

        </div>
    </div>
</section>


</body>
</html>