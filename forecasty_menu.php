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
$hour = $wf->getData('hour');
$day = $wf->getData('day');
$week = $wf->getData('week');

$sc->setVars(array(
	'temperature' => $current['temperature'],
	'feelsLike' => $current['feelsLike'],
	'condition' => $current['condition'],
	'humidity' => $current['humidity'],
	'windSpeed' => $current['windSpeed'],
	'visibility' => $current['visibility'],
	'pressure' => $current['pressure'],
	'dewPoint' => $current['dewPoint'],
));

$text = $tp->parseTemplate($template['menu'], false, $sc);
e107::getRender()->tablerender('Weathedsadar', $text);
