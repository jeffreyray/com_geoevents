<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.6.2   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		Geo Events
* @subpackage	Usergroups
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

if (!class_exists('GeoeventsClassFormField'))
	require_once(JPATH_ADMINISTRATOR . DIRECTORY_SEPARATOR. 'components' .DIRECTORY_SEPARATOR. 'com_geoevents' .DIRECTORY_SEPARATOR. 'helpers' .DIRECTORY_SEPARATOR. 'loader.php');


/**
* Form field for Geoevents.
*
* @package	Geoevents
* @subpackage	Form
*/
class GeoeventsCkJFormFieldModal_Thirdusergroup extends GeoeventsClassFormFieldModal
{
	/**
	* Default label for the picker.
	*
	* @var string
	*/
	protected $_nullLabel = 'GEOEVENTS_DATA_PICKER_SELECT_USERGROUP';

	/**
	* Option in URL
	*
	* @var string
	*/
	protected $_option = 'com_geoevents';

	/**
	* Modal Title
	*
	* @var string
	*/
	protected $_title;

	/**
	* View in URL
	*
	* @var string
	*/
	protected $_view = "thirdusergroups";

	/**
	* Field type
	*
	* @var string
	*/
	protected $type = 'modal_thirdusergroup';

	/**
	* Method to get the field input markup.
	*
	* @access	protected
	*
	* @return	string	The field input markup.
	*
	* @since	11.1
	*/
	protected function getInput()
	{
		$db	= JFactory::getDBO();
		$db->setQuery(
			'SELECT `title`' .
			' FROM #__usergroups' .
			' WHERE id = '.(int) $this->value
		);
		$this->_title = $db->loadResult();

		if ($error = $db->getErrorMsg()) {
			JError::raiseWarning(500, $error);
		}


		return parent::getInput();
	}


}

// Search for a fork to be able to override this class
JLoader::register('JFormFieldModal_Thirdusergroup', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'models' .DS. 'fields' .DS. 'modal' .DS. 'thirdusergroup.php');
JLoader::load('JFormFieldModal_Thirdusergroup'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('JFormFieldModal_Thirdusergroup')){ class JFormFieldModal_Thirdusergroup extends GeoeventsCkJFormFieldModal_Thirdusergroup{} }

