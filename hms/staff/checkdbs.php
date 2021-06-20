<?php
include_once 'dbconnect.php';
// Get the variables.
$username=$_SESSION['login'];
$userid = $_GET['userid'];
$userip = "Updated Appointment List";
$status = "1";

$userid = $_GET['userid'];
$chkYesNo = $_GET['chkYesNo'];

$update = mysqli_query($con,"UPDATE appointment SET status='done' WHERE appId=$userid");
$log =  mysqli_query($con,"INSERT INTO userlog (uid,username,userip,status)
     VALUES ('$uId','$username','$userip','$status')");
if($update)
{

    echo "<script>alert('Updated Successfully');</script>";
    echo "<script>window.location.href ='appointmentStaff.php'</script>";
}
else
{
    echo "<script>window.location.href ='view-patient.php?viewid=$vid'</script>";
}


?>
