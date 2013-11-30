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
* Geoevents List Model
*
* @package	Geoevents
* @subpackage	Classes
*/
class GeoeventsCkModelVendorapplications extends GeoeventsClassModelList
{
	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'vendorapplication';

	/**
	* Constructor
	*
	* @access	public
	* @param	array	$config	An optional associative array of configuration settings.
	* @return	void
	*/
	public function __construct($config = array())
	{
		//Define the sortables fields (in lists)
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'vendor_name', 'a.vendor_name',
				'_user_name', '_user_.name',
				'store_type', 'a.store_type',
				'frontage', 'a.frontage',
				'number_of_workers', 'a.number_of_workers',
				'indigenous', 'a.indigenous',
				'fee', 'a.fee',
				'approved', 'a.approved',
				'creation_date', 'a.creation_date',

			);
		}

		//Define the filterable fields
		$this->set('filter_vars', array(
			'published' => 'cmd',
			'event' => 'cmd',
			'store_type' => 'varchar',
			'frontage' => 'varchar',
			'indigenous' => 'cmd',
			'approved' => 'cmd',
			'sortTable' => 'cmd',
			'directionTable' => 'cmd',
			'limit' => 'cmd'
				));


		parent::__construct($config);
		
	}

	/**
	* Method to get a list of items.
	*
	* @access	public
	*
	* @return	mixed	An array of data items on success, false on failure.
	*
	* @since	11.1
	*/
	public function getItems()
	{

		$items	= parent::getItems();
		$app	= JFactory::getApplication();


		$this->populateParams($items);

		//Create linked objects
		$this->populateObjects($items);

		return $items;
	}

	/**
	* Method to get the layout (including default).
	*
	* @access	public
	*
	* @return	string	The layout alias.
	*/
	public function getLayout()
	{
		$jinput = JFactory::getApplication()->input;
		return $jinput->get('layout', 'default', 'STRING');
	}

	/**
	* Method to get a store id based on model configuration state.
	* 
	* This is necessary because the model is used by the component and different
	* modules that might need different sets of data or differen ordering
	* requirements.
	*
	* @access	protected
	* @param	string	$id	A prefix for the store id.
	* @return	void
	*
	* @since	1.6
	*/
	protected function getStoreId($id = '')
	{
		// Compile the store id.










		return parent::getStoreId($id);
	}

	/**
	* Method to auto-populate the model state.
	* 
	* This method should only be called once per instantiation and is designed to
	* be called on the first call to the getState() method unless the model
	* configuration flag to ignore the request is set.
	* 
	* Note. Calling getState in this method will result in recursion.
	*
	* @access	public
	* @param	string	$ordering	
	* @param	string	$direction	
	* @return	void
	*
	* @since	11.1
	*/
	public function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication();
		$session = JFactory::getSession();
		$acl = GeoeventsHelper::getActions();

		parent::populateState('a.event', 'asc');

		//Only show the published items
		if (!$acl->get('core.admin') && !$acl->get('core.edit.state'))
			$this->setState('filter.published', 1);
	}

	/**
	* Preparation of the list query.
	*
	* @access	protected
	* @param	object	&$query	returns a filled query object.
	* @return	void
	*/
	protected function prepareQuery(&$query)
	{

		$acl = GeoeventsHelper::getActions();

		//FROM : Main table
		$query->from('#__geoevents_vendorapplications AS a');



		//IMPORTANT REQUIRED FIELDS
		$this->addSelect(	'a.id,'
						.	'a.checked_out,'
						.	'a.created_by,'
						.	'a.published');

		switch($this->getState('context', 'all'))
		{
			case 'vendorapplications.default':

				//BASE FIELDS
				$this->addSelect(	'a.approved,'
								.	'a.checked_out_time,'
								.	'a.creation_date,'
								.	'a.fee,'
								.	'a.frontage,'
								.	'a.indigenous,'
								.	'a.number_of_workers,'
								.	'a.products,'
								.	'a.store_type,'
								.	'a.user,'
								.	'a.vendor_name');

				//SELECT
				$this->addSelect('_user_.name AS `_user_name`');
				$this->addSelect('_checked_out_.name AS `_checked_out_name`');

				//JOIN
				$this->addJoin('`#__users` AS _user_ ON _user_.id = a.user', 'LEFT');
				$this->addJoin('`#__users` AS _checked_out_ ON _checked_out_.id = a.checked_out', 'LEFT');

				break;

			case 'vendorapplications.modal':

				//BASE FIELDS
				$this->addSelect(	'a.checked_out_time,'
								.	'a.event');

				//SELECT
				$this->addSelect('_checked_out_.name AS `_checked_out_name`');

				//JOIN
				$this->addJoin('`#__users` AS _checked_out_ ON _checked_out_.id = a.checked_out', 'LEFT');

				break;
			case 'all':
				//SELECT : raw complete query without joins
				$this->addSelect('a.*');

				// Disable the pagination
				$this->setState('list.limit', null);
				$this->setState('list.start', null);
				break;
		}

		//FILTER - Access for : Root table
		$wherePublished = $allowAuthor = true;
		$whereAccess = false;
		$this->prepareQueryAccess('a', $whereAccess, $wherePublished, $allowAuthor);
		$query->where("($allowAuthor OR $wherePublished)");

		//WHERE - FILTER : Publish state
		$published = $this->getState('filter.published');
		if (is_numeric($published))
		{
			$allowAuthor = '';
			if (($published == 1) && !$acl->get('core.edit.state')) //ACL Limit to publish = 1
			{
				//Allow the author to see its own unpublished/archived/trashed items
				if ($acl->get('core.edit.own') || $acl->get('core.view.own'))
					$allowAuthor = ' OR a.created_by = ' . (int)JFactory::getUser()->get('id');
			}
			$query->where('(a.published = ' . (int) $published . $allowAuthor . ')');
		}
		elseif (!$published)
		{
			$query->where('(a.published = 0 OR a.published = 1 OR a.published IS NULL)');
		}

		//WHERE - FILTER : Event
		if((int)$this->getState('filter.event') > 0)
			$this->addWhere("a.event = " . (int)$this->getState('filter.event'));

		//WHERE - FILTER : Store type
		if($this->getState('filter.store_type') !== null)
			$this->addWhere("a.store_type = " . $this->_db->Quote($this->getState('filter.store_type')));

		//WHERE - FILTER : Frontage
		if($this->getState('filter.frontage') !== null)
			$this->addWhere("a.frontage = " . $this->_db->Quote($this->getState('filter.frontage')));

		//WHERE - FILTER : Indigenous
		if($this->getState('filter.indigenous') !== null)
			$this->addWhere("a.indigenous = " . (int)$this->getState('filter.indigenous'));

		//WHERE - FILTER : Approved
		if($this->getState('filter.approved') !== null)
			$this->addWhere("a.approved = " . (int)$this->getState('filter.approved'));

		//Populate only uniques strings to the query
		//SELECT
		foreach($this->getState('query.select', array()) as $select)
			$query->select($select);

		//JOIN
		foreach($this->getState('query.join.left', array()) as $join)
			$query->join('LEFT', $join);

		//WHERE
		foreach($this->getState('query.where', array()) as $where)
			$query->where($where);

		//GROUP ORDER : Prioritary order for groups in lists
		foreach($this->getState('query.groupOrder', array()) as $groupOrder)
			$query->order($groupOrder);

		//ORDER
		foreach($this->getState('query.order', array()) as $order)
			$query->order($order);

		//ORDER
		$orderCol = $this->getState('list.ordering');
		$orderDir = $this->getState('list.direction', 'asc');

		if ($orderCol)
			$query->order($orderCol . ' ' . $orderDir);
	}


}

// Search for a fork to be able to override this class
JLoader::register('GeoeventsModelVendorapplications', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'models' .DS. 'vendorapplications.php');
JLoader::load('GeoeventsModelVendorapplications'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('GeoeventsModelVendorapplications')){ class GeoeventsModelVendorapplications extends GeoeventsCkModelVendorapplications{} }

