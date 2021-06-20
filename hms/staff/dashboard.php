<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if (isset($_POST['addTask']))

{
	$task = $_POST['taskInput'];
	$username = $_SESSION['login'];

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

	<title>Staff | Dashboard</title>

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
                <li class="active">
                    <a href="dashboard.php"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>

                </li>
                <li>
                    <a href="manage-patient.php"><i class="fa fa-id-card"></i> <span class="nav-label">Patient Records</span></a>

                </li>

								<li>
									<a href="#"><i class="fa fa-calendar"></i> <span class="nav-label">Appointments</span><span class="fa arrow"></span></a>
									<ul class="nav nav-second-level collapse">
											<li><a href="appointmentStaff.php">Appointment List</a></li>
											<li><a href="addSchedule.php">Manage Schedule</a></li>
									</ul>
								</li>

								<li>
									<a href="#"><i class="fa fa-calendar"></i> <span class="nav-label">Manage Medicines</span><span class="fa arrow"></span></a>
									<ul class="nav nav-second-level collapse">
											<li><a href="manage-medicines.php">Medicines</a></li>
											<li><a href="manage-stocks.php">Stocks</a></li>
									</ul>
								</li>



								<!-- <li>
                    <a href="purchase-records.php"><i class="fa fa-medkit"></i> <span class="nav-label">Purchase Records</span></a>

                </li> -->

                <!-- <li>
                    <a href="manage-users.php"><i class="fa fa-users"></i> <span class="nav-label">Manage Users</span>  </a>
                </li>

                <li>
                    <a href="user-logs.php"><i class="fa fa-history"></i> <span class="nav-label">Activity Log</span>  </a>
                </li> -->

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

									<div class="col-lg-3">
										<a href="medicines-low.php">
											<div class="widget style1 red-bg">
													<div class="row">
															<div class="col-4">
																	<i class="fas fa-pills fa-5x"></i>
															</div>
															<div class="col-8 text-right">
																<span> Medicines Low on Stocks </span>
																<?php
																$result = mysqli_query($con, "select * from medicines where quantity<=10;");

																while(mysqli_fetch_array($result))
																{
																	$rowsMed = mysqli_num_rows($result);
																	}
																 ?>
																	<h2 class="font-bold"><?php echo $rowsMed; ?></h2>
															</div>
													</div>
											</div></a>
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
																			 		$username = $_SESSION['login'];
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

	$(document).ready(function() {

					$('.i-checks').iCheck({
							checkboxClass: 'icheckbox_square-green',
							radioClass: 'iradio_square-green'
					});

			/* initialize the external events
			 -----------------------------------------------------------------*/


			$('#external-events div.external-event').each(function() {

					// store data so the calendar knows to render an event upon drop
					$(this).data('event', {
							title: $.trim($(this).text()), // use the element's text as the event title
							stick: true // maintain when user navigates (see docs on the renderEvent method)
					});

					// make the event draggable using jQuery UI
					$(this).draggable({
							zIndex: 1111999,
							revert: true,      // will cause the event to go back to its
							revertDuration: 0  //  original position after the drag
					});

			});


			/* initialize the calendar
			 -----------------------------------------------------------------*/
			var date = new Date();
			var d = date.getDate();
			var m = date.getMonth();
			var y = date.getFullYear();

			$('#calendar').fullCalendar({
					header: {
							left: 'prev,next today',
							center: 'title',
							right: 'month,agendaWeek,agendaDay'
					},
					editable: true,
					droppable: true, // this allows things to be dropped onto the calendar
					drop: function() {
							// is the "remove after drop" checkbox checked?
							if ($('#drop-remove').is(':checked')) {
									// if so, remove the element from the "Draggable Events" list
									$(this).remove();
							}
					},
					events: [
							{
									title: 'Anna Malto',
									start: new Date(y, m, 1)
							},
							/* {
									title: 'Long Event',
									start: new Date(y, m, d-5),
									end: new Date(y, m, d-2)
							}, */
							{
									id: 999,
									title: 'Benedict Cruz',
									start: new Date(y, m, d-3, 16, 0),
									allDay: false
							},
							{
									id: 999,
									title: 'Carl Atienza',
									start: new Date(y, m, d+4, 16, 0),
									allDay: false
							},
							{
									title: 'Bon Martinez',
									start: new Date(y, m, d, 10, 30),
									allDay: false
							},
							{
									title: 'James Suarez',
									start: new Date(y, m, d, 12, 0),
									end: new Date(y, m, d, 14, 0),
									allDay: false
							},
							{
									title: 'Armand Betan',
									start: new Date(y, m, d+1, 19, 0),
									end: new Date(y, m, d+1, 22, 30),
									allDay: false
							},
							{
									title: 'Miko Gatchalian fb',
									start: new Date(y, m, 28),
									end: new Date(y, m, 29),
									url: 'http://facebook.com/'
							}
					]
			});


	});

</script>

	<script>
			$(document).ready(function() {


					var d1 = [[1262304000000, 6], [1264982400000, 3057], [1267401600000, 20434], [1270080000000, 31982], [1272672000000, 26602], [1275350400000, 27826], [1277942400000, 24302], [1280620800000, 24237], [1283299200000, 21004], [1285891200000, 12144], [1288569600000, 10577], [1291161600000, 10295]];
					var d2 = [[1262304000000, 5], [1264982400000, 200], [1267401600000, 1605], [1270080000000, 6129], [1272672000000, 11643], [1275350400000, 19055], [1277942400000, 30062], [1280620800000, 39197], [1283299200000, 37000], [1285891200000, 27000], [1288569600000, 21000], [1291161600000, 17000]];

					var data1 = [
							{ label: "Data 1", data: d1, color: '#17a084'},
							{ label: "Data 2", data: d2, color: '#127e68' }
					];
					$.plot($("#flot-chart1"), data1, {
							xaxis: {
									tickDecimals: 0
							},
							series: {
									lines: {
											show: true,
											fill: true,
											fillColor: {
													colors: [{
															opacity: 1
													}, {
															opacity: 1
													}]
											},
									},
									points: {
											width: 0.1,
											show: false
									},
							},
							grid: {
									show: false,
									borderWidth: 0
							},
							legend: {
									show: false,
							}
					});

					var lineData = {
							labels: ["January", "February", "March", "April", "May", "June", "July"],
							datasets: [
									{
											label: "Example dataset",
											backgroundColor: "rgba(26,179,148,0.5)",
											borderColor: "rgba(26,179,148,0.7)",
											pointBackgroundColor: "rgba(26,179,148,1)",
											pointBorderColor: "#fff",
											data: [48, 48, 60, 39, 56, 37, 30]
									},
									{
											label: "Example dataset",
											backgroundColor: "rgba(220,220,220,0.5)",
											borderColor: "rgba(220,220,220,1)",
											pointBackgroundColor: "rgba(220,220,220,1)",
											pointBorderColor: "#fff",
											data: [65, 59, 40, 51, 36, 25, 40]
									}
							]
					};

					var lineOptions = {
							responsive: true
					};


					var ctx = document.getElementById("lineChart").getContext("2d");
					new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});


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
