<!DOCTYPE html>
<html lang="en">
<head>
    <title>Quotes - York Colleges Guild</title>
    <link rel="stylesheet" href="styles/quotes.css" type="text/css">
</head>
<body>

<?php

echo $_POST["quoteId"];
$payload = json_encode(
    array(
        "event_type" => "quote-approved",
        "client_payload" => array(
            "quote_id" => $_POST["quoteId"],
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
        "Authorization: Bearer " . $data,
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
    echo "Quote will appear on website soon";
}