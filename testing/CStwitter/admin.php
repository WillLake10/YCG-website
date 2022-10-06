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
    <div class="admin-head">Admin</div>

    <form action="adminSubmit.php" method="post">
        <div class="admin-subhead">Carousel Data</div>
        <div>
            <label for="timeOnSlide">Time to display each Tweet (second between 1 and 60):</label>
            <input type="number" id="timeOnSlide" name="timeOnSlide" min="1" max="60" value="<?php
            $carouselData_url = 'data/carouselData.json';
            $carouselData = file_get_contents($carouselData_url);
            $carouselData = json_decode($carouselData);
            echo "$carouselData->timeOnSlide"
            ?>">
        </div><br>
        <div>
            <label for="showEmoji">Show Emoji's on Carousel:</label>
            <input type="checkbox" name="showEmoji" <?php
            if ($carouselData->showEmoji == "true") {
                echo "checked ";
            }
            ?>value="showEmoji">
        </div>
        <br><br>
        <div class="admin-subhead">Tweet Content</div>

        <table class="table">

            <thead>
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Time Created</th>
                <th scope="col">Text</th>
                <th scope="col">Hide From Carousel</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $tweets_url = 'data/tweets.json';
            $tweets = file_get_contents($tweets_url);
            $tweets = json_decode($tweets);

            $tweetAdminUrl = 'data/tweetsAdmin.json';
            $tweetAdmin = file_get_contents($tweetAdminUrl);
            $tweetAdmin = json_decode($tweetAdmin);

            foreach ($tweets as $tweet) {
                echo "<tr>";
                echo "<td>@$tweet->authorUsername</td>";
                $t = strtotime($tweet->createdAt);
                echo "<td>";
                echo date('g:i A  ·  M d, Y', $t);
                echo "</td>";
                echo "<td>";
                echo substr($tweet->text, 0, 50);
                echo "...</td>";
                echo "<td>";
                echo "<input type=\"checkbox\" name=\"$tweet->id-hide\"";
                foreach ($tweetAdmin as $admin) {
                    if ($admin->id == $tweet->id && $admin->hideFromCarousel == "true") {
                        echo "checked ";
                    }
                }
                echo "value=\"hidden\">";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>

        <input type="submit">
    </form>
</div>
</body>

