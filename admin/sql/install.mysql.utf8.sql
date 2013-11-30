CREATE TABLE IF NOT EXISTS `#__geoevents_events` (
	`id` int(11) NOT NULL auto_increment,
	`title` VARCHAR(255) NOT NULL ,
	`alias` VARCHAR(255) ,
	`start_time` DATETIME NOT NULL ,
	`end_time` DATETIME NOT NULL ,
	`location` VARCHAR(255) ,
	`ordering` INT(11) ,
	`published` INT(11) DEFAULT 0 ,
	`description` TEXT ,
	`access` INT(11) DEFAULT 1 ,
	`created_by` INT(11) ,
	`modified_by` INT(11) ,
	`creation_date` DATE ,
	`modification_date` DATE ,
	`checked_out` INT(11) NOT NULL DEFAULT 0 ,
	`checked_out_time` DATETIME ,

	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__geoevents_vendorapplications` (
	`id` int(11) NOT NULL auto_increment,
	`event` INT(11) NOT NULL ,
	`vendor_name` VARCHAR(255) NOT NULL ,
	`user` INT(11) NOT NULL ,
	`indigenous` TINYINT NOT NULL DEFAULT 0 ,
	`store_type` VARCHAR(255) NOT NULL ,
	`frontage` VARCHAR(255) NOT NULL DEFAULT '3' ,
	`electricity` TINYINT DEFAULT 0 ,
	`number_of_workers` INT(11) NOT NULL ,
	`products` TEXT ,
	`offer_work_shop` TINYINT NOT NULL DEFAULT 0 ,
	`description` TEXT NOT NULL ,
	`comments` TEXT ,
	`agree_to_conditions` TINYINT NOT NULL DEFAULT 0 ,
	`published` INT(11) DEFAULT 1 ,
	`fee` DECIMAL(6,2 ) DEFAULT 0 ,
	`approved` TINYINT DEFAULT 0 ,
	`creation_date` DATE ,
	`modification_date` DATE ,
	`created_by` INT(11) ,
	`modified_by` INT(11) ,
	`checked_out` INT(11) NOT NULL DEFAULT 0 ,
	`checked_out_time` DATETIME ,

	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__geoevents_volunteerapplications` (
	`id` int(11) NOT NULL auto_increment,

	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



