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

if (!class_exists('GeoeventsClassFormField'))
	require_once(JPATH_ADMINISTRATOR . DIRECTORY_SEPARATOR. 'components' .DIRECTORY_SEPARATOR. 'com_geoevents' .DIRECTORY_SEPARATOR. 'helpers' .DIRECTORY_SEPARATOR. 'loader.php');


/**
* Form field for Geoevents.
*
* @package	Geoevents
* @subpackage	Form
*/
class GeoeventsCkFormFieldCksearch extends GeoeventsClassFormField
{
	/**
	* The form field type.
	*
	* @var string
	*/
	public $type = 'cksearch';

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

		$this->input = JDom::_('html.form.input.search', array_merge(array(
				'dataKey' => $this->getOption('name'),
				'domClass' => $this->getOption('class'),
				'domId' => $this->id,
				'domName' => $this->name,
				'dataValue' => $this->value,
				'label' => JText::_($this->getOption('placeholder',  $this->getOption('label'))),
				'placeholder' => $this->getOption('placeholder'),
				'responsive' => $this->getOption('responsive'),
				'size' => $this->getOption('size')
			), $this->jdomOptions));

		return parent::getInput();
	}


}

// Search for a fork to be able to override this class
JLoader::register('JFormFieldCksearch', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'models' .DS. 'fields' .DS. 'cksearch.php');
JLoader::load('JFormFieldCksearch'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('JFormFieldCksearch')){ class JFormFieldCksearch extends GeoeventsCkFormFieldCksearch{} }

