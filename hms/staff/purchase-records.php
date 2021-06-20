<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();


if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from medicines where id = '".$_GET['id']."'");
                  $_SESSION['msg']="data deleted !!";
		  }


			if(isset($_POST['purchase']))
			{





			$sql=mysqli_query($con,"update medicines set quantity=quantity + '" . $_POST["quantity"] . "' where ID='" . $_POST["medicine_id"] . "'");
			if($sql)
			{
			echo "<script>alert('Added stocks successfully');</script>";
			header('location:manage-medicines.php');

			}
			}




			if(isset($_POST['submit_medicine']))
			{

				$medicine_name=$_POST['medicine_name'];
			$dosage=$_POST['dosage'];
			$formulation=$_POST['formulation'];
			$quantity=$_POST['quantity'];



			$sql=mysqli_query($con,"insert into medicines(medicine_name,dosage,formulation,quantity) values('$medicine_name','$dosage','$formulation','$quantity')");
			if($sql)
			{
			echo "<script>alert('Medicine added Successfully');</script>";
			header('location:manage-medicines.php');

			}
			}



if(isset($_POST['edit_medicine']))
			{
				 $id=$_POST['id'];
				$medicine_name=$_POST['medicine_name'];
			$dosage=$_POST['dosage'];
			$formulation=$_POST['formulation'];
			$quantity=$_POST['quantity'];
			$sql=mysqli_query($con,"update medicines set medicine_name='$medicine_name',dosage='$dosage',formulation='$formulation',quantity='$quantity' where id='$id'");
			if($sql)
			{
			 // echo "<script>alert('Patient info updated Successfully');</script>";


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
	<link href="insp/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">

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
                    <a href="manage-medicines.php"><i class="fa fa-medkit"></i> <span class="nav-label">Medicine Stocks</span></a>

                </li>

								<li class="active">
                    <a href="purchase-records.php"><i class="fa fa-medkit"></i> <span class="nav-label">Purchase Records</span></a>

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
                            <h5>Purchase Records</h5>

                            <div class="ibox-tools">
                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal6">
                                    New Purchase
                                </button>



                            </div>

														<div class="modal inmodal fade" id="myModal6" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Add Medicine Stocks</h4>

                                        </div>
                                        <div class="modal-body">

                                                <form role="form" name="" method="post">

																									<div class="form-group row"><label class="col-sm-2 col-form-label">Patient</label>


																															<div class="col-sm-10">

																																<select data-placeholder="Choose a Country..." class="chosen-select"  name="patient_id" tabindex="2">

																																	<?php

																																											 $ret=mysqli_query($con,"select * from tblpatient");

																													while ($row=mysqli_fetch_array($ret)) {
																																											 ?>

																																<option value="<?php  echo $row['id'];?>"><?php  echo $row['PatientName'];?></option>

																																<?php } ?>
																																</select>

																															</div>


																									</div>
																										<div class="hr-line-dashed"></div>
                                                    <div class="form-group row"><label class="col-sm-2 col-form-label">Medicine</label>


                                                                <div class="col-sm-10">

																																	<select data-placeholder="Choose a Country..." class="chosen-select"  name="medicine_id" tabindex="2">

																																		<?php

																																												 $ret=mysqli_query($con,"select * from medicines");

																														while ($row=mysqli_fetch_array($ret)) {
																																												 ?>

																																	<option value="<?php  echo $row['id'];?>"><?php  echo $row['medicine_name'];?> <?php  echo $row['dosage'];?> (<?php  echo $row['formulation'];?>)</option>

																																	<?php } ?>
																																	</select>

																																</div>


                                                    </div>



																										<div class="hr-line-dashed"></div>
                                                    <div class="form-group row"><label class="col-sm-2 col-form-label">Quantity</label>
                                                        <div class="col-sm-10"><input type="text" name="quantity" class="form-control">
                                                        </div>
                                                    </div>







                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
																						<button type="submit" name="purchase" id="purchase" class="btn btn-o btn-primary">
																						Add Stocks
																						</button>
                                        </div>
																				</form>
                                    </div>
                                </div>
                            </div>








                        </div>
                        <div class="ibox-content">
                            <input type="text" class="form-control form-control-sm m-b-xs" id="filter"
                                   placeholder="Search for Medicines">

                            <table class="footable table table-stripped" data-page-size="14" data-filter=#filter>
                                <thead>
                                    <tr>
																			<!-- <th class="center">#</th> -->
																			<th>Medicine Info</th>
																			<th>Quantity</th>
																			<th>Purchased By</th>
																			<th>Logged By</th>


																			<th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>

																			<?php
$sql=mysqli_query($con,"select * from medicines");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


																				<tr>
																					<!-- <td class="center"><?php echo $cnt;?>.</td> -->
																					<td class="hidden-xs"><?php echo $row['medicine_name'];?></td>
																					<td><?php echo $row['dosage'];?></td>
																					<td><?php echo $row['formulation'];?></td>
																					<td><?php echo $row['quantity'];?></td>



																					<td>
																						<!-- <a href="edit-patient.php?editid=<?php echo $row['ID'];?>" class="btn btn-info btn-xs">Edit</a> -->
																						<a href="#editmed<?php echo $row['id']?>" data-toggle="modal" class="btn btn-success btn-xs">Edit</a>
																						<a href="manage-medicines.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-danger btn-xs">Delete</a>

	                                        </td>




																					<div class="modal inmodal fade" id="editmed<?php echo $row['id']?>" tabindex="-1" role="dialog"  aria-hidden="true">
							                                <div class="modal-dialog modal-lg">
							                                    <div class="modal-content">
							                                        <div class="modal-header">
							                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							                                            <h4 class="modal-title">Edit Medicine Form</h4>

							                                        </div>
							                                        <div class="modal-body">

							                                                <form role="form" name="" method="post">
							                                                    <div class="form-group row"><label class="col-sm-2 col-form-label">Medicine Name</label>


							                                                                <div class="col-sm-10"><input type="text" name="medicine_name" value="<?php  echo $row['medicine_name'];?>" class="form-control"></div>


							                                                    </div>

																																	<div class="hr-line-dashed"></div>
							                                                    <div class="form-group row"><label class="col-sm-2 col-form-label">Dosage</label>
							                                                        <div class="col-sm-10"><input type="text" name="dosage" value="<?php  echo $row['dosage'];?>" class="form-control">
							                                                        </div>
							                                                    </div>

							                                                    <div class="hr-line-dashed"></div>
							                                                    <div class="form-group row"><label class="col-sm-2 col-form-label">Formulation</label>
							                                                        <div class="col-sm-10"><input type="text" name="formulation" value="<?php  echo $row['formulation'];?>" class="form-control">
							                                                        </div>
							                                                    </div>

																																	<div class="hr-line-dashed"></div>
							                                                    <div class="form-group row"><label class="col-sm-2 col-form-label">Quantity</label>
							                                                        <div class="col-sm-10"><input type="text" name="quantity" value="<?php  echo $row['quantity'];?>" class="form-control">
							                                                        </div>
							                                                    </div>

																																	<input type="hidden" name="id" value="<?php echo $row['id']?>" />







							                                        </div>

							                                        <div class="modal-footer">
							                                            <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
																													<button type="submit" name="edit_medicine" id="edit_medicine" class="btn btn-o btn-primary">
																													Submit
																													</button>
																													<!-- <a href="manage-medicines.php?id=<?php echo $row['id']?>&edit_medicine=edit_medicine" class="btn btn-o btn-primary">Submit</a> -->

							                                        </div>
																											</form>
							                                    </div>
							                                </div>
							                            </div>



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

	<!-- Chosen -->
	<script src="insp/js/plugins/chosen/chosen.jquery.js"></script>

	<!-- Custom and plugin javascript -->
	<script src="insp/js/inspinia.js"></script>
	<script src="insp/js/plugins/pace/pace.min.js"></script>


	<script src="insp/js/plugins/datapicker/bootstrap-datepicker.js"></script>

	<!-- Page-Level Scripts -->
	<script>
			$(document).ready(function() {

					$('.footable').footable();
					$('.footable2').footable();
					$('.chosen-select').chosen({width: "100%"});

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
