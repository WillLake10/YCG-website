<?php

$url = 'calender/calender.json'; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$data = json_decode($data); // decode the JSON feed
$found = false;
$n = 0;

echo "<link rel=\"stylesheet\" href=\"styles/event.css\" type=\"text/css\">";

if (count($data) != 0) {
    foreach ($data as $event) {
        if($event->practice && !$found) {
            $found = true;
            $start = $event->s_date;
            $n = $n + 1;
            echo "<p>What - $event->title</p>";
            echo "<p>Where - $event->location</p>";
            echo "<p>When - $start->full</p>";
        }
    }
}

if ($n === 0) {
    echo "<p>What - No Practice for now</p>";
    echo "<p>Where - </p>";
    echo "<p>When - </p>";
}
