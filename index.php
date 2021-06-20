<?php
include_once 'dbconnect.php';
require "appointment_plugins/include/aes256.php";


mysqli_query($con,"DELETE FROM tblpatient WHERE (UpdationDate < NOW() - INTERVAL 10 YEAR)");
// $appid=null;
// $appdate=null;


// if (isset($_GET['scheduleDate']) && isset($_GET['appid'])) {
// 	$appdate =$_GET['scheduleDate'];
// 	$appid = $_GET['appid'];
// }
// // on b.icPatient = a.icPatient
// $res = mysqli_query($con,"SELECT a.* FROM doctorschedule a
// WHERE a.scheduleDate='$appdate' AND scheduleId=$appid");
// $userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);



//INSERT
if (isset($_POST['submit'])) {
// $patientIc = mysqli_real_escape_string($con,$userRow['icPatient']);
// $patientIc = 8888;

$scheduleid = mysqli_real_escape_string($con,$_POST['scheduleid']);
$firstName = encryptthis(mysqli_real_escape_string($con,$_POST['fname']), key);
$lastName = encryptthis(mysqli_real_escape_string($con,$_POST['lname']), key);
$contactNo = encryptthis(mysqli_real_escape_string($con,$_POST['contact']), key);
$reason = mysqli_real_escape_string($con,$_POST['reason']);
$avail = "notavail";


$query = "INSERT INTO appointment ( scheduleId ,firstName, lastName, contactNo , appComment  )
VALUES ( '$scheduleid', '$firstName','$lastName', '$contactNo','$reason') ";

//update table appointment schedule
$sql = "UPDATE doctorschedule SET bookAvail = '$avail' WHERE scheduleId = $scheduleid" ;
$scheduleres=mysqli_query($con,$sql);
if ($scheduleres) {
	$btn= "disable";
}


$result = mysqli_query($con,$query);
// echo $result;
if( $result )
{

echo "<script>alert('Appointment set sucessfully! Please wait for our staff to contact you and confirm your appointment. Thank you!'); window.location='index.php'</script>";

}
else
{
	echo mysqli_error($con);
?>
<script type="text/javascript">
alert('Appointment booking fail. Please try again.');
</script>
<?php
header("Location: index.php");
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Clinica Abeleda | Home</title>


    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style1.css" rel="stylesheet">

    <!-- for appointment  calendar
    <link href="appointment_plugins/css/date/style.css" rel="stylesheet">
    <link href="appointment_plugins/css/date/style1.css" rel="stylesheet">
    <link href="appointment_plugins/css/date/blocks.css" rel="stylesheet">

    <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
    <link href="css/date/material.css" rel="stylesheet">-->

	<link href="appointment_plugins/css/date/date/bootstrap-datepicker.css" rel="stylesheet">
    <link href="appointment_plugins/css/date/date/bootstrap-datepicker3.css" rel="stylesheet">

</head>
<body id="page-top" class="landing-page no-skin-config" style="scrollbar-width: thin;">
<!-- Messenger Chat plugin Code -->
<div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v10.0'
          });
        };

        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      </script>

      <!-- Your Chat plugin code -->
      <div class="fb-customerchat"
        attribution="biz_inbox"
        page_id="103559001863075">
         
</div>
<!-- Messenger Chat plugin Code END -->

<div class="navbar-wrapper">
        <nav class="navbar navbar-default navbar-fixed-top navbar-expand-md" role="navigation">
            <div class="container">
                <a class="navbar-brand" href="index.php">CLINICA ABELEDA</a>
                <div class="navbar-header page-scroll">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="nav-link page-scroll" href="#page-top" style="color:#096e76">Home</a></li>
                        <li><a class="nav-link page-scroll" href="#services">Services</a></li>

						<li><a class="nav-link page-scroll" href="#team">About Us</a></li>

                        <li><a class="nav-link page-scroll" href="#contact">Contact</a></li>

                    </ul>
                </div>
            </div>
        </nav>
