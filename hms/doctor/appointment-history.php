<?php
session_start();
error_reporting(0);
require "include/aes256.php";
include('include/config.php');
include('include/checklogin.php');
check_login();
if(isset($_GET['cancel']))
		  {
mysqli_query($con,"update appointment set doctorStatus='0' where id ='".$_GET['id']."'");
                  $_SESSION['msg']="Appointment canceled !!";
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
							<li>
									<a href="dashboard.php"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>

							</li>
							<li>

									<a href="manage-patient.php"><i class="fa fa-table"></i> <span class="nav-label">Patient Records</span></a>


							</li>
							<li class="active">
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
	</div><br><br>
	<div class="panel panel-primary filterable">
											 <!-- Default panel contents -->
											<div class="panel-heading">
											 <h3 class="panel-title">Appointment List</h3>
											 <div class="pull-right"><br>
													 <button class="btn btn-outline-success btn-filter"><span class="fa fa-filter"></span> Filter</button>
													 <!-- <button class='btn btn-outline-success' type='submit' value='Submit' name='submit'>Update</button> -->
											 </div>
										 </div><br><br>
											 <div class="panel-body">
											 <!-- Table -->
											 <table class="table table-hover table-bordered">
													 <thead>
															 <tr class="filters">
																	 <th><input type="text" class="form-control" placeholder="First Name" disabled></th>
																	 <th><input type="text" class="form-control" placeholder="Last  Name" disabled></th>
																	 <th><input type="text" class="form-control" placeholder="Contact #" disabled></th>
																	 <th><input type="text" class="form-control" placeholder="Reason for Appointment" disabled></th>
																	 <th><input type="text" class="form-control" placeholder="Date" disabled></th>
																	 <th><input type="text" class="form-control" placeholder="Start" disabled></th>
																	 <th><input type="text" class="form-control" placeholder="End" disabled></th>
																	 <th><input type="text" class="form-control" placeholder="Status" disabled></th>
																	 <!-- <th><input type="text" class="form-control" placeholder="Complete" disabled></th> -->
																	 <!-- <th><input type="text" class="form-control" placeholder="Delete" disabled></th> -->
															 </tr>
													 </thead>

													 <?php
													 $res=mysqli_query($con,"SELECT b.*,c.*
																									 FROM appointment b
																									 JOIN doctorschedule c
																									 On b.scheduleId=c.scheduleId
																									 Order By appId desc");
																 if (!$res) {
																	 printf("Error: %s\n", mysqli_error($con));
																	 exit();
															 }
													 while ($appointment=mysqli_fetch_array($res)) {

															 if ($appointment['status']=='process') {
																	 $status="danger";
																	 $icon='remove';
																	 $checked='';

															 } else {
																	 $status="success";
																	 $icon='ok';
																	 $checked = 'disabled';
															 }


															 echo "<tbody>";
															 echo "<tr class='$status'>";

																	 echo "<td>" . decryptthis($appointment['firstName'], key) . "</td>";
																	 echo "<td>" . decryptthis($appointment['lastName'], key) . "</td>";
																	 echo "<td>" . decryptthis($appointment['contactNo'], key). "</td>";
																	 echo "<td>" . $appointment['appComment'] . "</td>";
																	 echo "<td>" . $appointment['scheduleDate'] . "</td>";
																	 echo "<td>" . $appointment['startTime'] . "</td>";
																	 echo "<td>" . $appointment['endTime'] . "</td>";
																	 echo "<td><span class='glyphicon glyphicon-".$icon."' aria-hidden='true'></span>".' '."". $appointment['status'] . "</td>";
																	 // echo "<form method='POST'>";
																	 // echo "<td class='text-center'><input type='checkbox' name='enable' id='enable' value='".$appointment['appId']."' onclick='chkit(".$appointment['appId'].",this.checked);' ".$checked."></td>";
														// 			 echo "<td class='text-center'><a href='#' id='".$appointment['appId']."' class='delete'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
													 // </td>";

													 }
											echo "</tbody>";
											echo "</table>";
											echo "<div class='panel panel-default'>";
											echo "<div class='col-md-offset-3 pull-right'>";
											// echo "<button class='btn btn-primary' type='submit' value='Submit' name='submit'>Update</button>";
											 echo "</div>";
											 echo "</div>";
											 ?>

											 <!-- <table>
											 <tr>
												<td colspan="5">
														<ul class="pagination float-right" ></ul>
												</td>
											</tr>
										</table> -->
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
														 <script src="insp/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

														 <!-- Page-Level Scripts -->
																 <!-- panel end -->
						 <script type="text/javascript">
						 function chkit(uid, chk) {
								chk = (chk==true ? "1" : "0");
								var url = "checkdbs.php?userid="+uid+"&chkYesNo="+chk;
								if(window.XMLHttpRequest) {
									 req = new XMLHttpRequest();
								} else if(window.ActiveXObject) {
									 req = new ActiveXObject("Microsoft.XMLHTTP");
								}
								// Use get instead of post.
								req.open("GET", url, true);
								req.send(null);
						 }
						 </script>
														 </div>
														 <!-- /.container-fluid -->
												 </div>
												 <!-- /#page-wrapper -->
										 </div>
										 <!-- /#wrapper -->
										 <!-- jQuery -->
										 <script src="../patient/assets/js/jquery.js"></script>
										 <script type="text/javascript">

										 // echo "<td class='text-center'><a href='#' id='".$appointment['appId']."' class='delete'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
						 $(function() {
						 $(".delete").click(function(){
						 var element = $(this);
						 var appid = element.attr("id");
						 var info = 'id=' + appid;
						 if(confirm("Are you sure you want to delete this?"))
						 {
							$.ajax({
								type: "POST",
								url: "deleteAppointment.php",
								data: info,
								success: function(){
							}
						 });
							 $(this).parent().parent().fadeOut(300, function(){ $(this).remove();});
							}
						 return false;
						 });
						 });
						 </script>
										 <!-- Bootstrap Core JavaScript -->
										 <script src="../patient/assets/js/bootstrap.min.js"></script>
										 <!-- Latest compiled and minified JavaScript -->
											<!-- script for jquery datatable start-->
										 <script type="text/javascript">
												 /*
												 Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
												 */
												 $(document).ready(function(){
														 $('.filterable .btn-filter').click(function(){
																 var $panel = $(this).parents('.filterable'),
																 $filters = $panel.find('.filters input'),
																 $tbody = $panel.find('.table tbody');
																 if ($filters.prop('disabled') == true) {
																		 $filters.prop('disabled', false);
																		 $filters.first().focus();
																 } else {
																		 $filters.val('').prop('disabled', true);
																		 $tbody.find('.no-result').remove();
																		 $tbody.find('tr').show();
																 }
														 });

														 $('.filterable .filters input').keyup(function(e){
																 /* Ignore tab key */
																 var code = e.keyCode || e.which;
																 if (code == '9') return;
																 /* Useful DOM data and selectors */
																 var $input = $(this),
																 inputContent = $input.val().toLowerCase(),
																 $panel = $input.parents('.filterable'),
																 column = $panel.find('.filters th').index($input.parents('th')),
																 $table = $panel.find('.table'),
																 $rows = $table.find('tbody tr');
																 /* Dirtiest filter function ever ;) */
																 var $filteredRows = $rows.filter(function(){
																		 var value = $(this).find('td').eq(column).text().toLowerCase();
																		 return value.indexOf(inputContent) === -1;
																 });
																 /* Clean previous no-result if exist */
																 $table.find('tbody .no-result').remove();
																 /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
																 $rows.show();
																 $filteredRows.hide();
																 /* Prepend no-result row if all rows are filtered */
																 if ($filteredRows.length === $rows.length) {
																		 $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
																 }
														 });
												 });
										 </script>
	</body>
</html>
