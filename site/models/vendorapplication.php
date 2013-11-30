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
* Geoevents Item Model
*
* @package	Geoevents
* @subpackage	Classes
*/
class GeoeventsCkModelVendorapplication extends GeoeventsClassModelItem
{
	/**
	* View list alias
	*
	* @var string
	*/
	protected $view_item = 'vendorapplication';

	/**
	* View list alias
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
		parent::__construct();
	}

	/**
	* Method to delete item(s).
	*
	* @access	public
	* @param	array	&$pks	Ids of the items to delete.
	*
	* @return	boolean	True on success.
	*/
	public function delete(&$pks)
	{
		if (!count( $pks ))
			return true;


		if (!parent::delete($pks))
			return false;



		return true;
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
		return $jinput->get('layout', 'edit', 'STRING');
	}

	/**
	* Returns a Table object, always creating it.
	*
	* @access	public
	* @param	string	$type	The table type to instantiate.
	* @param	string	$prefix	A prefix for the table class name. Optional.
	* @param	array	$config	Configuration array for model. Optional.
	*
	* @return	JTable	A database object
	*
	* @since	1.6
	*/
	public function getTable($type = 'vendorapplication', $prefix = 'GeoeventsTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	* Method to increment hits (check session and layout)
	*
	* @access	public
	* @param	array	$layouts	List of authorized layouts for hitting the object.
	*
	* @return	boolean	Null if skipped. True when incremented. False if error.
	*
	* @since	11.1
	*/
	public function hit($layouts = null)
	{
		return parent::hit(array());
	}

	/**
	* Method to get the data that should be injected in the form.
	*
	* @access	protected
	*
	* @return	mixed	The data for the form.
	*/
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_geoevents.edit.vendorapplication.data', array());

		if (empty($data)) {
			//Default values shown in the form for new item creation
			$data = $this->getItem();

			// Prime some default values.
			if ($this->getState('vendorapplication.id') == 0)
			{
				$jinput = JFactory::getApplication()->input;

				$data->id = 0;
				$data->event = $jinput->get('filter_event', $this->getState('filter.event'), 'INT');
				$data->vendor_name = null;
				$data->user = $jinput->get('filter_user', $this->getState('filter.user'), 'INT');
				$data->indigenous = 0;
				$data->store_type = $jinput->get('filter_store_type', $this->getState('filter.store_type'), 'STRING');
				$data->frontage = $jinput->get('filter_frontage', $this->getState('filter.frontage','3'), 'STRING');
				$data->electricity = 0;
				$data->number_of_workers = null;
				$data->products = null;
				$data->offer_work_shop = 0;
				$data->description = null;
				$data->comments = null;
				$data->agree_to_conditions = 0;
				$data->published = 1;
				$data->fee = null;
				$data->approved = 0;
				$data->creation_date = null;
				$data->modification_date = null;
				$data->created_by = $jinput->get('filter_created_by', $this->getState('filter.created_by'), 'INT');
				$data->modified_by = $jinput->get('filter_modified_by', $this->getState('filter.modified_by'), 'INT');
				$data->checked_out = $jinput->get('filter_checked_out', $this->getState('filter.checked_out'), 'INT');
				$data->checked_out_time = null;

			}
		}
		return $data;
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
		$app = JFactory::getApplication();
		$session = JFactory::getSession();
		$acl = GeoeventsHelper::getActions();



		parent::populateState($ordering, $direction);

		//Only show the published items
		if (!$acl->get('core.admin') && !$acl->get('core.edit.state'))
			$this->setState('filter.published', 1);
	}

	/**
	* Preparation of the query.
	*
	* @access	protected
	* @param	object	&$query	returns a filled query object.
	* @param	integer	$pk	The primary id key of the vendorapplication
	* @return	void
	*/
	protected function prepareQuery(&$query, $pk)
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
			case 'vendorapplication.edit':

