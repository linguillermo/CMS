<?php
session_start();
error_reporting(0);
require "include/aes256.php";
include('include/config.php');
include('include/checklogin.php');
check_login();
// if(isset($_POST['submit']))
//   {
//
//     $vid=$_GET['viewid'];
//     $bp=$_POST['bp'];
//     $labs=$_POST['labs'];
//     $weight=$_POST['weight'];
//     $temp=$_POST['temp'];
//    $pres=$_POST['pres'];
//
//
//       $query.=mysqli_query($con, "insert   tblmedicalhistory(PatientID,BloodPressure,Laboratories,Weight,Temperature,MedicalPres)value('$vid','$bp','$labs','$weight','$temp','$pres')");
//     if ($query) {
//     echo '<script>alert("Medicle history has been added.")</script>';
//     echo "<script>window.location.href ='view-patient.php?viewid=$vid'</script>";
//   }
//   else
//     {
//       echo '<script>alert("Something Went Wrong. Please try again")</script>';
//     }
//
//
// }
//
// ?>


<?php
if(isset($_POST['save']))
{
	$eid=$_GET['editid'];
  $vid=$_GET['viewid'];
  $labs=encryptthis($_POST['labs'], key);
  $weight=encryptthis($_POST['weight'], key);

  $pres=encryptthis($_POST['pres'], key);

$sql=mysqli_query($con,"UPDATE tblmedicalhistory SET Laboratories='$labs',Weight='$weight',MedicalPres='$pres' WHERE ID='$eid'");
if($sql)
{
 echo "<script>alert('Patient info updated Successfully');</script>";
 echo "<script>window.location.href ='view-patient.php?viewid=$vid'</script>";

}
else {
 echo "<script>alert('Error editing profile!');</script>";
}




// $id=$_POST['id'];
//   $quant=$_POST['quantity'];


  for ($a = 0; $a < count($_POST["id"]); $a++)
  {
    $query = mysqli_query($con,"update medicines set quantity=quantity - '" . $_POST["quantity"][$a] . "' where ID='" . $_POST["id"][$a] . "'");
    mysqli_query($con, $query);
  }

  for ($a = 0; $a < count($_POST["id"]); $a++)
  {
    $sql = "INSERT INTO tblmedicineused (patientID, medicineusedID, medicineID, medicineinfo, quantity) VALUES ('$patientID', '$eid', '" . $_POST["id"][$a] . "', '" . $_POST["medicineinfo"][$a] . "', '" . $_POST["quantity"][$a] . "')";
    mysqli_query($con, $sql);
  }


  // $query = mysqli_query($con,"update medicines set quantity=quantity - '" . $_POST["quantity"][$a] . "' where ID='" . $_POST["id"][$a] . "'");
  //
  //     if($query)
  //     {
  //     echo "<script>alert('Successfully stored');</script>";
  //   }
  //   else{
  //       echo"<script>alert('Somthing wrong!!!');</script>";
  //   }

  // Handle delete
  if (isset($_POST['delete_id'])) {
      // get value of id that sent from address bar
      $delete_id = $_POST['delete_id'];

      // Delete data in mysql from row that has this id
      $sql="DELETE FROM tblmedicineused WHERE id='$delete_id'";

      mysqli_query($con, $sql);
      // if successfully deleted

  }



}
?>




