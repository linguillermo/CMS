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


//NEW PASSWORD CODE START
if (isset($_POST['new_password']))
{
	  $new_pass = mysqli_real_escape_string($db, $_POST['new_pass_c']);

  	// Grab to token that came from the email link
		$token = $_GET['token'];

    // select email address of user from the password_reset table
    $sql = "SELECT email FROM password_resets WHERE token='$token' LIMIT 1";
    $results = mysqli_query($db, $sql);
    $email = mysqli_fetch_assoc($results)['email'];

    if ($email)
		{
			$new_pass_1 = md5($new_pass);
      $sql_1 = "UPDATE users SET password='$new_pass_1' WHERE email='$email'";
      $results = mysqli_query($db, $sql_1);
      header('location: index.php' );
    }
		else
		{
			$_SESSION['errmsg'] = "There is something wrong! Please try again!";
		}
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
            <h3>New Password</h3>

            <p>Please enter your new password<br>
						<span style="color:red;"><?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg']="";?></span>
					</p>
            <form class="form-login m-t" role="form" method="post" oninput='new_pass_c.setCustomValidity(new_pass.value != new_pass_c.value ? "Passwords do not match." : "")'>
							<div class="form-group">
									<input type="password" class="form-control" placeholder="New Password" required="" name="new_pass">
							</div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Confirm New Password" required="" name="new_pass_c">
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b" name="new_password">Submit</button>
                <!-- <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a> -->
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
