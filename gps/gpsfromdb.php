<?php

//Jozef Nagy
//5/2014
//Reads GPS from db and outputs it into a standard GPX file format

//$json = file_get_contents('php://input');
//$array = json_decode($json, true);


//$apikey = NewUser($array);

//return JSON array
//exit(json_encode($apikey));

//Config script contains setup information. Required. 
include '../config.php';
require('phpGPX_JN.php');

// a.) create instance of phpGoogleKML class
$gps = new phpGPX();
$gps->filename = "gps_output.gpx";

//GPS parameters
$uid = 37;

$con=mysqli_connect("localhost",$cfg_db,$cfg_db_passwd,$cfg_db_user);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//$email = mysql_real_escape_string($array["Email"]);

$result = mysqli_query($con, "select lat, NS, lon, EW, eventdate from gps where uid = $uid limit 5");

if(mysqli_num_rows($result)==0)
{
	//Generate the API Key
	//$key = gen_random_string(16);
	//mysqli_query($con,"INSERT INTO users (email, apikey) VALUES ('$email', '$key')");
}

while($row = mysqli_fetch_array($result)) {
	//Shift the decimal left 2 digits because of how values are stored in the DB.
	$lat = $row['lat'];
	$lat = $lat / 100;
	$lon = $row['lon'];
	$lon = $lon / 100;

	//Set whether lat or lon is positive or negative
	if($row['NS']=="S"){
		$lat = $lat * -1;
	}
        if($row['EW']=="W"){
                $lon = $lon * -1;
        }

	$gps->addPoint($lat,$lon,"2014-05-24T12:03:31Z");
}

mysqli_close($con);

$gps->CreateGPXFile();

//return $key;
//return "harcoded_result";




?>
