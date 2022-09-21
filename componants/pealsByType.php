<?php
$url = 'peals/pealData.json';
$data = file_get_contents($url);
$data = json_decode($data);
$url = 'peals/counts.json';
$counts = file_get_contents($url);
$counts = json_decode($counts);
$current_year = $data[0]->academic_year;
$current_count = findObjectByAcademicYear($current_year, $counts);
$first = true;
$first_p = true;
$first_q = true;
$first_o = true;

function findObjectByAcademicYear($academic_year, $counts)
{
    foreach ($counts as $element) {
        if ($academic_year == $element->academic_year) {
            return $element;
        }
    }

    return false;
}

if (count($data) != 0) {
    printf("<section id=\"nav%02d\"></section>", substr($current_year, 0, 4));
    printf("<section id=\"BTT%02d\">", substr($current_year, 0, 4));

    include('componants/backToTop.html');
    echo "</section>";
    include('componants/splitterFull.html');
    printf("<section id=\"%02d\">", substr($current_year, 0, 4));

    echo "<div class=\"container\">";
    echo "<div class=\"head_title text-ycgGreen\">$current_year</div>";
    echo "<div class=\"row\">";

    echo "<div class=\"col-md-4 col-12 text-ycgGreen counter\"> Peals = $current_count->peals </div>";
    echo "<div class=\"col-md-4 col-12 text-ycgGreen counter\"> Quaters = $current_count->quarters </div>";
    echo "<div class=\"col-md-4 col-12 text-ycgGreen counter\"> Other = $current_count->other </div>";

    foreach ($data as $peal) {
        if ($peal->academic_year != $current_year) {
            if (!$first) {
                echo "</div>";
            } else {
                $first = false;
            }
            printf("<section id=\"nav%02d\"></section>", substr($peal->academic_year, 0, 4));
            printf("<section id=\"BTT%02d\">", substr($peal->academic_year, 0, 4));

            echo "</div>";
            include('componants/backToTop.html');
            echo "</section>";
            printf("<section id=\"%02d\">", substr($peal->academic_year, 0, 4));
            echo "</div>";

            include('componants/splitterFull.html');

            echo "<div class=\"container\">";
            echo "<div class=\"head_title text-ycgGreen\">$peal->academic_year</div>";
            echo "<div class=\"row\">";
            $current_year = $peal->academic_year;

            $current_count = findObjectByAcademicYear($current_year, $counts);
            $first_p = true;
            $first_q = true;
            $first_o = true;
            echo "<div class=\"col-md-4 col-12 text-ycgGreen counter\"> Peals = $current_count->peals </div>";
            echo "<div class=\"col-md-4 col-12 text-ycgGreen counter\"> Quarters = $current_count->quarters </div>";
            echo "<div class=\"col-md-4 col-12 text-ycgGreen counter\"> Other = $current_count->other </div>";
        } else {

        }

        if ($peal->type === 0) {
            if ($current_count->peals > 0 && $first_p) {
                echo "</div>";
                echo "<div class=\"head_subtitle text-ycgGreen\"> Peals </div>";
                echo "<div class=\"row\">";
                $first_p = false;
            }
        }
        elseif ($peal->type === 1) {
            if ($current_count->quarters > 0 && $first_q) {
                echo "</div>";
                echo "<div class=\"head_subtitle text-ycgGreen\"> Quarters </div>";
                echo "<div class=\"row\">";
                $first_q = false;
            }
        }
        elseif ($peal->type === 2) {
            if ($current_count->other > 0 && $first_o) {
                echo "</div>";
                echo "<div class=\"head_subtitle text-ycgGreen\"> Other </div>";
                echo "<div class=\"row\">";
                $first_o = false;
            }
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