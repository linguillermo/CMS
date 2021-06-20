<?php

//Devt Connection
define('DB_SERVER','localhost');
define('DB_USER','u949229776_admin');
define('DB_PASS' ,'CMA_adm1n');
define('DB_NAME', 'u949229776_hms');

//Remote Database Connection

// define('DB_SERVER','localhost');
// define('DB_USER','root');
// define('DB_PASS' ,'');
// define('DB_NAME', 'hms');

$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
