<?php
echo "<section id=\"recent\"><div class=\"container\"><div class=\"row\">";
for ($a = 0; $a <= 1; $a++) {
    echo "<div class=\"col-md-6 pb-3\"><div class=\"head_title\">";
        if ($a == 0){
            echo "Last Peal";
            $url = 'peals/lastPeal.json';
        } else{
            echo "Last Ringing";
            $url = 'peals/lastRinging.json';
        }
        $data = file_get_contents($url);
        $peal = json_decode($data);
    echo "</div>";
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
                        echo "<li>$ringer->bell - $ringer->name</li>";
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
echo "</div></div></section>";