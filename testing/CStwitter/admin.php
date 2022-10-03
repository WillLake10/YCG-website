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
    <div class="admin-head">Admin</div>

    <form action="adminSubmit.php" method="post">
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
            $tweets_url = 'tweets.json';
            $tweets = file_get_contents($tweets_url);
            $tweets = json_decode($tweets);

            $tweetAdminUrl = 'testing/CStwitter/tweetsAdmin.json';
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
                foreach ($tweetAdmin as $admin){
                    if($admin->id == $tweet->id && $admin->hideFromCarousel == "true"){
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

