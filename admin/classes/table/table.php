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



/**
* Geoevents Table class
*
* @package	Geoevents
* @subpackage	
*/
class GeoeventsCkClassTable extends JTable
{
	/**
	* Method to get the item id in table.
	*
	* @access	protected
	*
	* @return	int	Item id value, 0 if empty
	*
	* @since	Cook 2.0
	*/
	protected function getId()
	{
		$tblKey = $this->getKeyName();
		return (int)$this->$tblKey;
	}

	/**
	* Method to toggle a value, including integer values
	*
	* @access	public
	* @param	string	$fieldName	The field to increment.
	* @param	integer	$pk	The id of the item.
	* @param	integer	$max	Max possible values (modulo). Reset to 0 when the value is superior to max.
	*
	* @return	boolean	True when changed. False if error.
	*
	* @since	Cook 2.0
	*/
	public function toggle($fieldName, $pk = null, $max = 1)
	{
		// If field do not exists return false
		if (!property_exists($this, $fieldName))
			return false;

		$this->load($pk);

		//Calculate the new value
		$value = $this->$fieldName + 1;
		if ($value > $max)
			$value = 0;


		// Check the row in by primary key.
		$query = $this->_db->getQuery(true);
		$query->update($this->_tbl);
		$query->set(qn($this->_db, $fieldName) . ' = ' . (int)$value);
		$query->where($this->_tbl_key . ' = ' . $this->_db->quote($pk));
		$this->_db->setQuery($query);

		// Check for a database error.
		if (!$this->_db->query())
			return false;

		// Set table values in the object.
		$this->fieldName = $value;

		return true;
	}


}

// Search for a fork to be able to override this class
JLoader::register('GeoeventsClassTable', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'classes' .DS. 'table' .DS. 'table.php');
JLoader::load('GeoeventsClassTable'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('GeoeventsClassTable')){ class GeoeventsClassTable extends GeoeventsCkClassTable{} }

