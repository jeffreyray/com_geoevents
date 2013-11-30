<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.6.2   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		Geo Events
* @subpackage	Vendorapplications
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
* Geoevents Vendorapplications Controller
*
* @package	Geoevents
* @subpackage	Vendorapplications
*/
class GeoeventsCkControllerVendorapplications extends GeoeventsClassControllerList
{
	/**
	* The context for storing internal data, e.g. record.
	*
	* @var string
	*/
	protected $context = 'vendorapplications';

	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'vendorapplication';

	/**
	* The URL view list variable.
	*
	* @var string
	*/
	protected $view_list = 'vendorapplications';

	/**
	* Constructor
	*
	* @access	public
	* @param	array	$config	An optional associative array of configuration settings.
	* @return	void
	*/
	public function __construct($config = array())
	{
		parent::__construct($config);
		$app = JFactory::getApplication();

	}

	/**
	* Return the current layout.
	*
	* @access	protected
	* @param	bool	$default	If true, return the default layout.
	*
	* @return	string	Requested layout or default layout
	*/
	protected function getLayout($default = null)
	{
		if ($default)
			return 'default';

		$jinput = JFactory::getApplication()->input;
		return $jinput->get('layout', 'default', 'CMD');
	}


}

// Search for a fork to be able to override this class
JLoader::register('GeoeventsControllerVendorapplications', JPATH_SITE_GEOEVENTS .DS. 'fork' .DS. 'controllers' .DS. 'vendorapplications.php');
JLoader::load('GeoeventsControllerVendorapplications'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('GeoeventsControllerVendorapplications')){ class GeoeventsControllerVendorapplications extends GeoeventsCkControllerVendorapplications{} }

