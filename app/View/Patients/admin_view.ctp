<div class="patients view">
<h2><?php echo __('Patient'); ?></h2>
	<table>
		<tr>
			<td width="20%"><?php echo __('Id'); ?></td>
			<td><?php echo h($patient['Patient']['id']); ?></td>
		</tr>
		<tr>
			<td><?php echo __('Voornaam'); ?></td>
			<td><?php echo h($patient['Patient']['firstname']); ?></td>
		</tr>

		<tr>
			<td><?php echo __('Achternaam'); ?></td>
			<td><?php echo h($patient['Patient']['lastname']); ?></td>
		</tr>
		<tr>
			<td><?php echo __('Adres'); ?></td>
			<td><?php echo h($patient['Patient']['street']); ?></td>
		</tr>
		<tr>
			<td><?php echo __('Huisnummer'); ?></td>
			<td><?php echo h($patient['Patient']['housenumber']); ?></td>
		</tr>
		<tr>
			<td><?php echo __('Huisnummer toevoeging'); ?></td>
			<td><?php echo h($patient['Patient']['housenumber_addition']); ?></td>
		</tr>
		<tr>
			<td><?php echo __('Postcode'); ?></td>
			<td><?php echo h($patient['Patient']['zipcode']); ?></td>
		</tr>
		<tr>
			<td><?php echo __('Stad'); ?></td>
			<td><?php echo h($patient['Patient']['city']); ?></td>
		</tr>
		<tr>
			<td><?php echo __('Land'); ?></td>
			<td><?php echo h($patient['Patient']['country']); ?></td>
		</tr>
		<tr>
			<td><?php echo __('Email'); ?></td>
			<td><?php echo h($patient['Patient']['email']); ?></td>
		</tr>
		<tr>
			<td><?php echo __('Geboortedatum'); ?></td>
			<td><?php echo h($patient['Patient']['birthday']); ?></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo __('Created'); ?></td>
			<td><?php echo h($patient['Patient']['created']); ?></td>
		</tr>
		<tr>
			<td><?php echo __('Modified'); ?></td>
			<td><?php echo h($patient['Patient']['modified']); ?></td>
		</tr>
	</table>
</div>
<div class="actions">
	<h3><?php echo __('Links'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Patient Aanpassen'), array('action' => 'edit', $patient['Patient']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Patient Verwijderen'), array('action' => 'delete', $patient['Patient']['id']), null, __('Are you sure you want to delete # %s?', $patient['Patient']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Patientenlijst'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nieuwe Patient'), array('action' => 'add')); ?> </li>
	</ul>
</div>
