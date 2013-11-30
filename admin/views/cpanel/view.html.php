<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.6.2   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		Geo Events
* @subpackage	Cpanel
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
* HTML View class for the Geoevents component
*
* @package	Geoevents
* @subpackage	Cpanel
*/
class GeoeventsCkViewCpanel extends GeoeventsClassView
{
	/**
	* Execute and display a template script.
	*
	* @access	public
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*
	* @since	11.1
	*/
	public function display($tpl = null)
	{
		$layout = $this->getLayout();
		if (!in_array($layout, array('default')))
			JError::raiseError(0, $layout . ' : ' . JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'));

		$fct = "display" . ucfirst($layout);

		$this->addForkTemplatePath();
		$this->$fct($tpl);			
		$this->_parentDisplay($tpl);
	}

	/**
	* Execute and display a template : Geo Events
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*
	* @since	11.1
	*/
	protected function displayDefault($tpl = null)
	{
		$document	= JFactory::getDocument();
		$this->title = JText::_("GEOEVENTS_LAYOUT_GEO_EVENTS");
		$document->title = $document->titlePrefix . $this->title . $document->titleSuffix;

		$this->menu = GeoeventsHelper::addSubmenu('cpanel', 'default', 'cpanel');
		//Toolbar initialization

		JToolBarHelper::title(JText::_('GEOEVENTS_LAYOUT_GEO_EVENTS'), 'geoevents_cpanel');

	}


}

// Search for a fork to be able to override this class
JLoader::register('GeoeventsViewCpanel', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'views' .DS. 'cpanel' .DS. 'view.html.php');
JLoader::load('GeoeventsViewCpanel'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('GeoeventsViewCpanel')){ class GeoeventsViewCpanel extends GeoeventsCkViewCpanel{} }

