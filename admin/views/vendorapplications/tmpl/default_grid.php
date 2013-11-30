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


JHtml::addIncludePath(JPATH_ADMIN_GEOEVENTS.'/helpers/html');
JHtml::_('behavior.tooltip');
//JHtml::_('behavior.multiselect');

$model		= $this->model;
$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$saveOrder	= $listOrder == 'a.ordering' && $listDirn != 'desc';
?>
<div class="clearfix"></div>
<div class="">
	<table class='table' id='grid-vendorapplications'>
		<thead>
			<tr>
				<?php if ($model->canSelect()): ?>
				<th>
					<?php echo JDom::_('html.form.input.checkbox', array(
						'dataKey' => 'checkall-toggle',
						'title' => JText::_('JGLOBAL_CHECK_ALL'),
						'selectors' => array(
							'onclick' => 'Joomla.checkAll(this);'
						)
					)); ?>
				</th>
				<?php endif; ?>

				<th style="text-align:left" width="20%">
					<?php echo JHTML::_('grid.sort',  "GEOEVENTS_FIELD_VENDOR_NAME", 'a.vendor_name', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:left" width="8%">
					<?php echo JHTML::_('grid.sort',  "GEOEVENTS_FIELD_NAME", '_user_.name', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:center" width="12%">
					<?php echo JHTML::_('grid.sort',  "GEOEVENTS_FIELD_STORE_TYPE", 'a.store_type', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:left" width="12%">
					<?php echo JText::_("GEOEVENTS_FIELD_PRODUCTS"); ?>
				</th>

				<th style="text-align:right" width="8%">
					<?php echo JHTML::_('grid.sort',  "GEOEVENTS_FIELD_FRONTAGE", 'a.frontage', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:center" width="8%">
					<?php echo JHTML::_('grid.sort',  "GEOEVENTS_FIELD_NUMBER_OF_WORKERS", 'a.number_of_workers', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:center" width="8%">
					<?php echo JHTML::_('grid.sort',  "GEOEVENTS_FIELD_INDIGENOUS", 'a.indigenous', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:center" width="8%">
					<?php echo JHTML::_('grid.sort',  "GEOEVENTS_FIELD_FEE", 'a.fee', $listDirn, $listOrder ); ?>
				</th>

				<th width="8%">
					<?php echo JHTML::_('grid.sort',  "GEOEVENTS_FIELD_APPROVED", 'a.approved', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:center" width="8%">
					<?php echo JHTML::_('grid.sort',  "GEOEVENTS_FIELD_CREATION_DATE", 'a.creation_date', $listDirn, $listOrder ); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$k = 0;
		for ($i=0, $n=count( $this->items ); $i < $n; $i++):
			$row = &$this->items[$i];
			?>

			<tr class="<?php echo "row$k"; ?>">
				<?php if ($model->canSelect()): ?>
				<td>
					<?php if ($row->params->get('access-edit') || $row->params->get('tag-checkedout')): ?>
						<?php echo JDom::_('html.grid.checkedout', array(
													'dataObject' => $row,
													'num' => $i
														));
						?>
					<?php endif; ?>
				</td>
				<?php endif; ?>

				<td style="text-align:left" width="20%">
					<?php echo JDom::_('html.fly', array(
						'commandAcl' => array('core.edit.own', 'core.edit'),
						'dataKey' => 'vendor_name',
						'dataObject' => $row,
						'num' => $i,
						'task' => 'vendorapplication.edit'
					));?>
				</td>

				<td style="text-align:left" width="8%">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => '_user_name',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center" width="12%">
					<?php echo JDom::_('html.fly.enum', array(
						'dataKey' => 'store_type',
						'dataObject' => $row,
						'labelKey' => 'text',
						'list' => GeoeventsHelper::enumList('vendorapplications', 'store_type'),
						'listKey' => 'value'
					));?>
				</td>

				<td style="text-align:left" width="12%">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'products',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:right" width="8%">
					<?php echo JDom::_('html.fly.enum', array(
						'dataKey' => 'frontage',
						'dataObject' => $row,
						'labelKey' => 'text',
						'list' => GeoeventsHelper::enumList('vendorapplications', 'frontage'),
						'listKey' => 'value'
					));?>
				</td>

				<td style="text-align:center" width="8%">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'number_of_workers',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center" width="8%">
					<?php echo JDom::_('html.fly.bool', array(
						'dataKey' => 'indigenous',
						'dataObject' => $row,
						'togglable' => false,
						'viewType' => 'icon'
					));?>
				</td>

				<td style="text-align:center" width="8%">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => 'fee',
						'dataObject' => $row
					));?>
				</td>

				<td width="8%">
					<?php echo JDom::_('html.grid.bool', array(
						'commandAcl' => array('core.edit.own', 'core.edit'),
						'ctrl' => 'vendorapplication',
						'dataKey' => 'approved',
						'dataObject' => $row,
						'num' => $i,
						'taskYes' => 'toggle_approved',
						'viewType' => 'icon'
					));?>
				</td>

				<td style="text-align:center" width="8%">
					<?php echo JDom::_('html.fly.datetime', array(
						'dataKey' => 'creation_date',
						'dataObject' => $row,
						'dateFormat' => 'Y-m-d'
					));?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		endfor;
		?>
		</tbody>
	</table>
</div>
