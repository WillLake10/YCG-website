<?php
$url = 'calender/calender.json'; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$data = json_decode($data); // decode the JSON feed
$first = true;
$n = 0;

echo "<link rel=\"stylesheet\" href=\"styles/event.css\" type=\"text/css\">";

if (count($data) != 0) {
    foreach ($data as $event) {
        $start = $event->s_date;
        $end = $event->e_date;
        $n = $n + 1;
        echo "<li>";
        echo "<time datetime=$start->full>";
        echo "<span class=\"day\">$start->day</span>";
        echo "<span class=\"month\">$start->month</span>";
        echo "<span class=\"year\">$start->year</span>";
        echo "<span class=\"time\">$start->time</span>";
        echo "</time>";
        echo "<div class=\"info\">";
        echo "<h2 class=\"title\">$event->title</h2>";
        if ($event->location != "") {
            echo "<p class=\"desc\"><span class=\"text-ycgGreen\">Where:</span> $event->location</p>";
        }
        if (!$event->allDay) {
            echo "<p class=\"desc\"><span class=\"text-ycgGreen\">When:</span> $start->weekday, $start->time - $end->time </p>";
        }
        else {
            echo "<p class=\"desc\"><span class=\"text-ycgGreen\">When:</span> $start->weekday, All Day</p>";
        }
        if ($event->description != "") {
            echo "<p class=\"desc\"><span class=\"text-ycgGreen\">What:</span> $event->description</p>";
        }
        echo "</div></li>";
    }
}

if ($n === 0) {
    echo "<h2>No Events Upcoming</h2>";
}
