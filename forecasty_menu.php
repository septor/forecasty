<?php
/*
 * Forecasty - A weather plugin for e107
 *
 * Copyright (C) 2015 Patrick Weaver (http://trickmod.com/)
 * For additional information refer to the README.md file.
 *
 */
if (!defined('e107_INIT')) { exit; }
require_once(e_PLUGIN.'forecasty/lib.php');
$pref = e107::pref('forecasty');
$tp = e107::getParser();
$sc = e107::getScBatch('forecasty', true);
$template = e107::getTemplate('forecasty');

// TODO: Gather the visitors location if they are a memeber, if not, utilize the fallbackLocation.
$location = $pref['fallbackLocation'];
$weather = json_decode(file_get_contents('https://api.forecast.io/forecast/'.$pref['apiKey'].'/'.$location));
$current = $weather->currently;

$sc->setVars(array(
	'temperature' => $current->temperature,
	'feelsLike' => $current->apparentTemperature,
	'condition' => $current->summary,
	'humidity' => $current->humidity,
	'windSpeed' => $current->windSpeed,
	'visibility' => $current->visibility,
	'pressure' => $current->pressure,
	'dewPoint' => $current->dewPoint,
));

$text = $tp->parseTemplate($template['menu'], false, $sc);
e107::getRender()->tablerender('Weather', $text);