<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Clinica Abeleda | Patient Records</title>

    <link href="insp/css/bootstrap.min.css" rel="stylesheet">
    <link href="insp/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css">

    <link href="insp/css/plugins/summernote/summernote-bs4.css" rel="stylesheet">
		<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>


    <link href="insp/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="insp/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="insp/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
    <link href="insp/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <link href="insp/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">


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
                <!-- <li class="active">
                    <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Patients</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="active"><a href="manage-patient.php">Patient Records</a></li>
                        <li><a href="doctor-treatment-records.html">Treatment Records</a></li>
                        <li><a href="doctor-prescription-records.html">Prescription Records</a></li>

                    </ul>
                </li> -->

                <li class="active">
  									<a href="manage-patient.php"><i class="fa fa-table"></i> <span class="nav-label">Patient Records</span></a>

  							</li>
                <li>
                    <a href="doctor-approved-appointments.html"><i class="fa fa-calendar"></i> <span class="nav-label">Appointments</span>  </a>
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

        <div class="wrapper wrapper-content animated fadeInRight ecommerce">


					<?php
	                             $vid=$_GET['viewid'];
	                             $ret=mysqli_query($con,"select * from tblpatient where ID='$vid'");
                               $cnt=1;
                              	while ($row=mysqli_fetch_array($ret)) {
                                 $gender = decryptthis($row['PatientGender'], key);
                                 $patientContact=decryptthis($row['PatientContno'], key);
                                 $patadd=decryptthis($row['PatientAdd'], key);
                                 $patoccupt=decryptthis($row['PatientOccupation'], key);
																 $patage=decryptthis($row['PatientAge'], key);
																 $patbday=decryptthis($row['PatientBday'], key);
	                             ?>

            <div class="ibox">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="m-b-md">

                                <h2><?php  echo decryptthis($row['PatientName'], key);?></h2>
                            </div>

                        </div>
                    </div>
										<div class="row">
	                      <div class="col-lg-6">
	                          <dl class="row mb-0">
	                              <div class="col-sm-4 text-sm-right"><dt>Gender:</dt> </div>
	                              <div class="col-sm-8 text-sm-left"><dd class="mb-1"><?php  echo $gender;?></dd></div>
	                          </dl>
	                          <dl class="row mb-0">
	                              <div class="col-sm-4 text-sm-right"><dt>Address:</dt> </div>
	                              <div class="col-sm-8 text-sm-left"><dd class="mb-1"><?php  echo $patadd;?></dd> </div>
	                          </dl>
	                          <dl class="row mb-0">
	                              <div class="col-sm-4 text-sm-right"><dt>Phone No:</dt> </div>
	                              <div class="col-sm-8 text-sm-left"> <dd class="mb-1"><?php  echo $patientContact;?></dd></div>
	                          </dl>
	                          <dl class="row mb-0">
	                              <div class="col-sm-4 text-sm-right"><dt>Occupation:</dt> </div>
	                              <div class="col-sm-8 text-sm-left"> <dd class="mb-1"><?php  echo $patoccupt;?></dd></div>
	                          </dl>
	                          <dl class="row mb-0">
	                              <div class="col-sm-4 text-sm-right"><dt>Date of Birth:</dt> </div>
	                              <div class="col-sm-8 text-sm-left"> <dd class="mb-1"><?php echo date('F j, Y', strtotime($patbday));?></dd></div>
	                          </dl>
	                          <dl class="row mb-0">
	                              <div class="col-sm-4 text-sm-right"> <dt>Age:</dt></div>
	                              <div class="col-sm-8 text-sm-left"> <dd class="mb-1"> 	<?php  echo $patage;?> y/o </dd></div>
	                          </dl>



	                      </div>
	                      <div class="col-lg-6" id="cluster_info">

	                          <dl class="row mb-0">
	                              <div class="col-sm-4 text-sm-right">
	                                  <dt>Last Appointment:</dt>
	                              </div>
	                              <div class="col-sm-8 text-sm-left">
	                                  <dd class="mb-1"><?php  echo date('F j, Y g:i A', strtotime($row['UpdationDate']));?></dd>
	                              </div>
	                          </dl>
	                          <dl class="row mb-0">
	                              <div class="col-sm-4 text-sm-right">
	                                  <dt>Created:</dt>
	                              </div>
	                              <div class="col-sm-8 text-sm-left">
	                                  <dd class="mb-1"> <?php  echo date('F j, Y g:i A', strtotime($row['CreationDate']));?></dd>
	                              </div>
	                          </dl>

	                      </div>
	                  </div>


	              </div>

								<?php }?>
            </div>


						<?php
				                                           $eid=$_GET['editid'];
				                                          $ret=mysqli_query($con,"select * from tblmedicalhistory where ID='$eid'");
				                                          $cnt=1;
				                                          while ($row=mysqli_fetch_array($ret)) {

				                                          ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li><a class="nav-link active" data-toggle="tab" href="#tab-1"> Info</a></li>



                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">
																				<form method="POST" name="submit">
                                        <fieldset>

																						<div class="form-group row"><label class="col-sm-2 col-form-label">Weight:</label>
                                                <div class="col-md-4"><input name="weight" value="<?php  echo decryptthis($row['Weight'], key);?>" class="form-control wd-450"></div>
                                            </div>

																						<div class="form-group row"><label class="col-sm-2 col-form-label">Laboratories:</label>
                                                <div class="col-md-4"><input name="labs" value="<?php  echo decryptthis($row['Laboratories'], key);?>" class="form-control wd-450"></div>
                                            </div>


                                            <div class="form-group row"><label class="col-sm-2 col-form-label">Description:</label>
                                                <div class="col-sm-10">
                                                    <textarea class="summernote" name="pres">
                                                        <?php  echo decryptthis($row['MedicalPres'], key);?>

                                                    </textarea>
                                                </div>
                                            </div>


																						<?php } ?>




                                            <div class="form-group row"><label class="col-sm-2 col-form-label">Medication Used</label>
                                                <div class="col-sm-10">
                                                    <div class="row">
                                                        <div class="col-md-3">

                                                            <div class="form-group">

                                                                <div>
                                                                    <select data-placeholder="Choose a Country..." class="chosen-select"  tabindex="2">

                                                                      <?php

                                                            	                             $ret=mysqli_query($con,"select * from medicines");

                                                            	while ($row=mysqli_fetch_array($ret)) {
                                                            	                             ?>

                                                                    <option value="<?php  echo $row['id'];?>"><?php  echo $row['medicine_name'];?> <?php  echo $row['dosage'];?> (<?php  echo $row['formulation'];?>)</option>

                                                                    <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-2">
                                                            <div><input name="qty" placeholder="Qty" class="form-control wd-450" id="qty"></div>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <button class="btn btn-primary" type="button" id="submit1">Add Medicine</button>
                                                        </div>
                                                    </div>

                                                    <?php
                                                    $medicineusedID=$_GET['editid'];
                                                    $ret=mysqli_query($con,"select * from tblmedicineused where medicineusedID='$medicineusedID'");



                                                    ?>



                                                    <div class="table-responsive">
                                                        <table class="table table-stripped table-bordered" id="table1">

                                                            <thead>
                                                              <tr>
                                                                <th style="width:5%">
                                                                    Quantity
                                                                </th>

                                                                  <th style="width: 90%">
                                                                      Medicine
                                                                  </th>



                                                                  <th style="width:5%">
                                                                      Actions
                                                                  </th>
                                                              </tr>
                                                            </thead>

                                                            <tbody>
                                                              <?php
                                                                while ($row=mysqli_fetch_array($ret)) {
                                                                ?>
                                                              <tr>

                                                                  <td><?php  echo $row['quantity'];?></td>
                                                                  <td><?php  echo $row['medicineinfo'];?></td>
                                                                  <td><button class="btn btn-white btn-sm" type="submit" name="delete_id"><i class="fa fa-trash"></i></button></td>

                                                              </tr>
<?php } ?>

                                                            </tbody>

                                                        </table>
                                                    </div>


                                                </div>
                                            </div>

                                        </fieldset>



                                    </div>



                                </div>





                            </div>
                    </div>
                </div>
            </div>
            <div style="text-align: center; padding: 10px;">
                <a type="button" class="btn btn-danger" href="view-patient.php?viewid=<?php echo $vid;?>" data-dismiss="modal">Cancel</a>
                <button type="submit" class="btn btn-primary demo2" name="save" id="save">Save</button>
            </div>
            </form>
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

<!-- Custom and plugin javascript -->
<script src="insp/js/inspinia.js"></script>
<script src="insp/js/plugins/pace/pace.min.js"></script>

<!-- SUMMERNOTE -->
<script src="insp/js/plugins/summernote/summernote-bs4.js"></script>

<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

<script src="insp/js/plugins/ckeditor/ckeditor.js"></script>

<!-- Data picker -->
<script src="insp/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Clock picker -->
<script src="insp/js/plugins/clockpicker/clockpicker.js"></script>

<!-- Chosen -->
<script src="insp/js/plugins/chosen/chosen.jquery.js"></script>

<!-- TouchSpin -->
<script src="insp/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

<script>
    $(document).ready(function(){



        $('.summernote').summernote({
					height: 300
				});

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
    $(document).ready(function(){

        $('.chosen-select').chosen({width: "100%"});

        $('.clockpicker').clockpicker();

        $(".touchspin1").TouchSpin({
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

    });



    $("#submit1").click(function () {
        {
            var selected = $('.chosen-select :selected');
            var qty = document.getElementById("qty").value;

                 $('#table1').append('<tr><td style="width:5%">'+qty+'</td><td style="width:90%">'+selected.text()+'<input type="text"  name="medicineinfo[]" value="'+selected.text()+'" hidden><input type="text"  name="id[]" value="'+selected.val()+'" hidden><input type="text"  name="quantity[]" value="'+qty+'" hidden></td><td style="width:5%"><button class="btn btn-white btn-sm" class="button" onclick="deleteRow(this)"><i class="fa fa-trash"></i></button></td></tr>');
            // $('#table1').append('<tr><td>'+$(this).text()+'</td></tr>');
            //if you need ah text like days do with that

        }
    });


    function deleteRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("table1").deleteRow(i);
  }
</script>

<script>
											 CKEDITOR.replace( 'editor1' );
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
