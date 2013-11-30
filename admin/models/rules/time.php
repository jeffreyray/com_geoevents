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
* Form validator rule for Geoevents.
*
* @package	Geoevents
* @subpackage	Form
*/
class GeoeventsCkFormRuleTime extends GeoeventsClassFormRule
{
	/**
	* Specifiate the default format.
	*
	* @var string
	*/
	protected $dateFormat = 'Y-m-d';

	/**
	* Indicates that this class contains special methods (ie: get()).
	*
	* @var boolean
	*/
	public $extended = true;

	/**
	* Unique name for this rule.
	*
	* @var string
	*/
	protected $handler = 'time';

	/**
	* Use this function to customize your own javascript rule.
	* $this->regex must be null if you want to customize here.
	*
	* @access	public
	* @param	JXMLElement	$fieldNode	The JXMLElement object representing the <field /> tag for the form field object.
	*
	* @return	string	A JSON string representing the javascript rules validation.
	*/
	public function getJsonRule($fieldNode)
	{
		if (!isset($fieldNode['format']))
			return;

		$timeFormat = $fieldNode['format'];
		$regex = GeoeventsHelperDates::strftime2regex($timeFormat, false, false);

		$values = array(
			"#regex" => 'new RegExp("' . $regex . '", \'i\')'
		);

		if (isset($fieldNode['msg-incorrect']))
			$values["alertText"] = LI_PREFIX . JText::_($fieldNode['msg-incorrect']);
		else
			$values["alertText"] = LI_PREFIX . JText::sprintf('GEOEVENTS_ERROR_INCORRECT_FORMAT_EXPECTED', $timeFormat);

		$json = GeoeventsHelperHtmlValidator::jsonFromArray($values);
		return "{" . LN . $json . LN . "}";
	}

	/**
	* Method to test the field.
	*
	* @access	public
	* @param	SimpleXMLElement	$element	The JXMLElement object representing the <field /> tag for the form field object.
	* @param	mixed	$value	The form field value to validate.
	* @param	string	$group	The field name group control value. This acts as as an array container for the field.
	* @param	JRegistry	$input	An optional JRegistry object with the entire data set to validate against the entire form.
	* @param	JForm	$form	The form object for which the field is being tested.
	*
	* @return	boolean	True if the value is valid, false otherwise.
	*
	* @since	11.1
	*/
	public function test(SimpleXMLElement $element, $value, $group = null, JRegistry $input = null, JForm $form = null)
	{
		// Common test : Required, Unique
		if (!self::testDefaults($element, $value, $group, $input, $form))
			return false;
		//Convert the date format (strftime) in regular exprassion
		$this->regex = GeoeventsHelperDates::strftime2regex($this->dateFormat, false);

		return true;
	}


}

// Search for a fork to be able to override this class
JLoader::register('JFormRuleTime', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'models' .DS. 'rules' .DS. 'time.php');
JLoader::load('JFormRuleTime'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('JFormRuleTime')){ class JFormRuleTime extends GeoeventsCkFormRuleTime{} }

