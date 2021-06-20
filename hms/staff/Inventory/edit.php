<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');

include('config.php');

if (isset($_POST['submit']))
{
$id=mysqli_real_escape_string($db,$_POST['id']);
$name=mysqli_real_escape_string($db, $_POST['product_name']);
$dosage=mysqli_real_escape_string($db, $_POST['dosage']);
$quant=mysqli_real_escape_string($db, $_POST['quantity']);
$formulation=mysqli_real_escape_string($db, $_POST['formulation']);

$username=$_SESSION['login'];
$uip = "Edited Medicine";

mysqli_query($db,"UPDATE product SET product_name='$name', dosage='$dosage' ,quantity='$quant' ,formulation='$formulation' WHERE product_id='$id'");
mysqli_query($db,"INSERT INTO userlog (uid,username,userip,status) VALUES ('$uId','$username','$uip','$status')");
header("Location:inventory.php");
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
{

$id = $_GET['id'];
$result = mysqli_query($db,"SELECT * FROM product WHERE product_id=".$_GET['id']);

$row = mysqli_fetch_array($result);

if($row)
{

$id = $row['product_id'];
$name = $row['product_name'];
$dosage = $row['dosage'];
$quant=$row['quantity'];
$formulation=$row['formulation'];
}
else
{
echo "No results!";
}
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
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
                                <li><a class="dropdown-item" href="login.html">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            CA
                        </div>
                    </li>
                    <li>
                        <a href="staff-dashboard.html"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>

                    </li>
                    <li>
                        <a href="staff-patient-records.html"><i class="fa fa-table"></i> <span class="nav-label">Patients</span></a>

                    </li>

                    <li>
                        <a href="staff-approved-appointments.html"><i class="fa fa-calendar"></i> <span class="nav-label">Appointments</span>  </a>
                    </li>

                    <li class="active">
                        <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Medicine Stocks</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="staff-medicines.html">Medicines</a></li>
                            <li class="active"><a href="staff-stocks.html">Stocks</a></li>
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
                <a href="login.html">
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
                            <h5></h5>
</head>
<body>

<center>

<form action="" method="post" action="edit.php">
<input type="hidden" name="id" value="<?php echo $id; ?>"/>

<p>
<tr><center>
<td colspan="1"><b><font color='grey' size="8"> Edit Medicine Records </font></b></td>
</tr></center></p>

<table border="1">
<tr>
<td width="175"><b><font color='Black'>Id#</font></b></td>
<td><label>
<input type="text" name="id" value="<?php echo $id; ?>" required />
</label></td>
</tr>
</table>

<table border="1">
<tr>
<td width="175"><b><font color='Black' >Item Name</font></b></td>
<td><label>
<input type="display" name="product_name" value="<?php echo $name; ?>" required />
</label></td>
</tr>
</table>


<table border="1">
<tr>
<td width="175"><b><font color='Black'>Dosage</font></b></td>
<td><label>
<input type="text" name="dosage" value="<?php echo $dosage ?>" />
</label></td>
</tr>
</table>

<table border="1">
<tr>
<td width="175"><b><font color='Black'>Quantity</font></b></td>
<td><label>
<input type="text" name="quantity" value="<?php echo $quant;?>" required />
</label></td>
</tr>
</table>




<table border="1">
<tr>
<td width="175"><b><font color='Black'>Form</font></b></td>
<td><label>
<input type="text" name="formulation" value="<?php echo $formulation;?>" required />
</label></td>
</tr>
</table>


<br>
</br




<tr align="Right">
<td colspan="2"><label>
<input type="submit" name="submit" class="btn btn-primary" value="Edit">



<a href ="inventory.php" button type="button" class="btn btn-danger">Cancel</a>
</label></td>
</tr>



</form>
</center>
</body>
</html>
