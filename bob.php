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
    <title>Bob - York Colleges Guild</title>
    <script src="gallaria/galleria.js"></script>
    <link rel="stylesheet" href="styles/galleriaStyle.css" type="text/css">
</head>
<body>

<?php
    include ('componants/pageTop.html');
    include ('componants/splitterFull.html');
    include ('componants/navbar.html');
?>

<section id="pagetitle">
    <div class="container pt-3 pb-3">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-12 col-md-6">
                <div class="pagetitle">
                    Bob the Badger
                </div>
            </div>
        </div>
    </div>
</section>

<section id="welcome">
    <div class="container">

        <div class="row">
            <div class="col-md-8">
                <p>Every great society needs a mascot. Bob is ours. Decked out in YCG green, he accompanies us at
                    practices, socials and meetings - lending a hand with a tone of stuff that only a small stuffed
                    badger can. He's been kidnapped more times than we can count (sometimes by members of our own
                    society!) but we always get him back in the end. Thankfully, Bob is extremely media-savvy: to see
                    more of his adventures, follow him on Instagram and Facebook below</p>
                <img src="images/social_media/insta.jpg" height="15"><a href=" https://www.instagram.com/ycgbob/"> @ycgbob</a></p>
                <img src="images/social_media/fb.png" height="15"><a href="https://www.facebook.com/bob.huntington.7568"> Bob Huntington</a> </p>

                <p>Alternatively, hang out in one of the many pubs around York - you'll be sure to bump into him
                    eventually.</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="galleria">
                            <?php
                                $url = 'data/bobPhotos.json';
                                $data = file_get_contents($url);
                                $photos = json_decode($data);
                                foreach ($photos as $photo) {
                                    echo "<img src=\"images/bob/$photo[0]\" data-title=\"$photo[1]\">";
                                }
                            ?>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <img src="images/bob/bob.jpg" class="img-fluid mx-auto d-block">
                <br>
            </div>
        </div>
    </div>
</section>

<script>
    (function() {
        Galleria.loadTheme('gallaria/themes/twelve/galleria.twelve.js');
        Galleria.run('.galleria',{
            imageCrop: false,
            autoplay: 2000
        });
    }());
</script>

</body>
</html>