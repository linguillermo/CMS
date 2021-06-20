<?php
session_start();
error_reporting(0);
require "include/aes256.php";
include("include/config.php");

//localhost connection
// $db = mysqli_connect("localhost","root","","hms");

//online connection
$db = mysqli_connect("localhost","u949229776_admin","CMA_adm1n","u949229776_hms");

// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Reset Password</title>

		<link href="insp/css/bootstrap.min.css" rel="stylesheet">
    <link href="insp/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="insp/css/animate.css" rel="stylesheet">
    <link href="insp/css/style.css" rel="stylesheet">

	</head>
	<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h2 class="logo-name" style="text-align: center;">Clinica Abeleda</h2>
            </div>
            <h3>Reset Password</h3>
					</p>
            <form class="form-login m-t" role="form" method="post">
                <div class="form-group">
                    We sent an email to <b><?php echo $_GET['email'] ?></b> to help you recover your account.<p><p>
                    Please Check your email.
                </div>
								<a href="index.php" class="btn btn-primary block full-width m-b">Go to Login Page</a>
            </form>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>
