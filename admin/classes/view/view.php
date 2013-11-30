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

jimport('joomla.application.component.view');


/**
* HTML View class for the Geoevents component
*
* @package	Geoevents
* @subpackage	Class
*/
class GeoeventsCkClassView extends CkJView
{
	/**
	* Call the parent display function. Trick for forking overrides.
	*
	* @access	protected
	* @param	string	$tpl	Template.
	* @return	void
	*
	* @since	Cook 2.0
	*/
	protected function _parentDisplay($tpl)
	{
		parent::display($tpl);
	}

	/**
	* Manage a template override in the fork directory
	*
	* @access	protected
	*
	* @return	void	
	* @return	void
	*
	* @since	Cook 2.0
	*/
	protected function addForkTemplatePath()
	{
		$this->addTemplatePath(JPATH_COMPONENT .DS. 'fork' .DS. 'views' .DS. $this->getName() .DS. 'tmpl');
	}

	/**
	* Renders the fieldset form.
	*
	* @access	public
	* @param	array	$fieldset	Fielset. array of fields.
	*
	* @return	string	Rendered fields.
	*
	* @since	Cook 2.6.1
	*/
	public function renderFieldset($fieldset)
	{
		$html = '';

		// Iterate through the fields and display them.
		foreach($fieldset as $field)
		{
			//Check ACL
		    if ((method_exists($field, 'canView')) && !$field->canView())
		    	continue;

			if ($field->hidden)
			{
				$html .= $field->input;
				continue;
			}
	
			$selectors = (($field->type == 'Editor' || $field->type == 'Textarea') ? ' style="clear: both; margin: 0;"' : '');
	
			$html .= '<div class="control-group field-' . $field->id . $field->responsive . '">';

			$html .= '<div class="control-label">' 
					. $field->label
					. '</div>';

			$html .= '<div class="controls"' . $selectors . '>'
					. $field->input
					. '</div>';

			$html .= '</div>';
		}
		return $html;
	}

	/**
	* Renders the error stack and returns the results as a string
	*
	* @access	public
	* @param	boolean	$raw	Only stack of string. rendered HTML instead.
	*
	* @return	string	Rendered messages.
	*
	* @since	Cook 2.0
	*/
	public function renderMessages($raw = true)
	{
		// Initialise variables.
		$buffer = null;
		$lists = null;

		// Get the message queue
		$messages = JFactory::getApplication()->getMessageQueue();

		$rawMessages = array();
		// Build the sorted message list
		if (is_array($messages) && !empty($messages))
		{
			foreach ($messages as $msg)
			{
				if (isset($msg['type']) && isset($msg['message']))
				{
					$lists[$msg['type']][] = $msg['message'];
					$rawMessages[] = $msg['message'];
				}
			}
		}

		if ($raw)
			return implode("\n", $rawMessages );

		// Build the return string
		$buffer .= "\n<div id=\"system-message-container\">";

		// If messages exist render them
		if (is_array($lists))
		{
			$buffer .= "\n<dl id=\"system-message\">";
			foreach ($lists as $type => $msgs)
			{
				if (count($msgs))
				{
					$buffer .= "\n<dt class=\"" . strtolower($type) . "\">" . JText::_($type) . "</dt>";
					$buffer .= "\n<dd class=\"" . strtolower($type) . " message\">";
					$buffer .= "\n\t<ul>";
					foreach ($msgs as $msg)
					{
						$buffer .= "\n\t\t<li>" . $msg . "</li>";
					}
					$buffer .= "\n\t</ul>";
					$buffer .= "\n</dd>";
				}
			}
			$buffer .= "\n</dl>";
		}

		$buffer .= "\n</div>";
		return $buffer;
	}


}

// Search for a fork to be able to override this class
JLoader::register('GeoeventsClassView', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'classes' .DS. 'view' .DS. 'view.php');
JLoader::load('GeoeventsClassView'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('GeoeventsClassView')){ class GeoeventsClassView extends GeoeventsCkClassView{} }

