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
            require "TweetAdmin.php";

            $request_body = file_get_contents('http://www.ycg.org.uk/testing/CStwitter/adminSubmit.php//input');
            echo "<p>$request_body</p>";

            $tweets_url = 'tweets.json';
            $tweets = file_get_contents($tweets_url);
            $tweets = json_decode($tweets);

            $allTweetAdmin = array();
            foreach ($tweets as $tweet) {
//                echo "<p>loop start</p>";

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

                        phpinfo();
            ?>
    <form action="admin.php">
        <input type="submit" value="Back To Admin" />
    </form>
</div>
</body>

