
<?php include('componants/standardPageTop.php'); ?>

<section id="pagetitle">
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-12 col-md-6">
                <div class="pagetitle">
                    Peals and Quarters
                </div>
            </div>
        </div>
        <div class="row pt-3 pl-2 pr-2">
            <p">This is a record of the peals and quarter peals rung by members of the York Colleges
            Guild. This list is by no means complete, but we try to keep it as up to date as possible.</p>
            <p>Records are displayed in academic year from September 1st to August 31st</p>
            <p">To see a summary and stats of YCG ringing <a href="pealsSummary.php">click here</a> </p>
        </div>
    </div>
    <div class="container pb-3">
        <div class="row pt-3 pl-2 pr-2">
            <?php
            $url = 'peals/lastEdit.json'; // path to your JSON file
            $data = file_get_contents($url); // put the contents of the file into a variable
            $data = json_decode($data);
            echo "<p>Last Update: $data->time</p>"
            ?>
        </div>
    </div>
</section>

<script src="scripts/pealNav.js" type="text/javascript"></script>