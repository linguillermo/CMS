<?php
session_start();
error_reporting(0);
require "include/aes256.php";
include('include/config.php');
include('include/checklogin.php');
check_login();


if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from users where id = '".$_GET['id']."'");
                  $_SESSION['msg']="data deleted !!";
		  }

			if(isset($_POST['submit']))
			{

				$fullName=$_POST['fullName'];
			$role=$_POST['role'];
			$email=$_POST['email'];
			$username=$_POST['username'];
			// $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
			$password=md5($_POST['password']);


			$sql=mysqli_query($con,"insert into users(fullName,role,email,username,password) values('$fullName','$role','$email','$username','$password')");
			if($sql)
			{
			echo "<script>alert('User added Successfully');</script>";
			header('location:manage-users.php');

			}
			}

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
                <!-- <li>
                    <a href="manage-patient.php"><i class="fa fa-id-card"></i> <span class="nav-label">Patient Records</span></a>

                </li>

                <li>
                    <a href="admin-approved-appointments.html"><i class="fa fa-calendar"></i> <span class="nav-label">Appointments</span>  </a>
                </li> -->

								<li>
										<a href="manage-medicines.php"><i class="fa fa-table"></i> <span class="nav-label">Medicine Stocks</span></a>

								</li>

                <li class="active">
                    <a href="manage-users.php"><i class="fa fa-users"></i> <span class="nav-label">Manage Users</span>  </a>
                </li>

                <li>
                    <a href="user-logs.php"><i class="fa fa-history"></i> <span class="nav-label">Activity Log</span>  </a>
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
                            <h5>Users List</h5>

                            <div class="ibox-tools">
                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal5">
                                    Add New User
                                </button>
                            </div>

                            <div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">New User Form</h4>

                                        </div>
                                        <div class="modal-body">

                                                <form role="form" name="" method="post">
                                                    <div class="form-group row"><label class="col-sm-2 col-form-label">Full Name</label>


                                                                <div class="col-sm-10"><input type="text" name="fullName" class="form-control"></div>


                                                    </div>

																										<div class="hr-line-dashed"></div>
                                                    <div class="form-group row"><label class="col-sm-2 col-form-label">User Role</label>
                                                        <div class="col-sm-10"><input type="text" name="role" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="hr-line-dashed"></div>
                                                    <div class="form-group row"><label class="col-sm-2 col-form-label">E-Mail</label>
                                                        <div class="col-sm-10"><input type="text" name="email" class="form-control">
                                                        </div>
                                                    </div>

																										<div class="hr-line-dashed"></div>
                                                    <div class="form-group row"><label class="col-sm-2 col-form-label">Username</label>
                                                        <div class="col-sm-10"><input type="text" name="username" class="form-control">
                                                        </div>
                                                    </div>

																										<div class="hr-line-dashed"></div>
                                                    <div class="form-group row"><label class="col-sm-2 col-form-label">Password</label>
                                                        <div class="col-sm-10"><input type="password" name="password" class="form-control">
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
                                   placeholder="Search for Users">

                            <table class="footable table table-stripped" data-page-size="14" data-filter=#filter>
                                <thead>
                                    <tr>
																			<th class="center">#</th>
																			<th>Full Name</th>
																			<th>Username</th>
																			<th>User Role</th>
																			<th>Email</th>

																			<th>Creation Date</th>
																			<th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

																			<?php
$sql=mysqli_query($con,"select * from users");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


																				<tr>
																					<td class="center"><?php echo $cnt;?>.</td>
																					<td class="hidden-xs"><?php echo $row['fullName'];?></td>
																					<td><?php echo $row['username'];?></td>
																					<td><?php echo $row['role'];?></td>
																					<td><?php echo $row['email'];?></td>

																					<td><?php echo $row['regDate'];?></td>

																					<td>
																						<!-- <a href="edit-patient.php?editid=<?php echo $row['ID'];?>" class="btn btn-info btn-xs">Edit</a> -->
																						<a href="manage-users.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-danger btn-xs">Delete</a>
	                                        </td>
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
