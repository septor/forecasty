CREATE TABLE forecasty_oneliners (
	`id` int(10) unsigned NOT NULL auto_increment,
	`line` varchar(250) NOT NULL,
	`condition` varchar(250) NOT NULL,
	`vulgarity` varchar(250) NOT NULL,
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1;
