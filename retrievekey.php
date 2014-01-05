<?php

//Jozef Nagy
//12/2013
//Used for getting back a lost or forgotten API Key. It emails the key to the email provided. 
//BUG NOTICE: THIS FUNCTION DOESN'T WORK. THE EMAIL DOESN'T SEND. Switch to using a dedicated email address via an SMTP server. 

$json = file_get_contents('php://input');
$array = json_decode($json, true);

SendKey($array);

function SendKey($array){

//Gets the API key for given email address and sends an email to that user including the key.
//Config script contains setup information. Required. 
include 'config.php';

$con=mysqli_connect("localhost",$cfg_db,$cfg_db_passwd,$cfg_db_user);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$email = mysql_real_escape_string($array["Email"]);

$result = mysqli_query($con, "select APIKey from users where email = '$email'");

if(mysqli_num_rows($result)==0)
{
	return;
}

while($row = mysqli_fetch_array($result)) {
    $key = $row['APIKey'];}

mysqli_close($con);

//Generate an email
mail($email, "API Key", "You have requested that your OBD2 API Key be re-sent to you. It is: $key"); 

}


