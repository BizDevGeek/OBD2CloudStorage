<?php

//Jozef Nagy
//12/2013
//JSON + REST web service for storing GPS data

$json = file_get_contents('php://input');
$array = json_decode($json, true);

//$file = 'data.txt';
//$string = date("c")."-".$array["name"] . "\n";
//$string = date("c")."-".$json . "\n";
//file_put_contents($file, $string, FILE_APPEND | LOCK_EX);

$result = SaveGPSData($array);
exit(json_encode($result)); //sends back "true" if operation is a success


function SaveGPSData($array){

//Config script contains setup information. Required. 
include 'config.php';

$con=mysqli_connect("localhost",$cfg_db,$cfg_db_passwd,$cfg_db_user);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Get user ID (uid) based on API Key
$select = mysqli_query($con,"select uid from users where APIKey = '".$array["APIKey"]."'"); 
//$row = $select->fetch_row();
mysqli_data_seek($select, 0);
$row = mysqli_fetch_row($select);
$uid = $row[0];

$result = mysqli_query($con,"INSERT INTO gps (uid, lat, lon, EventDate) 
VALUES ('".$uid."', ".$array["lat"].", ".$array["lon"].", '".$array["EventDate"]."')");


mysqli_close($con);

return $result;
}

?>
