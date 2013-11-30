<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.6.2   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		Geo Events
* @subpackage	
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
* Geoevents  Controller
*
* @package	Geoevents
* @subpackage	
*/
class GeoeventsCkClassController extends CkJController
{
	/**
	* Call the parent display function. Trick for forking overrides.
	*
	* @access	protected
	* @return	void
	*
	* @since	Cook 2.0
	*/
	protected function _parentDisplay()
	{
		//Add the fork views path (LILO) instead of FIFO
		array_push($this->paths['view'], JPATH_COMPONENT . DS. 'fork' .DS. 'views');

		parent::display();
	}


}

// Search for a fork to be able to override this class
JLoader::register('GeoeventsClassController', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'classes' .DS. 'controller.php');
JLoader::load('GeoeventsClassController'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('GeoeventsClassController')){ class GeoeventsClassController extends GeoeventsCkClassController{} }

