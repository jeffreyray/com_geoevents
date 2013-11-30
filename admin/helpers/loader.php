<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.6.2   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		Geo Events
* @subpackage	Contents
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
defined( '_JEXEC' ) or die( 'Restricted access' );

// Some usefull constants
if(!defined('DS')) define('DS',DIRECTORY_SEPARATOR);
if(!defined('BR')) define("BR", "<br />");
if(!defined('LN')) define("LN", "\n");

//Joomla 1.6 only
if (!defined('JPATH_PLATFORM')) define('JPATH_PLATFORM', JPATH_SITE .DS. 'libraries');

// Main component aliases
if (!defined('COM_GEOEVENTS')) define('COM_GEOEVENTS', 'com_geoevents');
if (!defined('GEOEVENTS_CLASS')) define('GEOEVENTS_CLASS', 'Geoevents');

// Component paths constants
if (!defined('JPATH_ADMIN_GEOEVENTS')) define('JPATH_ADMIN_GEOEVENTS', JPATH_ADMINISTRATOR . DS . 'components' . DS . COM_GEOEVENTS);
if (!defined('JPATH_SITE_GEOEVENTS')) define('JPATH_SITE_GEOEVENTS', JPATH_SITE . DS . 'components' . DS . COM_GEOEVENTS);

// JQuery use
if(!defined('JQUERY_VERSION')) define('JQUERY_VERSION', '1.8.2');


$app = JFactory::getApplication();
jimport('joomla.version');
$version = new JVersion();

if (!class_exists('CkJLoader'))
{
	// Joomla! 1.6 - 1.7
	if (version_compare($version->RELEASE, '2.5', '<'))
	{
		// Load the missing class file
		require_once(JPATH_ADMIN_GEOEVENTS .DS. 'legacy' .DS. 'loader.php');
				
		// Register the autoloader functions.
		CkJLoader::setup();
	}
	
	
	//Joomla! 2.5 and later
	else
	{	
		class CkJLoader extends JLoader{}
	}
}

// Automatically find the class files (Platform 12.1)
CkJLoader::registerPrefix('GeoeventsClass', JPATH_ADMIN_GEOEVENTS .DS.'classes');
CkJLoader::registerPrefix('GeoeventsHelper', JPATH_ADMIN_GEOEVENTS .DS.'helpers');

// Find Legacy Files (class files missing in previous versions)
CkJLoader::registerPrefix('GeoeventsLegacy', JPATH_ADMIN_GEOEVENTS .DS.'legacy');

CkJLoader::discover('GeoeventsClass', JPATH_ADMIN_GEOEVENTS .DS.'classes');
CkJLoader::discover('GeoeventsHelper', JPATH_ADMIN_GEOEVENTS .DS.'helpers');


// Some helpers
CkJLoader::register('JToolBarHelper', JPATH_ADMINISTRATOR .DS. "includes" .DS. "toolbar.php", true);
CkJLoader::register('JSubMenuHelper', JPATH_ADMINISTRATOR .DS. "includes" .DS. "toolbar.php", true);

// Register all Models because of unsolved random JLoader issue.
// Cook offers 3 months subscribtion for the person who solve this issue.
JLoader::register('GeoeventsModelEvents', JPATH_COMPONENT .DS. 'models' .DS. 'events.php');
JLoader::register('GeoeventsModelEvent', JPATH_COMPONENT .DS. 'models' .DS. 'event.php');
JLoader::register('GeoeventsModelVendorapplications', JPATH_COMPONENT .DS. 'models' .DS. 'vendorapplications.php');
JLoader::register('GeoeventsModelVendorapplication', JPATH_COMPONENT .DS. 'models' .DS. 'vendorapplication.php');
JLoader::register('GeoeventsModelVolunteerapplications', JPATH_COMPONENT .DS. 'models' .DS. 'volunteerapplications.php');
JLoader::register('GeoeventsModelVolunteerapplication', JPATH_COMPONENT .DS. 'models' .DS. 'volunteerapplication.php');
JLoader::register('GeoeventsModelCpanel', JPATH_COMPONENT .DS. 'models' .DS. 'cpanel.php');
JLoader::register('GeoeventsModelCpanelbutton', JPATH_COMPONENT .DS. 'models' .DS. 'cpanelbutton.php');
JLoader::register('GeoeventsModelThirdusers', JPATH_COMPONENT .DS. 'models' .DS. 'thirdusers.php');
JLoader::register('GeoeventsModelThirduser', JPATH_COMPONENT .DS. 'models' .DS. 'thirduser.php');
JLoader::register('GeoeventsModelThirdviewlevels', JPATH_COMPONENT .DS. 'models' .DS. 'thirdviewlevels.php');
JLoader::register('GeoeventsModelThirdviewlevel', JPATH_COMPONENT .DS. 'models' .DS. 'thirdviewlevel.php');
JLoader::register('GeoeventsModelThirdusergroups', JPATH_COMPONENT .DS. 'models' .DS. 'thirdusergroups.php');
JLoader::register('GeoeventsModelThirdusergroup', JPATH_COMPONENT .DS. 'models' .DS. 'thirdusergroup.php');
JLoader::register('GeoeventsModelThirdcategories', JPATH_COMPONENT .DS. 'models' .DS. 'thirdcategories.php');
JLoader::register('GeoeventsModelThirdcategory', JPATH_COMPONENT .DS. 'models' .DS. 'thirdcategory.php');
JLoader::register('GeoeventsModelThirdcontents', JPATH_COMPONENT .DS. 'models' .DS. 'thirdcontents.php');
JLoader::register('GeoeventsModelThirdcontent', JPATH_COMPONENT .DS. 'models' .DS. 'thirdcontent.php');

// Handle cross compatibilities
require_once(dirname(__FILE__) .DS. 'mvc.php');

// Load the component Dependencies
require_once(dirname(__FILE__) .DS. 'helper.php');

// Always use the Javascript framework for UI
JHTML::_("behavior.framework");


// Configure paths
$lang = JFactory::getLanguage();
if ($app->isSite())
{
	$lang->load('com_geoevents', JPATH_SITE);
	CkJController::addModelPath(JPATH_SITE_GEOEVENTS .DS.'models');
}
else
{
	$lang->load('com_geoevents', JPATH_ADMINISTRATOR);
	CkJController::addModelPath(JPATH_ADMIN_GEOEVENTS .DS.'models');
}


// Set the table directory
JTable::addIncludePath(JPATH_ADMIN_GEOEVENTS . DS . 'tables');

//Instance JDom
if (!isset($app->dom))
{
	jimport('jdom.dom');
	if (!class_exists('JDom'))
		JError::raiseError(null, 'JDom plugin is required');

	JDom::getInstance();	
}