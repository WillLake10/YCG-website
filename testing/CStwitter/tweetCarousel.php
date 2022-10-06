<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CS Twitter Wall</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">-->
    <!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>-->
    <link rel="stylesheet" href="style/carouselStyle.css">
    <meta http-equiv="refresh" content="3600">
</head>

<body>
<?php //include "getTweets.php"; ?>
<div class="carousel">
    <?php
    $tweets_url = 'data/tweets.json';
    $tweets = file_get_contents($tweets_url);
    $tweets = json_decode($tweets);

    $tweetAdminUrl = 'data/tweetsAdmin.json';
    $tweetAdmin = file_get_contents($tweetAdminUrl);
    $tweetAdmin = json_decode($tweetAdmin);

    $carouselData_url = 'data/carouselData.json';
    $carouselData = file_get_contents($carouselData_url);
    $carouselData = json_decode($carouselData);

    $tweet = $tweets[1];
    foreach ($tweets as $tweet) {
        $currentTime = strtotime($tweet->createdAt);
        $monthAgo = strtotime("-1 month");
        if ($monthAgo > $currentTime) {
            continue;
        }
        foreach ($tweetAdmin as $admin) {
            if ($admin->id == $tweet->id && $admin->hideFromCarousel == "true") {
                continue 2;
            }
        }
        echo "<div class=\"carousel-item\">";
        echo "<div class=\"grid-tweet-container\">";

        //            Profile Image
//        Images used often are saved locally, currently this is UniOfYork, UoY_CS, UoY_CSstudents
//        This is due to only being able to pull low res profile images from the twitter api
        $savedProfiles_url = 'data/savedProfiles.json';
        $savedProfiles = file_get_contents($savedProfiles_url);
        $savedProfiles = json_decode($savedProfiles);

        $imgLoc = $tweet->authorProfileImgUrl;


        echo "<div class=\"profile_img\">";

        foreach ($savedProfiles as $savedProfile) {
            if ($tweet->authorUsername == $savedProfile->username) {
                $imgLoc = $savedProfile->img_loc;
            }
        }
        echo "<img src=\"$imgLoc\" alt=\"\" class=\"\">";
        echo "</div>";

        //            Profile name and username
        echo "<div class=\"profile-name\">$tweet->authorName</div>";
        echo "<div class=\"profile-username\">@$tweet->authorUsername</div>";
        $tweetText = $tweet->text;
        if (strpos($tweetText, "https") !== false) {
            $tweetText = substr($tweet->text, 0, strpos($tweet->text, "https"));
        }

        $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
        $tweetText = preg_replace($regexSymbols, '', $tweetText);
        if ($carouselData->showEmoji == "false") {
            // Match Emoticons
            $regex_emoticons = '/[\x{1F000}-\x{1FFFF}]/u';
            $tweetText = preg_replace($regex_emoticons, '', $tweetText);

            // Match Miscellaneous Symbols
            $regex_misc = '/[\x{2600}-\x{26FF}]/u';
            $tweetText = preg_replace($regex_misc, '', $tweetText);

            // Match Dingbats
            $regex_dingbats = '/[\x{2700}-\x{27BF}]/u';
            $tweetText = preg_replace($regex_dingbats, '', $tweetText);
        }
        $lenString = strlen($tweetText);


        //            Tweet content
        $t = strtotime($tweet->createdAt);
        if ($tweet->hasImg) {
            $size = "3vw";
            if ($lenString > 100) {
                $size = "2vw";
            }
            if ($lenString > 200) {
                $size = "1.5vw";
            }
            echo "<div class=\"tweet-content\">";
            echo "<div class=\"grid-tweet-content-container\">";
            echo "<div class=\"tweet-text\">";
            echo "<div style='font-size: $size'>";
            echo "<p>$tweetText</p>";
            echo "</div>";
            echo "</div>";
            echo "<div class=\"tweet-img\">";
            echo "<img src=\"$tweet->imgUrl\" alt=\"$tweet->imgAlt\" class=\"\">";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        } else {
            $size = "6vw";
            if ($lenString > 100) {
                $size = "4vw";
            }
            if ($lenString > 200) {
                $size = "3vw";
            }
            echo "<div class=\"tweet-content\">";
            echo "<div class=\"tweet-text-full\">";
            echo "<div style='font-size: $size'>";
            echo "<p>$tweetText</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }

//    Time
        echo "<div class=\"tweet-time\">";
        echo date('g:i A  ·  M d, Y', $t);
        echo "</div>";
        echo "<div class=\"twitter-logo\"><img src=\"img/twitterLogo.png\" alt=\"\"></div>";

        echo "</div>";
        echo "</div>";
    }
    ?>
</div>
<script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        window.onload = function () {
            var slides = document.getElementsByClassName('carousel-item'),
                addActive = function (slide) {
                    slide.classList.add('active')
                },
                removeActive = function (slide) {
                    slide.classList.remove('active')
                    slide.classList.add('last')
                };
            removeLast = function (slide) {
                slide.classList.remove('last')
            };
            addActive(slides[0]);

            setInterval(function () {
                    for (var i = 0; i < slides.length; i++) {
                        if (i + 1 == slides.length) {
                            addActive(slides[0]);
                            slides[0].style.zIndex = 100;
                            setTimeout(removeActive, 0, slides[i]); //Doesn't be worked in IE-9
                            setTimeout(removeLast, 4500, slides[i]) //Doesn't be worked in IE-9

                            break;
                        }
                        if (slides[i].classList.contains('active')) {
                            slides[i].removeAttribute('style');
                            setTimeout(removeActive, 0, slides[i]);
                            setTimeout(removeLast, 4500, slides[i]) //Doesn't be worked in IE-9
                            addActive(slides[i + 1]);
                            break;
                        }
                    }
                },  <?php
                $carouselData_url = 'data/carouselData.json';
                $carouselData = file_get_contents($carouselData_url);
                $carouselData = json_decode($carouselData);
                $time = $carouselData->timeOnSlide;
                // If time value is not numeric time will default to 10 seconds
                if (is_numeric($time)) {
                    $time = $time * 1000;
                    echo "$time";
                } else {
                    echo "10000";
                }
                ?>

            );
        }
    }
</script>
</body>

