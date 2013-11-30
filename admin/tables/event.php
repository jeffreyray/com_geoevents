<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.6.2   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		Geo Events
* @subpackage	Events
* @copyright	2013 GeoParadise.org
* @author		Jeffrey Ray - geoparadise.org - geolab@geoparadise.org
* @license		All rights reserved.
*
*             .oooO  Oooo.
*             (   )  (   )
* -------------\ (----) /----------------------------------------------------------- +
*               \_)  (_/
*/

// no direct access
defined('_JEXEC') or die('Restricted access');



/**
* Geoevents Table class
*
* @package	Geoevents
* @subpackage	Event
*/
class GeoeventsCkTableEvent extends GeoeventsClassTable
{
	/**
	* Constructor
	*
	* @access	public
	* @param	object	&$db	Database connector object
	* @param	string	$tbl	Table name
	* @param	string	$key	Primary key
	* @return	void
	*/
	public function __construct(&$db, $tbl = '#__geoevents_events', $key = 'id')
	{
		parent::__construct($tbl, $key, $db);
	}


}

// Search for a fork to be able to override this class
JLoader::register('GeoeventsTableEvent', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'tables' .DS. 'event.php');
JLoader::load('GeoeventsTableEvent'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('GeoeventsTableEvent')){ class GeoeventsTableEvent extends GeoeventsCkTableEvent{} }

