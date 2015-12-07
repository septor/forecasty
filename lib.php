<?php

// Output lat,lon for a given address.
// $address can be many things; zip code - city,state - etc.
function getLocation($address)
{
    $prepAddr = str_replace(' ','+',$address);
    $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
    $output= json_decode($geocode);
    $latitude = $output->results[0]->geometry->location->lat;
    $longitude = $output->results[0]->geometry->location->lng;

    return $latitude.','.$longitude;
}

// Fahrenheit to Celsius
function f2c($temp)
{
	return 5/9*($temp-32);
}

// Celsius to Fahrenheit
function c2f($temp)
{
	return $temp*9/5+32;
}

?>
