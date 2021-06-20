<?php

include_once 'dbconnect.php';
$q = $_GET['q'];
$res = mysqli_query($con,"SELECT * FROM doctorschedule WHERE scheduleDate='$q' and bookAvail='available'");
if (!$res) {
die("Error running $sql: " . mysqli_error());
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php
        if (mysqli_num_rows($res)==0) {
        echo "<div class='alert alert-danger' role='alert'>No available Schedule for today.</div>";

        } else {
        echo "   <table class='table table-hover'>";
            echo " <thead>";
                echo " <tr>";



                    echo "  <th>Start Time</th>";
                    echo "  <th>End Time</th>";
                    echo " <th>Availability</th>";
                    echo "  <th>Book Now!</th>";
                echo " </tr>";
            echo "  </thead>";
            echo "  <tbody>";
                while($row = mysqli_fetch_array($res)) {
                ?>
                <tr>
                    <?php
                    // $avail=null;
                    // $btnclick="";
                    if ($row['bookAvail']!='available') {
                    $avail="danger";
                    $btnstate="disabled";
                    $btnclick="danger";
                    }
                    else {
                    $avail="primary";
                    $btnstate="";
                    $btnclick="primary";

                    }


                    // if ($rowapp['bookAvail']!="available") {
                    // $btnstate="disabled";
                    // } else {
                    // $btnstate="";
                    // }



                    echo "<td>" . $row['startTime'] . "</td>";
                    echo "<td>" . $row['endTime'] . "</td>";
                    echo "<td> <span class='label label-".$avail."'>". $row['bookAvail'] ."</span></td>";
                    echo "<td><button type='button' class='btn btn-success btn-xs ".$btnstate." passingID'  data-id='10' data-toggle='modal' data-target='#myModal5' onclick='$(\"#scheduleid\").val(\"" . $row['scheduleId'] . "\");'>Set Appointment</button></td>";
                    // echo "<td><a href='appointment.php?&appid=" . $row['scheduleId'] . "&scheduleDate=".$q."'>Book</a></td>";
                    // <td><button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#exampleModal'>Book Now</button></td>";
                    //triggered when modal is about to be shown
                    ?>


                    <!-- ?> -->
                </tr>

                <?php
                }
                }
                ?>
            </tbody>
            <!-- modal start -->














        </body>
    </html>
