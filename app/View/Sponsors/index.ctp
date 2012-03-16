<div class="sponsors index">
	<h2><?php echo __('Sponsors');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('giving_level');?></th>
			<th><?php echo $this->Paginator->sort('photo_url');?></th>
			<th><?php echo $this->Paginator->sort('website');?></th>
			<th><?php echo $this->Paginator->sort('details');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($sponsors as $sponsor): ?>
	<tr>
		<td><?php echo h($sponsor['Sponsor']['name']); ?>&nbsp;</td>
		<td><?php echo h($sponsor['Sponsor']['giving_level']); ?>&nbsp;</td>
		<td><?php echo h($sponsor['Sponsor']['photo_url']); ?>&nbsp;</td>
		<td><?php echo h($sponsor['Sponsor']['website']); ?>&nbsp;</td>
		<td><?php echo truncate($sponsor['Sponsor']['details'], 10); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $sponsor['Sponsor']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $sponsor['Sponsor']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $sponsor['Sponsor']['id']), null, __('Are you sure you want to delete # %s?', $sponsor['Sponsor']['id'])); ?>
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
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Sponsor'), array('action' => 'add')); ?></li>
	</ul>
</div>
