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
defined('_JEXEC') or die('Restricted access');



/**
* Geoevents Helper functions.
*
* @package	Geoevents
* @subpackage	Helper
*/
class GeoeventsCkHelper
{
	/**
	* Cache for ACL actions
	*
	* @var object
	*/
	protected static $acl = null;

	/**
	* Directories aliases.
	*
	* @var array
	*/
	protected static $directories;

	/**
	* Determines when requirements have been loaded.
	*
	* @var boolean
	*/
	protected static $loaded = null;

	/**
	* Call a JS file. Manage fork files.
	*
	* @access	protected static
	* @param	JDocument	$doc	Document.
	* @param	string	$base	Component base from site root.
	* @param	string	$file	Component file.
	* @param	boolean	$replace	Replace the file or override. (Default : Replace)
	* @return	void
	*
	* @since	Cook 2.0
	*/
	protected static function addScript($doc, $base, $file, $replace = true)
	{
		$url = JURI::root(true) . '/' . $base . '/' . $file;
		$url = str_replace(DS, '/', $url);
		
		$urlFork = null;
		if (file_exists(JPATH_SITE .DS. $base .DS. 'fork' .DS. $file))
		{
			$urlFork = JURI::root(true) . '/' . $base . '/fork/' . $file;
			$urlFork = str_replace(DS, '/', $urlFork);
		}

		if ($replace && $urlFork)
			$url = $urlFork;

		$doc->addScript($url);

		if (!$replace && $urlFork)
			$doc->addScript($urlFork);
	}

	/**
	* Call a CSS file. Manage fork files.
	*
	* @access	protected static
	* @param	JDocument	$doc	Document.
	* @param	string	$base	Component base from site root.
	* @param	string	$file	Component file.
	* @param	boolean	$replace	Replace the file or override. (Default : Override)
	* @return	void
	*
	* @since	Cook 2.0
	*/
	protected static function addStyleSheet($doc, $base, $file, $replace = false)
	{
		$url = JURI::root(true) . '/' . $base . '/' . $file;
		$url = str_replace(DS, '/', $url);

		$urlFork = null;
		if (file_exists(JPATH_SITE .DS. $base .DS. 'fork' .DS. $file))
		{
			$urlFork = JURI::root(true) . '/' . $base . '/fork/' . $file;
			$urlFork = str_replace(DS, '/', $urlFork);
		}

		if ($replace && $urlFork)
			$url = $urlFork;

		$doc->addStyleSheet($url);

		if (!$replace && $urlFork)
			$doc->addStyleSheet($urlFork);
	}

	/**
	* Configure the Linkbar.
	*
	* @access	public static
	* @param	varchar	$view	The name of the active view.
	* @param	varchar	$layout	The name of the active layout.
	* @param	varchar	$alias	The name of the menu. Default : 'menu'
	* @return	void
	*
	* @since	1.6
	*/
	public static function addSubmenu($view, $layout, $alias = 'menu')
	{
		$items = self::getMenuItems();

		// Will be handled in XML in future (or/and with the Joomla native menus)
		// -> give your opinion on j-cook.pro/forum

		
		$client = 'admin';
		if (JFactory::getApplication()->isSite())
			$client = 'site';
	
		$links = array();
		switch($client)
		{
			case 'admin':
				switch($alias)
				{
					case 'cpanel':
					case 'menu':
					default:
						$links = array(
							'admin.events.default',
							'admin.vendorapplications.default'
						);
								
						if ($alias != 'cpanel')
							array_unshift($links, 'admin.cpanel');
					
						break;
				}
				break;
		
			case 'site':
				switch($alias)
				{
					case 'cpanel':
					case 'menu':
					default:
						$links = array(				);
								
						if ($alias != 'cpanel')
							array_unshift($links, 'site.cpanel');
					
						break;
				}
				break;
		}


		//Compile with selected items in the right order
		$menu = array();
		foreach($links as $link)
		{
			if (!isset($items[$link]))
				continue;	// Not found
		
			$item = $items[$link];
	
			// Menu link
			$extension = 'com_geoevents';
			if (isset($item['extension']))
				$extension = $item['extension'];
	
			$url = 'index.php?option=' . $extension;
			if (isset($item['view']))
				$url .= '&view=' . $item['view'];
			if (isset($item['layout']))
				$url .= '&layout=' . $item['layout'];
	
			// Is active
			$active = ($item['view'] == $view);
			if (isset($item['layout']))
				$active = $active && ($item['layout'] == $layout);
	
			// Reconstruct it the Joomla format
			$menu[] = array(JText::_($item['label']), $url, $active, $item['icon']);

		}

		$version = new JVersion();
		//Create the submenu in the old fashion way
		if (version_compare($version->RELEASE, '3.0', '<'))
		{
			$html = "";	
			// Prepare the submenu module
			foreach ($menu as $entry )
				JSubMenuHelper::addEntry($entry[0], $entry[1], $entry[2]);
		}

		return $menu;
	}

