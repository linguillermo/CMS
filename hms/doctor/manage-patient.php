<?php
session_start();
error_reporting(0);
require "include/aes256.php";
include('include/config.php');
include('include/checklogin.php');
check_login();



if(isset($_POST['submit']))
{
	//for logs
	$username = $_SESSION['dlogin'];
	$id = $_SESSION['id'];
	$userip = "Added New Patient";
	$status = "1";

	$docid=$_SESSION['id'];
	// $patname=$_POST['patname'];
$patname=encryptthis($_POST['patname'], key);
$patcontact=encryptthis($_POST['patcontact'], key);
$pataddress=encryptthis($_POST['pataddress'], key);
$patbday=encryptthis($_POST['patbday'], key);
//$patage=$_POST['patage'];
$patbday2=$_POST['patbday'];
$patbday1 = explode("/", $patbday2);
$patage1 = (date("md", date("U", mktime(0, 0, 0, $patbday1[0], $patbday1[1], $patbday1[2]))) > date("md")
    ? ((date("Y") - $patbday1[2]) - 1)
    : (date("Y") - $patbday1[2]));
$patage = encryptthis($patage1, key);
$gender=encryptthis($_POST['gender'], key);
$patoccupation=encryptthis($_POST['patoccupation'],key);

$log = "INSERT INTO userlog (uid,username,userip,status)
			 VALUES ('$uId','$username','$userip','$status')";

$sql=mysqli_query($con,"insert into tblpatient(Docid,PatientName,PatientContno,PatientAdd,PatientAge,PatientBday,PatientGender,PatientOccupation)
values('$docid','$patname','$patcontact','$pataddress','$patage','$patbday','$gender','$patoccupation')");
if($sql)
{
echo "<script>alert('Patient info added Successfully');</script>";
mysqli_query($con,$log);
header('location:manage-patient.php');

}
}

?>




<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Clinica Abeleda | Appointments</title>

	<link href="insp/css/bootstrap.min.css" rel="stylesheet">
	<link href="insp/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css">

	<!-- FooTable -->
	<link href="insp/css/plugins/footable/footable.core.css" rel="stylesheet">
	<link href="insp/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

	<link href="insp/css/animate.css" rel="stylesheet">
	<link href="insp/css/style.css" rel="stylesheet">


	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#patemail").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

</head>

<body>

	<div id="wrapper">

	<nav class="navbar-default navbar-static-side" role="navigation">
			<div class="sidebar-collapse">
					<ul class="nav metismenu" id="side-menu">
							<li class="nav-header">
									<div class="dropdown profile-element">
											<img alt="image" class="rounded-circle" src="insp/img/New Project.png"/>
											<?php $query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
															while($row=mysqli_fetch_array($query))
															{ ?>


                            <span class="block m-t-xs font-bold"><?php echo $row['fullName']; ?></span>
                            <span class="text-muted text-xs block"><?php echo $row['role']; ?></span>


													<?php } ?>
									</div>
									<div class="logo-element">
											CA
									</div>
							</li>
							<li>
									<a href="dashboard.php"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>

							</li>
							<li class="active">
									<a href="manage-patient.php"><i class="fa fa-table"></i> <span class="nav-label">Patient Records</span></a>

							</li>
							<li>
									<a href="appointment-history.php"><i class="fa fa-calendar"></i> <span class="nav-label">Appointments</span>  </a>
							</li>
					</ul>

			</div>
	</nav>

	<div id="page-wrapper" class="gray-bg">
			<div class="row border-bottom">
			<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
					<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
					<form role="search" class="navbar-form-custom" action="search_results.html">
							<div class="form-group">
									<input type="text" placeholder="" class="form-control" name="top-search" id="top-search">
							</div>
					</form>
			</div>
			<ul class="nav navbar-top-links navbar-right">
					<li>
							<span class="m-r-sm text-muted welcome-message">Welcome to Clinica Abeleda</span>
					</li>




					<li>
							<a href="logout.php">
									<i class="fa fa-sign-out"></i> Log out
							</a>
					</li>

			</ul>

			</nav>
			</div>

			<div class="wrapper wrapper-content animated fadeInRight">


            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Patient List</h5>

                            <div class="ibox-tools">
                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal5">
                                    Add New Patient
                                </button>
                            </div>

                            <div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">New Patient Form</h4>

                                        </div>
                                        <div class="modal-body">

                                                <form role="form" name="" method="post">
                                                    <div class="form-group row"><label class="col-sm-2 col-form-label">Patient Name</label>


                                                                <div class="col-sm-10"><input type="text" name="patname" class="form-control"></div>


                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                    <div class="form-group row"><label class="col-sm-2 col-form-label">Address</label>
                                                        <div class="col-sm-10"><input type="text" name="pataddress" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                    <div class="form-group row"><label class="col-sm-2 col-form-label">Phone No.</label>

                                                        <div class="col-sm-10">
                                                            <div class="input-group m-b">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-addon">+63</span>
                                                                </div>
                                                                <input type="text" name="patcontact" class="form-control">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                    <div class="form-group row" id="data_1"><label class="col-sm-2 col-form-label">Date of Birth</label>

                                                        <div class="col-sm-5"><div class="input-group date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="patbday" class="form-control" value="mm/dd/yyyy">
                                                        </div></div>

																												<label class="col-sm-1 col-form-label">Gender</label>
                                                        <div class="col-sm-4">
																													<!-- <input type="text" name="gender" class="form-control"> -->

																													<select class="form-control m-b" name="gender">
											                                        <option value="Male">Male</option>
											                                        <option value="Female">Female</option>

											                                    </select>

                                                        </div>



                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                    <div class="form-group row"><label class="col-sm-2 col-form-label">Occupation</label>
                                                        <div class="col-sm-10"><input type="text" name="patoccupation" class="form-control">
                                                        </div>
                                                    </div>



                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
																						<button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">
																						Submit
																						</button>
                                        </div>
																				</form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="ibox-content">
                            <input type="text" class="form-control form-control-sm m-b-xs" id="filter"
                                   placeholder="Search for Patients">

                            <table class="footable table table-stripped" data-page-size="14" data-filter=#filter>
                                <thead>
                                    <tr>
																			<th class="center">#</th>
																			<th>Patient Name</th>
																			<th>Address</th>
																			<th>Contact No. </th>
																			<th>Date of Birth </th>
																			<th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

																			<?php

																				$sql=mysqli_query($con,"select * from tblpatient");
																				$cnt=1;
																				while($row=mysqli_fetch_array($sql))
																				{
																					$name=decryptthis($row['PatientName'], key);
																					$patadd=decryptthis($row['PatientAdd'], key);
																					$patcontno=decryptthis($row['PatientContno'], key);
																					$patientbday=decryptthis($row['PatientBday'],key);

																				?>


																				<tr>
																					<td class="center"><?php echo $cnt;?>.</td>
																					<td class="hidden-xs"><?php echo $name;?></td>
																					<td><?php echo $patadd;?></td>
																					<td>0<?php echo $patcontno;?></td>
																					<td><?php echo date('F j, Y', strtotime($patientbday));?></td>

																					<td>
																						<!-- <a href="edit-patient.php?editid=<?php echo $row['ID'];?>" class="btn btn-info btn-xs">Edit</a> -->
	                                        <a href="view-patient.php?viewid=<?php echo $row['ID'];?>" class="btn btn-primary btn-xs">View</a></td>
                                    </tr>


																		<?php
																			$cnt=$cnt+1;
																			 }?>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="5">
                                        <ul class="pagination float-right"></ul>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
			<div class="footer">
					<div>
							<strong>Copyright</strong> Clinica Abeleda &copy; 2020
					</div>
			</div>

			</div>
			</div>



	<!-- Mainly scripts -->
	<script src="insp/js/jquery-3.1.1.min.js"></script>
	<script src="insp/js/popper.min.js"></script>
	<script src="insp/js/bootstrap.js"></script>
	<script src="insp/js/plugins/metisMenu/jquery.metisMenu.js"></script>
	<script src="insp/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

	<!-- FooTable -->
	<script src="insp/js/plugins/footable/footable.all.min.js"></script>

	<!-- Custom and plugin javascript -->
	<script src="insp/js/inspinia.js"></script>
	<script src="insp/js/plugins/pace/pace.min.js"></script>


	<script src="insp/js/plugins/datapicker/bootstrap-datepicker.js"></script>

	<!-- Page-Level Scripts -->
	<script>
			$(document).ready(function() {

					$('.footable').footable();
					$('.footable2').footable();

			});

	</script>



	<script>
    $(document).ready(function(){





        $('.input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

    });
</script>


		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>
