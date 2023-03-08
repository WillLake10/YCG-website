<!DOCTYPE html>
<!--
Website: York Colleges Guild
Type: PHP
Page: Quotes submit
Created: 7th March 2023
Last modified: 7th March 2023
Author: Will Lake
-->
<html lang="en">
<head>
    <?php include ('../componants/head.html'); ?>
    <title>Quotes - York Colleges Guild</title>
    <link rel="stylesheet" href="styles/quotes.css" type="text/css">
<!--    <style>-->
<!--        table {-->
<!--            font-family: arial, sans-serif;-->
<!--            border-collapse: collapse;-->
<!--            width: 100%;-->
<!--        }-->
<!---->
<!--        td, th {-->
<!--            border: 1px solid #dddddd;-->
<!--            text-align: left;-->
<!--            padding: 8px;-->
<!--        }-->
<!---->
<!--        tr:nth-child(even) {-->
<!--            background-color: #dddddd;-->
<!--        }-->
<!--    </style>-->
</head>
<body>

<?php include ('standardPageTop.php'); ?>

<section id="pagetitle">
    <div class="container pt-3 pb-3">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-12 col-md-6">
                <div class="pagetitle">
                   Submit a quote for the <span class="text-ycgGreen">YCG</span> quote page
                </div>
            </div>
        </div>
    </div>
</section>

<section id="quotes">
    <div class="container">
        <form action="quotesConfimation.php" method="post">
            <table>
                <tr>
                    <td style="width:30%">Name:</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>E-mail:</td>
                    <td><input type="text" name="email"></td>
                </tr>
            </table>
            <table style="width:100%">
                <tr>
                    <th style="width:30%">Name</th>
                    <th>Quote</th>
                </tr>
                <tr>
                    <td><input style="width:100%" type="text" name="name1"><br></td>
                    <td><input style="width:100%" type="text" name="quote1"><br></td>
                </tr>
                <tr>
                    <td><input style="width:100%" type="text" name="name2"><br></td>
                    <td><input style="width:100%" type="text" name="quote2"><br></td>
                </tr>
                <tr>
                    <td><input style="width:100%" type="text" name="name3"><br></td>
                    <td><input style="width:100%" type="text" name="quote3"><br></td>
                </tr>
                <tr>
                    <td><input style="width:100%" type="text" name="name4"><br></td>
                    <td><input style="width:100%" type="text" name="quote4"><br></td>
                </tr>
            </table>
            <br>
            <input type="submit">
        </form>
    </div>
</section>

</body>
</html>