<?php
/*
 * Forecasty - A weather plugin for e107
 *
 * Copyright (C) 2015 Patrick Weaver (http://trickmod.com/)
 * For additional information refer to the README.md file.
 *
 */
class forecasty_shortcodes extends e_shortcode
{
	function sc_forecasty_temperature($parm='')
	{
		$output = ($pref['accuracy'] == 'round' ? round($this->var['temperature']) : $this->var['temperature']);
		return $output;
	}

	function sc_forecasty_feelslike($parm='')
	{
		$output = ($pref['accuracy'] == 'round' ? round($this->var['feelsLike']) : $this->var['feelsLike']);
		return $output;
	}

	function sc_forecasty_condition($parm='')
	{
		return $this->var['condition'];
	}

	function sc_forecasty_humidity($parm='')
	{
		return $this->var['humidity'];
	}

	function sc_forecasty_windspeed($parm='')
	{
		return $this->var['windSpeed'];
	}

	function sc_forecasty_visibility($parm='')
	{
		return $this->var['visibility'];
	}

	function sc_forecasty_pressure($parm='')
	{
		return $this->var['pressure'];
	}

	function sc_forecasty_dewpoint($parm='')
	{
		return $this->var['dewPoint'];
	}
}
