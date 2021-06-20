<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();



?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Admin | View Patients</title>

	<link href="insp/css/bootstrap.min.css" rel="stylesheet">
	<link href="insp/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css">

	<!-- FooTable -->
	<link href="insp/css/plugins/footable/footable.core.css" rel="stylesheet">
	<link href="insp/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

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
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold">Admin</span>
                            <span class="text-muted text-xs block">Administrator <b class="caret"></b></span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                            <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                            <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="login.html">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        CA
                    </div>
                </li>
                <li>
                    <a href="dashboard.php"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>

                </li>
                <!-- <li>
                    <a href="manage-patient.php"><i class="fa fa-id-card"></i> <span class="nav-label">Patient Records</span></a>

                </li>

                <li>
                    <a href="admin-approved-appointments.html"><i class="fa fa-calendar"></i> <span class="nav-label">Appointments</span>  </a>
                </li> -->

                <li>
                    <a href="#"><i class="fa fa-medkit"></i> <span class="nav-label">Medicine Stocks</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="admin-medicines.html">Medicines</a></li>
                        <li><a href=" admin-stocks.html">Stocks</a></li>
                    </ul>
                </li>

                <li>
                    <a href="manage-users.php"><i class="fa fa-users"></i> <span class="nav-label">Manage Users</span>  </a>
                </li>

                <li class="active">
                    <a href="user-logs.php"><i class="fa fa-history"></i> <span class="nav-label">Activity Logs</span>  </a>
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
                    <a href="login.html">
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
                            <h5>Activity Logs</h5>



                        </div>
                        <div class="ibox-content">
                            <input type="text" class="form-control form-control-sm m-b-xs" id="filter"
                                   placeholder="Search for Patients">

                            <table class="footable table table-stripped" data-page-size="14" data-filter=#filter>
                                <thead>
                                    <tr>
																			<th class="center">#</th>
																			<th>User ID</th>
																			<th>User Name</th>
																			<th>Login Time</th>
																			<th>Logout Time</th>
																			<th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>

																			<?php
$sql=mysqli_query($con,"select * from userlog ");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


																				<tr>
																					<td class="center"><?php echo $cnt;?>.</td>
																					<td class="hidden-xs"><?php echo $row['uid'];?></td>
																					<td><?php echo $row['username'];?></td>
																					<td><?php echo date('F j, Y', strtotime($row['loginTime']));?></td>
																					<td><?php echo date('F j, Y', strtotime($row['logout']));?></td>

																					<td>
																						<?php if($row['status']==1)
{
	echo "Success";
}
else
{
	echo "Failed";
}?></td>
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
