<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.6.2   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		Geo Events
* @subpackage	Users
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
class GeoeventsCkJFormFieldModal_Thirduser extends GeoeventsClassFormFieldModal
{
	/**
	* Default label for the picker.
	*
	* @var string
	*/
	protected $_nullLabel = 'GEOEVENTS_DATA_PICKER_SELECT_USER';

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
	protected $_view = "thirdusers";

	/**
	* Field type
	*
	* @var string
	*/
	protected $type = 'modal_thirduser';

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
		if ($this->value == 'auto')
			$this->_title = JText::_('GEOEVENTS_AUTO');
		else
		{
			$db	= JFactory::getDBO();
			$db->setQuery(
				'SELECT `name`' .
				' FROM #__users' .
				' WHERE id = '.(int) $this->value
			);
			$this->_title = $db->loadResult();
	
			if ($error = $db->getErrorMsg()) {
				JError::raiseWarning(500, $error);
			}
		}

		return parent::getInput();
	}

	/**
	* Method to extend the buttons in the picker.
	*
	* @access	protected
	*
	* @return	array	An array of tasks
	*
	* @since	Cook 2.5.8
	*/
	protected function getTasks()
	{
		$labelAuto = JText::_('GEOEVENTS_AUTO');
		$scriptAuto = "document.id('" . $this->id . "_id').value = 'auto';";
		$scriptAuto .= "document.id('" . $this->id . "_name').value = '" . htmlspecialchars($labelAuto, ENT_QUOTES, 'UTF-8') . "';";
		
		return array(
			'auto' => array(
				'label' => 'GEOEVENTS_AUTO',
				'icon' => 'user',
				'jsCommand' => $scriptAuto,
				'description' => 'GEOEVENTS_AUTOSELECT_CURRENT_USER'
			)

		);
	}


}

// Search for a fork to be able to override this class
JLoader::register('JFormFieldModal_Thirduser', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'models' .DS. 'fields' .DS. 'modal' .DS. 'thirduser.php');
JLoader::load('JFormFieldModal_Thirduser'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('JFormFieldModal_Thirduser')){ class JFormFieldModal_Thirduser extends GeoeventsCkJFormFieldModal_Thirduser{} }

