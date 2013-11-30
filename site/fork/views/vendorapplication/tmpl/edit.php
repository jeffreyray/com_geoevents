<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.6.2   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		Geo Events
* @subpackage	Vendorapplications
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


GeoeventsHelper::headerDeclarations();
//Load the formvalidator scripts requirements.
JDom::_('html.toolbar');
?>
<script language="javascript" type="text/javascript">
	//Secure the user navigation on the page, in order preserve datas.
	//var holdForm = true;
	//window.onbeforeunload = function closeIt(){	if (holdForm) return false;};
</script>


<div class="article-header">
				<div class="article-title">
				<div class="article-title2">
				<div class="article-title3">
				<h1 class="title">
									<?php echo $this->title;?>
				</h1>
				</div>
				</div>
				</div>
				
				<div class="clear"></div>
</div>

<form action="<?php echo(JRoute::_("index.php")); ?>" method="post" name="adminForm" id="adminForm" class='form-validate' enctype='multipart/form-data'>
	<div>
		<div>

			<!-- BRICK : form -->
			<?php echo $this->loadTemplate('form'); ?>
		</div>
		<div>

			<!-- BRICK : toolbar_sing -->
			<?php echo JDom::_('html.toolbar', array(
				"bar" => JToolBar::getInstance('toolbar')
			));?>
		</div>
	</div>

		<input name="_download" type="hidden" id="_download" value=""/>

	<?php 
		$jinput = JFactory::getApplication()->input;
		echo JDom::_('html.form.footer', array(
		'dataObject' => $this->item,
		'values' => array(
					'id' => $this->state->get('vendorapplication.id')
				)));
	?>
</form>
