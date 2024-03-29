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

jimport('joomla.application.component.modellist');


/**
* Geoevents List Model
*
* @package	Geoevents
* @subpackage	Classes
*/
class GeoeventsCkClassModelList extends JModelList
{
	/**
	* Data array
	*
	* @var array
	*/
	protected $_data = null;

	/**
	* Pagination object
	*
	* @var object
	*/
	protected $_pagination = null;

	/**
	* Total
	*
	* @var integer
	*/
	protected $_total = null;

	/**
	* Context string for the model type.  This is used to handle uniqueness
	*
	* @var string
	*/
	protected $context = null;

	/**
	* Filterable fields keys
	*
	* @var array
	*/
	protected $filter_vars = array();

	/**
	* Search entries
	*
	* @var array
	*/
	protected $search_vars = array();

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

		$layout = $this->getLayout();
		$jinput = JFactory::getApplication()->input;
		$render = $jinput->get('render', null, 'CMD');

		$this->context = strtolower($this->option . '.' . $this->getName()
					. ($layout?'.' . $layout:'')
					. ($render?'.' . $render:'')
					);
	}

	/**
	* Method to store an EXTRA at the end of the SQL query. (LIMIT for example)
	*
	* @access	public
	* @param	string	$extra	
	* @return	void
	*
	* @deprecated	1
	*/
	public function addExtra($extra)
	{
		$this->addQuery('extra', $extra);
	}

	/**
	* Method to store a PRIORITARY ORDER for the SQL query. Used to group the
	* fields.
	* Deprecated : use addGroupOrder()
	*
	* @access	public
	* @param	string	$groupby	
	* @return	void
	*/
	public function addGroupBy($groupby)
	{
		$this->addGroupOrder($groupby);
	}

	/**
	* Method to store a PRIORITARY ORDER for the SQL query. Used to group the
	* fields per value.
	*
	* @access	public
	* @param	string	$groupOrder	
	* @return	void
	*/
	public function addGroupOrder($groupOrder)
	{
		//Legacy support
		$this->addQuery('groupby', $groupOrder);

		$this->addQuery('groupOrder', $groupOrder);
	}

	/**
	* Method to store a JOIN entry for the SQL query.
	*
	* @access	public
	* @param	string	$join	
	* @param	string	$type	
	* @return	void
	*/
	public function addJoin($join, $type = 'left')
	{
		$join = preg_replace("/^((LEFT)?(RIGHT)?(INNER)?(OUTER)?\sJOIN)/", "", $join);
		$this->addQuery('join.' . strtolower($type), $join);
	}

	/**
	* Method to store an ORDER entry for the SQL query.
	*
	* @access	public
	* @param	string	$order	
	* @return	void
	*/
	public function addOrder($order)
	{
		$this->addQuery('order', $order);
	}

	/**
	* Concat SQL parts in query. (Suggested by Cook Self Service)
	*
	* @access	public
	* @param	string	$type	SQL command.
	* @param	string	$queryElement	Command content.
	* @return	void
	*/
	public function addQuery($type, $queryElement)
	{
		$queryElement = trim($queryElement);
		$queries = $this->getState('query.' . $type, array());
		if (!in_array($queryElement, $queries))
		{
			$queries[] = $queryElement;
			$this->setState('query.' . $type, $queries);
		}
	}

	/**
	* Method to concat a search entry.
	*
	* @access	protected
	* @param	string	$instance	
	* @param	string	$namespace	
	* @param	string	$method	
	* @return	void
	*/
	protected function addSearch($instance, $namespace, $method)
	{
		$search = new stdClass();
		$search->method = $method;


		if (!isset($this->_searches[$instance]))
			$this->_searches[$instance] = array();

		$this->_searches[$instance][$namespace] = $search;
	}

	/**
	* Method to store a SELECT entry for the SQL query.
	*
	* @access	public
	* @param	string	$select	
	* @return	void
	*/
	public function addSelect($select)
	{
		$this->addQuery('select', $select);
	}

	/**
	* Method to store a WHERE entry for the SQL query.
	*
	* @access	public
	* @param	string	$where	
	* @return	void
	*/
	public function addWhere($where)
	{
		$this->addQuery('where', $where);
	}

	/**
	* Method to build a SQL search string.
	*
	* @access	protected
	* @param	string	$instance	
	* @param	string	$searchText	
	* @param	string	$options	
	*
	* @return	string	The formated SQL string for the research.
	*/
	protected function buildSearch($instance, $searchText, $options = array('join' => 'AND', 'ignoredLength' => 0))
	{
		if (!isset($this->_searches[$instance]))
			return;

		$db= JFactory::getDBO();
		$tests = array();
		foreach($this->_searches[$instance] as $namespace => $search)
		{
			$test = "";
			switch($search->method)
			{
				case 'like':
					$test = $namespace . " LIKE " . $db->Quote("%%s%");
					break;

				case 'exact':
					$test = $namespace . " = " . $db->Quote("%s");
					break;

				case '':
					break;
			}

			if ($test)
				$tests[] = $test;
		}

		if (!count($tests))
			return "";

		$whereSearch = implode(" OR ", $tests);

		//SPLIT SEARCHED TEXT
		$searchesParts = array();

		foreach(explode(" ", $searchText) as $searchStr)
		{
			$searchStr = trim($searchStr);
			if ($searchStr == '')
				continue;

			if ((isset($options['ignoredLength'])) && (strlen($searchStr) <= $options['ignoredLength']))
				continue;

			if ($search->method == 'like')
			{
				$version = new JVersion();
				if ($version->isCompatible('1.7'))
					$searchStr = $db->escape($searchStr);
				else
					$searchStr = $db->getEscaped($searchStr);
			}
	

			$searchesParts[] = "(" . str_replace("%s", $searchStr, $whereSearch) . ")";
		}

		if (!count($searchesParts))
			return;

		if (isset($options['join']))
			$join = strtoupper($options['join']);
		else
			$join = "AND";

		$where = implode(" " . $join . " ", $searchesParts);

		return $where;
	}

	/**
	* Check if the user can access to the configuration.
	*
	* @access	public
	*
	* @return	boolean	True if allowed.
	*/
	public function canAdmin()
	{
		$acl = GeoeventsHelper::getActions();

		if ($acl->get('core.admin'))
			return true;

		return false;
	}

	/**
	* Check if the user can create new items.
	*
	* @access	public
	*
	* @return	boolean	True if allowed.
	*/
	public function canCreate()
	{
		$acl = GeoeventsHelper::getActions();
		
		if ($acl->get('core.create'))
			return true;
		
		return false;
	}

	/**
	* Method to test whether a user can delete items.
	*
	* @access	public
	*
	* @return	boolean	True if allowed.
	*/
	public function canDelete()
	{
		$acl = GeoeventsHelper::getActions();
		
		if ($acl->get('core.delete'))
			return true;

		if ($acl->get('core.delete.own'))
			return true;
		
		return false;
	}

	/**
	* Check if the user can edit items.
	*
	* @access	public
	*
	* @return	boolean	True if allowed.
	*/
	public function canEdit()
	{
		$acl = GeoeventsHelper::getActions();
		
		if ($acl->get('core.edit'))
			return true;

		if ($acl->get('core.edit.own'))
			return true;
		
		return false;
	}

	/**
	* Check if the user can edit the states (publish, default, ...).
	*
	* @access	public
	*
	* @return	boolean	True if allowed.
	*/
	public function canEditState()
	{
		$acl = GeoeventsHelper::getActions();
		
		if ($acl->get('core.edit.state'))
			return true;
		
		return false;
	}

	/**
	* Check if allowed to process any acl task.
	*
	* @access	public
	*
	* @return	boolean	True if allowed.
	*/
	public function canSelect()
	{
		if ($this->canAdmin())
		return true;

		if ($this->canEdit())
		return true;

		if ($this->canDelete())
		return true;

		if ($this->canEditState())
		return true;

		if ($this->canEditState())
		return true;

		return false;
	}

	/**
	* Method to get a customized form.
	*
	* @access	public
	* @param	string	$instance	The name of the form in XML file.
	* @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	* @param	string	$control	The name of the control group.
	*
	* @return	JXMLElement	A Fieldset containing all the field parameters (XML node)
	*
	* @since	Cook 2.0
	*/
	public function getForm($instance = 'default.filters', $loadData = true, $control = null)
	{
		$model = CkJModel::getInstance($this->view_item, 'GeoeventsModel');
		$form = $model->getForm(null, $loadData, $control);

		if (empty($form))
			return null;

		if ($loadData)
		{
			//Fill the form with the states vars (For filters)
			foreach ($this->filter_vars as $filterVar => $type)
			{
				switch($filterVar)
				{
					case 'sortTable':
						$fieldName = $filterVar;
						$stateVar = 'list.ordering';
						break;

					case 'directionTable':
						$fieldName = $filterVar;
						$stateVar = 'list.direction';
						break;
				
					case 'limit':
						$fieldName = $filterVar;
						$stateVar = 'list.limit';
						break;
			
					default:
						$fieldName = 'filter_' . $filterVar;
						$stateVar = 'filter.' . $filterVar;
						break;
				}
				$value = $this->getState($stateVar);
		
				$form->setValue($fieldName, '', $value);
			}

			//Fill the form with the states vars (For Searches)
			foreach ($this->search_vars as $searchVar => $type)
			{		
				$value = $this->getState('search.' . $searchVar);
				$form->setValue('search_' . $searchVar, '', $value);
			}			
		}

		$fieldSet = $form->getFieldset($instance);
	
		//Check ACL (access property)
		$allowedFields = array();
		foreach($fieldSet as $name => $field)
		{
			if ((method_exists($field, 'canView')) && !$field->canView())
				continue;

			$allowedFields[$name] = $field;
		}
		return $allowedFields;
	}

	/**
	* Method to get an array of data items. Override to catch the errors.
	*
	* @access	public
	*
	* @return	array	Items objects.
	*
	* @since	11.1
	*/
	public function getItems()
	{
		try
		{
			$result = parent::getItems();
			$db = $this->getDbo();
			if ($error = $db->getErrorMsg()) {
				if (!$this->canAdmin())
					$error = JText::_('GEOEVENTS_ERROR_INVALID_QUERY');
				throw new Exception($error);
			}
		}
		catch (JException $e)
		{

		}
		return $result;
	}

	/**
	* Get the current layout. Abstract function to override.
	*
	* @access	public
	*
	* @return	string	The default layout alias.
	*
	* @since	11.1
	*/
	public function getLayout()
	{
		return 'default';
	}

	/**
	* Method to get a JDatabaseQuery object for retrieving the data set from a
	* database.
	*
	* @access	public
	*
	* @return	JDatabaseQuery	A JDatabaseQuery object to retrieve the data set.
	*
	* @since	11.1
	*/
	public function getListQuery()
	{
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$this->prepareQuery($query);
		return $query;
	}

	/**
	* Proxy to get the model.
	*
	* @access	public
	* @param	bool	$item	If true, return the item model
	*
	* @return	JModel	Return the model.
	*
	* @since	1.6
	*/
	public function getModel($item = false)
	{
		if ($item)
			return CkJModel::getInstance($this->view_item, 'GeoeventsModel');

		return parent::getModel();
	}

	/**
	* Alternative to avoid userVar beeing updated for Ajax calls.
	*
	* @access	public
	* @param	string	$key	The key of the user state variable.
	* @param	string	$request	The name of the variable passed in a request.
	* @param	string	$default	The default value for the variable if not found. Optional.
	* @param	string	$type	Filter for the variable, for valid values see {@link JFilterInput::clean()}. Optional.
	* @param	string	$resetPage	If true, the limitstart in request is set to zero
	* @return	void
	*/
	public function getUserStateFromRequest($key, $request, $default = null, $type = 'none', $resetPage = true)
	{
		$app = JFactory::getApplication();
		$jinput = JFactory::getApplication()->input;

		$old_state = $app->getUserState($key);
		$cur_state = (!is_null($old_state)) ? $old_state : $default;

		$new_state = $jinput->get($request, null, $type);

		//Return to the first pagination page if var state changed
		if ($resetPage && !empty($new_state) && ($cur_state != $new_state))
		{
			$this->setState('limitstart', 0);
			$app->setUserState($this->context . '.limitstart', 0);
		}

		// Save the new value only if it is set in this request.
		if ($new_state !== null)
			$app->setUserState($key, $new_state);
		else
			$new_state = $cur_state;

		return $new_state;
	}

	/**
	* Prepare some additional derivated objects.
	*
	* @access	public
	* @param	array	&$items	The objects to populate.
	* @return	void
	*/
	public function populateObjects(&$items)
	{

	}

	/**
	* Prepare some additional important values.
	*
	* @access	public
	* @param	array	&$items	The objects to populate.
	* @return	void
	*/
	public function populateParams(&$items)
	{
		if (!isset($items) || empty($items))
			return;

		$model = CkJModel::getInstance($this->view_item, 'GeoeventsModel');
		foreach ($items as &$item)
		{
			// TODO : attribs
		//			$itemParams = new JRegistry;
		//			$itemParams->loadString((isset($item->attribs)?$item->attribs:$item->params));

			//$item->params = clone $this->getState('params');

			$item->params = new JObject();;

			if ($model)
			{
				if ($model->canView($item))
					$item->params->set('access-view', true);

				if ($model->canEdit($item))
					$item->params->set('access-edit', true);

				if ($model->canDelete($item))
					$item->params->set('access-delete', true);

				if ($model->isCheckedIn($item))
					$item->params->set('tag-checkedout', true);

				if (isset($item->published))
					$item->params->set('tag-published', $item->published);

				if (isset($item->default))
					$item->params->set('tag-default', $item->default);

			}
		}
	}

	/**
	* Method to auto-populate the model state.
	*
	* @access	public
	* @param	string	$ordering	
	* @param	string	$direction	
	* @return	void
	*/
	public function populateState($ordering = null, $direction = null)
	{
		$jinput = JFactory::getApplication()->input;
		$layout = $jinput->get('layout', null, 'CMD');
		$render = $jinput->get('render', '', 'CMD');

		if ($layout == 'ajax')
			$this->setState('context', 'ajax' . ($render?'.'.$render:''));

		$globalParams = JComponentHelper::getParams('com_geoevents', true);
		$this->setState('params', $globalParams);

		// If the context is set, assume that stateful lists are used.
		if ($this->context)
		{
			$app = JFactory::getApplication();
	
		// FILTERS
			foreach($this->filter_vars as $var => $varType)
			{
				/*
				//1. First read the Request in URL
				//2. Then read the persistant value for THIS context
				//3. Finaly read the state var sent by the caller
				$value = $this->getUserStateFromRequest(
					$this->context . '.filter.' . $var, 
					'filter_' . $var, 
					$this->state->get('filter.' . $var), 
					$varType
				);
		*/
				//1. Read the state var sent by the caller
				//2. Then read the Request in URL
				//3. Finally read the persistant value for THIS context
				$value = $this->state->get('filter.' . $var, 
					$this->getUserStateFromRequest(
					$this->context . '.filter.' . $var, 
					'filter_' . $var, 
					null, 
					$varType
				));

				//Convert datetime entries back from a custom format
				if ($value && (preg_match("/^date:(.+)/", $varType, $matches)))
				{
					$date = GeoeventsHelperDates::timeFromFormat($value, $matches[1]);
					if ($date)
					{
						jimport('joomla.utilities.date');
						$jdate = new JDate($date);
						$value = GeoeventsHelperDates::toSql($jdate);
					}
					else
						continue;
				}
				$this->setState('filter.' . $var, $value);
			}

		// FILTERS : SEARCHES
			foreach($this->search_vars as $var => $varType)
			{
				//see Filters
				/*
				$value = $this->getUserStateFromRequest(
					$this->context . '.search.' . $var, 
					'filter_' . $var, 
					$this->state->get('search.' . $var), 
					$varType);
				*/

				//1. Read the state var sent by the caller
				//2. Then read the Request in URL
				//3. Finally read the persistant value for THIS context
				$value = $this->state->get('search.' . $var, 
					$this->getUserStateFromRequest(
					$this->context . '.search.' . $var, 
					'search_' . $var, 
					null, 
					$varType
				));
		
				$this->setState('search.' . $var, $value);
			}
	
	
		// PAGINATION : LIMIT
			//1. First read the state var sent by the caller
			//2. Then read the Request in URL
			//3. Then read the default limit value for THIS context
			//4. Finally read the list limit value from the Joomla configuration					
			$value = $this->state->get('list.limit',
						$app->getUserStateFromRequest('global.list.limit', 'limit',
							$this->state->get('list.limit.default', 
								$app->getCfg('list_limit')))
			);
			
			$limit = $value;
			$this->setState('list.limit', $limit);


		// PAGINATION : LIMIT START
			//1. First read the Request in URL
			//2. Then read the state var sent by the caller
			$value = $app->getUserStateFromRequest(
					$this->context . '.limitstart', 'limitstart', 
						$this->state->get('list.limitstart')
			);
			
			
			$limitstart = ($limit != 0 ? (floor($value / $limit) * $limit) : 0);
			$this->setState('list.start', $limitstart);


		// SORTING : ORDERING (Vocabulary confusion in Joomla. This is a SORTING. Ordering is an index value in the item.)
			//1. First read the Request in URL
			//2. Then read the default sorting value sent trough the args (called 'ordering')
			$value = $app->getUserStateFromRequest(
					$this->context . '.ordercol', 'filter_order', 
						$ordering
			);
				
				
			if (!in_array($value, $this->filter_fields))
			{
				$value = $ordering;
				$app->setUserState($this->context . '.ordercol', $value);
			}
			$this->setState('list.ordering', $value);


		// SORTING : DIRECTION
			//1. First read the Request in URL
			//2. Then read the default direction value sent trough the args.
			$value = $app->getUserStateFromRequest(
					$this->context . '.orderdirn', 'filter_order_Dir', 
						$direction
			);
				
			if (!in_array(strtoupper($value), array('ASC', 'DESC', '')))
			{
				$value = $direction;
				$app->setUserState($this->context . '.orderdirn', $value);
			}
			$this->setState('list.direction', $value);
		}
		else
		{
			$this->setState('list.start', 0);
			$this->state->set('list.limit', 0);
		}

		if (defined('JDEBUG'))
			$_SESSION["Geoevents"]["Model"][$this->getName()]["State"] = $this->state;
	}

	/**
	* Prepare the query for filtering accesses. Can be used on foreign keys.
	*
	* @access	protected
	* @param	varchar	$table	The table alias (_tablealias_).
	* @param	varchar	&$whereAccess	The returned SQL access filter. Set to true to activate it.
	* @param	varchar	&$wherePublished	The returned SQL published filter. Set to true to activate it.
	* @param	varchar	&$allowAuthor	The returned SQL to allow author to pass. Set to true to activate it.
	* @return	void
	*/
	protected function prepareQueryAccess($table = 'a', &$whereAccess = null, &$wherePublished = null, &$allowAuthor = null)
	{
		$acl = GeoeventsHelper::getActions();

		// Must be aliased ex : _tablename_
		if ($table != 'a')
			$table = '_' . trim($table, '_') . '_';


		// ACCESS - View Level Access
		if ($whereAccess)
		{
			// Select fields requirements
			if ($table != 'a')
				$this->addSelect($table . '.access AS `' . $table . 'access`');	

			$whereAccess = '1';
			if (!$this->canAdmin())
			{	
			    $groups	= implode(',', JFactory::getUser()->getAuthorisedViewLevels());
				$whereAccess = $table . '.access IN ('.$groups.')';
			}
		}

		// ACCESS - Author
		if ($allowAuthor)
		{
			// Select fields requirements
			if ($table != 'a')
				$this->addSelect($table . '.created_by AS `' . $table . 'created_by`');

			$allowAuthor = '0';
			//Allow the author to see its own unpublished/archived/trashed items
			if ($acl->get('core.edit.own') || $acl->get('core.view.own') || $acl->get('core.delete.own'))
				$allowAuthor = $table . '.created_by = ' . (int)JFactory::getUser()->get('id');
		
		}

		// ACCESS - Publish state
		if ($wherePublished)
		{
			// Select fields requirements
			if ($table != 'a')
				$this->addSelect($table . '.published AS `' . $table . 'published`');

			$wherePublished = '(' . $table . '.published = 1 OR ' . $table . '.published IS NULL)'; //Published or undefined state
			//Allow some users to access (core.edit.state)
			if ($acl->get('core.edit.state'))
				$wherePublished = '1'; //Do not filter

			// FILTER - Published state
			$published = $this->getState('filter.published');

			//Only apply filter on current table. Aand only if ACL permits.
			if (($table == 'a') && (is_numeric($published)) && $acl->get('core.edit.state'))
			{
				//Limit to publish state when filter is applied
				$wherePublished = $table . '.published = ' . (int)$published;
				//Does not apply the author condition when filter is defined
				$allowAuthor = '0';
			}
		}

		// Fallback values
		if (!$whereAccess)
			$whereAccess = '1';

		if (!$allowAuthor)
			$allowAuthor = '0';

		if (!$wherePublished)
			$wherePublished = '1';
	}

	/**
	* Prepare the language translation of items for SQL query.
	*
	* @access	protected
	* @param	array	$fields	The fields you want to translate.
	* @param	array	$options	An array of configuration.
	* @return	void
	*/
	protected function prepareQueryTranslate($fields, $options = array())
	{
		if (empty($fields))
			return;

		//Define an alias prefix when the selected field is abroad FK. (ie: _product_category_title, use : _product_category_)
		$fieldPrefix = '';
		if (isset($options['fieldPrefix']))
		{
			$fieldPrefix = $options['fieldPrefix'];
			$tableAlias = $fieldPrefix;
			$langTableAlias = '__lang' . $fieldPrefix;
		}
		else
		{
			$tableAlias = 'a';
			$langTableAlias = '__lang_';
		}

		//The alias used in query for temporary load the related language item (be careful unicity of table aliases)
		if (isset($options['langTableAlias']))
			$langTableAlias = $options['langTableAlias'];

		//The table name from witch are stored the languages strings
		$tableFrom = '#__' . ltrim($this->option, '_com') . '_' . $this->getName();
		if (isset($options['tableFrom']))
			$tableFrom = $options['tableFrom'];

		//Define the field on which the filter is working. Language tag (ie: en-GB).
		$keyLang = 'language';
		if (isset($options['keyLang']))
			$keyLang = $options['keyLang'];

		//Define the recursive field FK which relate to the original item
		$keyXref = 'xref';
		if (isset($options['keyXref']))
			$keyXref = $options['keyXref'];

		//Limit to the root elements when not the root table (a.)
		if (isset($options['tableFrom']))
			$this->addWhere("($tableAlias.$keyXref IS NULL || $tableAlias.$keyXref = 0)");

		//Apply the filter
		$stateValue = $this->getState('filter.language');
		if ($stateValue !== null)
		{
			// Join language table (recursive 1 level)
			$this->addJoin("`$tableFrom` AS `$langTableAlias` ON ($langTableAlias.$keyXref = $tableAlias.id AND $langTableAlias.$keyLang = "
					. $this->_db->Quote($stateValue)
					. ')' , 'LEFT');

			//Translatable fields
			foreach($fields as $key)
				$this->addSelect("(CASE WHEN ($langTableAlias.$key IS NOT NULL AND $langTableAlias.$key > 0) THEN $langTableAlias.$key ELSE $tableAlias.$key END) AS `$fieldPrefix$key`");
		}
	}

	/**
	* Method to adjust the ordering of a row.
	*
	* @access	public
	* @param	array	$ids	The ID of the primary key to move.
	* @param	int	$inc	Delta increment, usually +1 or -1.
	*
	* @return	boolean	True on success
	*
	* @since	11.1
	*/
	public function reorder($ids, $inc)
	{
		$model = $this->getModel(true);

		$table = $model->getTable();
		$table->load($ids[0]);

		if (!$table->move($inc))
			return false;

		$conditions = $model->getReorderConditions($table);
		$conditions = (count($conditions)?implode(" AND ", $conditions):'');
		$table->reorder($conditions);

		return true;
	}

	/**
	* Saves the manually set order of records.
	*
	* @access	public
	* @param	array	$pks	An array of primary key ids.
	* @param	array	$order	order values
	*
	* @return	boolean	True on success
	*
	* @since	11.1
	*/
	public function saveorder($pks, $order)
	{
		$model = $this->getModel(true);
		$model->saveorder($pks, $order);
	}

	/**
	* Method to set model state variables. Update local vars.
	*
	* @access	public
	* @param	string	$property	The name of the property.
	* @param	mixed	$value	The value of the property to set or null.
	*
	* @return	mixed	The previous value of the property or null if not set.
	*
	* @since	11.1
	*/
	public function setState($property, $value = null)
	{
		if ($property == 'context')
			$this->context = $value;
	
		return parent::setState($property, $value);
	}


}

// Search for a fork to be able to override this class
JLoader::register('GeoeventsClassModelList', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'classes' .DS. 'model' .DS. 'list.php');
JLoader::load('GeoeventsClassModelList'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('GeoeventsClassModelList')){ class GeoeventsClassModelList extends GeoeventsCkClassModelList{} }

