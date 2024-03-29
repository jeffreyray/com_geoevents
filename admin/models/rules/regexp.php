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
class GeoeventsCkFormRuleRegexp extends GeoeventsClassFormRule
{
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
	protected $handler = 'regexp';

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
		// If the regexp is empty, the field is valid.
		if (empty($element['regexp']))
			return true;

		$this->regex = $element['regexp'];

		if (!empty($element['regexpModifiers']))
			$this->modifiers = $element['regexpModifiers'];

		$invert = false;
		if (!empty($element['regexpInvert']))
			$invert = $element['regexpInvert'];

		// Test the value against the regular expression.
		$test = parent::test($element, $value, $group, $input, $form);

		if ($invert?$test:!$test)
			return false;

		return true;
	}


}

// Search for a fork to be able to override this class
JLoader::register('JFormRuleRegexp', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'models' .DS. 'rules' .DS. 'regexp.php');
JLoader::load('JFormRuleRegexp'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('JFormRuleRegexp')){ class JFormRuleRegexp extends GeoeventsCkFormRuleRegexp{} }

