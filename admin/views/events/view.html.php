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
* HTML View class for the Geoevents component
*
* @package	Geoevents
* @subpackage	Events
*/
class GeoeventsCkViewEvents extends GeoeventsClassView
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
	* Execute and display a template : Events
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
		$this->title = JText::_("GEOEVENTS_LAYOUT_EVENTS");
		$document->title = $document->titlePrefix . $this->title . $document->titleSuffix;

		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$state->set('context', 'events.default');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= GeoeventsHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('default.filters');
		$this->menu = GeoeventsHelper::addSubmenu('events', 'default');
		$lists = array();
		$this->lists = &$lists;

		

		//Filters
		// Sort by
		$filters['sortTable']->jdomOptions = array(
			'list' => $this->getSortFields('default')
		);

		// Limit
		$filters['limit']->jdomOptions = array(
			'pagination' => $this->pagination
		);

		//Toolbar initialization

		JToolBarHelper::title(JText::_('GEOEVENTS_LAYOUT_EVENTS'), 'geoevents_events');
		// New
		if ($model->canCreate())
			CkJToolBarHelper::addNew('event.add', "GEOEVENTS_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			CkJToolBarHelper::editList('event.edit', "GEOEVENTS_JTOOLBAR_EDIT");

		// Publish
		if ($model->canEditState())
			CkJToolBarHelper::publishList('events.publish', "GEOEVENTS_JTOOLBAR_PUBLISH");

		// Unpublish
		if ($model->canEditState())
			CkJToolBarHelper::unpublishList('events.unpublish', "GEOEVENTS_JTOOLBAR_UNPUBLISH");

		// Archive
		if ($model->canEditState())
			CkJToolBarHelper::archiveList('events.archive', "GEOEVENTS_JTOOLBAR_ARCHIVE");

		// Trash
		if ($model->canEditState())
			CkJToolBarHelper::trash('events.trash', "GEOEVENTS_JTOOLBAR_TRASH");

		// Delete
		if ($model->canDelete())
			CkJToolBarHelper::deleteList(JText::_('GEOEVENTS_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'event.delete', "GEOEVENTS_JTOOLBAR_DELETE");

		// Config
		if ($model->canAdmin())
			CkJToolBarHelper::preferences('com_geoevents');
	}

	/**
	* Execute and display a template : Events
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
		$this->title = JText::_("GEOEVENTS_LAYOUT_EVENTS");
		$document->title = $document->titlePrefix . $this->title . $document->titleSuffix;

		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$state->set('context', 'events.modal');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= GeoeventsHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$this->filters = $filters = $model->getForm('modal.filters');
		$this->menu = GeoeventsHelper::addSubmenu('events', 'modal');
		$lists = array();
		$this->lists = &$lists;

		

		//Filters
		// Limit
		$filters['limit']->jdomOptions = array(
			'pagination' => $this->pagination
		);

		//Toolbar initialization

		JToolBarHelper::title(JText::_('GEOEVENTS_LAYOUT_EVENTS'), 'geoevents_events');

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
			'a.title' => JText::_('GEOEVENTS_FIELD_TITLE'),
			'a.start_time' => JText::_('GEOEVENTS_FIELD_START_TIME'),
			'a.end_time' => JText::_('GEOEVENTS_FIELD_END_TIME'),
			'a.published' => JText::_('GEOEVENTS_FIELD_STATUS'),
			'a.ordering' => JText::_('GEOEVENTS_FIELD_ORDERING'),
			'_access_.title' => JText::_('GEOEVENTS_FIELD_ACCESS'),
			'_created_by_.name' => JText::_('GEOEVENTS_FIELD_CREATED_BY'),
			'a.creation_date' => JText::_('GEOEVENTS_FIELD_CREATION_DATE')
		);
	}


}

// Search for a fork to be able to override this class
JLoader::register('GeoeventsViewEvents', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'views' .DS. 'events' .DS. 'view.html.php');
JLoader::load('GeoeventsViewEvents'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('GeoeventsViewEvents')){ class GeoeventsViewEvents extends GeoeventsCkViewEvents{} }

