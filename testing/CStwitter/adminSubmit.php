<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - CS Twitter Wall</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="refresh" content="3600">

</head>

<body>
<div class="admin-container">
    <div class="admin-head">Admin - Submit</div>
            <?php
//            phpinfo();
            require "TweetAdmin.php";

            $tweets_url = 'tweets.json';
            $tweets = file_get_contents($tweets_url);
            $tweets = json_decode($tweets);

            $allTweetAdmin = array();
            foreach ($tweets as $tweet) {
                $tweetAd = new TweetAdmin();
                $tweetAd->setId($tweet->id);
                if ($_POST["$tweet->id-hide"] == "hidden"){
                    $tweetAd->setHideFromCarousel("true");
                    echo "<p>Tweet $tweet->id is hidden from the carousel</p>";
                }
                else {
                    $tweetAd->setHideFromCarousel("false");
                }
                $allTweetAdmin[] = $tweetAd;
            }

            $tweetAdminFile = fopen("tweetsAdmin.json", "w") or die("Unable to open file!");
            chmod("tweetsAdmin.json", 0777);
            fwrite($tweetAdminFile, json_encode($allTweetAdmin));
            fclose($tweetAdminFile);
            ?>
    <form action="admin.php">
        <input type="submit" value="Back To Admin" />
    </form>
</div>
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

