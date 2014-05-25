<?
require('phpGPX.php');

// a.) create instance of phpGoogleKML class
$my = new phpGPX();

// b.) Change these properties only in case when you'd like to change default values (see documentation for default values).
$my->filename = "test.gpx";
//$my->outputDirectory = "./export/";

// c.1) add Point(s) to your GPX file
$my->addPoint("name2","cmrwe","swym","teype","des",42.000421,21.057541);
$my->addPoint("name1","cmrdf","sywem","type","dewer2s",42.78777,21.052521);
$my->addPoint("name4","cmry","symtr","tewrype","des",42.11251,21.744521);

// or c.2) to add Line to GPX file
// $my->addLinePlacemark();

// d.1) create GPX file
$my->CreateGPXfile();

// d.2) or display GPX file
//$my->DownloadGPXfile("TXT");

// d.3) or display GPX file
//$my->DisplayGPXfile();

// HOWTO display phpGPX properties ?
//echo $my->KML_name;
//echo $my->KML_description;
//echo $my->outputDirectory;
//echo $my->xmlns_url;
// etc ...

?>
