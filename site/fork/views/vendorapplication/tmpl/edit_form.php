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


$fieldSets = $this->form->getFieldsets();

// get html content to display
$params = JFactory::getApplication()->getParams();
?>
<?php $fieldSet = $this->form->getFieldset('edit.form');?>
<fieldset class="fieldsform form-horizontal">


	<?php
	// Event
	$field = $fieldSet['jform_event'];
	$field->jdomOptions = array(
		'list' => $this->lists['fk']['event']
			);
	?>

	<?php echo $field->input; ?>



	<?php
	// Vendor Name
	$field = $fieldSet['jform_vendor_name'];
	?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
		<div class="control-label">
			<?php echo $field->label; ?>
		</div>
	
	    <div class="controls">
			<?php echo $field->input; ?>
		</div>
	</div>


	<?php
	// Store type
	$field = $fieldSet['jform_store_type'];
	$field->jdomOptions = array(
		'list' => $this->lists['select']['store_type']->list
			);
	?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
		<div class="control-label">
			<?php echo $field->label; ?>
		</div>
	
	    <div class="controls">
			<?php echo $field->input; ?>
		</div>
	</div>

	


	<?php
	// Products
	$field = $fieldSet['jform_products'];
	?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
		<div class="control-label">
			<?php echo $field->label; ?>
		</div>
	
	    <div class="controls">
			<?php echo $field->input; ?>
		</div>
	</div>
	
	<?php
	// Description
	$field = $fieldSet['jform_description'];
	?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
		<div class="control-label">
			<?php echo $field->label; ?>
		</div>
	
	    <div class="controls">
			<?php echo $field->input; ?>
		</div>
	</div>

	<div class="field-break"></div>

<?php
	// Frontage
	$field = $fieldSet['jform_frontage'];
	$field->jdomOptions = array(
		'list' => $this->lists['select']['frontage']->list
			);
	?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
		<div class="control-label">
			<?php echo $field->label; ?>
		</div>
	
	    <div class="controls">
			<?php echo $field->input; ?>
		</div>
	</div>

	<?php
	// Number of workers
	$field = $fieldSet['jform_number_of_workers'];
	?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
		<div class="control-label">
			<?php echo $field->label; ?>
		</div>
	
	    <div class="controls">
			<?php echo $field->input; ?>
		</div>
	</div>

	<?php
	// Electricity
	$field = $fieldSet['jform_electricity'];
	?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
		<div class="control-label">
			<?php echo $field->label; ?>
		</div>
	
	    <div class="controls">
			<?php echo $field->input; ?>
		</div>
	</div>

	<div class="field-break"></div>

	<?php
	// Indigenous
	$field = $fieldSet['jform_indigenous'];
	?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
		<div class="control-label">
			<?php echo $field->label; ?>
		</div>
	
	    <div class="controls">
			<?php echo $field->input; ?>
		</div>
	</div>

	<?php
	// Offer work shop
	$field = $fieldSet['jform_offer_work_shop'];
	?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
		<div class="control-label">
			<?php echo $field->label; ?>
		</div>
	
	    <div class="controls">
			<?php echo $field->input; ?>
		</div>
	</div>

	<div class="field-break"></div>
	
	<div class="control-group terms-and-conditions">
		<div class="control-label">
			Terms and conditions
		</div>
		<div class="controls">
			<textarea><?php echo $params->get('vendor_terms_and_conditions'); ?></textarea>
		</div>
	</div>
	
	<?php
	// Agree to conditions
	$field = $fieldSet['jform_agree_to_conditions'];
	?>
	<div class="control-group <?php echo 'field-' . $field->id . $field->responsive; ?>">
		<div class="control-label">
			<?php echo $field->label; ?>
		</div>
	
	    <div class="controls">
			<?php echo $field->input; ?>
		</div>
	</div>
</fieldset>
