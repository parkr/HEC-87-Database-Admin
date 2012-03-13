<div class="speakers view">
<h2><?php  echo __('Speaker');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($speaker['Speaker']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event'); ?></dt>
		<dd>
			<?php echo $this->Html->link($speaker['Event']['name'], array('controller' => 'events', 'action' => 'view', $speaker['Event']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($speaker['Speaker']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($speaker['Speaker']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Position'); ?></dt>
		<dd>
			<?php echo h($speaker['Speaker']['position']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company'); ?></dt>
		<dd>
			<?php echo h($speaker['Speaker']['company']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bio'); ?></dt>
		<dd>
			<?php echo h($speaker['Speaker']['bio']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Photo'); ?></dt>
		<dd>
			<?php echo h($speaker['Speaker']['photo']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Speaker'), array('action' => 'edit', $speaker['Speaker']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Speaker'), array('action' => 'delete', $speaker['Speaker']['id']), null, __('Are you sure you want to delete # %s?', $speaker['Speaker']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Speakers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Speaker'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
	</ul>
</div>
