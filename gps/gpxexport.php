<?php

//Outputs the export file to browser for download
function SendToBrowser(){
        // open the file in a binary mode
        $name = './img/ok.png';
        $fp = fopen($name, 'rb');

        // send the right headers
        header("Content-Type: image/png");
        header("Content-Length: " . filesize($name));
        
        // dump the picture and stop the script
        fpassthru($fp);
}



//Jozef Nagy
//5/2014
//Reads GPS from db and outputs it into a standard GPX file format
//Input parameters come from an HTML page and are sent as POST data. 

//$json = file_get_contents('php://input');
//$array = json_decode($json, true);


//$apikey = NewUser($array);

//return JSON array
//exit(json_encode($apikey));

function logger($msg){
	$file = "log.txt";
	//$d=date(Y-m-d--H-i-s);
	$d=date("c");
	file_put_contents($file, "$d - $msg\n", FILE_APPEND);
}

//Config script contains setup information. Required. 
include '/var/www/obdapi/config.php'; //db login info
require('phpGPX_JN.php'); //the code that generates the GPX XML file

// a.) create instance of phpGoogleKML class
$gps = new phpGPX();
$outputdir = "gpsexport/";
$gps->outputDirectory = $outputdir;
$file = uniqid().".gpx";
$gps->filename = $file;

//GPS parameters
/*
//Hardcoded inputs for debugging:
$uid = 38;
$apikey =  P9wwTdj5P3o1Y195 //sample API
$startdt = "2014-05-28 00:00:00";
$enddt = "2014-05-29 23:59:59";
$timezone_offset = 4; //UTC offset for your timezone. -4 is Eastern Standard Time.
*/

$apikey = $_POST['apikey'];
$dtstart = $_POST['dtstart'];
$dtend = $_POST['dtend'];
$timezone_offset = 4;


$con=mysqli_connect("localhost",$cfg_db,$cfg_db_passwd,$cfg_db_user);

// Check connection
if (mysqli_connect_errno())
{
	logger("db connection failed");
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//cleanup the input strings for validation and against SQL injection
$apikey = $con->real_escape_string($apikey);
$dtstart = $con->real_escape_string($dtstart);
$dtend = $con->real_escape_string($dtend);

//log("Start export for api key: $apikey");

//$email = mysql_real_escape_string($array["Email"]);

//$result = mysqli_query($con, "select lat, NS, lon, EW, eventdate from gps where uid = $uid and eventdate between '$startdt' and '$enddt'");
$result = mysqli_query($con, "select lat, NS, lon, EW, eventdate from gps inner join users on gps.uid = users.uid where users.apikey = '$apikey' and eventdate between '$dtstart' and '$dtend' ");

//General DB error w/ qry execution
if($result == false)
{
	logger("qry error: ".$con->error);
        echo htmlspecialchars("DB Error: ".$con->error);
        //header("Location: http://www.blackboxpi.com");
	exit();
}

//spit back a syntactically correct GPX file w/ no data points, or return an HTML page w/ error message.
if(mysqli_num_rows($result)==0)
{
	//log("Failed to return data for $apikey");
	logger("Failed to return data for APIKey: $apikey; dtStart: $dtstart; dtEnd: $dtend");
	header("Location: http://www.blackboxpi.com/empty-gpx-file/");
	exit;
}/* else { //temp redirect for if there's no SQL error. REMOVE THIS
        header("Location: http://www.blackboxpi.com");
        exit;
}*/

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

	//Offset the UTC time to user's local time
	$dt = new DateTime($row['eventdate']);
	//$dt = $dt->add(new DateInterval("P".$timezone_offset."H"));
	//$dt = $dt->add(new DateInterval('PT4H'));

	$gps->addPoint($lat,$lon,$dt->format(DateTime::ISO8601));
}

mysqli_close($con);

try {
	$gps->CreateGPXFile();
}
catch(Exception $e){
	logger("Failed to export GPX file: CreateGPXFile() - ".$e->getMessage());
}

logger("Generated GPX file for APIKey:".$apikey);

//Output HTML page w/ link to file
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title>Download page</title>
</head>
<body>
<a href="<?php echo($outputdir.$file);?>">Download</a><br><br>
API Key: <?php echo($apikey);?><br>
Start Date: <?php echo($dtstart);?><br>
End Date: <?php echo($dtend);?><br>
</body>
</html>

