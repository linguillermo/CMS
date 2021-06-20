<?php
$DB_host = "localhost";
$DB_user = "u949229776_admin";
$DB_pass = "CMA_adm1n";
$DB_name = "u949229776_hms";
try
{
 $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
 $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
 $e->getMessage();
}
?>
