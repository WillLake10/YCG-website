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
        .grid-container {
            grid-template-areas:
            'year type peals quarters other total'
            'extra extra extra extra extra extra';
            grid-template-columns: 10% 18% 18% 18% 18% 18%;
        }

        .grid-container-title {
            grid-template-areas:
            'year type peals quarters other total'
            'extra extra extra extra extra extra';
            grid-template-columns: 10% 18% 18% 18% 18% 18%;
        }

        .type {
            grid-area: type;
        }

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
                    Peals and Quarters Changes Stats
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
            <p>This is a summary of all the changes stats ringing performed by members of YCG that is recorded on bellboard.</p>
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
                <div class="type bold">
                    <div class="side">
                        Type
                    </div>
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
            $url = 'peals/stats.json';
            $stats = file_get_contents($url);
            $stats = json_decode($stats);

            //            $url_loc = 'peals/locationsCounts.json';
            //            $locations = file_get_contents($url_loc);
            //            $locations = json_decode($locations);

            foreach ($stats as $element) {
                $pc = number_format($element->peal_changes);
                $qc = number_format($element->quarter_changes);
                $oc = number_format($element->other_changes);
                $tc = number_format($element->total_changes);
                $pb = number_format($element->peal_blows);
                $qb = number_format($element->quarter_blows);
                $ob = number_format($element->other_blows);
                $tb = number_format($element->total_blows);
                echo "<div class=\"grid-container\">";
                echo "<div class=\"year\">$element->academic_year</div>";
                echo "<div class=\"type\">Changes</div>";
                echo "<div class=\"peals\">$pc</div>";
                echo "<div class=\"quarters\">$qc</div>";
                echo "<div class=\"other\">$oc</div>";
                echo "<div class=\"total\">$tc</div>";
                echo "</div>";
                echo "<div class=\"grid-container\">";
                echo "<div class=\"year\"></div>";
                echo "<div class=\"type\">Blows</div>";
                echo "<div class=\"peals\">$pb</div>";
                echo "<div class=\"quarters\">$qb</div>";
                echo "<div class=\"other\">$ob</div>";
                echo "<div class=\"total\">$tb</div>";
                echo "</div>";
                echo "<div class=\"grid-container\" style='grid-template-rows: 5px;'>";
                echo "</div>";
                if ($element->academic_year === "2021/22") {
                    echo "<div class=\"grid-container\">";
                    echo "<div class=\"year\">2020/21</div>";
                    echo "<div class=\"type\">Changes</div>";
                    echo "<div class=\"peals\">0</div>";
                    echo "<div class=\"quarters\">0</div>";
                    echo "<div class=\"other\">0</div>";
                    echo "<div class=\"total\">0</div>";
//                    echo "<div class=\"expand\"></div>";
//                    echo "<div class=\"extra\" style=\"display: none\"></div>";
                    echo "</div>";
                    echo "<div class=\"grid-container\">";
                    echo "<div class=\"year\"></div>";
                    echo "<div class=\"type\">Blows</div>";
                    echo "<div class=\"peals\">0</div>";
                    echo "<div class=\"quarters\">0</div>";
                    echo "<div class=\"other\">0</div>";
                    echo "<div class=\"total\">0</div>";
//                    echo "<div class=\"expand\"></div>";
//                    echo "<div class=\"extra\" style=\"display: none\"></div>";
                    echo "</div>";
                    echo "<div class=\"grid-container\" style='grid-template-rows: 5px;'>";
                    echo "</div>";
                }
                if ($element->academic_year === "2004/05") {
                    echo "<div class=\"grid-container\">";
                    echo "<div class=\"year\">2003/04</div>";
                    echo "<div class=\"type\">Changes</div>";
                    echo "<div class=\"peals\">0</div>";
                    echo "<div class=\"quarters\">0</div>";
                    echo "<div class=\"other\">0</div>";
                    echo "<div class=\"total\">0</div>";
//                    echo "<div class=\"expand\"></div>";
//                    echo "<div class=\"extra\" style=\"display: none\"></div>";
                    echo "</div>";
                    echo "<div class=\"grid-container\">";
                    echo "<div class=\"year\"></div>";
                    echo "<div class=\"type\">Blows</div>";
                    echo "<div class=\"peals\">0</div>";
                    echo "<div class=\"quarters\">0</div>";
                    echo "<div class=\"other\">0</div>";
                    echo "<div class=\"total\">0</div>";
//                    echo "<div class=\"expand\"></div>";
//                    echo "<div class=\"extra\" style=\"display: none\"></div>";
                    echo "</div>";
                    echo "<div class=\"grid-container\" style='grid-template-rows: 5px;'>";
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
