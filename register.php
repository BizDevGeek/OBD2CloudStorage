<?php

//Jozef Nagy
//12/2013
//JSON + REST web service for storing OBD2 data

$json = file_get_contents('php://input');
$array = json_decode($json, true);


$apikey = NewUser($array);

//return JSON array
exit(json_encode($apikey));




function NewUser($array){

//Config script contains setup information. Required. 
include 'config.php';

$con=mysqli_connect("localhost",$cfg_db,$cfg_db_passwd,$cfg_db_user);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$email = mysql_real_escape_string($array["Email"]);

$result = mysqli_query($con, "select uid, email, APIKey from users where email = '$email'");

if(mysqli_num_rows($result)==0)
{
	//Generate the API Key
	$key = gen_random_string(16);
	mysqli_query($con,"INSERT INTO users (email, apikey) VALUES ('$email', '$key')");
}

while($row = mysqli_fetch_array($result)) {
    $key = $row['APIKey'];}

mysqli_close($con);

return $key;
//return "harcoded_result";

}


function gen_random_string($length=16)
{
	$chars ="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";//length:36
	$final_rand='';
	for($i=0;$i<$length; $i++)
	{
		$final_rand .= $chars[ rand(0,strlen($chars)-1)];

	}
	return $final_rand;
}

?>
