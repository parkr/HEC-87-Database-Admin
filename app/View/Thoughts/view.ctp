<div class="thoughts view">
<h2><?php  echo __('Thought');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($thought['Thought']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($thought['Thought']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Link'); ?></dt>
		<dd>
			<?php echo h($thought['Thought']['link']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Thought'), array('action' => 'edit', $thought['Thought']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Thought'), array('action' => 'delete', $thought['Thought']['id']), null, __('Are you sure you want to delete # %s?', $thought['Thought']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Thoughts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Thought'), array('action' => 'add')); ?> </li>
	</ul>
</div>
