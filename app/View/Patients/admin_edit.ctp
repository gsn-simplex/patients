<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

<div class="patients form">
<?php echo $this->Form->create('Patient'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Patient'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('firstname', array('label' => 'Voornaam'));
		echo $this->Form->input('lastname', array('label' => 'Achternaam'));
		echo $this->Form->input('street', array('label' => 'Adres'));
		echo $this->Form->input('housenumber', array('label' => 'Huisnummer'));
		echo $this->Form->input('housenumber_addition', array('label' => 'Huisnummer toevoeging'));
		echo $this->Form->input('zipcode', array('label' => 'Postcode'));
		echo $this->Form->input('city', array('label' => 'Stad'));
		echo $this->Form->input('country', array('label' => 'Land'));
		echo $this->Form->input('email', array('label' => 'Email'));
		echo $this->Form->input('birthday', array('label' => 'Geboortedatum', 'type' => 'text', 'id' => 'datepicker'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Links'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Patient Verwijderen'), array('action' => 'delete', $this->Form->value('Patient.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Patient.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Patientenlijst'), array('action' => 'index')); ?></li>
	</ul>
</div>

<script>
$(function() {
	$( "#datepicker" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "yy-mm-dd",
		maxDate: "0",
		yearRange: "-100:+0"
	});
});
</script>