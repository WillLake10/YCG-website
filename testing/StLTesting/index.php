<!DOCTYPE html>
<!--
Website: York Colleges Guild
Type: PHP
Page: Home
Created: 19th April 2020
Last modified: 15th June 2020
Author: Will Lake
-->
<html lang="en">
<head>
    <meta name="KEYWORDS" content="">
    <title>St Lawrence Ringers</title>
    <?php include('componants/head.html'); ?>
    <link rel="stylesheet" href="styles/peal.css" type="text/css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:n,b,i,bi" media="all">

    <?php include('componants/parrallax.html'); ?>

</head>
<body>

<div class="debug">
    <label><input type="checkbox"> Debug</label>
</div>


<div class="parallax">
    <div id="group2" class="parallax__group">

        <div class="parallax__layer parallax__layer--base">
            <div class="title">St Lawrence Ringers</div>
        </div>
        <div class="parallax__layer parallax__layer--base">
            <div class="font1">YORK</div>
        </div>
        <div class="parallax__layer parallax__layer--back">
            <div class="title"></div>
        </div>
    </div>
    <div id="group3" class="parallax__group">
        <div class="parallax__layer parallax__layer--base">
            <?php include('componants/navbar.php'); ?>

            <?php include('componants/COVID.html'); ?>

            <section id="pagetitle">
                <div class="container pt-3 pb-3">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-12 col-md-6">
                            <div class="pagetitle">
                                Welcome
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="welcome">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <p>We are the St Lawrence Society of Change Ringers - a bellringing society based at St
                                Lawrence Parish Church, a Church of England church in the city of York. We are a mixed
                                band of local residents and university students, ranging from new starters to
                                experienced ringers, with a wide repertoire.
                            </p>
                            <p>We practice weekly on a Monday night from 7:30 - 9:00 pm, and ring to announce the two
                                main Sunday services from 9:25 am and 5:15 pm. We always welcome visitors (and indeed
                                local residents wishing to take-up ringing), but please get in touch beforehand as we
                                occasionally make one-off changes.
                            </p>
                            <p>Our ring of eight is popular with peal and quarter peal ringers, as well as visiting
                                bands, and we will always try to cater for booking requests. Please get in touch with
                                Iain (Secretary) or Charlotte (Ringing Master) on admin@stlawrenceringers.org.uk if you
                                would like to arrange this, or with any other queries.
                            </p>
                            <p>We look forward to seeing you soon!</p>
                        </div>
                        <div class="col-md-6">
                            <figure>
                                <img src="images/st_laurence_bells.jpg" class="img-fluid mx-auto d-block">
                                <figcaption>The bells on display in church - Easter 1999</figcaption>
                            </figure>
                            <br>
                        </div>
                    </div>

                    <?php include('componants/splitterFull.html'); ?>
                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <figure>
                                <img src="images/St_Lawrence_Spring.jpg" class="img-fluid mx-auto d-block">
                                <figcaption>The Church in Spring</figcaption>
                            </figure>
                        </div>
                        <div class="col-md-6">
                            <p>Our usual weekly ringing times are:
                            </p>
                            <p>Monday Night Practice: 7:30 pm - 9:00 pm
                            </p>
                            <p>Sunday Morning Service: 9:25 am - 10:00 am
                            </p>
                            <p>Sunday Evensong: 5:15 pm - 6:00 pm
                            </p>
                            <p>
                                Additional ringing is often arranged on Friday evenings, and Sunday evenings after
                                Evensong
                                has finished. The band sometimes rings for occasional offices and services outside the
                                usual
                                pattern. Handbell practices are occasionally organised - please get in touch if you are
                                interested in handbell ringing in particular.</p>
                            <br>
                        </div>
                    </div>
                </div>
            </section>

            <?php include('componants/footer.html'); ?>
        </div>
    </div>
</div>

<script>
    var debugInput = document.querySelector("input");

    function updateDebugState() {
        document.body.classList.toggle('debug-on', debugInput.checked);
    }

    debugInput.addEventListener("click", updateDebugState);
    updateDebugState();
</script>

</body>
</html>