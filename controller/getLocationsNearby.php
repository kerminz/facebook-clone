<?php

$data = json_decode(file_get_contents("php://input")); // waiting for Json Data
$longt = $data->longt;
$lat = $data->lat;

	
if (isset($lat)) {
	$jsonurl = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=$lat,$longt&radius=300&rankBy=distance&key=AIzaSyDNIe8dwtPScVkxUdurDShxnLRmDfPfuWU";
	$json = file_get_contents($jsonurl);
	echo $json;
}




?>