				//BASE FIELDS
				$this->addSelect(	'a.agree_to_conditions,'
								.	'a.checked_out_time,'
								.	'a.description,'
								.	'a.electricity,'
								.	'a.event,'
								.	'a.frontage,'
								.	'a.indigenous,'
								.	'a.number_of_workers,'
								.	'a.offer_work_shop,'
								.	'a.products,'
								.	'a.store_type,'
								.	'a.user,'
								.	'a.vendor_name');

				//SELECT
				$this->addSelect('_event_.title AS `_event_title`');
				$this->addSelect('_user_.name AS `_user_name`');
				$this->addSelect('_checked_out_.name AS `_checked_out_name`');

				//JOIN
				$this->addJoin('`#__geoevents_events` AS _event_ ON _event_.id = a.event', 'LEFT');
				$this->addJoin('`#__users` AS _user_ ON _user_.id = a.user', 'LEFT');
				$this->addJoin('`#__users` AS _checked_out_ ON _checked_out_.id = a.checked_out', 'LEFT');

				break;
			case 'all':
				//SELECT : raw complete query without joins
				$query->select('a.*');
				break;
		}

		//WHERE : Item layout (based on $pk)
		$query->where('a.id = ' . (int) $pk);		//TABLE KEY

		//FILTER - Access for : Root table
		$wherePublished = $allowAuthor = true;
		$whereAccess = false;
		$this->prepareQueryAccess('a', $whereAccess, $wherePublished, $allowAuthor);
		$query->where("($allowAuthor OR $wherePublished)");

		//SELECT : Instance Add-ons
		foreach($this->getState('query.select', array()) as $select)
			$query->select($select);

		//JOIN : Instance Add-ons
		foreach($this->getState('query.join.left', array()) as $join)
			$query->join('LEFT', $join);
	}

	/**
	* Prepare and sanitise the table prior to saving.
	*
	* @access	protected
	* @param	JTable	$table	A JTable object.
	*
	* @return	void	
	* @return	void
	*
	* @since	1.6
	*/
	protected function prepareTable($table)
	{
		$date = JFactory::getDate();


		if (empty($table->id))
		{
			//Creation date
			if (empty($table->creation_date))
				$table->creation_date = GeoeventsHelperDates::toSql($date);

			//Defines automatically the author of this element
			$table->created_by = JFactory::getUser()->get('id');
		}
		else
		{
			//Modification date
			$table->modification_date = GeoeventsHelperDates::toSql($date);
		}

	}

	/**
	* Save an item.
	*
	* @access	public
	* @param	array	$data	The post values.
	*
	* @return	boolean	True on success.
	*/
	public function save($data)
	{
		//Convert from a non-SQL formated date (creation_date)
		$data['creation_date'] = GeoeventsHelperDates::getSqlDate($data['creation_date'], array('Y-m-d'), true);

		//Convert from a non-SQL formated date (modification_date)
		$data['modification_date'] = GeoeventsHelperDates::getSqlDate($data['modification_date'], array('Y-m-d'), true);

		//Convert from a non-SQL formated date (checked_out_time)
		$data['checked_out_time'] = GeoeventsHelperDates::getSqlDate($data['checked_out_time'], array('Y-m-d H:i'), true);
		//Some security checks
		$acl = GeoeventsHelper::getActions();

		//Secure the published tag if not allowed to change
		if (isset($data['published']) && !$acl->get('core.edit.state'))
			unset($data['published']);

		//Secure the author key if not allowed to change
		if (isset($data['created_by']) && !$acl->get('core.edit'))
			unset($data['created_by']);

		if (parent::save($data)) {
			return true;
		}
		return false;


	}


}

// Search for a fork to be able to override this class
JLoader::register('GeoeventsModelVendorapplication', JPATH_SITE_GEOEVENTS .DS. 'fork' .DS. 'models' .DS. 'vendorapplication.php');
JLoader::load('GeoeventsModelVendorapplication'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('GeoeventsModelVendorapplication')){ class GeoeventsModelVendorapplication extends GeoeventsCkModelVendorapplication{} }

