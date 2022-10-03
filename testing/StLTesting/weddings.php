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
                                Weddings
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="welcome">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="figBox">
                                <img src="images/st_laurenceinterior.gif" style="max-width: 100%">
                                <div class="figureCap">The Church Interior</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <p>The bellringers of St Lawrence are more than happy to add to your special day by ringing
                                the bells before or after your wedding.
                            </p>
                            <p>There is a charge of £250 if you would just like the bells after the service (please
                                enquire if you would like bells before the service too).
                            </p>
                            <p>Please email admin@stlawrenceringers.org.uk for more details.
                            </p>
                        </div>
                        <div class="col-md-4">
                            <div class="figBox">
                                <img src="images/stLTower.jpg" style="max-width: 100%">
                                <div class="figureCap">The Tower</div>
                            </div>
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