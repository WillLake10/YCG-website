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
                                Contact Us
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="welcome">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Please feel free to contact us using any of the below methods:
                            </p>
                            <p>Email: admin@stlawrenceringers.org.uk
                            </p>
                            <p>Telephone: xxxxx xxxxxx (Huw - Secretary), or xxxxx xxxxxx (Billy - Ringing Master).
                            </p>
                            <p>St Lawrence Parish Church is located on Lawrence Street, just outside Walmgate Bar,
                                opposite the Waggon & Horses public house. The postcode is YO10 3WP (incorrectly marked
                                3BN in a lot of sources!). Parking is available outside the church.
                            </p>
                        </div>
                        <div class="col-md-6">
                            <iframe width="425" height="350"
                                    src="https://maps.google.co.uk/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=YO10+3BN&amp;aq=&amp;sll=53.95356,-1.063764&amp;sspn=0.007753,0.01929&amp;ie=UTF8&amp;hq=&amp;hnear=YO10+3BN,+United+Kingdom&amp;t=m&amp;ll=53.960025,-1.077175&amp;spn=0.017674,0.036478&amp;z=14&amp;output=embed"
                                    frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe>
                            <br>
                            <a style="text-align: left; color: rgb(0, 0, 255);"
                               href="https://maps.google.co.uk/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=YO10+3BN&amp;aq=&amp;sll=53.95356,-1.063764&amp;sspn=0.007753,0.01929&amp;ie=UTF8&amp;hq=&amp;hnear=YO10+3BN,+United+Kingdom&amp;t=m&amp;ll=53.960025,-1.077175&amp;spn=0.017674,0.036478&amp;z=14">View
                                Larger Map</a>
                        </div>
                    </div>
                    <br>
                    <?php include('componants/splitterFull.html'); ?>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Other Ringing Societies in York:</h3>
                            <div>
                                <span class="bellItem">St Martins: </span>
                                <span class="bellInstence">
                                    <a href="http://stmartinsyorkbells.org.uk/">www.stmartinsyorkbells.org.uk</a>
                                </span><br>
                                <span class="bellItem">St Wilfrids: </span>
                                <span class="bellInstence">
                                    <a href="http://www.stwilfridsbellringers.org.uk/">www.stwilfridsbellringers.org.uk</a>
                                </span><br>
                                <span class="bellItem">York Colleges Guild: </span>
                                <span class="bellInstence">
                                    <a href="http://ycg.org.uk">www.ycg.org.uk</a>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3>St Lawrence Parish Church:</h3>
                            <div>
                                <a href="http://stlawrenceparishchurch.org.uk/">http://stlawrenceparishchurch.org.uk</a>
                            </div>
                            <div><a href="http://www.achurchnearyou.com/york-st-lawrence-st-nicholas/">http://www.achurchnearyou.com/york-st-lawrence-st-nicholas</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <br>
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