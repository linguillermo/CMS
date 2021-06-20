
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Clinica Abeleda | Stocks</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css">

    <!-- FooTable -->
    <link href="css/plugins/footable/footable.core.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="script.js"></script>




</head>

<body>

    <div id="wrapper">

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <img alt="image" class="rounded-circle" src="img/New Project.png"/>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold">Anna Santos</span>
                                <span class="text-muted text-xs block">Staff <b class="caret"></b></span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                                <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                                <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            CA
                        </div>
                    </li>
                    <li>
<<<<<<< HEAD
                        <a href="staff/dashboard.html"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
=======
                        <a href="../dashboard.php"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
>>>>>>> edd85bfc147d01d4fd0538490c8aa697f0d21b8d

                    </li>
                    <li>
                        <a href="../manage-patient.php"><i class="fa fa-id-card"></i> <span class="nav-label">Patient Records</span></a>

                    </li>

                    <li>
                      <a href="#"><i class="fa fa-calendar"></i> <span class="nav-label">Appointments</span><span class="fa arrow"></span></a>
                      <ul class="nav nav-second-level collapse">
                          <li><a href="../appointmentStaff.php">Appointment List</a></li>
                          <li><a href="../addSchedule.php">Doctor Schedule</a></li>
                      </ul>
                    </li>

                    <li class="active">
                        <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Medicine Stocks</span></a>

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
                <a href="../logout.php">
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
                            <h5>Medicine List</h5>

                            <div class="ibox-tools">
                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal5">
                                    Add Stocks
                                </button>

                                <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal6">
                                 QTY
                                </button>
									</div>

 <!---------------Modal5 - Add Stocks    -->

                            <!-- Start of modal -->
                            <div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Add Stocks</h4>

                                        </div>
                                        <div class="modal-body">

                                                <form method="POST" action="additem.php">

                                                    <div class="form-group row" ><label class="col-sm-4 col-form-label">Medicine Name</label>
                                                        <div class="col-sm-8"><input type="text" class="form-control" name="product_name" required>
                                                        </div>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                    <div class="form-group row"><label class="col-sm-4 col-form-label">Dosage</label>
                                                        <div class="col-sm-8"><input type="text" class="form-control" name="dosage" required>
                                                        </div>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                    <div class="form-group row"><label class="col-sm-4 col-form-label">Quantity</label>
                                                        <div class="col-sm-8"><input type="text" class="form-control" name="quant" id="quant" min="1" max="">
                                                        </div>
                                                    </div>

													<div class="hr-line-dashed"></div>
                                                    <div class="form-group row"><label class="col-sm-4 col-form-label">Formulation</label>
                                                        <div class="col-sm-8"><input type="text" class="form-control" name="formulation" required>

                                                        </div>
                                                    </div>


                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary" name="add">Save</button>
                                                    </div>
                                              </form>  </div>
                                        </div>
                                    </div>
                                </div>

                        <!-- End of modal -->



<!--- start of Modal 6 ------------------------------------------------------------------------------------->

			<div class="modal inmodal fade" id="myModal6" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Quantity Checker</h4>

                                        </div>
                                        <div class="modal-body">
                                                <form method="POST" action="order.php">


                                                    <div class="form-group row"><label class="col-sm-4 col-form-label">Product Name</label>
                                                        <div class="col-sm-8"><input type="text" class="form-control" name="product_name" required> </div>

														</div>
                                                    <div class="hr-line-dashed"></div>
                                                    <div class="form-group row"><label class="col-sm-4 col-form-label">Dosage</label>
                                                        <div class="col-sm-8"><input type="text" class="form-control" name="dosage">
                                                        </div>





																			<div class="col-lg-2">
																				<div class="input-group">
																					<span class="input-group-btn">
																						<button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
																						  <span class="glyphicon glyphicon-minus"></span>
																						</button>
																					</span>
				                                    					<input type="text" id="quantity" name="quantity" class="form-control input-number" value="10" min="1" max="100" required>
				                                    					<span class="input-group-btn">
				                                        					<button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
				                                            					<span class="glyphicon glyphicon-plus"></span>
				                                        					</button>



																						<button type="submit" class="btn btn-primary" name="order">Submit</button>

                                                            </div>


                                                    </div>
                                                    	</div>
                                        </div>
	                                 </div>
                                 </div>

</div>
<!---End of Modal 6	--------------------------------------------------------------------------------------->


<!--- start of Display Screen/ Refresh----------------------------------------------------------------------->
<!-- Add stockcs -->
                       <div class="ibox-content">

                               <input type="text" class="form-control form-control-sm m-b-xs" id="filter"
                                   placeholder="Search for Medicine">



                            <table class="footable table table-stripped" data-page-size="10" data-filter=#filter>
                                <thead>
                                    <tr>

                                        <th style="width:20%;"># </th>
                                        <th style="width:20%;">Medicine </th>
                                        <th style="width:20%;">Dosage </th>
                                        <th style="width:20%;">Quantity </th>
                                        <th style="width:20%;">Formulation</th>
										<th style="width:20%;">Action</th>
                                    </tr>

					<tbody>
                                    <?php
                                     $conn = new mysqli("localhost","root","","hms");
                                     $sql = "SELECT * FROM product";
                                     $result = $conn->query($sql);
                                $count=0;
                                     if ($result -> num_rows >  0) {

                                       while ($row = $result->fetch_assoc())
                               {
                                  $count=$count+1;
                                         ?>


                                         <tr>
                                          <td><?php echo $count ?></td>
                                            <td><?php echo $row["product_name"] ?></td>
                                            <td><?php echo $row["dosage"]  ?></td>
                                            <td><?php echo $row["quantity"]  ?></td>
											<td><?php echo $row["formulation"]  ?></td>
											<td>

						 </div>

<!--- End of Display Screen/ Refresh----------------------------------------------------------------------->



					  <a href="edit.php?id=<?php echo $row["product_id"] ?>" class="btn btn-info btn-xs">Edit</a>





	                <a href="delete.php?id=<?php echo $row["product_id"] ?>" class="btn btn-danger btn-xs">Delete</a>





                                  <?php

                                       }
                                     }

                                  ?>
                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="5">
                                        <ul class="pagination float-right" ></ul>
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

        <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
	<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- FooTable -->
    <script src="js/plugins/footable/footable.all.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
	<script src="js/plugins/pace/pace.min.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {

            $('.footable').footable();
            $('.footable2').footable();


            var mem = $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            var yearsAgo = new Date();
            yearsAgo.setFullYear(yearsAgo.getFullYear() - 20);

            $('#selector').datepicker('setDate', yearsAgo );

        });




    </script>

	<script>

	 $(document).ready(function(){

var quantitiy=0;
   $('.quantity-right-plus').click(function(e){

        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());

        // If is not undefined

            $('#quantity').val(quantity + 1);


            // Increment

    });

     $('.quantity-left-minus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());

        // If is not undefined

            // Increment
            if(quantity>0){
            $('#quantity').val(quantity - 1);
            }
    });

});

	</script>

	<script>
			$(document).ready(function() {

					$('.footable').footable();
					$('.footable2').footable();

			});

	</script>

	<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>

</body>

</html>
