<!DOCTYPE html>
<!--
Website: York Colleges Guild
Type: PHP
Page: <?php $page ?>
Created: 22nd April 2020
Last modified: 7th March 2023
Author: Will Lake
-->
<html lang="en">
<head>

<?php

include('../componants/head.html');
$url = '../data/galleryData.json'; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$titles = array_reverse(json_decode($data));
$title = "";
foreach ($titles as $t) {
    if ($t->folderName == $page) {
        $title = $t->displayName;
    }
}
?>

<title><?php echo $title ?> - York Colleges Guild</title>
<link rel="stylesheet" href="../styles/gallery.css">
</head>
<body>

<?php
include('standardPageTop.php');


?>


<section id="pagetitle">
    <div class="container pt-3 pb-3">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-12 col-md-6">
                <div class="pagetitle">
                    <?php echo $title ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="quotes">
    <div class="container">
        <div class="row">
            <?php
            //
            $path = '../../gallery/' . $page;
            $files = scandir($path);
            $images = array_diff($files, array('.', '..'));

            $cnt = 1;

            foreach ($images as $image) {
                echo "<div class=\"col-md-3 col-sm-6 pt-2\">";
                echo "<img src='../../gallery/$page/$image' class='galleryImg' onclick=\"openModal();currentSlide($cnt)\" class='hover-shadow'>";
                echo "</div>";
                $cnt = $cnt + 1;
            }
            ?>


        </div>

    </div>
    <div id="myModal" class="modal">
        <span class="close cursor" onclick="closeModal()">&times;</span>
        <div class="modal-content centered">

            <?php
            foreach ($images as $image) {
                echo "<div class=\"mySlides\">";
                echo "<img src=\"../../gallery/thumbnails/$page/$image\" style=\"width:100%\">";
                echo "</div>";
            }
            ?>

        </div>
    </div>
</section>
<script>
    // Open the Modal
    function openModal() {
        document.getElementById("myModal").style.display = "block";
    }

    // Close the Modal
    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    document.getElementById("myModal").addEventListener('click', function () {
        document.getElementById("myModal").style.display = "none";
    })

    var slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        var captionText = document.getElementById("caption");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        captionText.innerHTML = dots[slideIndex - 1].alt;
    }
</script>

</body>
</html>