	/**
	* Prepare the enumeration static lists.
	*
	* @access	public static
	* @param	string	$ctrl	The model in wich to find the list.
	* @param	string	$fieldName	The field reference for this list.
	*
	* @return	array	Prepared arrays to fill lists.
	*/
	public static function enumList($ctrl, $fieldName)
	{
		$lists = array();

		$lists["vendorapplications"]["store_type"] = array();
		$lists["vendorapplications"]["store_type"]["1"] = array("value" => "1", "text" => JText::_("GEOEVENTS_ENUM_VENDORAPPLICATIONS_STORE_TYPE_FOODBEVERAGE"));
		$lists["vendorapplications"]["store_type"]["2"] = array("value" => "2", "text" => JText::_("GEOEVENTS_ENUM_VENDORAPPLICATIONS_STORE_TYPE_CLOTHINGJEWELRYOTHER"));


		$lists["vendorapplications"]["frontage"] = array();
		$lists["vendorapplications"]["frontage"]["3"] = array("value" => "3", "text" => JText::_("GEOEVENTS_ENUM_VENDORAPPLICATIONS_FRONTAGE_3_METERS"));
		$lists["vendorapplications"]["frontage"]["4 "] = array("value" => "4 ", "text" => JText::_("GEOEVENTS_ENUM_VENDORAPPLICATIONS_FRONTAGE_4_METERS_50"));
		$lists["vendorapplications"]["frontage"]["5"] = array("value" => "5", "text" => JText::_("GEOEVENTS_ENUM_VENDORAPPLICATIONS_FRONTAGE_5_METERS_100"));
		$lists["vendorapplications"]["frontage"]["6"] = array("value" => "6", "text" => JText::_("GEOEVENTS_ENUM_VENDORAPPLICATIONS_FRONTAGE_6_METERS_150"));




		return $lists[$ctrl][$fieldName];
	}

	/**
	* Gets a list of the actions that can be performed.
	*
	* @access	public static
	*
	* @return	JObject	An ACL object containing authorizations
	*
	* @deprecated	Cook 2.0
	*/
	public static function getAcl()
	{
		return self::getActions();
	}

	/**
	* Gets a list of the actions that can be performed.
	*
	* @access	public static
	* @param	integer	$itemId	The item ID.
	*
	* @return	JObject	An ACL object containing authorizations
	*
	* @since	1.6
	*/
	public static function getActions($itemId = 0)
	{
		if (isset(self::$acl))
			return self::$acl;

		$user	= JFactory::getUser();
		$result	= new JObject;

		$actions = array(
			'core.admin',
			'core.manage',
			'core.create',
			'core.edit',
			'core.edit.state',
			'core.edit.own',
			'core.delete',
			'core.delete.own',
			'core.view.own',
		);

		foreach ($actions as $action)
			$result->set($action, $user->authorise($action, COM_GEOEVENTS));

		self::$acl = $result;

		return $result;
	}

