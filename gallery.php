<!DOCTYPE html>
<!--
Website: York Colleges Guild
Type: PHP
Page: Gallary
Created: 18th June 2020
Last modified: 18th June 2020
Author: Will Lake
-->
<html lang="en">
<head>
    <?php include('componants/head.html'); ?>

    <link rel="stylesheet" href="bootstrap-gallery/web/assets/mobirise-icons/mobirise-icons.css">
    <link rel="stylesheet" href="bootstrap-gallery/tether/tether.min.css">
    <link rel="stylesheet" href="bootstrap-gallery/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-gallery/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="bootstrap-gallery/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="bootstrap-gallery/theme/css/style.css">
    <link rel="stylesheet" href="bootstrap-gallery/gallery/style.css">
    <link rel="stylesheet" href="bootstrap-gallery/mobirise/css/mbr-additional.css" type="text/css">

    <title>Gallery - York Colleges Guild</title>
</head>
<body>

<?php include('componants/standardPageTop.php'); ?>

<section id="pagetitle" style="background-color: #ffffff">
    <div class="container pt-3 pb-3">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-12 col-md-6">
                <div class="pagetitle">
                    Gallery
                </div>
            </div>
        </div>
    </div>
</section>

<section id="gallary" class="mbr-gallery mbr-slider-carousel cid-ruuHhHl8AI">
    <div class="container">
        <div><!-- Filter -->
            <div class="mbr-gallery-filter container gallery-filter-active">
                <ul buttons="0">
                    <li class="mbr-gallery-filter-all"><a class="btn btn-md btn-primary-outline active display-7"
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
                            $folders = json_decode($data);
                            $number = 0;
                            foreach (array_reverse($folders) as $folder) {
                                $directory = "/gallery/$folder[0]";
                                $images = glob($directory . "/*.jpg");

                                foreach ($images as $image) {
                                    echo "<div class=\"mbr-gallery-item mbr-gallery-item--p2\" data-video-url=\"false\" data-tags=\"$folder[1]\">";
                                    echo "<div href=\"#lb-gallery2-0\" data-slide-to=\"$number\" data-toggle=\"modal\">";
                                    echo "<img src=\"$image\" alt=\"\" title=\"\"><span class=\"icon-focus\"></span></div></div>";
                                    $number = $number + 1;
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div><!-- Lightbox -->
            <div data-app-prevent-settings="" class="mbr-slider modal fade carousel slide" tabindex="-1"
                 data-keyboard="true" data-interval="false" id="lb-gallery2-0">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="carousel-inner">
                                <?php
                                $url = 'data/gallery.json';
                                $data = file_get_contents($url);
                                $folders = json_decode($data);
                                foreach (array_reverse($folders) as $b => $folder) {
                                    $directory = "images/gallery/$folder[0]";
                                    $images = glob($directory . "/*.jpg");

                                    foreach ($images as $a => $image) {
                                        if ($a == 0 && $b == 0) {
                                            echo "<div class=\"carousel-item active\"><img src=\"$image\" alt=\"\" title=\"\"></div>";
                                        } else {
                                            echo "<div class=\"carousel-item\"><img src=\"$image\" alt=\"\" title=\"\"></div>";
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <a class="carousel-control carousel-control-prev" role="button" data-slide="prev"
                               href="#lb-gallery2-0"><span class="mbri-left mbr-iconfont"
                                                           aria-hidden="true"></span><span
                                        class="sr-only">Previous</span></a><a
                                    class="carousel-control carousel-control-next"
                                    role="button" data-slide="next"
                                    href="#lb-gallery2-0"><span
                                        class="mbri-right mbr-iconfont" aria-hidden="true"></span><span
                                        class="sr-only">Next</span></a><a class="close" href="#" role="button"
                                                                          data-dismiss="modal"><span
                                        class="sr-only">Close</span></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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