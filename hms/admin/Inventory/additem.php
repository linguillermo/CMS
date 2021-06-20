<?php
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
if (isset($_POST['add'])) {
  // receive all input values from the form
  echo "connect";
  $item_name=mysqli_real_escape_string($db, $_POST['product_name']);
  $item_dosage=mysqli_real_escape_string($db, $_POST['dosage']);
  $quant=mysqli_real_escape_string($db, $_POST['quant']);
  $formulation=mysqli_real_escape_string($db, $_POST['formulation']);
	
    $query = "INSERT INTO product (product_name,dosage,quantity,formulation)
  			  VALUES('$item_name','$item_dosage','$quant','$formulation')";
      if(mysqli_query($db, $query))
      {
      echo "<script>alert('Successfully stored');</script>";

    }
    else{
        echo"<script>alert('Somthing wrong!!!');</script>";
    }

  	header('location: inventory.php');

}
?>
