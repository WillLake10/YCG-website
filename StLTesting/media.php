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

    <link rel="stylesheet" href="bootstrap-gallery/web/assets/mobirise-icons/mobirise-icons.css">
    <link rel="stylesheet" href="bootstrap-gallery/tether/tether.min.css">
    <link rel="stylesheet" href="bootstrap-gallery/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-gallery/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="bootstrap-gallery/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="bootstrap-gallery/theme/css/style.css">
    <link rel="stylesheet" href="bootstrap-gallery/gallery/style.css">
    <link rel="stylesheet" href="bootstrap-gallery/mobirise/css/mbr-additional.css" type="text/css">

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


            <section id="pagetitle" style="background-color: #ffffff">
                <div class="container pt-3 pb-3">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-12 col-md-6">
                            <div class="pagetitle">
                                Media
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="gallary" class="mbr-gallery mbr-slider-carousel cid-ruuHhHl8AI" style="padding-top: 0px">
                <div class="container">
                    <div><!-- Filter -->
                        <div class="mbr-gallery-filter container gallery-filter-active">
                            <ul buttons="0">
                                <li class="mbr-gallery-filter-all"><a
                                            class="btn btn-md btn-primary-outline active display-7"
                                            href="">All</a></li>
                            </ul>
                        </div><!-- Gallery -->
                        <div class="mbr-gallery-row">
                            <div class="mbr-gallery-layout-default">
                                <div>
                                    <div>
                                        <?php
                                        $url = 'data/gallery.json';
                                        $data = file_get_contents($url);
                                        $images = json_decode($data);
                                        $number = 0;
                                        foreach ($images as $image) {
                                            echo "<a href=\"$image->imageName\" target=\"_blank\">";
                                            echo "<div class=\"mbr-gallery-item mbr-gallery-item--p2\" data-video-url=\"false\" data-tags=\"$image->dataTags\">";
                                            echo "<div href=\"#lb-gallery2-0\" data-slide-to=\"$number\" data-toggle=\"modal\">";
                                            echo "<img src=\"$image->imageName\" alt=\"$image->title\" title=\"$image->title\"><span class=\"icon-focus\"></span></div></div></a>";
                                            $number = $number + 1;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
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

<script src="bootstrap-gallery/web/assets/jquery/jquery.min.js"></script>
<script src="bootstrap-gallery/popper/popper.min.js"></script>
<script src="bootstrap-gallery/tether/tether.min.js"></script>
<script src="bootstrap-gallery/bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap-gallery/smoothscroll/smooth-scroll.js"></script>
<script src="bootstrap-gallery/bootstrapcarouselswipe/bootstrap-carousel-swipe.js"></script>
<script src="bootstrap-gallery/vimeoplayer/jquery.mb.vimeo_player.js"></script>
<script src="bootstrap-gallery/masonry/masonry.pkgd.min.js"></script>
<script src="bootstrap-gallery/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="bootstrap-gallery/theme/js/script.js"></script>
<script src="bootstrap-gallery/gallery/player.min.js"></script>
<script src="bootstrap-gallery/gallery/script.js"></script>
<script src="bootstrap-gallery/slidervideo/script.js"></script>

</body>
</html>