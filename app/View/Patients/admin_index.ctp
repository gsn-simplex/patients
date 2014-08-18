<div class="patients index">
	<h2><?php echo __('Patienten'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('firstname'); ?></th>
			<th><?php echo $this->Paginator->sort('lastname'); ?></th>
			<th><?php echo $this->Paginator->sort('zipcode'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('birthday'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($patients as $patient): ?>
	<tr>
		<td><?php echo h($patient['Patient']['id']); ?>&nbsp;</td>
		<td><?php echo h($patient['Patient']['firstname']); ?>&nbsp;</td>
		<td><?php echo h($patient['Patient']['lastname']); ?>&nbsp;</td>
		<td><?php echo h($patient['Patient']['zipcode']); ?>&nbsp;</td>
		<td><?php echo h($patient['Patient']['email']); ?>&nbsp;</td>
		<td><?php echo h($patient['Patient']['birthday']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link("", array('action' => 'view', $patient['Patient']['id']), array("class" => "glyphicon glyphicon-eye-open btn")); ?>
			<?php echo $this->Html->link("", array('action' => 'edit', $patient['Patient']['id']), array("class" => "glyphicon glyphicon-pencil btn")); ?>
			<?php echo $this->Form->postLink("", array('action' => 'delete', $patient['Patient']['id']), array("class" => "glyphicon glyphicon-remove btn btn-danger"), __('Are you sure you want to delete # %s?', $patient['Patient']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Links'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Nieuwe Patient'), array('action' => 'add')); ?></li>
	</ul>
</div>
