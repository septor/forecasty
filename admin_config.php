<?php
/*
 * Forecasty - A weather plugin for e107
 *
 * Copyright (C) 2015 Patrick Weaver (http://trickmod.com/)
 * For additional information refer to the README.md file.
 *
 */
require_once('../../class2.php');
if (!getperms('P'))
{
	header('location:'.e_BASE.'index.php');
	exit;
}

class forecasty_adminArea extends e_admin_dispatcher
{
	protected $modes = array(
		'main'	=> array(
			'controller' 	=> 'forecasty_ui',
			'path' 			=> null,
			'ui' 			=> 'forecasty_form_ui',
			'uipath' 		=> null
		),
	);

	protected $adminMenu = array(
		'main/list'			=> array('caption' => 'Manage One Liners', 'perm' => 'P'),
		'main/create'		=> array('caption' => 'Create One Liner', 'perm' => 'P'),
		'main/prefs' 		=> array('caption' => LAN_PREFS, 'perm' => 'P'),
		'main/custom'		=> array('caption' => 'Get Location', 'perm' => 'P'),
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'
	);

	protected $menuTitle = 'forecasty';
}

class forecasty_ui extends e_admin_ui
{
	protected $pluginTitle		= 'Forecasty';
	protected $pluginName		= 'forecasty';
	protected $table			= 'forecasty_oneliners';
	protected $pid				= 'id';
	protected $perPage			= 10;
	protected $batchDelete		= true;
	protected $listOrder		= 'id DESC';

	protected $fields = array(
		'checkboxes' =>  array(
			'title' => '',
			'type' => null,
			'data' => null,
			'width' => '5%',
			'thclass' => 'center',
			'forced' => '1',
			'class' => 'center',
			'toggle' => 'e-multiselect',
		),
		'id' => array(
			'title' => LAN_ID,
			'data' => 'int',
			'width' => '5%',
			'help' => '',
			'readParms' => '',
			'writeParms' => '',
			'class' => 'left',
			'thclass' => 'left',
		),
		'line' => array(
			'title' => 'One Liner',
			'type' => 'text',
			'data' => 'str',
			'width' => 'auto',
			'inline' => true,
			'help' => 'A line used to describe the current weather condition.',
			'readParms' => '',
			'writeParms' => '',
			'class' => 'left',
			'thclass' => 'left',
		),
		'condition' => array(
			'title' => 'Weather Condition',
			'type' => 'dropdown',
			'data' => 'str',
			'width' => 'auto',
			'inline' => true,
			'help' => '',
			'readParms' => '',
			'writeParms' => array('optArray' => array(
				'clear-day' => 'Clear (day)',
				'clear-night' => 'Clear (night)',
				'rain' => 'Raining',
				'snow' => 'Snowing',
				'sleet' => 'Sleeting',
				'wind' => 'Windy',
				'fog' => 'Foggy',
				'cloudy' => 'cloudy',
				'partly-cloudy-day' => 'Partly Cloudy (day)',
				'partly-cloudy-night' => 'Partly Cloudy (night)',
			),
			'class' => 'left',
			'thclass' => 'left',
		),
		'vulgarity' => array(
			'title' => 'Vulgarity Level',
			'type' => 'dropdown',
			'data' => 'str',
			'width' => 'auto',
			'inline' => true,
			'help' => '',
			'readParms' => '',
			'writeParms' => array('optArray' => array(
				'low' => 'Low',
				'medium' => 'Medium',
				'high' => 'High',
			),
			'class' => 'left',
			'thclass' => 'left',
		),
	));

	protected $fieldpref = array();

	protected $prefs = array(
		'apiKey' => array(
			'title' => 'API Key',
			'type' => 'text',
			'data' => 'str',
			'help' => 'Your Dark Sky Forecast API Key.'
		),
		'fallbackLocation' => array(
			'title' => 'Fallback Location',
			'type' => 'text',
			'data' => 'str',
			'help' => 'The location you want displayed if your visitors do not show up.'
		),
		'tempType' => array(
			'title' => 'Temperature Type',
			'type' => 'dropdown',
			'data' => 'str',
			'help' => 'The unit used to measure the temperature, Fahrenheit (F) or Celsius (C).',
			'writeParms' => array('optArray' => array(
				'F' => 'Fahrenheit',
				'C' => 'Celsius',
			)),
		),
		'accuracy' => array(
			'title' => 'Temperature Accuracy',
			'type' => 'dropdown',
			'data' => 'str',
			'help' => 'Do you want an exact temperature display or rounded?',
			'writeParms' => array('optArray' => array(
				'exact' => 'Exact Temperature',
				'round' => 'Rounded Temperature',
			)),
		),
		'tempThreshold'	=> array(
			'title' => 'Temperature Threshold',
			'type' => 'number',
			'data' => 'str',
			'help' => 'The temperature in which the plugin converts from hot to cold (or cold to hot).'
		),
		'hotColor' => array(
			'title' => 'Hot Hex Color',
			'type' => 'text',
			'data' => 'str',
			'help' => 'The color you want various elements displayed when the temperature is above the threshold.'
		),
		'coldColor'	=> array(
			'title' => 'Cold Hex Color',
			'type' => 'text',
			'data' => 'str',
			'help' => 'The color you want various elements displayed when the temperature is below the threshold.'
		),
		'vulgarity'	=> array(
			'title' => 'Vulgarity',
			'type' => 'dropdown',
			'data' => 'str',
			'help' => 'Based on your audiance, you may want a lower vulgarity displayed.',
			'writeParms' => array('optArray' => array(
				'low' => 'Low',
				'medium' => 'Medium',
				'high' => 'High',
			)),
		),
	);

	public function init()
	{
	}

	public function beforeCreate($new_data)
	{
		return $new_data;
	}

	public function afterCreate($new_data, $old_data, $id)
	{
	}

	public function onCreateError($new_data, $old_data)
	{
	}

	public function beforeUpdate($new_data, $old_data, $id)
	{
		return $new_data;
	}

	public function afterUpdate($new_data, $old_data, $id)
	{
	}

	public function onUpdateError($new_data, $old_data, $id)
	{
	}

	public function customPage()
	{
		// TODO: Utilize the URL instead of the local file.
		// First, I have to figure out why it won't load!
		e107::js('forecasty', 'assets/googlemaps.js', 'jquery');
		//		e107::js('url', 'http://maps.googleapis.com/maps/api/js?sensor=false');

		e107::js('forecasty', 'assets/jquery-gmaps-latlon-picker.js', 'jquery');
		e107::css('forecasty', 'assets/jquery-gmaps-latlon-picker.css');

		$text = '
		The below accepts many different formats of locations:
		<ul>
			<li>Zip Codes</li>
			<li>City, State</li>
			<li>City, Country</li>
			<li>State</li>
			<li>.. etc.</li>
		</ul>

		You can also fine tune your location by dragging and double clicking the map.
		<br /><br />
		<fieldset class="gllpLatlonPicker">
			<input type="text" class="gllpSearchField">
			<input type="button" class="gllpSearchButton" value="Search">
			<div class="gllpMap">Google Maps</div>
			Latitude: <input type="text" class="gllpLatitude" value="-76.61483160837915">
			<br />
			Longitude: <input type="text" class="gllpLongitude" value="19.218757152557373">
			<input type="hidden" class="gllpZoom" value="3">
		</fieldset>
		<br /><br />
		For your Fallback Location you need Latitude,Longitude in that exact format.<br /><br />

		This page will be updated to work, flow, and look better in the future.
		';
		return $text;
	}
}

class forecasty_form_ui extends e_admin_form_ui
{
}

new forecasty_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;
