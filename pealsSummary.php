<!DOCTYPE html>
<!--
Website: York Colleges Guild
Type: PHP
Page: Peals and Quarters Summary
Created: 19th September 2022
Last modified: 18th October 2022
Author: Will Lake
-->
<html lang="en">
<head>
    <?php include('componants/head.html'); ?>
    <title>Peals & Quarters - York Colleges Guild</title>
    <link rel="stylesheet" href="styles/peal.css" type="text/css">
</head>
<body>

<?php include('componants/standardPageTop.php'); ?>

<section id="pagetitle">
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-12 col-md-6">
                <div class="pagetitle">
                    Peals and Quarters Summary
                </div>
            </div>
        </div>
        <div class="row pt-3 pl-2 pr-2 text-center">
            <p>This is a summary of all the ringing performed by members of YCG that is recorded on bellboard.</p>
        </div>
    </div>
</section>

<section id="test">
    <div class="container pt-3 pl-2 pr-2">
        <div class="row">
            <div class="grid-container-title">
                <div class="year">
                    Year
                </div>
                <div class="peals bold">
                    <div class="side">
                        Peals
                    </div>
                </div>
                <div class="quarters bold">
                    <div class="side">
                        Quarters
                    </div>
                </div>
                <div class="other bold">
                    <div class="side">
                        Other
                    </div>
                </div>
                <div class="total bold">
                    <div class="side">
                        Total
                    </div>
                </div>
            </div>
            <?php
            $url = 'peals/counts.json';
            $counts = file_get_contents($url);
            $counts = json_decode($counts);

            $url_loc = 'peals/locationsCounts.json';
            $locations = file_get_contents($url_loc);
            $locations = json_decode($locations);

            foreach ($counts as $element) {
                $total = $element->peals + $element->quarters + $element->other;
                echo "<div class=\"grid-container\">";
                echo "<div class=\"year\">$element->academic_year</div>";
                echo "<div class=\"peals\">$element->peals</div>";
                echo "<div class=\"quarters\">$element->quarters</div>";
                echo "<div class=\"other\">$element->other</div>";
                echo "<div class=\"total\">$total</div>";
                echo "<div class=\"expand\">";
                echo "<button class=\"collapsible\" id=\"button-$element->academic_year\" onclick=\"myFunction('$element->academic_year')\"></button>";
                echo "</div>";
                echo "<div class=\"extra\" id=\"content-$element->academic_year\" style=\"display: none\">";
                foreach ($locations as $years) {
                    if ($years->academic_year === $element->academic_year) {
                        foreach ($years->tower as $tower) {
                            $t = str_replace(', North Yorkshire', '', $tower->tower);
                            echo "<div class=\"grid-container-location\">";
                            echo "<div class=\"tower\">$t</div>";
                            echo "<div class=\"peals\">$tower->peals</div>";
                            echo "<div class=\"quarters\">$tower->quarters</div>";
                            echo "<div class=\"other\">$tower->other</div>";
                            echo "<div class=\"total\">$tower->total</div>";
                            echo "</div>";
                        }
                    }
                }


                echo "</div>";
                echo "</div>";
                if ($element->academic_year === "2021/22") {
                    echo "<div class=\"grid-container\">";
                    echo "<div class=\"year\">2020/21</div>";
                    echo "<div class=\"peals\">0</div>";
                    echo "<div class=\"quarters\">0</div>";
                    echo "<div class=\"other\">0</div>";
                    echo "<div class=\"total\">0</div>";
//                    echo "<div class=\"expand\"></div>";
//                    echo "<div class=\"extra\" style=\"display: none\"></div>";
                    echo "</div>";
                }
                if ($element->academic_year === "2004/05") {
                    echo "<div class=\"grid-container\">";
                    echo "<div class=\"year\">2003/04</div>";
                    echo "<div class=\"peals\">0</div>";
                    echo "<div class=\"quarters\">0</div>";
                    echo "<div class=\"other\">0</div>";
                    echo "<div class=\"total\">0</div>";
//                    echo "<div class=\"expand\"></div>";
//                    echo "<div class=\"extra\" style=\"display: none\"></div>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>
</section>

<script>
    function myFunction(year) {
        var x = document.getElementById("content-" + year);
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>

<br><br>
</body>
</html>