<?php

require "vendor/autoload.php";
require "Tweet.php";

use Abraham\TwitterOAuth\TwitterOAuth;

$secrets_url = 'secrets.json';
$secrets = file_get_contents($secrets_url);
$secrets = json_decode($secrets);

$settings = array(
    'oauth_access_token' => $secrets->api_key,
    'oauth_access_token_secret' => $secrets->api_secret,
    'consumer_key' => $secrets->access_token,
    'consumer_secret' => $secrets->access_token_secret
);

$connection = new TwitterOAuth($secrets->api_key, $secrets->api_secret, $secrets->access_token, $secrets->access_token_secret);
$connection->setApiVersion('2');
$tweets = $connection->get("tweets/search/recent", [
    "query" => "from:uoy_csstudents",
//    "query" => "from:WillLake5",
//    "query" => "from:LeicesterTigers",
    "max_results" => "10",
    "expansions" => "attachments.media_keys,author_id,referenced_tweets.id.author_id",
    "tweet.fields" => "author_id,created_at,id",
    "media.fields" => "alt_text,url",
    "user.fields" => "name,profile_image_url,username",
]);
//$statuses = $connection->get("users/by/username/uoy_csstudents", []);
//$response = $connection->get('users', ['ids' => 12]);

//echo json_encode($statuses);

$allTweets = array();
foreach ($tweets->data as $tweetData) {
    $tweet = new Tweet();
//    echo $tweetData->referenced_tweets[0];
    $retweet = false;
    if ($tweetData->referenced_tweets != ""){
        foreach ($tweetData->referenced_tweets as $refInfo){
            if($refInfo->type == "retweeted"){
                $retweet = true;
                $refId = $refInfo->id;
                foreach ($tweets->includes->tweets as $includedTweet){
                    if ($includedTweet->id == $refId){
                        $tweet->setId($includedTweet->id);
                        $tweet->setText($includedTweet->text);
                        $tweet->setType("Retweet");
                        $tweet->setCreatedAt($includedTweet->created_at);
                        $tweet->setAuthorId($includedTweet->author_id);
                        foreach ($tweets->includes->users as $user){
                            if ($user->id == $includedTweet->author_id){
                                $tweet->setAuthorName($user->name);
                                $tweet->setAuthorUsername($user->username);
                                $tweet->setAuthorProfileImgUrl($user->profile_image_url);
                            }
                        }
                        if ($includedTweet->attachments->media_keys != ""){
                            $tweet->setHasImg(true);
                            $mediaKey = $tweetData->attachments->media_keys[0];
                            foreach ($tweets->includes->media as $mediaData){
                                if ($mediaData->media_key == $mediaKey){
                                    $tweet->setImgAlt($mediaData->alt_text);
                                    $tweet->setImgType($mediaData->type);
                                    $tweet->setImgUrl($mediaData->url);
                                }
                            }
                        } else {
                            $tweet->setHasImg(false);
                        }
                    }
                }
            }
        }
    }
    if ($tweetData->referenced_tweets == "" || !$retweet) {
        $tweet->setId($tweetData->id);
        $tweet->setText($tweetData->text);
        $tweet->setType("Tweet");
        $tweet->setCreatedAt($tweetData->created_at);
        $tweet->setAuthorId($tweetData->author_id);
        foreach ($tweets->includes->users as $user) {
            if ($user->id == $tweetData->author_id) {
                $tweet->setAuthorName($user->name);
                $tweet->setAuthorUsername($user->username);
                $tweet->setAuthorProfileImgUrl($user->profile_image_url);
            }
        }
        if ($tweetData->attachments->media_keys != "") {
            $tweet->setHasImg(true);
            $mediaKey = $tweetData->attachments->media_keys[0];
            foreach ($tweets->includes->media as $mediaData) {
                if ($mediaData->media_key == $mediaKey) {
                    $tweet->setImgAlt($mediaData->alt_text);
                    $tweet->setImgType($mediaData->type);
                    $tweet->setImgUrl($mediaData->url);
                }
            }
        } else {
            $tweet->setHasImg(false);
        }
    }
    if ($tweet->getImgUrl() == null){
        $tweet->setHasImg(false);
        $tweet->setImgAlt("");
        $tweet->setImgType("");
        $tweet->setImgUrl("");
    }
    $allTweets[] = $tweet;
}


$storedTweetsUrl = 'tweets.json';
$storedTweets = file_get_contents($storedTweetsUrl);
$storedTweets = json_decode($storedTweets);
foreach ($storedTweets as $storedTweet){
    $duplicate = false;
    foreach ($allTweets as $newTweet){
        if ($storedTweet->id == $newTweet->id){
            $duplicate = true;
        }
    }
    if (!$duplicate){
        $t = new Tweet();
        $t->setId($storedTweet->id);
        $t->setText($storedTweet->text);
        $t->setType($storedTweet->type);
        $t->setCreatedAt($storedTweet->createdAt);
        $t->setAuthorId($storedTweet->authorId);
        $t->setAuthorName($storedTweet->authorName);
        $t->setAuthorUsername($storedTweet->authorUsername);
        $t->setAuthorProfileImgUrl($storedTweet->authorProfileImgUrl);
        $t->setHasImg($storedTweet->hasImg);
        $t->setImgAlt($storedTweet->imgAlt);
        $t->setImgType($storedTweet->imgType);
        $t->setImgUrl($storedTweet->imgUrl);

        $allTweets[] = $t;
    }
}

$tweetFile = fopen("tweets.json", "w") or die("Unable to open file!");
fwrite($tweetFile, json_encode($allTweets));
fclose($tweetFile);