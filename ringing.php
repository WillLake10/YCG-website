<!DOCTYPE html>
<!--
Website: York Colleges Guild
Type: PHP
Page: Ringing
Created: 20th April 2020
Last modified: 8th March 2022
Author: Will Lake
-->
<html lang="en">
<head>
    <?php include('componants/head.html'); ?>
    <title>Ringing - York Colleges Guild</title>
</head>
<body>

<?php include('componants/standardPageTop.php'); ?>

<section id="pagetitle">
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-12 col-md-6">
                <div class="pagetitle">
                    Tower bell practices and other ringing
                </div>
            </div>
        </div>
    </div>
</section>

<section id="ringing">
    <div class="container pt-3 pb-3">
        <div class="row">
            <div class="col-md-6">
                <img src="images/ringing/ycg-ringers.jpg" class="img-fluid mx-auto d-block">
            </div>
            <div class="col-md-6">
                <p>We hold weekly practices alternating between York Oratory (St Wilfrid's) and St Lawrence's Church
                    in York. To see where we are this week refer to the events page</p>
                <p>At YCG, we ring a range of methods and activities - no matter your ability, there'll be
                    something for you here. Training is provided for complete beginners, while many of our older
                    members attend other practices throughout the city - they'd be more than happy to take you
                    along as a friendly face!.</p>
            </div>
        </div>
    </div>
</section>
<!--
<?php include('componants/splitterFull.html'); ?>

<section id="spurriergate">
    <div class="container pt-3 pb-3">
        <div class="row">
            <div class="col-md-9">
                <div class="head_title text-ycgGreen">
                    York Oratory (St Wilfrid's)
                </div>
                <p><span class="text-ycgGreen bold">Time:</span> 14:30-16:00</p>
                <p>For ringing at York Oratory, we meet on campus at 14:00 or so and walk into the city together or we
                    sometimes head to 'spoons for lunch before practice, and possibly another pub after 'spoons'.
                    After practice a group of us normally go to Evensong ringing at St Lawrences at 17:45 and have
                    enough time to have a pint in the Waggon before ringing and sometimes end up in another pub
                    after</p>
                <p>See doves entry <a href="https://dove.cccbr.org.uk/detail.php?tower=12165">here</a></p>
            </div>
            <div class="col-md-3">
                <img src="images/ringing/oratory.JPG" class="img-fluid mx-auto d-block" width="100%">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div id="map-container-google-9" class="z-depth-1-half map-container-5" style="height: 300px">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2347.309796732819!2d-1.086880084138265!3d53.96176618011258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487931a7b4868691%3A0x14b43f0a0ccbafb1!2sYork%20Oratory!5e0!3m2!1sen!2suk!4v1646748686260!5m2!1sen!2suk"
                                    width="600" height="450" style="border:0;" allowfullscreen=""
                                    loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="head_title">
                    About York Oratory
                </div>
                <p><span class="text-ycgGreen bold">Number of bells:</span> 10</p>
                <p><span class="text-ycgGreen bold">Tenor:</span> 18-1-21 in F</p>
                <p><span class="text-ycgGreen bold">Oldest Bell:</span> 2-10 cast in 1938)</p>
                <p><span class="text-ycgGreen bold">Canons:</span> No</p>
                <p><span class="text-ycgGreen bold">Cast by:</span> 1-2 - John Taylor Bellfounders Ltd (1995), 3-10 -
                    Gillett & Johnston (1938)</p>
                <p><span class="text-ycgGreen bold">Interesting Fact:</span> One of only 2 Catholic churches to have
                    change ringing bells</p>
            </div>
        </div>
    </div>
</section>

<?php include('componants/splitterFull.html'); ?>

<section id="stlawrence">
    <div class="container pt-3 pb-3">
        <div class="row">
            <div class="col-md-6">
                <div class="head_title text-ycgGreen">
                    St Lawrences
                </div>
                <p><span class="text-ycgGreen bold">Time:</span> 15:30-17:00</p>
                <p>When we go to St Lawrences a group of us sometimes meet for food at Courtyard on campus before
                    walking up to St Lawrences. We often stay after our practice for the Evensong ringing at St
                    Lawrences at 17:15.</p>
                <p>See doves entry <a href="https://dove.cccbr.org.uk/detail.php?DoveID=YORK+++SLA">here</a></p>
            </div>
            <div class="col-md-6">
                <img src="images/ringing/stLawrences.jpg" class="img-fluid mx-auto d-block" width="100%">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div id="map-container-google-9" class="z-depth-1-half map-container-5" style="height: 300px">
                            <iframe src="https://maps.google.com/maps?q=St%20Lawrences%20church%2C%20york&t=&z=15&ie=UTF8&iwloc=&output=embed"
                                    frameborder="0"
                                    style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="head_title">
                    About St Lawrences
                </div>
                <p><span class="text-ycgGreen bold">Number of bells:</span> 8</p>
                <p><span class="text-ycgGreen bold">Tenor:</span> 7-3-24 in A</p>
                <p><span class="text-ycgGreen bold">Oldest Bell:</span> 281 Years (Unused bell hung in ringing room cast
                    in 1739)</p>
                <p><span class="text-ycgGreen bold">Canons:</span> No</p>
                <p><span class="text-ycgGreen bold">Cast by:</span> 1-2 & 5 - John Taylor Bellfounders Ltd (1999), 3-4 &
                    7-8 - John Taylor & Co
                    (1947), 6 - John Taylor & Co (Bellfounders) Ltd (1988)</p>
                <p><span class="text-ycgGreen bold">Interesting Fact:</span> The bells where put in in 1999 for the
                    millennium</p>
            </div>
        </div>
    </div>
</section>
-->
<?php include('componants/splitterFull.html'); ?>

<section id="otherringing">
    <div class="container pt-3 pb-3">
        <div class="head_title">
            Local Ringing around York members attend
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Tower</th>
                <th>Time</th>
                <th>Day</th>
                <th>Ringing type</th>
                <th>Notes</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>York Minster</td>
                <td>09:00 - 10:00</td>
                <td>Sunday</td>
                <td>Service Ringing</td>
                <td></td>
            </tr>
            <tr>
                <td>St Lawrence</td>
                <td>09:30 - 10:15</td>
                <td>Sunday</td>
                <td>Service Ringing</td>
                <td>Followed by breakfast at Morisons with the ringers</td>
            </tr>
            <tr>
                <td>St Wilfrid's</td>
                <td>10:00 - 10:30</td>
                <td>Sunday</td>
                <td>Service Ringing</td>
                <td>Cafe trip between ringing</td>
            </tr>
            <tr>
                <td>St Wilfrid's</td>
                <td>11:30 - 12:00</td>
                <td>Sunday</td>
                <td>Service Ringing</td>
                <td></td>
            </tr>
            <tr>
                <td>St Lawrence</td>
                <td>17:45 - 18:30</td>
                <td>Sunday</td>
                <td>Service Ringing</td>
                <td></td>
            </tr>
            <tr>
                <td>St Lawrence</td>
                <td>19:30 - 21:00</td>
                <td>Monday</td>
                <td>Practice Night</td>
                <td></td>
            </tr>
            <tr>
                <td>St Martins</td>
                <td>19:30 - 21:00</td>
                <td>Tuesday</td>
                <td>Practice Night</td>
                <td>Advanced Practice</td>
            </tr>
            <tr>
                <td>York Minster</td>
                <td>19:30 - 21:00</td>
                <td>Tuesday</td>
                <td>Practice Night</td>
                <td>Advanced Practice (By arrangement with the Minster ringers)</td>
            </tr>
            <tr>
                <td>St Olave's</td>
                <td>19:00 - 20:30</td>
                <td>Wednesday</td>
                <td>Practice Night</td>
                <td>Once a month practice, check when on</td>
            </tr>
            <tr>
                <td>St Wilfrid's</td>
                <td>19:30 - 21:00</td>
                <td>Thursday</td>
                <td>Practice Night</td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>
</section>

</body>
</html>
