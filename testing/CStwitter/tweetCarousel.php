<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CS Twitter Wall</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="refresh" content="3600">
</head>

<body>
<?php include "getTweets.php";?>
<?php
$tweets_url = 'tweets.json';
$tweets = file_get_contents($tweets_url);
$tweets = json_decode($tweets);

$tweetAdminUrl = 'tweetsAdmin.json';
$tweetAdmin = file_get_contents($tweetAdminUrl);
$tweetAdmin = json_decode($tweetAdmin);

$tweet = $tweets[1];
foreach ($tweets as $tweet) {
    foreach ($tweetAdmin as $admin){
        if($admin->id == $tweet->id && $admin->hideFromCarousel == "true"){
           continue 2;
        }
    }
    echo "<div class=\"mySlides fade\">";
    echo "<div class=\"grid-tweet-container\">";

    //            Profile Image
    echo "<div class=\"profile_img\">";
    echo "<img src=\"$tweet->authorProfileImgUrl\" alt=\"\" class=\"\">";
    echo "</div>";
    //            Profile name and username
    echo "<div class=\"profile-name\">$tweet->authorName</div>";
    echo "<div class=\"profile-username\">@$tweet->authorUsername</div>";
    $tweetText = $tweet->text;
    if (strpos($tweetText, "https") !== false) {
        $tweetText = substr($tweet->text, 0, strpos($tweet->text, "https"));
    }

    $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
    $lenString = strlen(preg_replace($regexSymbols, '', $tweetText));


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
    echo "<div class=\"twitter-logo\"><img src=\"twitterLogo.png\" alt=\"\"></div>";

    echo "</div>";
    echo "</div>";
}
?>
<script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        // let dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1
        }
        slides[slideIndex - 1].style.display = "block";
        setTimeout(showSlides, 5000); // Change image every 2 seconds
    }
</script>
</body>

