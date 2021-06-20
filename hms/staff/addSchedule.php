<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
include_once 'dbconnect.php';
check_login();
// include_once 'connection/server.php';

// $res=mysqli_query($con,"SELECT * FROM doctor");
// $userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
// insert


if (isset($_POST['submit'])) {

$username=$_SESSION['login'];
$userid = $_GET['userid'];
$userip = "Added Appointment Schedule";
$status = "1";


$date = mysqli_real_escape_string($con,$_POST['date']);
$scheduleday  = mysqli_real_escape_string($con,$_POST['scheduleday']);
$starttime     = mysqli_real_escape_string($con,$_POST['starttime']);
$endtime     = mysqli_real_escape_string($con,$_POST['endtime']);
$bookavail         = mysqli_real_escape_string($con,$_POST['bookavail']);


$log = "INSERT INTO userlog (uid,username,userip,status)
         VALUES ('$uId','$username','$userip','$status')";
//INSERT
$query = " INSERT INTO doctorschedule (  scheduleDate, scheduleDay, startTime, endTime,  bookAvail)
VALUES ( '$date', '$scheduleday', '$starttime', '$endtime', '$bookavail' ) ";

$result = mysqli_query($con, $query);
// echo $result;
if( $result )
{
?>
<script type="text/javascript">
alert('Schedule added successfully.');
</script>
<?php mysqli_query($con,$log); ?>
<?php
}
else
{
?>
<script type="text/javascript">
alert('Added fail. Please try again.');
</script>
<?php
}

}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Staff | Appointment</title>

    <link href="insp/css/bootstrap.min.css" rel="stylesheet">
    <link href="insp/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css">

    <!-- FooTable -->
    <link href="insp/css/plugins/footable/footable.core.css" rel="stylesheet">

    <link href="insp/css/animate.css" rel="stylesheet">
    <link href="insp/css/style.css" rel="stylesheet">
    <link href="insp/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="../script.js"></script>
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

    								<li class="active">
    									<a href="#"> <i class="fa fa-calendar"></i> <span class="nav-label">Appointments</span><span class="fa arrow"></span></a>
    									<ul class="nav nav-second-level collapse">
    											<li><a href="appointmentStaff.php">Appointment List</a></li>
    											<li class= "active"><a href="addSchedule.php">Manage Schedule</a></li>
    									</ul>
    								</li>

                    <li>
    									<a href="#"><i class="fa fa-calendar"></i> <span class="nav-label">Manage Medicines</span><span class="fa arrow"></span></a>
    									<ul class="nav nav-second-level collapse">
    											<li><a href="manage-medicines.php">Medicines</a></li>
    											<li><a href="manage-stocks.php">Stocks</a></li>
    									</ul>
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

        <div id="page-wrapper" >
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">

                        </h2>

                    </div>
                </div>
                <!-- Page Heading end-->

                <!-- panel start -->
                <div class="panel panel-primary">

                    <!-- panel heading starat -->
                    <div class="panel-heading">
                        <h3 class="panel-title">Add Schedule</h3>
                    </div>
                    <!-- panel heading end -->

                    <div class="panel-body">
                    <!-- panel content start -->
                        <div class="bootstrap-iso">
                         <div class="container-fluid">
                          <div class="row">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                            <form class="form-horizontal" method="post">
                             <div class="form-group form-group-lg">
                              <label class="control-label col-sm-2 requiredField" for="date">
                               Date
                               <span class="asteriskField">
                                *
                               </span>
                              </label>
                              <div class="col-sm-10">
                               <div class="input-group">
                                <div class="input-group-addon">
                                 <i class="fa fa-calendar">
                                 </i>
                                </div>
                                <input class="form-control" id="date" name="date" type="text" required/>
                               </div>
                              </div>
                             </div>
                             <!-- <div class="form-group form-group-lg">
                              <label class="control-label col-sm-2 requiredField" for="scheduleday">
                               Day
                               <span class="asteriskField">
                                *
                               </span>
                              </label>
                              <div class="col-sm-10">
                               <select class="select form-control" id="scheduleday" name="scheduleday" required>
                                <option value="Monday">
                                 Monday
                                </option>
                                <option value="Tuesday">
                                 Tuesday
                                </option>
                                <option value="Wednesday">
                                 Wednesday
                                </option>
                                <option value="Thursday">
                                 Thursday
                                </option>
                                <option value="Friday">
                                 Friday
                                </option>
                                <option value="Saturday">
                                 Saturday
                                </option>
                                <option value="Sunday">
                                 Sunday
                                </option>
                               </select>
                              </div>
                             </div> -->
                             <div class="form-group form-group-lg">
                              <label class="control-label col-sm-2 requiredField" for="starttime">
                               Start Time
                               <span class="asteriskField">
                                *
                               </span>
                              </label>

                              <div class="col-sm-10">
                               <div class="input-group clockpicker"  data-align="top" data-autoclose="true">
                                <div class="input-group-addon">
                                 <i class="fa fa-clock-o">
                                 </i>
                                </div>
                                <input class="form-control" id="starttime" name="starttime" type="text" required/>
                               </div>
                              </div>
                             </div>
                             <div class="form-group form-group-lg">
                              <label class="control-label col-sm-2 requiredField" for="endtime">
                               End Time
                               <span class="asteriskField">
                                *
                               </span>
                              </label>
                              <div class="col-sm-10">
                               <div class="input-group clockpicker"  data-align="top" data-autoclose="true">
                                <div class="input-group-addon">
                                 <i class="fa fa-clock-o">
                                 </i>
                                </div>
                                <input class="form-control" id="endtime" name="endtime" type="text" required/>
                               </div>
                              </div>
                             </div>
                             <div class="form-group form-group-lg">
                              <label class="control-label col-sm-2 requiredField" for="bookavail">
                               Availabilty
                               <span class="asteriskField">
                                *
                               </span>
                              </label>
                              <div class="col-sm-10">
                               <select class="select form-control" id="bookavail" name="bookavail" required>
                                <option value="available">
                                 available
                                </option>
                                <option value="notavail">
                                 notavail
                                </option>
                               </select>
                              </div>
                             </div>
                             <div class="form-group">
                              <div class="col-sm-10 col-sm-offset-2">
                               <button class="btn btn-primary " name="submit" type="submit">
                                Submit
                               </button>
                              </div>
                             </div>
                            </form>
                           </div>
                          </div>
                         </div>
                        </div>
                    <!-- panel content end -->
                    <!-- panel end -->
                    </div>
                </div>
                <!-- panel start -->

                 <!-- panel start -->
                <div class="panel panel-primary filterable">

                    <!-- panel heading starat -->
                    <div class="panel-heading">
                        <h3 class="panel-title">Schedule List</h3>
                        <div class="pull-right">
                        <br> <button class="btn btn-outline-success btn-filter"><span class="fa fa-filter"></span> Filter</button>
                    </div>
                    </div>
                    <!-- panel heading end -->
                    <br><br><br>
                    <div class="panel-body" style="height: 700px; overflow: auto;">
                    <!-- panel content start -->
                       <!-- Table -->
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr class="filters">
                                <th><input type="text" class="form-control" placeholder="scheduleId" disabled></th>
                                <th><input type="text" class="form-control" placeholder="scheduleDate" disabled></th>
                                <!-- <th><input type="text" class="form-control" placeholder="scheduleDay" disabled></th> -->
                                <th><input type="text" class="form-control" placeholder="startTime." disabled></th>
                                <th><input type="text" class="form-control" placeholder="endTime" disabled></th>
                                <th><input type="text" class="form-control" placeholder="bookAvail" disabled></th>
                            </tr>
                        </thead>

                        <?php
                        $result=mysqli_query($con,"SELECT * FROM doctorschedule ORDER BY scheduleId desc");



                        while ($doctorschedule=mysqli_fetch_array($result)) {


                            echo "<tbody>";
                            echo "<tr>";
                                echo "<td>" . $doctorschedule['scheduleId'] . "</td>";
                                echo "<td>" . $doctorschedule['scheduleDate'] . "</td>";
                                // echo "<td>" . $doctorschedule['scheduleDay'] . "</td>";
                                echo "<td>" . $doctorschedule['startTime'] . "</td>";
                                echo "<td>" . $doctorschedule['endTime'] . "</td>";
                                echo "<td>" . $doctorschedule['bookAvail'] . "</td>";
                                echo "<form method='POST'>";
                                echo "<td class='text-center'><a href='#' id='".$doctorschedule['scheduleId']."' class='delete'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                        </td>";

                        }
                            echo "</tr>";
                       echo "</tbody>";
                   echo "</table>";
                   echo "<div class='panel panel-default'>";
                   echo "<div class='col-md-offset-3 pull-right'>";
                   // echo "<button class='btn btn-primary' type='submit' value='Submit' name='submit'>Update</button>";
                    echo "</div>";
                    echo "</div>";
                    ?>
                    <!-- panel content end -->
                    <!-- panel end -->
                    </div>
                </div>
                <!-- panel start -->
            </div>
        </div>
    <!-- /#wrapper -->
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


    <!-- jQuery -->
    <script src="../patient/assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../patient/assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-clockpicker.js"></script>
    <!-- Latest compiled and minified JavaScript -->
     <!-- script for jquery datatable start-->
    <!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
$(document).ready(function(){
    var date_input=$('input[name="date"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    date_input.datepicker({
        format: 'yyyy/mm/dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })
})
</script>
<script type="text/javascript">
$('.clockpicker').clockpicker();
</script>
<script type="text/javascript">
$(function() {
$(".delete").click(function(){
var element = $(this);
var id = element.attr("id");
var info = 'id=' + id;
if(confirm("Are you sure you want to delete this?"))
{
$.ajax({
type: "POST",
url: "deleteDocSchedule.php",
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
