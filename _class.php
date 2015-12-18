<?php
/*
 * Forecasty - A weather plugin for e107
 *
 * Copyright (C) 2015 Patrick Weaver (http://trickmod.com/)
 * For additional information refer to the README.md file.
 *
 */
class Forecasty
{
	function __construct($apiKey, $loc)
	{
		$this->json = json_decode(file_get_contents('https://api.forecast.io/forecast/'.$apiKey.'/'.$loc));
		$this->current = $this->json->currently;
		$this->nexthour = $this->json->hourly->data[1];
		$this->nextday = $this->json->daily->data[1];
		$this->nextweek = $this->json->daily->data[7];
	}

	public function getData($type = 'current')
	{
		if($type == 'nexthour')
			$data = $this->nexthour;
		elseif($type == 'nextday')
			$data = $this->nextday;
		elseif($type == 'nextweek')
			$data = $this->nextweek;
		elseif($type == 'current')
			$data = $this->current;

		if($type == 'nextday' || $type == 'nextweek')
		{
			$feelsLike = ($data->apparentTemperatureMin + $data->apparentTemperatureMax) / 2;
			$temperature = ($data->temperatureMin + $data->temperatureMax) / 2;
		}
		else
		{
			$feelsLike = $data->apparentTemperature;
			$temperature = $data->temperature;
		}

		$output = array(
			'temperature' => $temperature,
			'feelsLike' => $feelsLike,
			'icon' => $data->icon,
			'condition' => $data->summary,
			'humidity' => $data->humidity,
			'windSpeed' => $data->windSpeed,
			'visibility' => $data->visibility,
			'pressure' => $data->pressure,
			'dewPoint' => $data->dewPoint,
		);
		return $output;
	}

	public function getLocation($address)
	{
		$prepAddr = str_replace(' ', '+', $address);
		$geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
		$output = json_decode($geocode);
		$latitude = $output->results[0]->geometry->location->lat;
		$longitude = $output->results[0]->geometry->location->lng;

		return $latitude.','.$longitude;
	}

	public function f2c($temp)
	{
		return 5/9*($temp-32);
	}

	public function c2f($temp)
	{
		return $temp*9/5+32;
	}
}
