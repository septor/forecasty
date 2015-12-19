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

	function sc_icon($parm)
	{
		$pref = e107::pref('forecasty');

		$type = (empty($parm['type']) ? 'current' : $parm['type']);
		$height = (empty($parm['height']) ? '82px' : $parm['height']);
		$width = (empty($parm['width']) ? '82px' : $parm['width']);

		$iconSet = (isset($pref['iconSet']) ? $pref['iconSet'] : 'Climacons');
		$isp = e_PLUGIN.'forecasty/icons/'.$iconSet.'/';
		require_once($isp.'icon_set.php');

		if(!in_array($type, $this->types))
			$type = 'current';

		return '<img src="'.$isp.$this->var[$type]['icon'].'.'.$format.'" style="height:'.$height.'; width:'.$width.';" />';
	}


	function sc_condition($parm)
	{
		$type = (empty($parm['type']) ? 'current' : $parm['type']);

		if(!in_array($type, $this->types))
			$type = 'current';

		return $this->var[$type]['condition'];
	}

	function sc_oneliner($parm='')
	{
		$sql = e107::getDb();

		$icon = $this->var['current']['icon'];

		$oneliners = $sql->retrieve('forecasty_oneliners', '*', "`condition`='".$icon."' AND `vulgarity`='".e107::pref('forecasty', 'vulgarity')."'", true);

		return $oneliners[array_rand($oneliners)]['line'];
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
