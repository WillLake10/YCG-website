<?php
    $url = 'data/pealData.json'; // path to your JSON file
    $data = file_get_contents($url); // put the contents of the file into a variable
    $years = json_decode($data); // decode the JSON feed
    $yearnumber = 19;
    $yearnumberPlus = $yearnumber + 1;
    foreach ($years as $year) {
        if(count($year) != 0){
            if($yearnumber == -1){
                printf("<section id=\"navPre2000\"></section>");
                printf("<section id=\"BTTPre2000\">");
            }else{
                printf("<section id=\"nav20%02d\"></section>", $yearnumber);
                printf("<section id=\"BTT20%02d\">", $yearnumber);
            }
            include ('componants/backToTop.html');
            echo "</section>";
            include ('componants/splitterFull.html');
            if($yearnumber == -1){
                printf("<section id=\"Pre2000\">");
            }else{
                printf("<section id=\"20%02d\">", $yearnumber);
            }
                echo "<div class=\"container\">";
                   if($yearnumberPlus == 0){
                        printf("<div class=\"head_title text-ycgGreen\">Pre 2000</div>");
                   }else{
                        printf("<div class=\"head_title text-ycgGreen\">20%02d/%02d</div>", $yearnumber, $yearnumberPlus);
                   }
                       echo "<div class=\"row\">";
                          foreach ($year as $peal) {
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
                                       echo "<div class=\"pealmethodmain\">$peal->method</div>";
                                       echo "<div class=\"pealmethodsecondery\">$peal->methodSecond</div>";
                                       echo "<div class=\"pealringer\">";
                                           echo "<ul style=\"list-style-type:none;\">";
                                               foreach ($peal->ringers as $ringer) {
                                                   echo "<li>$ringer[0] - $ringer[1]</li>";
                                               }
                                           echo "</ul>";
                                       echo "</div>";
                                       foreach ($peal->footnotes as $footnote) {
                                           echo"<div class=\"pealfootnote\">$footnote</div>";
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
        $yearnumber = $yearnumber - 1;
        $yearnumberPlus = $yearnumberPlus - 1;
    }
    include ('componants/backToTop.html');
?>