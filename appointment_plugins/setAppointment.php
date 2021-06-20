<?php
include_once 'dbconnect.php';

// $appid=null;
// $appdate=null;
if (isset($_GET['scheduleDate']) && isset($_GET['appid'])) {
	$appdate =$_GET['scheduleDate'];
	$appid = $_GET['appid'];
}
// on b.icPatient = a.icPatient
$res = mysqli_query($con,"SELECT a.* FROM doctorschedule a
WHERE a.scheduleDate='$appdate' AND scheduleId=$appid");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);



//INSERT
if (isset($_POST['appointment'])) {
// $patientIc = mysqli_real_escape_string($con,$userRow['icPatient']);
// $patcontact=encryptthis($_POST['patcontact'], key);
$patientIc = 8888;
$scheduleid = mysqli_real_escape_string($con,$appid);
//  $labs=encryptthis($_POST['labs'], key);
$firstName = encryptthis($_POST['firstName'], key);
$lastName = encryptthis(mysqli_real_escape_string($con,$_POST['lastName']), key);
$contactNo = encryptthis(mysqli_real_escape_string($con,$_POST['contactNo']), key);
$symptom = mysqli_real_escape_string($con,$_POST['symptom']);
$avail = "notavail";


$query = "INSERT INTO appointment (   patientIc, scheduleId ,firstName, lastName, contactNo , appComment  )
VALUES ( '$patientIc','$scheduleid', '$firstName','$lastName', '$contactNo','$symptom') ";

//update table appointment schedule
$sql = "UPDATE doctorschedule SET bookAvail = '$avail' WHERE scheduleId = $scheduleid" ;
$scheduleres=mysqli_query($con,$sql);
if ($scheduleres) {
	$btn= "disable";
}


$result = mysqli_query($con,$query);
// echo $result;
if( $result )
{
?>
<script type="text/javascript">
alert('Appointment made successfully.');
</script>
<?php
header("Location: appointment.php");
}
else
{
	echo mysqli_error($con);
?>
<script type="text/javascript">
alert('Appointment booking fail. Please try again.');
</script>
<?php
header("Location: appointment.php");
}
//dapat dari generator end
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Clinica Abeleda | Home</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style1.css" rel="stylesheet">

    <link href="css/date/style.css" rel="stylesheet">
    <link href="css/date/style1.css" rel="stylesheet">
    <link href="css/date/blocks.css" rel="stylesheet">
    <link href="css/date/date/bootstrap-datepicker.css" rel="stylesheet">
    <link href="css/date/date/bootstrap-datepicker3.css" rel="stylesheet">
    <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
    <link href="css/date/material.css" rel="stylesheet">
</head>
<body id="page-top" class="landing-page no-skin-config">
<div class="navbar-wrapper">
        <nav class="navbar navbar-default navbar-fixed-top navbar-expand-md" role="navigation">
            <div class="container">
                <a class="navbar-brand" href="index.html">CLINICA ABELEDA</a>
                <div class="navbar-header page-scroll">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="nav-link page-scroll" href="#page-top">Home</a></li>
                        <li><a class="nav-link page-scroll" href="#features">Services</a></li>
                        <li><a class="nav-link page-scroll" href="#contact">Contact</a></li>
                        <li><a class="nav-link page-scroll" href="appointment.php">Appointment</a></li>
                        <li><a class="nav-link page-scroll" href="login.html">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
</div>
<br><br><br><br>


<div class="col-md-9 col-sm-9  user-wrapper">
	<div class="description">


		<div class="panel panel-default">
			<div class="panel-body">


				<form class="form" role="form" method="POST" accept-charset="UTF-8">

					<div class="panel panel-default">
						<div class="panel-heading">Appointment Information</div>
						<div class="panel-body">
							Date: <?php echo $userRow['scheduleDate'] ?><br>
							Time: <?php echo $userRow['startTime'] ?> - <?php echo $userRow['endTime'] ?><br>
						</div>
					</div>
					<div class="form-group">
						<label for="message-text" class="control-label">First Name:</label>
						<textarea class="form-control" name="firstName" required></textarea>
					</div>
					<div class="form-group">
						<label for="message-text" class="control-label">Last Name:</label>
						<textarea class="form-control" name="lastName" required></textarea>
					</div>
					<div class="form-group">
						<label for="recipient-name" class="control-label">Contact No:</label>
						<input type="text" class="form-control" name="contactNo" required>
					</div>
					<div class="form-group">
						<label for="message-text" class="control-label">Reason for appointment:</label>
						<textarea class="form-control" name="symptom" required></textarea>
					</div>
					<div class="form-group">
						<input type="submit" name="appointment" id="submit" class="btn btn-primary" value="Make Appointment">
					</div>
				</form>
			</div>
		</div>

	</div>

</div>
</div>
<!-- USER PROFILE ROW END-->
<!-- end -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
