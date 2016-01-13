# Forecasty

[![Join the chat at https://gitter.im/septor/forecasty](https://badges.gitter.im/septor/forecasty.svg)](https://gitter.im/septor/forecasty?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

Ever needed a weather plugin with a little bit of attitude? Of course giving people the weather is great, but why not make it fun for them? Guess what, now you can!

## Forecast.io API

Forecasty uses Forecast.io's API. In order to use Forecasty you need to register a dev account on the [forecast.io](https://developer.forecast.io/register) developer site and obtain an API token (don't share this with anyone!). You can ignore the "insert billing information" prompt if you don't plan on getting more than 1,000 requests a day. If you do plan on getting more than that it costs $1 for an additional 10,000 requests.

## Latitude,Longitude?

Yep, that's how locations are pushed to the API in order to get the relevant data back. There's code, though kind of buggy, that allows you to obtain a lat/long using a Google Maps like selecting method.

There's also a method for obtaining a lat/long based on address. You can do this by making an extended field and having the user enter the information if they want weather from where they are displayed instead of weather from what you set up.

## Requirements

The default icon set, [Climacons](http://adamwhitcroft.com/climacons/), is in SVG format. If you are using Internet Explorer you'll need to be on IE9+ and if you're using an Android based phone it will need to be running something higher than Gingerbread (2.3).

An alternative is to get a different icon set that isn't in SVG format if you don't want your users to have to worry about that.

## Icon Sets

If you don't like the default icon set you can add your own! The requirements for doing so are simple:

1. Upload your icons into the `/icons` directory in their own directory.
2. Make sure you have an icon to represent all the supported conditions (found below).
3. Include an `icon_set.php` file with the required variables (found below) inside the set's directory.

That's it. Now you just need to select it as your icon set in the preferences and you're good to go!

### Required Conditions

They should be named exactly as described below with your format prepending it; eg: `cloudy.png`

* clear-day
* clear-night
* rain
* snow
* sleet
* wind
* fog
* cloudy
* partly-cloudy-day
* partly-cloudy-night

This list could expand if the supported icons from the API gets increased.

### icon_set.php

Should be the in the following format:

```php
<?php
$name	= 'Climacons';
$author	= 'Adam Whitcroft';
$url	= 'http://adamwhitcroft.com/climacons/';
$format	= 'svg';
?>
```

The `$format` variable is *required* for the set to work, so make sure you include it.

## Default One Liners

Are auto installed when you install the plugin. If you want your one liner added to this list, you need to add to the [first issue](https://github.com/septor/forecasty/issues/1) with the requested information.
