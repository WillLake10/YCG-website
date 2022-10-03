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
    <title>Bells - St Lawrence Ringers</title>
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
                                The Bells
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="container">
                <?php
                $url = 'data/bells.json'; // path to your JSON file
                $data = file_get_contents($url); // put the contents of the file into a variable
                $bells = json_decode($data);
                foreach ($bells as $bell) {

                    echo "<div class=\"row\" style='margin-bottom: 10px; margin-top: 10px'>";
                    echo "<div class=\"bellName col-md-12\"> $bell->bell </div>";
                    echo "<div class=\"col-md-3\"><span class=\"bellItem\">Weight: </span><span class=\"bellInstence\"> $bell->weight </span></div>";
                    echo "<div class=\"col-md-3\"><span class=\"bellItem\">Date: </span><span class=\"bellInstence\"> $bell->date </span></div></div>";
                    echo "<div class=\"row\" style='margin-bottom: 10px; margin-top: 10px'>";
                    echo "<div class=\"col-md-3\"><span class=\"bellItem\">Diameter: </span><span class=\"bellInstence\"> $bell->diameter </span></div>";
                    echo "<div class=\"col-md-3\"><span class=\"bellItem\">Founder: </span><span class=\"bellInstence\"> $bell->founder </span></div></div>";
                    echo "<div class=\"row\" style='margin-bottom: 10px; margin-top: 10px'>";
                    echo "<div class=\"col-md-3\"><span class=\"bellItem\">Note: </span><span class=\"bellInstence\"> $bell->note </span></div>";
                    echo "<div class=\"col-md-3\"><span class=\"bellItem\">Crown: </span><span class=\"bellInstence\"> $bell->crown </span></div></div>";
                    echo "<div class=\"row\" style='margin-bottom: 10px; margin-top: 10px'>";
                    echo "<div class=\"col-md-6\"><span class=\"bellItem\">Inscription Band: </span><span class=\"bellInstence\"> $bell->inscriptionBand </span></div>";
                    echo "<div class=\"col-md-12\"><span class=\"bellItem\">Waist: </span><span class=\"bellInstence\"> $bell->waist </span></div><br></div>";
                    if ($bell->bell != "Unused Bell") {
                        include('componants/splitterFull.html');
                    }
                }
                ?>
            </div>

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