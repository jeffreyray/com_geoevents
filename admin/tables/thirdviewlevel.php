<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.6.2   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		Geo Events
* @subpackage	Viewlevels
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
* @subpackage	Viewlevel
*/
class GeoeventsCkTableThirdviewlevel extends GeoeventsClassTable
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
	public function __construct(&$db, $tbl = '#__viewlevels', $key = 'id')
	{
		parent::__construct($tbl, $key, $db);
	}


}

// Search for a fork to be able to override this class
JLoader::register('GeoeventsTableThirdviewlevel', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'tables' .DS. 'thirdviewlevel.php');
JLoader::load('GeoeventsTableThirdviewlevel'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('GeoeventsTableThirdviewlevel')){ class GeoeventsTableThirdviewlevel extends GeoeventsCkTableThirdviewlevel{} }

