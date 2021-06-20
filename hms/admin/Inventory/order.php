<?php
// initializing variables
$item_name = "";

$item_quantity    = "";


// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'hms');
if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

// Add item
if (isset($_POST['order'])) {
  // receive all input values from the form
  echo "connect";
  
  
// get the inputted quantity from order form  
  $item_name=mysqli_real_escape_string($db, $_POST['product_name']);
  $dosage=mysqli_real_escape_string($db, $_POST['dosage']);
  $quant=mysqli_real_escape_string($db, $_POST['quantity']);
	
  $query = "UPDATE product SET  quantity = quantity - '$quant' WHERE product_name='$item_name' ";
  $query = "UPDATE product SET  quantity = quantity - '$quant' WHERE dosage='$dosage' ";  
  			  		  
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
