<?php
$url = 'peals/pealData.json'; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$data = json_decode($data); // decode the JSON feed
$current_year = $data[0]->academic_year;
$first = true;

if (count($data) != 0) {
    printf("<section id=\"nav%02d\"></section>",substr($current_year, 0, 4));
    printf("<section id=\"BTT%02d\">",substr($current_year, 0, 4));

    include('componants/backToTop.html');
    echo "</section>";
    include('componants/splitterFull.html');
    printf("<section id=\"%02d\">",substr($current_year, 0, 4));

    echo "<div class=\"container\">";
    echo "<div class=\"head_title text-ycgGreen\">$current_year</div>";
    echo "<div class=\"row\">";

    foreach ($data as $peal) {
        if ($peal->academic_year != $current_year) {
            if(!$first) {
                echo "</div>";
            } else {
                $first = false;
            }
            printf("<section id=\"nav%02d\"></section>",substr($peal->academic_year, 0, 4));
            printf("<section id=\"BTT%02d\">",substr($peal->academic_year, 0, 4));

            echo "</div>";
            include('componants/backToTop.html');
            echo "</section>";
            printf("<section id=\"%02d\">",substr($peal->academic_year, 0, 4));
            echo "</div>";

            include('componants/splitterFull.html');

            echo "<div class=\"container\">";
            echo "<div class=\"head_title text-ycgGreen\">$peal->academic_year</div>";
            echo "<div class=\"row\">";
            $current_year = $peal->academic_year;
        }
        else {

        }
        echo "<div class=\"col-md-6 pb-3\">";
        echo "<div class=\"card bg-light text-dark pealcardpadding\">";
        echo "<div class=\"card-head\">";
        echo "<div class=\"pealdate\">$peal->date</div>";
        echo "<div class=\"pealtower\">$peal->location";
        if ($peal->weight != "") {
            echo " ($peal->weight)";
        }
        if ($peal->time != "") {
            echo " in $peal->time";
        }
        echo "</div>";
        echo "</div>";
        echo "<div class=\"card-body\">";
        echo "<div class=\"pealmethodmain\">$peal->changes $peal->method</div>";
        echo "<div class=\"pealmethodsecondery\">$peal->details</div>";
        echo "<div class=\"pealringer\">";
        echo "<ul style=\"list-style-type:none;\">";
        foreach ($peal->ringers as $ringer) {
            echo "<li>$ringer->bell - $ringer->name</li>";
        }
        echo "</ul>";
        echo "</div>";
        foreach ($peal->footnotes as $footnote) {
            echo "<div class=\"pealfootnote\">$footnote</div>";
        }
        if ($peal->image != "") {
            echo "<img src=\"$peal->image\" class=\"img-fluid mx-auto d-block pealphoto\">";
        }
        if ($peal->image != "") {
            echo "<span class=\"pealphotocaption\">$peal->imageCaption</span>";
        }
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
    echo "</div>";
    echo "</section>";

}
include('componants/backToTop.html');
?>