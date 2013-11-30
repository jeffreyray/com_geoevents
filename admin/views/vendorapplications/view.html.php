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
* HTML View class for the Geoevents component
*
* @package	Geoevents
* @subpackage	Vendorapplications
*/
class GeoeventsCkViewVendorapplications extends GeoeventsClassView
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
		if (!in_array($layout, array('default', 'modal')))
			JError::raiseError(0, $layout . ' : ' . JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'));

		$fct = "display" . ucfirst($layout);

		$this->addForkTemplatePath();
		$this->$fct($tpl);			
		$this->_parentDisplay($tpl);
	}

	/**
	* Execute and display a template : Vendor Applications
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
		$this->title = JText::_("GEOEVENTS_LAYOUT_VENDOR_APPLICATIONS");
		$document->title = $document->titlePrefix . $this->title . $document->titleSuffix;

		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$state->set('context', 'vendorapplications.default');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= GeoeventsHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('default.filters');
		$this->menu = GeoeventsHelper::addSubmenu('vendorapplications', 'default');
		$lists = array();
		$this->lists = &$lists;

		
		$lists['enum']['vendorapplications.store_type'] = GeoeventsHelper::enumList('vendorapplications', 'store_type');
		$lists['enum']['vendorapplications.frontage'] = GeoeventsHelper::enumList('vendorapplications', 'frontage');


		//Filters
		// Event > Title
		$modelEvent = CkJModel::getInstance('events', 'GeoeventsModel');
		$filters['filter_event']->jdomOptions = array(
			'list' => $modelEvent->getItems()
		);

		// Store type
		$filters['filter_store_type']->jdomOptions = array(
			'list' => GeoeventsHelper::enumList('vendorapplications', 'store_type')
		);

		// Frontage
		$filters['filter_frontage']->jdomOptions = array(
			'list' => GeoeventsHelper::enumList('vendorapplications', 'frontage')
		);

		// Sort by
		$filters['sortTable']->jdomOptions = array(
			'list' => $this->getSortFields('default')
		);

		// Limit
		$filters['limit']->jdomOptions = array(
			'pagination' => $this->pagination
		);

		//Toolbar initialization

		JToolBarHelper::title(JText::_('GEOEVENTS_LAYOUT_VENDOR_APPLICATIONS'), 'geoevents_vendorapplications');
		// New
		if ($model->canCreate())
			CkJToolBarHelper::addNew('vendorapplication.add', "GEOEVENTS_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			CkJToolBarHelper::editList('vendorapplication.edit', "GEOEVENTS_JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			CkJToolBarHelper::deleteList(JText::_('GEOEVENTS_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'vendorapplication.delete', "GEOEVENTS_JTOOLBAR_DELETE");

		// Archive
		if ($model->canEditState())
			CkJToolBarHelper::archiveList('vendorapplications.archive', "GEOEVENTS_JTOOLBAR_ARCHIVE");

		// Trash
		if ($model->canEditState())
			CkJToolBarHelper::trash('vendorapplications.trash', "GEOEVENTS_JTOOLBAR_TRASH");

		// Config
		if ($model->canAdmin())
			CkJToolBarHelper::preferences('com_geoevents');
	}

	/**
	* Execute and display a template : Vendor Applications
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
		$this->title = JText::_("GEOEVENTS_LAYOUT_VENDOR_APPLICATIONS");
		$document->title = $document->titlePrefix . $this->title . $document->titleSuffix;

		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$state->set('context', 'vendorapplications.modal');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= GeoeventsHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('modal.filters');
		$this->menu = GeoeventsHelper::addSubmenu('vendorapplications', 'modal');
		$lists = array();
		$this->lists = &$lists;

		
		$lists['enum']['vendorapplications.store_type'] = GeoeventsHelper::enumList('vendorapplications', 'store_type');
		$lists['enum']['vendorapplications.frontage'] = GeoeventsHelper::enumList('vendorapplications', 'frontage');


		//Filters
		// Event > Title
		$modelEvent = CkJModel::getInstance('events', 'GeoeventsModel');
		$filters['filter_event']->jdomOptions = array(
			'list' => $modelEvent->getItems()
		);

		// Store type
		$filters['filter_store_type']->jdomOptions = array(
			'list' => GeoeventsHelper::enumList('vendorapplications', 'store_type')
		);

		// Frontage
		$filters['filter_frontage']->jdomOptions = array(
			'list' => GeoeventsHelper::enumList('vendorapplications', 'frontage')
		);

		// Limit
		$filters['limit']->jdomOptions = array(
			'pagination' => $this->pagination
		);

		//Toolbar initialization

		JToolBarHelper::title(JText::_('GEOEVENTS_LAYOUT_VENDOR_APPLICATIONS'), 'geoevents_vendorapplications');

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
		return array(
			'a.vendor_name' => JText::_('GEOEVENTS_FIELD_VENDOR_NAME'),
			'_user_.name' => JText::_('GEOEVENTS_FIELD_NAME'),
			'a.store_type' => JText::_('GEOEVENTS_FIELD_STORE_TYPE'),
			'a.frontage' => JText::_('GEOEVENTS_FIELD_FRONTAGE'),
			'a.number_of_workers' => JText::_('GEOEVENTS_FIELD_NUMBER_OF_WORKERS'),
			'a.indigenous' => JText::_('GEOEVENTS_FIELD_INDIGENOUS'),
			'a.fee' => JText::_('GEOEVENTS_FIELD_FEE'),
			'a.approved' => JText::_('GEOEVENTS_FIELD_APPROVED'),
			'a.creation_date' => JText::_('GEOEVENTS_FIELD_CREATION_DATE')
		);
	}


}

// Search for a fork to be able to override this class
JLoader::register('GeoeventsViewVendorapplications', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'views' .DS. 'vendorapplications' .DS. 'view.html.php');
JLoader::load('GeoeventsViewVendorapplications'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('GeoeventsViewVendorapplications')){ class GeoeventsViewVendorapplications extends GeoeventsCkViewVendorapplications{} }

