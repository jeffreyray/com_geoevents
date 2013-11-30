<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.6.2   |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		
* @package		Geo Events
* @subpackage	Events
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
JDom::_('framework.sortablelist', array(
	'domId' => 'grid-events',
	'listOrder' => $listOrder,
	'listDirn' => $listDirn,
	'formId' => 'adminForm',
	'ctrl' => 'events',
	'proceedSaveOrderButton' => true,
));
?>
<div class="clearfix"></div>
<div class="">
	<table class='table' id='grid-events'>
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
					<?php echo JHTML::_('grid.sort',  "GEOEVENTS_FIELD_TITLE", 'a.title', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:center" width="10%">
					<?php echo JHTML::_('grid.sort',  "GEOEVENTS_FIELD_START_TIME", 'a.start_time', $listDirn, $listOrder ); ?>
				</th>

				<th width="10%">
					<?php echo JHTML::_('grid.sort',  "GEOEVENTS_FIELD_END_TIME", 'a.end_time', $listDirn, $listOrder ); ?>
				</th>

				<?php if ($model->canEditState()): ?>
				<th style="text-align:center" width="10%">
					<?php echo JHTML::_('grid.sort',  "GEOEVENTS_FIELD_STATUS", 'a.published', $listDirn, $listOrder ); ?>
				</th>
				<?php endif; ?>

				<?php if ($model->canEditState()): ?>
				<th style="text-align:center" width="10%">
					<?php echo JHTML::_('grid.sort',  "GEOEVENTS_HEADING_ORDERING", 'a.ordering', $listDirn, $listOrder ); ?>
				</th>
				<?php endif; ?>

				<th style="text-align:center" width="10%">
					<?php echo JHTML::_('grid.sort',  "GEOEVENTS_FIELD_ACCESS", '_access_.title', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:center" width="10%">
					<?php echo JHTML::_('grid.sort',  "GEOEVENTS_FIELD_CREATED_BY", '_created_by_.name', $listDirn, $listOrder ); ?>
				</th>

				<th style="text-align:center" width="10%">
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
						'dataKey' => 'title',
						'dataObject' => $row,
						'num' => $i,
						'task' => 'event.edit'
					));?>
				</td>

				<td style="text-align:center" width="10%">
					<?php echo JDom::_('html.fly.datetime', array(
						'dataKey' => 'start_time',
						'dataObject' => $row,
						'dateFormat' => 'Y-m-d H:i'
					));?>
				</td>

				<td width="10%">
					<?php echo JDom::_('html.fly.datetime', array(
						'dataKey' => 'end_time',
						'dataObject' => $row,
						'dateFormat' => 'Y-m-d H:i'
					));?>
				</td>

				<?php if ($model->canEditState()): ?>
				<td style="text-align:center" width="10%">
					<?php echo JDom::_('html.grid.publish', array(
						'ctrl' => 'events',
						'dataKey' => 'published',
						'dataObject' => $row,
						'num' => $i
					));?>
				</td>
				<?php endif; ?>

				<?php if ($model->canEditState()): ?>
				<td style="text-align:center" width="10%">
					<?php echo JDom::_('html.grid.ordering', array(
						'aclAccess' => 'core.edit.state',
						'dataKey' => 'ordering',
						'dataObject' => $row,
						'enabled' => $saveOrder
					));?>
				</td>
				<?php endif; ?>

				<td style="text-align:center" width="10%">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => '_access_title',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center" width="10%">
					<?php echo JDom::_('html.fly', array(
						'dataKey' => '_created_by_name',
						'dataObject' => $row
					));?>
				</td>

				<td style="text-align:center" width="10%">
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