</div>
<div id="inSlider" class="carousel slide" data-ride="carousel" >

    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Welcome to<br/>
                        Clinica Abeleda<br/>
                        </h1>
                    <p>Providing supportive care for your dermatological needs</p>
                    <p>
                     <!--   <a class="btn btn-lg btn-primary page-scroll" href="#appointment" role="button">MAKE AN APPOINTMENT</a>-->
						<div class="col-sm-10" style="padding:0px">
                              <h2>Set an appointment with us today!</h2>


                              <!-- date textbox -->

                              <div class="input-group" style="margin-bottom:10px;">
                                  <div class="input-group-addon">
                                      <i class="fa fa-calendar">
                                      </i>
                                  </div>
                                  <input class="form-control" id="date" name="date" value="<?php echo date("Y-m-d")?>" onchange="showUser(this.value)"/>
                              </div>

                              <!-- date textbox end -->

                              <!-- script start -->
                              <script>
                                  function showUser(str) {

                                      if (str == "") {
                                          document.getElementById("txtHint").innerHTML = "";
                                          return;
                                      } else {
                                          if (window.XMLHttpRequest) {
                                              // code for IE7+, Firefox, Chrome, Opera, Safari
                                              xmlhttp = new XMLHttpRequest();
                                          } else {
                                              // code for IE6, IE5
                                              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                          }
                                          xmlhttp.onreadystatechange = function() {
                                              if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                                  document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                                              }
                                          };
                                          xmlhttp.open("GET","appointment_plugins/getschedule.php?q="+str,true);
                                          console.log(str);
                                          xmlhttp.send();
                                      }
                                  }
                              </script>

                              <!-- script start end -->




                              <!-- table appointment start -->
                              <div id="txtHint"><b> </b></div>

                              <!-- table appointment end -->


                          </div>

                    </p>
                </div>

            </div>
            <!-- Set background for slide in css -->
            <div class="header-back one"></div>

        </div>

    </div>

</div>


<section id="services" class="container services">
    <div class="row">
        <div class="col-sm-3">
            <h2>Consultation</h2>
            <p>Guides you towards the specific medical services needed to improve your health.</p>

        </div>
        <div class="col-sm-3">
            <h2>Partial Ungiectomy</h2>
            <p>Surgical removal of a portion of a fingernail or toenail which causes pain or discomfort.</p>

        </div>
        <div class="col-sm-3">
            <h2>Steroid Injection</h2>
            <p>Treatment that delivers a high dose of medication that can help relieve pain and inflammation in a specific area of your body.</p>

        </div>
        <div class="col-sm-3">
            <h2>Mole removal</h2>
            <p>Removal of cosmetic moles, skin tags and other benign skin growths.</p>

        </div>
    </div>
</section>

<section  class="container services">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="navy-line"></div>
            <h1>Our Services</h1>
            <p>Clinica Abeleda offers a wide range of dermatological services. </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 wow fadeInLeft">
            <div >

                <h2>Sweatox </h2>
                <p>Relatively pain-free treatment that helps to reduce excess sweating of the underarms.</p>
            </div>
            <div class="m-t-lg">

                <h2>Acne Treatment</h2>
                <p>Provides effective medical and laser acne treatments to overcome your skin concerns.</p>
            </div>
        </div>
        <div class="col-md-6 text-center  wow zoomIn">
            <img src="img/landing/ds1.jpg" alt="dashboard" class="img-fluid">
        </div>
        <div class="col-md-3 text-right wow fadeInRight">
            <div>

                <h2>Excision Biopsy</h2>
                <p>Surgical removal of an entire tumor and some normal tissue around it.</p>
            </div>
            <div class="m-t-lg">

                <h2>Punch Biopsy</h2>
                <p>Procedure that acquires tissue for laboratory examination by taking a punch-size piece of skin from the body.</p>
            </div>
        </div>
    </div>

</section>

<section class="container services">
    <div class="row">
        <div class="col-sm-3">
            <h2>Fractional RF</h2>
            <p>Revolutionary treatment that visibly tightens your skin and reduces the signs of ageing.</p>

        </div>
        <div class="col-sm-3">
            <h2>IPL </h2>
            <p>Treatment that removes age spots, sun damage, freckles, birthmarks, varicose veins, wrinkle treatment and wrinkle reduction, rosacea, and unwanted body hair.</p>

        </div>
        <div class="col-sm-3">
            <h2>Electocauttery</h2>
            <p>Procedure that uses heat to destroy abnormal cell mass, such as a tumor or other lesion.</p>

        </div>
        <div class="col-sm-3">
            <h2>Mole removal</h2>
            <p>Removal of cosmetic moles, skin tags and other benign skin growths.</p>

        </div>
    </div>
</section>



<section class="features" id="team">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Our Team</h1>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 wow fadeInLeft">
                <div class="team-member">

                </div>
            </div>
            <div class="col-sm-6">
                <div class="team-member wow zoomIn">
                    <img src="img/landing/avatar1.jpg" class="img-fluid rounded-circle" alt="">
                    <h4><span class="navy">Ma. Rochelle A. De Guzman - Abeleda,</span> MD</h4>
                    <p>Fellowm Philippines Academy of Clinical and Cosmetic Dermatology <br>
						An Affiliate Society of the Philippine Medical Association</p>


                </div>
            </div>
            <div class="col-sm-3 wow fadeInRight">
                <div class="team-member">

                </div>
            </div>
        </div>

    </div>

</section>