	/**
	* Return the directories aliases full paths
	*
	* @access	public static
	*
	* @return	array	Arrays of aliases relative path from site root.
	*
	* @since	since
	*/
	public static function getDirectories()
	{
		if (!empty(self::$directories))
			return self::$directories;

		$configMedias = JComponentHelper::getParams('com_media');
		$config = JComponentHelper::getParams('com_geoevents');

		$comAlias = "com_geoevents";
		$directories = array(


			'DIR_TRASH' => $config->get("trash_dir", 'images' . DS . "trash"),

			'COM_ADMIN' => "administrator" .DS. 'components' .DS. $comAlias,
			'ADMIN' => "administrator",
			'COM_SITE' => 'components' .DS. $comAlias,
			'IMAGES' => $config->get('image_path', 'images'),
			'MEDIAS' => $configMedias->get('file_path', 'images'),
			'ROOT' => '',

		);



		self::$directories = $directories;
		return self::$directories;
	}

	/**
	* Get a file path or url depending of the method
	*
	* @access	public static
	* @param	string	$path	File path. Can contain directories aliases.
	* @param	string	$indirect	Method to access the file : [direct,indirect,physical]
	* @param	array	$options	File parameters.
	*
	* @return	string	File path or url
	*
	* @since	Cook 2.6.1
	*/
	public static function getFile($path, $indirect = 'physical', $options = null)
	{
		switch ($indirect)
		{
			case 'physical':	// Physical file on the drive (url is a path here)
				return GeoeventsClassFile::getPhysical($path, $options);
	
			case 'direct':		// Direct url
				return GeoeventsClassFile::getUrl($path, $options);
	
			case 'indirect':	// Indirect file access (through controller)
			default:
				return GeoeventsClassFile::getIndirectUrl($path, $options);
		}
	}

	/**
	* Extract usefull informations from the thumb creator.
	*
	* @access	public static
	* @param	string	$path	File path. Can contain directories aliases.
	* @param	array	$options	File parameters.
	*
	* @return	mixed	Array of various informations
	*
	* @since	Cook 2.6.1
	*/
	public static function getImageInfos($path, $options = null)
	{
		include_once(JPATH_ADMIN_GEOEVENTS .DS. 'classes' .DS. 'images.php');

		$filename = self::getFile($path, 'physical', null);

		$mime = GeoeventsClassFile::getMime($filename);
		$thumb = new GeoeventsClassImage($filename, $mime);

		$attrs = isset($options['attrs'])?$options['attrs']:null;
		$w = isset($options['width'])?(int)$options['width']:0;
		$h = isset($options['height'])?(int)$options['height']:0;

		if ($attrs)
			$thumb->attrs($attrs);

		$thumb->width($w);
		$thumb->height($h);
		$info = $thumb->info();
		
		return $info;
	}

	/**
	* Get an indirect url to find image through model restrictions.
	*
	* @access	public static
	* @param	string	$view	List model name
	* @param	string	$key	Field name where is stored the filename
	* @param	string	$id	Item id
	* @param	array	$options	File parameters.
	*
	* @return	string	Indirect url
	*
	* @since	Cook 2.6.1
	*/
	public static function getIndexedFile($view, $key, $id, $options = null)
	{
		return GeoeventsClassFile::getIndexUrl($view, $key, $id, $options);
	}

	/**
	* Load all menu items.
	*
	* @access	public static
	* @return	void
	*
	* @since	Cook 2.0
	*/
	public static function getMenuItems()
	{
		// Will be handled in XML in future (or/and with the Joomla native menus)
		// -> give your opinion on j-cook.pro/forum

		$items = array();

		$items['admin.events.default'] = array(
			'label' => 'GEOEVENTS_LAYOUT_EVENTS',
			'view' => 'events',
			'layout' => 'default',
			'icon' => 'geoevents_events'
		);

		$items['admin.vendorapplications.default'] = array(
			'label' => 'GEOEVENTS_LAYOUT_VENDOR_APPLICATIONS',
			'view' => 'vendorapplications',
			'layout' => 'default',
			'icon' => 'geoevents_vendorapplications'
		);

		$items['admin.cpanel'] = array(
			'label' => 'GEOEVENTS_LAYOUT_GEO_EVENTS',
			'view' => 'cpanel',
			'icon' => 'geoevents_cpanel'
		);

		$items['site.cpanel'] = array(
			'label' => 'GEOEVENTS_LAYOUT_GEO_EVENTS',
			'view' => 'cpanel',
			'icon' => 'geoevents_cpanel'
		);

		return $items;
	}

