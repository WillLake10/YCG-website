<!DOCTYPE html>
<!--
Website: York Colleges Guild
Type: PHP
Page: Quotes confimation
Created: 7th March 2023
Last modified: 7th March 2023
Author: Will Lake
-->
<html lang="en">
<head>
    <?php include('../componants/head.html'); ?>
    <title>Quotes - York Colleges Guild</title>
    <link rel="stylesheet" href="/main/styles/quotes.css" type="text/css">
</head>
<body>

<?php include('standardPageTop.php'); ?>

<section id="pagetitle">
    <div class="container pt-3 pb-3">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-12 col-md-6">
                <div class="pagetitle">
                    Submit a quote for the <span class="text-ycgGreen">YCG</span> quote page
                </div>
            </div>
        </div>
    </div>
</section>

<section id="quotes">
    <div class="container">
        <div class="row">
            <?php
            //        echo $_POST["username"];
            //        echo $_POST["email"];
            //        echo $_POST["code"];
            //        echo $_POST["name1"];
            //        echo $_POST["quote1"];
            //        echo "{\"event_type\": \"quote-submitted\",\"client_payload\": {\"input\": \"{\\\"username\\\": \\\"" . $_POST["username"] . "\\\", \\\"email\\\": \\\"" . $_POST["email"] . "\\\",\\\"code\\\": \\\"" . $_POST["code"] . "\\\",\\\"quote\\\": {\\\"name1\\\" : \\\"" . $_POST["name1"] . "\\\",\\\"quote1\\\" : \\\"" . $_POST["quote1"] . "\\\",\\\"name2\\\" : \\\"" . $_POST["name2"] . "\\\",\\\"quote2\\\" : \\\"" . $_POST["quote2"] . "\\\",\\\"name3\\\" : \\\"" . $_POST["name3"] . "\\\",\\\"quote3\\\" : \\\"" . $_POST["quote3"] . "\\\",\\\"name4\\\" : \\\"" . $_POST["name4"] . "\\\",\\\"quote4\\\" : \\\"" . $_POST["quote4"] . "\\\"}}\"}}";


            //        $payload = json_encode(array(
            //            "event_type" => "quote-submitted",
            //            "client_payload" => array(
            //                "input" => json_encode(array(
            //                    "username" => $_POST["username"],
            //                    "email" => $_POST["email"],
            //                    "code" => $_POST["code"],
            //                    "quote" => array(
            //                        "name1" => $_POST["name1"],
            //                        "quote1" => $_POST["quote1"],
            //                        "name2" => $_POST["name2"],
            //                        "quote2" => $_POST["quote2"],
            //                        "name3" => $_POST["name3"],
            //                        "quote3" => $_POST["quote3"],
            //                        "name4" => $_POST["name4"],
            //                        "quote4" => $_POST["quote4"]
            //                    )
            //                )
            //            ))
            //        ));

            function escape($in_string) {
                return str_replace("(", "!bracketO!", str_replace(")", "!bracketC!",addslashes($in_string)));
            }

            $payload = json_encode(
                array(
                    "event_type" => "quote-submitted",
                    "client_payload" => array(
                        "username" => escape($_POST["username"]),
                        "quote" => array(
                            "name1" => escape($_POST["name1"]),
                            "quote1" => escape($_POST["quote1"]),
                            "name2" => escape($_POST["name2"]),
                            "quote2" => escape($_POST["quote2"]),
                            "name3" => escape($_POST["name3"]),
                            "quote3" => escape($_POST["quote3"]),
                            "name4" => escape($_POST["name4"]),
                            "quote4" => escape($_POST["quote4"])
                        )
                    )
                )
            );
            $url = '../../token.txt'; // path to your JSON file
            $data = file_get_contents($url);

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://api.github.com/repos/WillLake10/YCG-website/dispatches",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
//            CURLOPT_POSTFIELDS => "{\"event_type\": \"quote-submitted\",\"client_payload\": {\"input\": \"{\\\"username\\\": \\\"" . $_POST["username"] . "\\\", \\\"email\\\": \\\"" . $_POST["email"] . "\\\",\\\"code\\\": \\\"" . $_POST["code"] . "\\\",\\\"quote\\\": {\\\"name1\\\" : \\\"" . $_POST["name1"] . "\\\",\\\"quote1\\\" : \\\"" . $_POST["quote1"] . "\\\",\\\"name2\\\" : \\\"" . $_POST["name2"] . "\\\",\\\"quote2\\\" : \\\"" . $_POST["quote2"] . "\\\",\\\"name3\\\" : \\\"" . $_POST["name3"] . "\\\",\\\"quote3\\\" : \\\"" . $_POST["quote3"] . "\\\",\\\"name4\\\" : \\\"" . $_POST["name4"] . "\\\",\\\"quote4\\\" : \\\"" . $_POST["quote4"] . "\\\"}}\"}}",
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_HTTPHEADER => [
                    "Accept: application/vnd.github.everest-preview+json",
                    "Authorization: Bearer " . $data ,
                    "Content-Type: application/json",
                    "User-Agent: WillLake10"
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                echo "<p>Thank you for submitting your quote, it has been sent to the committee for aproval and if approved it should
            appear on the quotes page soon</p>";
                echo "<div class=\"col-md-3\"></div>";
                echo "<div class=\"col-12 col-md-6\">";
                echo "<p>Quote Preview:</p>";
                if ($_POST["name1"] === '') {
                    echo "<p><span class=\"quotesExtra\"> " . $_POST["quote1"] . " </span></p>";
                } else {
                    echo "<p><span class=\"quotesName\"> " . $_POST["name1"] . ": </span>";
                    echo "<span class=\"quotesBody\"> " . $_POST["quote1"] . " </span></p>";
                }
                if ($_POST["name2"] === '') {
                    echo "<p><span class=\"quotesExtra\"> " . $_POST["quote2"] . " </span></p>";
                } else {
                    echo "<p><span class=\"quotesName\"> " . $_POST["name2"] . ": </span>";
                    echo "<span class=\"quotesBody\"> " . $_POST["quote2"] . " </span></p>";
                }
                if ($_POST["name3"] === '') {
                    echo "<p><span class=\"quotesExtra\"> " . $_POST["quote3"] . " </span></p>";
                } else {
                    echo "<p><span class=\"quotesName\"> " . $_POST["name3"] . ": </span>";
                    echo "<span class=\"quotesBody\"> " . $_POST["quote3"] . " </span></p>";
                }
                if ($_POST["name4"] === '') {
                    echo "<p><span class=\"quotesExtra\"> " . $_POST["quote4"] . " </span></p>";
                } else {
                    echo "<p><span class=\"quotesName\"> " . $_POST["name4"] . ": </span>";
                    echo "<span class=\"quotesBody\"> " . $_POST["quote4"] . " </span></p>";
                }
            }

            ?>
            <img src="egg.jpeg" alt="Easter Egg">
        </div>
    </div>
    </div>
</section>

</body>
</html>
