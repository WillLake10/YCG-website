<!DOCTYPE html>
<!--
Website: York Colleges Guild
Type: PHP
Page: Peals and Quarters Summary
Created: 19th September 2022
Last modified: 19th September 2022
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
        <div class="row pt-3 text-center">
            <p>This is a summary of all the ringing performed by members of YCG that is recorded on bellboard.</p>
        </div>
    </div>
</section>

<section id="pagetitle">
    <div class="container pt-3">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <table class="table table-striped table-bordered text-center">
                    <thead>
                    <tr>
                        <th scope="col" style="width: 20%">Year</th>
                        <th scope="col" style="width: 20%">Peals</th>
                        <th scope="col" style="width: 20%">Quarters</th>
                        <th scope="col" style="width: 20%">Other</th>
                        <th scope="col" style="width: 20%">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $url = 'peals/counts.json';
                    $counts = file_get_contents($url);
                    $counts = json_decode($counts);

                    foreach ($counts as $element) {
                        $total = $element->peals+$element->quarters+$element->other;
                        echo "<tr>";
                        echo "<th scope=\"row\">$element->academic_year</th>";
                        echo "<td>$element->peals</td>";
                        echo "<td>$element->quarters</td>";
                        echo "<td>$element->other</td>";
                        echo "<td>$total</td>";
                        echo "</tr>";
                        if ($element->academic_year === "2021/22") {
                            echo "<tr>";
                            echo "<th scope=\"row\">2020/21</th>";
                            echo "<td>0</td>";
                            echo "<td>0</td>";
                            echo "<td>0</td>";
                            echo "<td>0</td>";
                            echo "</tr>";
                        }
                        if ($element->academic_year === "2004/05") {
                            echo "<tr>";
                            echo "<th scope=\"row\">2003/04</th>";
                            echo "<td>0</td>";
                            echo "<td>0</td>";
                            echo "<td>0</td>";
                            echo "<td>0</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</section>

<section>

</section>

<br><br>
</body>
</html>