<section id="contact" class="gray-section contact">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Contact Us</h1>

            </div>
        </div>
        <div class="row m-b-lg justify-content-center">
            <div class="col-lg-3 ">
                <address>
                    <strong><span class="navy">Clinica Abeleda</span></strong><br/>
                    CIC Building, Burgos Avenue<br/>
                    Cabanatuan City, Nueva Ecija<br/>
                    <abbr title="Phone">(044) 463-0893
                </address>
            </div>
            <div class="col-lg-4">
                <p class="text-color">
                    We are a dermatology clinic that aims to provide supportive care to your dermatological needs.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">

                <p class="m-t-sm">
                    Follow us on social platform
                </p>
                <ul class="list-inline social-icon">

                    <li class="list-inline-item"><a href="https://www.facebook.com/clinicaabeleda"><i class="fa fa-facebook"></i></a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center m-t-lg m-b-lg">
                <p><strong>© 2020 Clinica Abeleda</strong><br>
				<a href="hms/admin">Admin</a> | <a href="hms/doctor/">Doctor</a> | <a href="hms/staff/">Staff</a>
				</p>
            </div>
        </div>
    </div>
</section>


<div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Appointment Form</h4>

            </div>
            <div class="modal-body">

                    <form role="form" name="" method="post">
                        <div class="form-group row"><label class="col-sm-3 col-form-label">First Name</label>


                                    <div class="col-sm-9"><input type="text" name="fname" class="form-control"></div>


                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row"><label class="col-sm-3 col-form-label">Last Name</label>
                            <div class="col-sm-9"><input type="text" name="lname" class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row"><label class="col-sm-3 col-form-label">Phone No.</label>

                            <div class="col-sm-9">
                                <div class="input-group m-b">
                                    <div class="input-group-prepend">
                                        <span class="input-group-addon">+63</span>
                                    </div>
                                    <input type="text" name="contact" class="form-control">
                                </div>

                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row" id="data_1"><label class="col-sm-3 col-form-label">Reason for Appointment</label>
                          <div class="col-sm-9"><textarea name="reason" class="form-control"></textarea>
                          </div>

                            </div>
                         <input type="text" class="form-control" name="scheduleid" id="scheduleid" value="" hidden> 



            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" id="submit" class="btn btn-sm btn-primary">
                Submit
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>
<script src="js/plugins/wow/wow.min.js"></script>

<!-- FOR CALENDAR/APPOINTMENT TAB-->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="appointment_plugins/js/date/jquery.js"></script>
<script src="appointment_plugins/js/date/date/bootstrap-datepicker.js"></script>
<script src="appointment_plugins/js/date/moment.js"></script>
<script src="appointment_plugins/js/date/transition.js"></script>
<script src="appointment_plugins/js/date/collapse.js"></script>
 <!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="appointment_plugins/js/date/bootstrap.min.js"></script>
<script type="text/javascript">
$('#myModal').on('shown.bs.modal', function () {
$('#myInput').focus()
})
</script>
<!-- date start -->

<script>
$(document).ready(function(){
    var date_input=$('input[name="date"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    date_input.datepicker({
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })

})
</script>

<!-- date end -->
<script>

    $(document).ready(function () {

        $('body').scrollspy({
            target: '#navbar',
            offset: 80
        });

        // Page scrolling feature
        $('a.page-scroll').bind('click', function(event) {
            var link = $(this);
            $('html, body').stop().animate({
                scrollTop: $(link.attr('href')).offset().top - 50
            }, 500);
            event.preventDefault();
            $("#navbar").collapse('hide');
        });



    });

    var cbpAnimatedHeader = (function() {
        var docElem = document.documentElement,
                header = document.querySelector( '.navbar-default' ),
                didScroll = false,
                changeHeaderOn = 200;
        function init() {
            window.addEventListener( 'scroll', function( event ) {
                if( !didScroll ) {
                    didScroll = true;
                    setTimeout( scrollPage, 250 );
                }
            }, false );
        }
        function scrollPage() {
            var sy = scrollY();
            if ( sy >= changeHeaderOn ) {
                $(header).addClass('navbar-scroll')
            }
            else {
                $(header).removeClass('navbar-scroll')
            }
            didScroll = false;
        }
        function scrollY() {
            return window.pageYOffset || docElem.scrollTop;
        }
        init();

    })();

    // Activate WOW.js plugin for animation on scrol
    new WOW().init();

</script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/date/jquery.js"></script>
<script src="js/date/date/bootstrap-datepicker.js"></script>
<script src="js/date/moment.js"></script>
<script src="js/date/transition.js"></script>
<script src="js/date/collapse.js"></script>
 <!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/date/bootstrap.min.js"></script>
<script type="text/javascript">
$('#myModal').on('shown.bs.modal', function () {
$('#myInput').focus()
})
</script>
<!-- date start -->

<script>
$(document).ready(function(){
    var date_input=$('input[name="date"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    date_input.datepicker({
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
    })

})

</script>

<!-- date end -->

</html>
</body>
</html>
