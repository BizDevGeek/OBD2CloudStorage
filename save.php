<?php

//Jozef Nagy
//12/2013
//JSON + REST web service for storing OBD2 data

//TODO: Check the INSERT qry's retun code. If good, retun that value to the API caller. 

$json = file_get_contents('php://input');
$array = json_decode($json, true);

//$file = 'data.txt';

//$string = date("c")."-".$array["name"] . "\n";
//$string = date("c")."-".$json . "\n";

//file_put_contents($file, $string, FILE_APPEND | LOCK_EX);

SaveMeasurement($array);



function SaveMeasurement($array){

//Config script contains setup information. Required. 
include 'config.php';

$con=mysqli_connect("localhost",$cfg_db,$cfg_db_passwd,$cfg_db_user);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

mysqli_query($con,"INSERT INTO readings (APIKey, PID, PIDValue, EventDate) 
VALUES ('".$array["APIKey"]."', '".$array["PID"]."', '".$array["PIDValue"]."', '".$array["EventDate"]."')");


mysqli_close($con);

}

?>
