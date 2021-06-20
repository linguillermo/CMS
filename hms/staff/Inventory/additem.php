<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');


// initializing variables
$item_name = "";
$item_dosage    = "";


// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'hms');
if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

// Add item
if (isset($_POST['add']))
{
  // receive all input values from the form
  // $ret=mysqli_query($con,"SELECT * FROM users WHERE username='".$_POST['username']."' and password='".$_POST['password']."' and role='staff'");
  // $num=mysqli_fetch_array($ret);

  echo "connect";
  $item_name=mysqli_real_escape_string($db, $_POST['product_name']);
  $item_dosage=mysqli_real_escape_string($db, $_POST['dosage']);
  $quant=mysqli_real_escape_string($db, $_POST['quant']);
  $formulation=mysqli_real_escape_string($db, $_POST['formulation']);
  $status=1;
  $uId=$_SESSION['id'];
  $username=$_SESSION['login'];
  $uip = "Added Medicine";
  $log = "INSERT INTO userlog (uid,username,userip,status)
          VALUES ('$uId','$username','$uip','$status')";

  $query = "INSERT INTO product (product_name,dosage,quantity,formulation)
  			  VALUES('$item_name','$item_dosage','$quant','$formulation')";

      if(mysqli_query($db, $query))
      {
      echo "<script>alert('Successfully stored');</script>";
      mysqli_query($db,$log);

      }
      else
      {
          echo"<script>alert('Somthing wrong!!!');</script>";
      }

    	header('location: inventory.php');

  }

?>
