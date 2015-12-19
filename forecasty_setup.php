<?php
/*
 * Forecasty - A weather plugin for e107
 *
 * Copyright (C) 2015 Patrick Weaver (http://trickmod.com/)
 * For additional information refer to the README.md file.
 *
 */
class forecasty_setup
{
	function install_pre($var)
	{
	}

	function install_post($var)
	{
/*		$query = "
		INSERT INTO `#forecasty_oneliners` (`id`, `line`, `condition`, `vulgarity`) VALUES
			(1, '', 'clear-day', 'low'),
			(2, '', 'clear-night', 'low'),
			(3, '', 'rain', 'low'),
			(4, '', 'snow', 'low'),
			(5, '', 'sleet', 'low'),
			(6, '', 'wind', 'low'),
			(7, '', 'fog', 'low'),
			(8, '', 'cloudy', 'low'),
			(9, '', 'partly-cloudy-day', 'low'),
			(10, '', 'partly-cloudy-night', 'low'),		
			(11, '', 'clear-day', 'medium'),
			(12, '', 'clear-night', 'medium'),
			(13, '', 'rain', 'medium'),
			(14, '', 'snow', 'medium'),
			(15, '', 'sleet', 'medium'),
			(16, '', 'wind', 'medium'),
			(17, '', 'fog', 'medium'),
			(18, '', 'cloudy', 'medium'),
			(19, '', 'partly-cloudy-day', 'medium'),
			(20, '', 'partly-cloudy-night', 'medium'),		
			(21, '', 'clear-day', 'high'),
			(22, '', 'clear-night', 'high'),
			(23, '', 'rain', 'high'),
			(24, '', 'snow', 'high'),
			(25, '', 'sleet', 'high'),
			(26, '', 'wind', 'high'),
			(27, '', 'fog', 'high'),
			(28, '', 'cloudy', 'high'),
			(29, '', 'partly-cloudy-day', 'high'),
			(30, '', 'partly-cloudy-night', 'high')		
		";

		$status = (e107::getDb()->gen($query)) ? E_MESSAGE_SUCCESS : E_MESSAGE_ERROR;
e107::getMessage()->add("Add Oneliners", $status);

 */
	}

	function uninstall_pre($var)
	{
	}

	function upgrade_post($needed)
	{
	}
}
