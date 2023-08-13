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
    <style>

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            /*border: 1px solid #dddddd;*/
            text-align: center;
            padding: 8px;
        }

        c
    </style>
</head>
<body>

<?php include('componants/standardPageTop.php'); ?>

<section id="pagetitle">
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-12 col-md-6">
                <div class="pagetitle">
                    Peals and Quarters Stages Stats
                </div>
            </div>
        </div>
        <table>
            <tr>
                <th><a href="pealsSummary.php">Peal Summary</a></th>
                <th><a href="pealsStats.php">Changes Stats</a></th>
                <th><a href="pealsStages.php">Stages Stats</a></th>
            </tr>
        </table>
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

            $url_loc = 'peals/stages.json';
            $stages = file_get_contents($url_loc);
            $stages = json_decode($stages);

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
                foreach ($stages as $stage) {
                    if ($stage->academic_year === $element->academic_year) {
                        $peals = $stage->peals;
                        $quarters = $stage->quarters;
                        $other = $stage->other;
                        $total = $stage->total;
                        if ($total->singles != 0) {
                            echo "<div class=\"grid-container-location\">";
                            echo "<div class=\"tower\">Singles</div>";
                            echo "<div class=\"peals\">$peals->singles</div>";
                            echo "<div class=\"quarters\">$quarters->singles</div>";
                            echo "<div class=\"other\">$other->singles</div>";
                            echo "<div class=\"total\">$total->singles</div>";
                            echo "</div>";
                        }
                        if ($total->minimus != 0) {
                            echo "<div class=\"grid-container-location\">";
                            echo "<div class=\"tower\">Minimus</div>";
                            echo "<div class=\"peals\">$peals->minimus</div>";
                            echo "<div class=\"quarters\">$quarters->minimus</div>";
                            echo "<div class=\"other\">$other->minimus</div>";
                            echo "<div class=\"total\">$total->minimus</div>";
                            echo "</div>";
                        }
                        if ($total->doubles != 0) {
                            echo "<div class=\"grid-container-location\">";
                            echo "<div class=\"tower\">Doubles</div>";
                            echo "<div class=\"peals\">$peals->doubles</div>";
                            echo "<div class=\"quarters\">$quarters->doubles</div>";
                            echo "<div class=\"other\">$other->doubles</div>";
                            echo "<div class=\"total\">$total->doubles</div>";
                            echo "</div>";
                        }
                        if ($total->minor != 0) {
                            echo "<div class=\"grid-container-location\">";
                            echo "<div class=\"tower\">Minor</div>";
                            echo "<div class=\"peals\">$peals->minor</div>";
                            echo "<div class=\"quarters\">$quarters->minor</div>";
                            echo "<div class=\"other\">$other->minor</div>";
                            echo "<div class=\"total\">$total->minor</div>";
                            echo "</div>";
                        }
                        if ($total->triples != 0) {
                            echo "<div class=\"grid-container-location\">";
                            echo "<div class=\"tower\">Triples</div>";
                            echo "<div class=\"peals\">$peals->triples</div>";
                            echo "<div class=\"quarters\">$quarters->triples</div>";
                            echo "<div class=\"other\">$other->triples</div>";
                            echo "<div class=\"total\">$total->triples</div>";
                            echo "</div>";
                        }
                        if ($total->major != 0) {
                            echo "<div class=\"grid-container-location\">";
                            echo "<div class=\"tower\">Major</div>";
                            echo "<div class=\"peals\">$peals->major</div>";
                            echo "<div class=\"quarters\">$quarters->major</div>";
                            echo "<div class=\"other\">$other->major</div>";
                            echo "<div class=\"total\">$total->major</div>";
                            echo "</div>";
                        }
                        if ($total->caters != 0) {
                            echo "<div class=\"grid-container-location\">";
                            echo "<div class=\"tower\">Caters</div>";
                            echo "<div class=\"peals\">$peals->caters</div>";
                            echo "<div class=\"quarters\">$quarters->caters</div>";
                            echo "<div class=\"other\">$other->caters</div>";
                            echo "<div class=\"total\">$total->caters</div>";
                            echo "</div>";
                        }
                        if ($total->royal != 0) {
                            echo "<div class=\"grid-container-location\">";
                            echo "<div class=\"tower\">Royal</div>";
                            echo "<div class=\"peals\">$peals->royal</div>";
                            echo "<div class=\"quarters\">$quarters->royal</div>";
                            echo "<div class=\"other\">$other->royal</div>";
                            echo "<div class=\"total\">$total->royal</div>";
                            echo "</div>";
                        }
                        if ($total->cinques != 0) {
                            echo "<div class=\"grid-container-location\">";
                            echo "<div class=\"tower\">Cinques</div>";
                            echo "<div class=\"peals\">$peals->cinques</div>";
                            echo "<div class=\"quarters\">$quarters->cinques</div>";
                            echo "<div class=\"other\">$other->cinques</div>";
                            echo "<div class=\"total\">$total->cinques</div>";
                            echo "</div>";
                        }
                        if ($total->maximus != 0) {
                            echo "<div class=\"grid-container-location\">";
                            echo "<div class=\"tower\">Maximus</div>";
                            echo "<div class=\"peals\">$peals->maximus</div>";
                            echo "<div class=\"quarters\">$quarters->maximus</div>";
                            echo "<div class=\"other\">$other->maximus</div>";
                            echo "<div class=\"total\">$total->maximus</div>";
                            echo "</div>";
                        }
                        if ($total->tolling != 0) {
                            echo "<div class=\"grid-container-location\">";
                            echo "<div class=\"tower\">Tolling</div>";
                            echo "<div class=\"peals\">$peals->tolling</div>";
                            echo "<div class=\"quarters\">$quarters->tolling</div>";
                            echo "<div class=\"other\">$other->tolling</div>";
                            echo "<div class=\"total\">$total->tolling</div>";
                            echo "</div>";
                        }
                        if ($total->other != 0) {
                            echo "<div class=\"grid-container-location\">";
                            echo "<div class=\"tower\">Other</div>";
                            echo "<div class=\"peals\">$peals->other</div>";
                            echo "<div class=\"quarters\">$quarters->other</div>";
                            echo "<div class=\"other\">$other->other</div>";
                            echo "<div class=\"total\">$total->other</div>";
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