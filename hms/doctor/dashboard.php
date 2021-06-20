<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();


if (isset($_POST['addTask']))

{
	$task = $_POST['taskInput'];
	$username = $_SESSION['dlogin'];

	$queryTask = "INSERT INTO tbltodo (username, todoNotes) value ('$username','$task')";
	if (empty($_POST['taskInput']))
	{
		echo "CANNOT BE EMPTY! MUST HAVE INPUTS!";
	}
	else {
		mysqli_query ($con,$queryTask);
	}
	header('Location: dashboard.php');
}

// DELETE TASKS
if (isset($_GET['del_task']))
{
	$id=$_GET['del_task'];

mysqli_query($con, "DELETE FROM tbltodo WHERE todoID =".$id);
header('Location: dashboard.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Clinica Abeleda | Dashboard</title>

	<link href="insp/css/bootstrap.min.css" rel="stylesheet">
	<link href="insp/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css">

	<link href="insp/css/plugins/iCheck/custom.css" rel="stylesheet">

	<link href="insp/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
	<link href="insp/css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'>


	<!-- Morris -->
	<link href="insp/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

	<link href="insp/css/animate.css" rel="stylesheet">
	<link href="insp/css/style.css" rel="stylesheet">

</head>

<body>
	<div id="wrapper">
	<nav class="navbar-default navbar-static-side" role="navigation">
			<div class="sidebar-collapse">
					<ul class="nav metismenu" id="side-menu">
							<li class="nav-header">
									<div class="dropdown profile-element">
											<img alt="image" class="rounded-circle" src="insp/img/New Project.png"/>
											<?php
															$query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
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
							<li class="active">
									<a href="dashboard.php"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>

							</li>
							<!-- <li>
									<a href="#"><i class="fa fa-table"></i> <span class="nav-label">Patients</span><span class="fa arrow"></span></a>
									<ul class="nav nav-second-level collapse">
											<li><a href="manage-patient.php">Patient Records</a></li>
											<li><a href="doctor-treatment-records.html">Treatment Records</a></li>
											<li><a href="doctor-prescription-records.html">Prescription Records</a></li>

									</ul>
							</li> -->

							<li>
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
					<div class="col-lg-3">
							<div class="widget style1 lazur-bg">
									<div class="row">
											<div class="col-4">
													<i class="fa fa-calendar-o fa-5x"></i>
											</div>
											<div class="col-8 text-right">
													<span> Pending Appointments </span>
													<?php
													$result = mysqli_query($con, "SELECT * FROM appointment where status='process'");

													while(mysqli_fetch_array($result))
													{
														$rows = mysqli_num_rows($result);
 													}
													 ?>
														<h2 class="font-bold"><?php echo $rows?></h2>
									</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
							<div class="widget style1 yellow-bg">
									<div class="row">
											<div class="col-4">
													<i class="fas fa-pills fa-5x"></i>
											</div>
											<div class="col-8 text-right">
												<span> Medicine Stocks </span>
												<?php
												$result = mysqli_query($con, "SELECT * FROM medicines");

												while(mysqli_fetch_array($result))
												{
													$rowsMed = mysqli_num_rows($result);
													}
												 ?>
													<h2 class="font-bold"><?php echo $rowsMed; ?></h2>
											</div>
									</div>
							</div>
					</div>
			</div>

			<!-- ********************************************************************************************************************* -->
			<!-- DASHBOARD CODE STARTS HERE -->

			<div class="wrapper wrapper-content  animated fadeInRight">
		            <div class="row">
		                <div class="col-lg" style="max-height: 580px; overflow-x: hidden; overflow-y: scroll;">
		                    <div class="ibox">
		                        <div class="ibox-content">
		                            <h3>To-do</h3>
		                            <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p>

																<form method="POST" action="">
		                            <div class="input-group">
		                                <input type="text" placeholder="Add new task. " class="input form-control-sm form-control" name="taskInput">
		                                <span class="input-group-btn">
		                                        <button type="submit" class="btn btn-sm btn-white" name="addTask"> <i class="fa fa-plus"></i> Add task</button>
		                                </span>
		                            </div>
															</form>
															 <?php
															 		$username = $_SESSION['dlogin'];
															 		$tasks = mysqli_query($con, "SELECT * FROM tbltodo WHERE username = '$username' ORDER BY todoStamp desc");
																	while ($row = mysqli_fetch_array($tasks)) {
															 ?>

	                             <ul class="sortable-list connectList agile-list" id="todo">
	                                 <li class="warning-element" id="<?php $taskID ?>">
	                                    <?php echo $row['todoNotes']; ?>
	                                     <div class="agile-detail">
																				 <span>
 																			 		 <a href="dashboard.php?del_task=<?php echo $row['todoID']; ?>" class="float-right fa fa-minus" </a>
																					 <a href="#" class="float-right btn btn-xs btn-white" id="pbutton" onclick="changeColor(this)">On-Going</a>
																				 </span>
	                                        <i class="fa fa-clock-o"></i><?php echo date('F j, Y, g:i a',strtotime($row['todoStamp'])); ?>
	                                     </div>
	                                 </li>
																 </ul>
																 <?php } ?>
		                        </div>
		                    </div>
											</div>
		               </div></div></div><br><br>



			<div class="footer">

					<div>
							<strong>Copyright</strong> Clinica Abeleda &copy; 2020
					</div>
			</div>

			</div>

	</div>

	<!-- Mainly scripts -->
	<script src="insp/js/plugins/fullcalendar/moment.min.js"></script>
	<script src="insp/js/jquery-3.1.1.min.js"></script>
	<script src="insp/js/popper.min.js"></script>
	<script src="insp/js/bootstrap.js"></script>
	<script src="insp/js/plugins/metisMenu/jquery.metisMenu.js"></script>
	<script src="insp/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

	<!-- Flot -->
	<script src="insp/js/plugins/flot/jquery.flot.js"></script>
	<script src="insp/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
	<script src="insp/js/plugins/flot/jquery.flot.spline.js"></script>
	<script src="insp/js/plugins/flot/jquery.flot.resize.js"></script>
	<script src="insp/js/plugins/flot/jquery.flot.pie.js"></script>
	<script src="insp/js/plugins/flot/jquery.flot.symbol.js"></script>
	<script src="insp/js/plugins/flot/curvedLines.js"></script>

	<!-- Peity -->
	<script src="insp/js/plugins/peity/jquery.peity.min.js"></script>
	<script src="insp/js/demo/peity-demo.js"></script>

	<!-- Custom and plugin javascript -->
	<script src="insp/js/inspinia.js"></script>
	<script src="insp/js/plugins/pace/pace.min.js"></script>

	<!-- jQuery UI -->
	<script src="insp/js/plugins/jquery-ui/jquery-ui.min.js"></script>

	<!-- Jvectormap -->
	<script src="insp/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
	<script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

	<!-- Sparkline -->
	<script src="insp/js/plugins/sparkline/jquery.sparkline.min.js"></script>

	<!-- Sparkline demo data  -->
	<script src="insp/js/demo/sparkline-demo.js"></script>

	<!-- ChartJS-->
	<script src="insp/js/plugins/chartJs/Chart.min.js"></script>

	<!-- iCheck -->
<script src="insp/js/plugins/iCheck/icheck.min.js"></script>

	<!-- Full Calendar -->
<script src="insp/js/plugins/fullcalendar/fullcalendar.min.js"></script>
<script>
	function changeColor()
	{
		var x = document.getElementById("pbutton");
		if (x.style.class == "")
		 {
			x.style.class = "fa fa-check";
		}
		else {
			return x;
		}
	}
</script>

<script>
		$(document).ready(function(){

				$("#todo, #inprogress, #completed").sortable({
						connectWith: ".connectList",
						update: function( event, ui ) {

								var todo = $( "#todo" ).sortable( "toArray" );
								var inprogress = $( "#inprogress" ).sortable( "toArray" );
								var completed = $( "#completed" ).sortable( "toArray" );
								$('.output').html("ToDo: " + window.JSON.stringify(todo) + "<br/>" + "In Progress: " + window.JSON.stringify(inprogress) + "<br/>" + "Completed: " + window.JSON.stringify(completed));
						}
				}).disableSelection();

		});
</script>

	</body>
</html>
