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
class GeoeventsCkFormFieldCkeditor extends GeoeventsClassFormField
{
	/**
	* The form field type.
	*
	* @var string
	*/
	public $type = 'ckeditor';

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

		$this->input = JDom::_('html.form.input.editor', array_merge(array(
				'dataKey' => $this->getOption('name'),
				'domClass' => $this->getOption('class'),
				'domId' => $this->id,
				'domName' => $this->name,
				'cols' => $this->getOption('cols'),
				'dataValue' => $this->value,
				'height' => $this->getOption('height'),
				'responsive' => $this->getOption('responsive'),
				'rows' => $this->getOption('rows'),
				'width' => $this->getOption('width')
			), $this->jdomOptions));

		return parent::getInput();
	}


}

// Search for a fork to be able to override this class
JLoader::register('JFormFieldCkeditor', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'models' .DS. 'fields' .DS. 'ckeditor.php');
JLoader::load('JFormFieldCkeditor'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('JFormFieldCkeditor')){ class JFormFieldCkeditor extends GeoeventsCkFormFieldCkeditor{} }

