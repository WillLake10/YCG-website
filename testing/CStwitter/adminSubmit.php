<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - CS Twitter Wall</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style/adminStyle.css">
    <meta http-equiv="refresh" content="3600">

</head>

<body>
<div class="admin-container">
    <div class="admin-head">Admin - Submit</div>
    <?php
    require "TweetAdmin.php";
    require "CarouselData.php";

    $request_body = file_get_contents('adminSubmit.php');
    $data=json_decode(file_get_contents('adminSubmit.php'),1);


    $carouselData = new CarouselData();
    $carouselData->timeOnSlide = $_POST["timeOnSlide"];
    echo "<p>Time on slide in carousel set to $carouselData->timeOnSlide second(s)</p>";

    $carouselData->numWeeks = $_POST["numWeeks"];
    echo "<p>$carouselData->numWeeks week(s) of tweets will be shown</p>";


    $showEmoji = $_POST["showEmoji"];
    if ($showEmoji == "showEmoji") {
        $carouselData->showEmoji = "true";
        echo "<p>Emoji's will be shown</p>";
    }
    else {
        $carouselData->showEmoji = "false";
        echo "<p>Emoji's will not be shown</p>";
    }


    $carouselDataFile = fopen("data/carouselData.json", "w") or die("Unable to open file!");
    fwrite($carouselDataFile, json_encode($carouselData));
    fclose($carouselDataFile);


    //    print_r($_POST);
//    echo "<p>$data</p>";
//    $f = fopen('php://input','r');
//    //            $request_body = stream_get_contents(STDIN);
//    while( $line = fgets( $f ) ) {
//        echo "<p>$line</p>";
//    }


    $tweets_url = 'data/tweets.json';
    $tweets = file_get_contents($tweets_url);
    $tweets = json_decode($tweets);

    $allTweetAdmin = array();
    foreach ($tweets as $tweet) {
//                echo "<p>loop start</p>";

        $tweetAd = new TweetAdmin();
        $tweetAd->setId($tweet->id);
        if ($_POST["$tweet->id-hide"] == "hidden") {
            $tweetAd->setHideFromCarousel("true");
            echo "<p>Tweet $tweet->id is hidden from the carousel</p>";
        } else {
            $tweetAd->setHideFromCarousel("false");
        }
        $allTweetAdmin[] = $tweetAd;
    }

    $tweetAdminFile = fopen("data/tweetsAdmin.json", "w") or die("Unable to open file!");
//    chmod("data/tweetsAdmin.json", 0777);
    fwrite($tweetAdminFile, json_encode($allTweetAdmin));
    fclose($tweetAdminFile);

    //                        phpinfo();
    ?>
    <form action="admin.php">
        <input type="submit" value="Back To Admin"/>
    </form>
</div>
</body>