	/**
	* Defines the headers of your template.
	*
	* @access	public static
	*
	* @return	void	
	* @return	void
	*/
	public static function headerDeclarations()
	{
		if (self::$loaded)
			return;
	
		$app = JFactory::getApplication();
		$doc = JFactory::getDocument();

		$siteUrl = JURI::root(true);

		$baseSite = 'components' .DS. COM_GEOEVENTS;
		$baseAdmin = 'administrator' .DS. 'components' .DS. COM_GEOEVENTS;

		$componentUrl = $siteUrl . '/' . str_replace(DS, '/', $baseSite);
		$componentUrlAdmin = $siteUrl . '/' . str_replace(DS, '/', $baseAdmin);

		//Required libraries
		//jQuery Loading : Abstraction to handle cross versions of Joomla
		JDom::_('framework.jquery');
		JDom::_('framework.jquery.chosen');
		JDom::_('framework.bootstrap');
		JDom::_('html.icon.glyphicon');
		JDom::_('html.icon.icomoon');


		//Load the jQuery-Validation-Engine (MIT License, Copyright(c) 2011 Cedric Dugas http://www.position-absolute.com)
		self::addScript($doc, $baseAdmin, 'js' .DS. 'jquery.validationEngine.js');
		self::addStyleSheet($doc, $baseAdmin, 'css' .DS. 'validationEngine.jquery.css');
		GeoeventsHelperHtmlValidator::loadLanguageScript();



		//CSS
		if ($app->isAdmin())
		{


			self::addStyleSheet($doc, $baseAdmin, 'css' .DS. 'geoevents.css');
			self::addStyleSheet($doc, $baseAdmin, 'css' .DS. 'toolbar.css');

		}
		else if ($app->isSite())
		{
			self::addStyleSheet($doc, $baseSite, 'css' .DS. 'geoevents.css');
			self::addStyleSheet($doc, $baseSite, 'css' .DS. 'toolbar.css');

		}



		self::$loaded = true;
	}

	/**
	* Recreate the URL with a redirect in order to : -> keep an good SEF ->
	* always kill the post -> precisely control the request
	*
	* @access	public static
	* @param	array	$vars	The array to override the current request.
	*
	* @return	string	Routed URL.
	*/
	public static function urlRequest($vars = array())
	{
		$parts = array();

		// Authorisated followers
		$authorizedInUrl = array(
					'option' => null, 
					'view' => null, 
					'layout' => null, 
					'Itemid' => null, 
					'tmpl' => null,
					'object' => null,
					'lang' => null);

		$jinput = JFactory::getApplication()->input;

		$request = $jinput->getArray($authorizedInUrl);

		foreach($request as $key => $value)
			if (!empty($value))
				$parts[] = $key . '=' . $value;

		$cid = $jinput->get('cid', array(), 'ARRAY');
		if (!empty($cid))
		{
			$cidVals = implode(",", $cid);
			if ($cidVals != '0')
				$parts[] = 'cid[]=' . $cidVals;
		}

		if (count($vars))
		foreach($vars as $key => $value)
			$parts[] = $key . '=' . $value;

		return JRoute::_("index.php?" . implode("&", $parts), false);
	}


}

// Search for a fork to be able to override this class
JLoader::register('GeoeventsHelper', JPATH_ADMIN_GEOEVENTS .DS. 'fork' .DS. 'helpers' .DS. 'helper.php');
JLoader::load('GeoeventsHelper'); /* To load class in memory */
// Fallback if no fork has been found
if (!class_exists('GeoeventsHelper')){ class GeoeventsHelper extends GeoeventsCkHelper{} }

