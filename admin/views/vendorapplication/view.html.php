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
* @subpackage	Vendorapplication
*/
class GeoeventsCkViewVendorapplication extends GeoeventsClassView
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
		if (!in_array($layout, array('edit')))
			JError::raiseError(0, $layout . ' : ' . JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'));

		$fct = "display" . ucfirst($layout);

		$this->addForkTemplatePath();
		$this->$fct($tpl);			
		$this->_parentDisplay($tpl);
	}

	/**
	* Execute and display a template : Vendor Application
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*
	* @since	11.1
	*/
	protected function displayEdit($tpl = null)
	{
		$document	= JFactory::getDocument();
		$this->title = JText::_("GEOEVENTS_LAYOUT_VENDOR_APPLICATION");
		$document->title = $document->titlePrefix . $this->title . $document->titleSuffix;

		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$state->set('context', 'vendorapplication.edit');
		$this->item		= $item		= $this->get('Item');
		$this->form		= $form		= $this->get('Form');
		$this->canDo	= $canDo	= GeoeventsHelper::getActions($model->getId());
		$lists = array();
		$this->lists = &$lists;

		$user		= JFactory::getUser();
		$isNew		= ($model->getId() == 0);

		//Check out the item.
		if (!$isNew)
			$model->checkout($model->getId());


		//Check ACL before opening the form (prevent from direct access)
		if (!$model->canEdit($item, true))
			$model->setError(JText::_('JERROR_ALERTNOAUTHOR'));

		// Check for errors.
		if (count($errors = $model->getErrors()))
		{
			JError::raiseError(500, implode(BR, array_unique($errors)));
			return false;
		}
		$jinput = JFactory::getApplication()->input;

		//Hide the component menu in item layout
		$jinput->set('hidemainmenu', true);

		//Toolbar initialization

		JToolBarHelper::title(JText::_('GEOEVENTS_LAYOUT_VENDOR_APPLICATION'), 'geoevents_vendorapplications');
		// Save
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			CkJToolBarHelper::apply('vendorapplication.apply', "GEOEVENTS_JTOOLBAR_SAVE");
		// Save & Close
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			CkJToolBarHelper::save('vendorapplication.save', "GEOEVENTS_JTOOLBAR_SAVE_CLOSE");
		// Save & New
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			CkJToolBarHelper::save2new('vendorapplication.save2new', "GEOEVENTS_JTOOLBAR_SAVE_NEW");
		// Save to Copy
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			CkJToolBarHelper::save2copy('vendorapplication.save2copy', "GEOEVENTS_JTOOLBAR_SAVE_TO_COPY");
		// Cancel
		CkJToolBarHelper::cancel('vendorapplication.cancel', "GEOEVENTS_JTOOLBAR_CANCEL");
		$lists['enum']['vendorapplications.store_type'] = GeoeventsHelper::enumList('vendorapplications', 'store_type');

		$lists['enum']['vendorapplications.frontage'] = GeoeventsHelper::enumList('vendorapplications', 'frontage');

		$model_event = CkJModel::getInstance('Events', 'GeoeventsModel');
		$model_event->addGroupOrder("a.title");
		$lists['fk']['event'] = $model_event->getItems();

		$model_user = CkJModel::getInstance('ThirdUsers', 'GeoeventsModel');
		$model_user->addGroupOrder("a.name");
		$lists['fk']['user'] = $model_user->getItems();

		//Store type
		$lists['select']['store_type'] = new stdClass();
		$lists['select']['store_type']->list = $lists['enum']['vendorapplications.store_type'];
		$lists['select']['store_type']->value = $item->store_type;

		//Frontage
		$lists['select']['frontage'] = new stdClass();
		$lists['select']['frontage']->list = $lists['enum']['vendorapplications.frontage'];
		$lists['select']['frontage']->value = $item->frontage;

		$model_created_by = CkJModel::getInstance('ThirdUsers', 'GeoeventsModel');
		$model_created_by->addGroupOrder("a.name");
		$lists['fk']['created_by'] = $model_created_by->getItems();
	}


}

// Search for a fork to be able to override this class
JLoader::register('GeoeventsViewVendorapplication', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'views' .DS. 'vendorapplication' .DS. 'view.html.php');
JLoader::load('GeoeventsViewVendorapplication'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('GeoeventsViewVendorapplication')){ class GeoeventsViewVendorapplication extends GeoeventsCkViewVendorapplication{} }

