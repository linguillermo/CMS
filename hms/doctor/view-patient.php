<?php
session_start();
error_reporting(0);
require "include/aes256.php";
include('include/config.php');
include('include/checklogin.php');
check_login();
if(isset($_POST['submit']))
  {

    $vid=$_GET['viewid'];
    $bp=$_POST['bp'];
    $labs=$_POST['labs'];
    $weight=$_POST['weight'];
    $temp=$_POST['temp'];
    $pres=$_POST['pres'];


   $query.=mysqli_query($con, "insert   tblmedicalhistory(PatientID,BloodPressure,Laboratories,Weight,Temperature,MedicalPres)value('$vid','$bp','$labs','$weight','$temp','$pres')");
    if ($query) {
    echo '<script>alert("Patient Information has been added.")</script>';
    echo "<script>window.location.href ='manage-patient.php'</script>";
  }
  else
    {
      echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }


}

?>


<?php
if(isset($_POST['save']))
{
  //for logs
  $username = $_SESSION['dlogin'];
  $id = $_SESSION['id'];
  $userip = "Edited Patient";
  $status = "1";

	$eid=$_GET['viewid'];
	$patname=encryptthis($_POST['patname'], key);
  $patcontact=encryptthis($_POST['patcontact'], key);
  $pataddress=encryptthis($_POST['pataddress'], key);
  $patbday=encryptthis($_POST['patbday'], key);

  $patbday2=$_POST['patbday'];
  $patbday1 = explode("/", $patbday2);


  $patage1 = (date("md", date("U", mktime(0, 0, 0, $patbday1[0], $patbday1[1], $patbday1[2]))) > date("md")
      ? ((date("Y") - $patbday1[2]) - 1)
      : (date("Y") - $patbday1[2]));
  $patage = encryptthis($patage1, key);
  $gender=encryptthis($_POST['gender'], key);
  $patoccupation=encryptthis($_POST['patoccupation'], key);

  $log = "INSERT INTO userlog (uid,username,userip,status)
            VALUES ('$uId','$username','$userip','$status')";

  $sql=mysqli_query($con,"update tblpatient set PatientName='$patname',PatientContno='$patcontact',PatientAdd='$pataddress',PatientBday='$patbday',PatientAge='$patage',PatientGender='$gender',PatientOccupation='$patoccupation' where ID='$eid'");
  if($sql)
  {
  /* echo "<script>alert('Patient info updated Successfully');</script>"; */
  mysqli_query ($con, $log);

  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Clinica Abeleda | Patient Records</title>

  <link href="insp/css/bootstrap.min.css" rel="stylesheet">
  <link href="insp/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css">

  <!-- FooTable -->
  <link href="insp/css/plugins/footable/footable.core.css" rel="stylesheet">

  <!-- Sweet Alert -->
    <link href="insp/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

  <link href="insp/css/animate.css" rel="stylesheet">
  <link href="insp/css/style.css" rel="stylesheet">
  <link href="insp/css/plugins/datapicker/datepicker3.css" rel="stylesheet">



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

        <?php
                             $vid=$_GET['viewid'];
                             $ret=mysqli_query($con,"select * from tblpatient where ID='$vid'");
                              $cnt=1;
                              while ($row=mysqli_fetch_array($ret))
                              {
                                  $gender = decryptthis($row['PatientGender'], key);
                                  $patientContact=decryptthis($row['PatientContno'], key);
                                  $patadd=decryptthis($row['PatientAdd'], key);
                                  $patoccupt=decryptthis($row['PatientOccupation'], key);
                                  $patbday=decryptthis($row['PatientBday'], key);
                                  $patage=decryptthis($row['PatientAge'], key);
                             ?>

          <div class="ibox">
              <div class="ibox-content">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="m-b-md">
                              <a href="#" class="btn btn-white btn-xs float-right" data-toggle="modal" data-target="#myModal5">Edit Patient Profile</a>
                              <h2><?php echo decryptthis( $row['PatientName'],key);?></h2>
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
                                  <dt>Last Updated:</dt>
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
                                  <dd class="mb-1"><?php  echo date('F j, Y g:i A', strtotime($row['CreationDate']));?></dd>
                              </div>
                          </dl>

                      </div>
                  </div>


              </div>

              <?php }?>
          </div>





          <div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Edit Patient Profile</h4>

                                </div>
                                <div class="modal-body">

                                        <form method="post" role="form" name="">
                                          <?php
                                           $eid=$_GET['viewid'];
                                          $ret=mysqli_query($con,"select * from tblpatient where ID='$eid'");
                                          $cnt=1;
                                          while ($row=mysqli_fetch_array($ret)) {
                                            $patname = decryptthis ($row['PatientName'], key);
                                            $patgender = decryptthis($row['PatientGender'], key);
                                            $patientContact=decryptthis($row['PatientContno'], key);
                                            $patadd=decryptthis($row['PatientAdd'], key);
                                            $patoccupt=decryptthis($row['PatientOccupation'], key);
                                            $patbday=decryptthis($row['PatientBday'], key);

                                          ?>
                                            <div class="form-group row"><label class="col-sm-2 col-form-label">Patient Name</label>

                                              <div class="col-sm-10"><input type="text" name="patname" value="<?php  echo $patname;?>" class="form-control"></div>


                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group row"><label class="col-sm-2 col-form-label">Address</label>
                                                <div class="col-sm-10"><input type="text" name="pataddress" class="form-control" value="<?php  echo $patadd;?>">
                                                </div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group row"><label class="col-sm-2 col-form-label">Phone No.</label>

                                                <div class="col-sm-10">
                                                    <div class="input-group m-b">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-addon">+63</span>
                                                        </div>
                                                        <input type="text" name="patcontact" class="form-control"  value="<?php  echo $patientContact;?>">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group row" id="data_1"><label class="col-sm-2 col-form-label">Date of Birth</label>

                                                <div class="col-sm-5"><div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="patbday" class="form-control" value="<?php  echo $patbday;?>">
                                                </div></div>

                                                <label class="col-sm-1 col-form-label">Gender</label>
                                                <div class="col-sm-4"><input type="text" name="gender" value="<?php  echo $patgender;?>" class="form-control">
                                                </div>





                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group row"><label class="col-sm-2 col-form-label">Occupation</label>
                                                <div class="col-sm-10"><input type="text" name="patoccupation" value="<?php  echo $patoccupt;?>" value class="form-control">
                                                </div>
                                            </div>
<?php } ?>


                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary demo2" name="save" id="save">Save</button>
                                </div>

                                </form>
                            </div>
                        </div>
                    </div>


          <div class="row">
              <div class="col-lg-12">
                  <div class="ibox ">
                      <div class="ibox-title">
                          <h5>Treatment Records</h5>
                          <div class="ibox-tools">
                              <a href="add-treatment.php?viewid=<?php echo $vid;?>" class="btn btn-primary btn-xs">
                                  Add New Record
                              </a>

                              <a class="collapse-link">
                                  <i class="fa fa-chevron-up"></i>
                              </a>

                          </div>

                      </div>
                      <div class="ibox-content">

                        <?php

$ret=mysqli_query($con,"select * from tblmedicalhistory  where PatientID='$vid'");



 ?>
                          <input type="text" class="form-control form-control-sm m-b-xs" id="filter"
                                 placeholder="Search...">

                          <table class="footable table table-stripped" data-page-size="14" data-filter=#filter>
                              <thead>
                                  <tr>
                                    <th width="20%">Treatment Date</th>
                                    <th width="20%">Weight</th>
                                    <th>Laboratories</th>

                                    <th width="10%">Action</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    while ($row=mysqli_fetch_array($ret))
                                    {
                                      $weightTreat= decryptthis($row['Weight'], key);
                                      $labTreat= decryptthis($row['Laboratories'], key);
  ?>
                                      <tr>
                                        <td><?php  echo date('F j, Y g:i A', strtotime($row['CreationDate']));?></td>

                                        <td><?php  echo $weightTreat;?> kgs</td>
                                        <td><?php  echo $labTreat;?></td>

                                          <td><a href="edit-treatment.php?viewid=<?php echo $vid;?>&editid=<?php echo $row['ID'];?>" class="btn btn-primary btn-xs">View</a></td>
                                      </tr>
                                      <?php $cnt=$cnt+1;} ?>



                              </tbody>
                              <tfoot>
                              <tr>
                                  <td colspan="9">
                                      <ul class="pagination float-right"></ul>
                                  </td>
                              </tr>
                              </tfoot>
                          </table>
                      </div>
                  </div>
              </div>
          </div>


          <div class="row">
              <div class="col-lg-12">
                  <div class="ibox ">
                      <div class="ibox-title">
                          <h5>Prescription Records</h5>
                          <div class="ibox-tools">
                              <a href="add-prescription.php?viewid=<?php echo $vid;?>" class="btn btn-primary btn-xs">
                                  Add New Record
                              </a>
                              <a class="collapse-link">
                                  <i class="fa fa-chevron-up"></i>
                              </a>

                          </div>

                      </div>
                      <div class="ibox-content">

                        <?php

$ret=mysqli_query($con,"select * from prescriptions where PatientID='$vid'");



 ?>
                          <input type="text" class="form-control form-control-sm m-b-xs" id="filter"
                                 placeholder="Search...">

                          <table class="footable table table-stripped" data-page-size="14" data-filter=#filter>
                              <thead>
                                  <tr>

                                      <th width="90%">Prescription Date</th>
                                      <th width="10%">Action</th>
                                  </tr>
                                  </thead>
                                  <tbody>

                                    <?php
while ($row=mysqli_fetch_array($ret)) {
  ?>
                                      <tr>

                                          <td><?php  echo date('F j, Y g:i A', strtotime($row['CreationDate']));?></td>
                                          <td><a href="view-prescription.php?viewid=<?php echo $vid;?>&prescid=<?php echo $row['ID'];?>" class="btn btn-primary btn-xs">View</a></td>
                                      </tr>
                                      <?php } ?>


                              </tbody>
                              <tfoot>
                              <tr>
                                  <td colspan="9">
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

      <script src="insp/js/plugins/datapicker/bootstrap-datepicker.js"></script>

  <!-- Mainly scripts -->
  <script src="insp/js/jquery-3.1.1.min.js"></script>
  <script src="insp/js/popper.min.js"></script>
  <script src="insp/js/bootstrap.js"></script>
  <script src="insp/js/plugins/metisMenu/jquery.metisMenu.js"></script>
  <script src="insp/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

  <!-- FooTable -->
  <script src="insp/js/plugins/footable/footable.all.min.js"></script>

  <!-- Sweet alert -->
    <script src="insp/js/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Data picker -->
<script src="insp/js/plugins/datapicker/bootstrap-datepicker.js"></script>

  <!-- Custom and plugin javascript -->
  <script src="insp/js/inspinia.js"></script>
  <script src="insp/js/plugins/pace/pace.min.js"></script>
  <script src="insp/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

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
