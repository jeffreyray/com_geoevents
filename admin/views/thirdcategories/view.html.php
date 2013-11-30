<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.6.2   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		Geo Events
* @subpackage	Categories
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
* @subpackage	Categories
*/
class GeoeventsCkViewThirdcategories extends GeoeventsClassView
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
		if (!in_array($layout, array('modal')))
			JError::raiseError(0, $layout . ' : ' . JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'));

		$fct = "display" . ucfirst($layout);

		$this->addForkTemplatePath();
		$this->$fct($tpl);			
		$this->_parentDisplay($tpl);
	}

	/**
	* Execute and display a template : Categories
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*
	* @since	11.1
	*/
	protected function displayModal($tpl = null)
	{
		$document	= JFactory::getDocument();
		$this->title = JText::_("GEOEVENTS_LAYOUT_CATEGORIES");
		$document->title = $document->titlePrefix . $this->title . $document->titleSuffix;

		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$state->set('context', 'thirdcategories.modal');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= GeoeventsHelper::getActions();
		$this->pagination	= $this->get('Pagination');

		$this->menu = GeoeventsHelper::addSubmenu('categories', 'modal');
		$lists = array();
		$this->lists = &$lists;

		

		//Toolbar initialization

		JToolBarHelper::title(JText::_('GEOEVENTS_LAYOUT_CATEGORIES'), 'geoevents_categories');

	}

	/**
	* Returns an array of fields the table can be sorted by.
	*
	* @access	protected
	* @param	string	$layout	The name of the called layout. Not used yet
	*
	* @return	array	Array containing the field name to sort by as the key and display text as value.
	*
	* @since	3.0
	*/
	protected function getSortFields($layout = null)
	{
		return array();
	}


}

// Search for a fork to be able to override this class
JLoader::register('GeoeventsViewThirdcategories', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'views' .DS. 'thirdcategories' .DS. 'view.html.php');
JLoader::load('GeoeventsViewThirdcategories'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('GeoeventsViewThirdcategories')){ class GeoeventsViewThirdcategories extends GeoeventsCkViewThirdcategories{} }

