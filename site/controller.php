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
* Geoevents Controller.
*
* @package	Geoevents
* @subpackage	Controller.
*/
class GeoeventsCkController extends GeoeventsClassController
{
	/**
	* The default view.
	*
	* @var string
	*/
	protected $default_view = 'cpanel';

	/**
	* Method to display a view.
	*
	* @access	public
	* @param	boolean	$cachable	If true, the view output will be cached.
	* @param	array	$urlparams	An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}..
	* @return	void
	*
	* @since	Cook 1.0
	*/
	public function display($cachable = false, $urlparams = false)
	{
		$jinput = JFactory::getApplication()->input;

		$this->_parentDisplay();

		//If page is called through POST, reconstruct the url
		if ($jinput->getMethod(null, null) == 'POST')
		{
			//Kill the post and rebuild the url
			$this->setRedirect(GeoeventsHelper::urlRequest());
			return;
		}

		return $this;
	}


}

// Search for a fork to be able to override this class
JLoader::register('GeoeventsController', JPATH_SITE_GEOEVENTS .DS. 'fork' .DS. 'controller.php');
JLoader::load('GeoeventsController'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('GeoeventsController')){ class GeoeventsController extends GeoeventsCkController{} }

