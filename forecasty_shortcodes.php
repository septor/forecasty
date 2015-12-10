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
	public $types = array('current', 'nexthour', 'nextday', 'nextweek');

	function sc_temperature($parm)
	{
		$type = (empty($parm['type']) ? 'current' : $parm['type']);
		if(!in_array($type, $this->types))
			$type = 'current';

		$output = ($pref['accuracy'] == 'round' ? round($this->var[$type]['temperature']) : $this->var[$type]['temperature']);

		return $output;
	}

	function sc_feelslike($parm)
	{
		$type = (empty($parm['type']) ? 'current' : $parm['type']);

		if(!in_array($type, $this->types))
			$type = 'current';

		$output = ($pref['accuracy'] == 'round' ? round($this->var[$type]['feelsLike']) : $this->var[$type]['feelsLike']);

		return $output;
	}

	function sc_condition($parm)
	{
		$type = (empty($parm['type']) ? 'current' : $parm['type']);

		if(!in_array($type, $this->types))
			$type = 'current';

		return $this->var[$type]['condition'];
	}

	function sc_humidity($parm)
	{
		$type = (empty($parm['type']) ? 'current' : $parm['type']);

		if(!in_array($type, $this->types))
			$type = 'current';

		return $this->var[$type]['humidity'];
	}

	function sc_windspeed($parm)
	{
		$type = (empty($parm['type']) ? 'current' : $parm['type']);

		if(!in_array($type, $this->types))
			$type = 'current';

		return $this->var[$type]['windSpeed'];
	}

	function sc_visibility($parm)
	{
		$type = (empty($parm['type']) ? 'current' : $parm['type']);

		if(!in_array($type, $this->types))
			$type = 'current';

		return $this->var[$type]['visibility'];
	}

	function sc_pressure($parm)
	{
		$type = (empty($parm['type']) ? 'current' : $parm['type']);

		if(!in_array($type, $this->types))
			$type = 'current';

		return $this->var[$type]['pressure'];
	}

	function sc_dewpoint($parm)
	{
		$type = (empty($parm['type']) ? 'current' : $parm['type']);

		if(!in_array($type, $this->types))
			$type = 'current';

		return $this->var[$type]['dewPoint'];
	}
}
