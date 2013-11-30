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
* Form field for Geoevents.
*
* @package	Geoevents
* @subpackage	Form
*/
class GeoeventsCkClassFormField extends JFormField
{
	/**
	* The literal input HTML.
	*
	* @var string
	*/
	protected $input = null;

	/**
	* The form field dynamic options (JDom legacy).
	*
	* @var array
	*/
	public $jdomOptions = array();

	/**
	* Method to get extended properties of the field.
	*
	* @access	public
	* @param	string	$name	Name of the property.
	*
	* @return	mixed	Field property value.
	*/
	public function __get($name)
	{
		switch ($name)
		{
			case 'format':
			case 'position':
			case 'align':
			case 'responsive':
				return $this->element[$name];
				break;
		}
		return parent::__get($name);
	}

	/**
	* Method to check the authorisations.
	*
	* @access	public
	*
	* @return	boolean	True if user is allowed to see the field.
	*/
	public function canView()
	{
		if (!isset($this->element['access']))
			return true;

		$access = (string)$this->element['access'];

		$acl = GeoeventsHelper::getActions();
		foreach(explode(",", $access) as $action)
			if ($acl->get($action))
				return true;

		return false;
	}

	/**
	* Method to get the field input markup.
	*
	* @access	public
	*
	* @return	string	The field input markup.
	*
	* @since	11.1
	*/
	public function getInput()
	{
		if (!$this->canView())
			return;

		//Loads the front javascript and HTML validator (inspirated by JDom.)
		//Hidden messages strings are created in order to fill the javascript message alert.
		//When an error occurs, the messages appears under each field.
		//On loading, the informations messages for each field are shown when values are empties.
		//Each validation occurs on the 'change' event, and merged together in alert box on form submit.
		//If the field is required without validation rule, the helper is called only for the required message implementation.

		$input = $this->input;
		$input .= GeoeventsHelperHtmlValidator::loadValidators($this->element, $this->id);

		return $input;
	}

	/**
	* Method to read an option parameter.
	*
	* @access	protected
	* @param	string	$name	The parameter name.
	* @param	string	$default	Default value.
	* @param	string	$type	Var type for this parameter.
	*
	* @return	mixed	Parameter value.
	*/
	protected function getOption($name, $default = null, $type = null)
	{
		if (!isset($this->element[$name]))
			return $default;

		$elemValue = $this->element[$name];

		switch($type)
		{
			case 'bool':
				$elemValue = (string)$elemValue;
				if (($elemValue == 'true') || ($elemValue == '1'))
					return true;

				if (($elemValue == 'false') || ($elemValue == '0'))
					return false;

				if (!empty($elemValue))
					return true;

				return false;
				break;

			case 'int':
				return (int)$elemValue;
				break;

			default:
				return (string)$elemValue;
				break;
		}
	}

	/**
	* Method to dynamic config the control.
	*
	* @access	public
	* @param	array	$options	An array of options.
	*
	* @return	void	
	* @return	void
	*/
	public function setJdomOptions($options)
	{
		$this->jdomOptions = $options;
	}


}

// Search for a fork to be able to override this class
JLoader::register('GeoeventsClassFormField', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'classes' .DS. 'form' .DS. 'field.php');
JLoader::load('GeoeventsClassFormField'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('GeoeventsClassFormField')){ class GeoeventsClassFormField extends GeoeventsCkClassFormField{} }

