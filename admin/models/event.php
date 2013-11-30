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
* Geoevents Item Model
*
* @package	Geoevents
* @subpackage	Classes
*/
class GeoeventsCkModelEvent extends GeoeventsClassModelItem
{
	/**
	* View list alias
	*
	* @var string
	*/
	protected $view_item = 'event';

	/**
	* View list alias
	*
	* @var string
	*/
	protected $view_list = 'events';

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

		//Integrity : Reset fk : event in vendorapplication
		$model = CkJModel::getInstance('vendorapplication', 'GeoeventsModel');
		if (!$model->integrityReset('event', $pks))
		{
			JError::raiseWarning( 1302, JText::_("GEOEVENTS_ALERT_ERROR_ON_RESET_KEYS") );
			return false;
		}

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
	public function getTable($type = 'event', $prefix = 'GeoeventsTable', $config = array())
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
		$data = JFactory::getApplication()->getUserState('com_geoevents.edit.event.data', array());

		if (empty($data)) {
			//Default values shown in the form for new item creation
			$data = $this->getItem();

			// Prime some default values.
			if ($this->getState('event.id') == 0)
			{
				$jinput = JFactory::getApplication()->input;

				$data->id = 0;
				$data->title = null;
				$data->alias = null;
				$data->start_time = null;
				$data->end_time = null;
				$data->location = null;
				$data->ordering = null;
				$data->published = 0;
				$data->description = null;
				$data->access = $jinput->get('filter_access', $this->getState('filter.access',1), 'INT');
				$data->created_by = $jinput->get('filter_created_by', $this->getState('filter.created_by'), 'INT');
				$data->modified_by = $jinput->get('filter_modified_by', $this->getState('filter.modified_by'), 'INT');
				$data->creation_date = null;
				$data->modification_date = null;
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
	* @param	integer	$pk	The primary id key of the event
	* @return	void
	*/
	protected function prepareQuery(&$query, $pk)
	{

		$acl = GeoeventsHelper::getActions();

		//FROM : Main table
		$query->from('#__geoevents_events AS a');



		//IMPORTANT REQUIRED FIELDS
		$this->addSelect(	'a.id,'
						.	'a.access,'
						.	'a.checked_out,'
						.	'a.created_by,'
						.	'a.published');

		switch($this->getState('context', 'all'))
		{
			case 'event.edit':

				//BASE FIELDS
				$this->addSelect(	'a.alias,'
								.	'a.checked_out_time,'
								.	'a.creation_date,'
								.	'a.description,'
								.	'a.end_time,'
								.	'a.location,'
								.	'a.modification_date,'
								.	'a.modified_by,'
								.	'a.ordering,'
								.	'a.start_time,'
								.	'a.title');

				//SELECT
				$this->addSelect('_access_.title AS `_access_title`');
				$this->addSelect('_checked_out_.name AS `_checked_out_name`');

				//JOIN
				$this->addJoin('`#__viewlevels` AS _access_ ON _access_.id = a.access', 'LEFT');
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
		$whereAccess = $wherePublished = $allowAuthor = true;
		$this->prepareQueryAccess('a', $whereAccess, $wherePublished, $allowAuthor);
		$query->where("($allowAuthor OR ($whereAccess AND $wherePublished))");

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
			// Set ordering to the last item if not set
			$conditions = $this->getReorderConditions($table);
			$conditions = (count($conditions)?implode(" AND ", $conditions):'');
			$table->ordering = $table->getNextOrder($conditions);

			//Defines automatically the author of this element
			$table->created_by = JFactory::getUser()->get('id');

			//Creation date
			if (empty($table->creation_date))
				$table->creation_date = GeoeventsHelperDates::toSql($date);
		}
		else
		{
			//Defines automatically the editor of this element
			$table->modified_by = JFactory::getUser()->get('id');

			//Modification date
			$table->modification_date = GeoeventsHelperDates::toSql($date);
		}
		//Alias
		if (empty($table->alias))
			$table->alias = JApplication::stringURLSafe($table->title);
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
		//Convert from a non-SQL formated date (start_time)
		$data['start_time'] = GeoeventsHelperDates::getSqlDate($data['start_time'], array('Y-m-d H:i'), true);

		//Convert from a non-SQL formated date (end_time)
		$data['end_time'] = GeoeventsHelperDates::getSqlDate($data['end_time'], array('Y-m-d H:i'), true);

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

		//Secure the access key if not allowed to change
		if (isset($data['access']) && !$acl->get('core.edit'))
			unset($data['access']);

		if (parent::save($data)) {
			return true;
		}
		return false;


	}


}

// Search for a fork to be able to override this class
JLoader::register('GeoeventsModelEvent', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'models' .DS. 'event.php');
JLoader::load('GeoeventsModelEvent'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('GeoeventsModelEvent')){ class GeoeventsModelEvent extends GeoeventsCkModelEvent{} }

