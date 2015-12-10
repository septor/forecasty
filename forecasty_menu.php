<?php
/*
 * Forecasty - A weather plugin for e107
 *
 * Copyright (C) 2015 Patrick Weaver (http://trickmod.com/)
 * For additional information refer to the README.md file.
 *
 */
if (!defined('e107_INIT')) { exit; }
require_once(e_PLUGIN.'forecasty/_class.php');
$pref = e107::pref('forecasty');
$tp = e107::getParser();
$sc = e107::getScBatch('forecasty', true);
$template = e107::getTemplate('forecasty');

// TODO: Gather the visitors location if they are a memeber, if not, utilize the fallbackLocation.
$location = $pref['fallbackLocation'];

$wf = new Forecasty($pref['apiKey'], $location);

$current = $wf->getData('current');
$hour = $wf->getData('nexthour');
$day = $wf->getData('nextday');
$week = $wf->getData('nextweek');

$sc->setVars(array(
	'current' => array(
		'temperature' => $current['temperature'],
		'feelsLike' => $current['feelsLike'],
		'condition' => $current['condition'],
		'humidity' => $current['humidity'],
		'windSpeed' => $current['windSpeed'],
		'visibility' => $current['visibility'],
		'pressure' => $current['pressure'],
		'dewPoint' => $current['dewPoint'],
	),
	'nexthour' => array(
		'temperature' => $hour['temperature'],
		'feelsLike' => $hour['feelsLike'],
		'condition' => $hour['condition'],
		'humidity' => $hour['humidity'],
		'windSpeed' => $hour['windSpeed'],
		'visibility' => $hour['visibility'],
		'pressure' => $hour['pressure'],
		'dewPoint' => $hour['dewPoint'],
	),
	'nextday' => array(
		'temperature' => $day['temperature'],
		'feelsLike' => $day['feelsLike'],
		'condition' => $day['condition'],
		'humidity' => $day['humidity'],
		'windSpeed' => $day['windSpeed'],
		'visibility' => $day['visibility'],
		'pressure' => $day['pressure'],
		'dewPoint' => $day['dewPoint'],
	),
	'nextweek' => array(
		'temperature' => $week['temperature'],
		'feelsLike' => $week['feelsLike'],
		'condition' => $week['condition'],
		'humidity' => $week['humidity'],
		'windSpeed' => $week['windSpeed'],
		'visibility' => $week['visibility'],
		'pressure' => $week['pressure'],
		'dewPoint' => $week['dewPoint'],
	),
));

$text = $tp->parseTemplate($template['menu'], false, $sc);
e107::getRender()->tablerender('Weather', $text);
