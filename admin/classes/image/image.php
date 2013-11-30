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
* Images Class for Geoevents.
*
* @package	Geoevents
* @subpackage	Class
*/
class GeoeventsCkClassImage extends GeoeventsImages
{

}

// Search for a fork to be able to override this class
JLoader::register('GeoeventsClassImage', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'classes' .DS. 'image' .DS. 'image.php');
JLoader::load('GeoeventsClassImage'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('GeoeventsClassImage')){ class GeoeventsClassImage extends GeoeventsCkClassImage{} }

