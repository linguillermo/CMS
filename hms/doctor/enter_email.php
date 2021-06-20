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

//START OF PASSWORD RESET BACKEND CODE
if (isset($_POST['reset-password'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);

  // ensure that the user exists on our system
  $query = "SELECT email FROM users WHERE email='$email'";
  $results = mysqli_query($db, $query);

  if (empty($email))
	{
    $_SESSION['errmsg'] = "Your email is required";
  }
	else if(mysqli_num_rows($results) <= 0)
	{
		$_SESSION['errmsg'] = "Sorry, the email you entered does not exist.";
  }
  // generate a unique random token of length 100
  $token = bin2hex(random_bytes(50));

  if (mysqli_num_rows($results) > 0)
	{
    // store token in the password-reset database table against the user's email
    $sql = "INSERT INTO password_resets(email, token) VALUES ('$email', '$token')";
    $results = mysqli_query($db, $sql);

    // Send email to user with the token in a link they can click on
    $to = $email;
    $subject = "Reset your password on clinicaableda.com";
    $msg =  'Helllo There! HERE IS YOUR PASSSWORD RESET!
		<a href="https://www.clinicaabeleda.com/hms/doctor/new_pass.php?token=' . $token .'&email='.$email.'>Click To Reset Password</a>';
    $msg = wordwrap($msg,70);
    $headers = "From: dontreply@clinicaableda.com";
    mail($to, $subject, $msg, $headers);
    header('location: pending.php?email=' . $email);
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
            <h3>Reset Password</h3>
            <p>Please enter your email address<br>
						<span style="color:red;"><?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg']="";?></span>
					</p>
            <form class="form-login m-t" role="form" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Email Address" required="" name="email">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b" name="reset-password">Submit</button>
								<a href="index.php" class="btn btn-danger block full-width m-b">Cancel</a>
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
