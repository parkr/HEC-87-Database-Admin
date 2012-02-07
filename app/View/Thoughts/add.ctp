<div class="thoughts form">
<?php echo $this->Form->create('Thought');?>
	<fieldset>
		<legend><?php echo __('Add Thought'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('link');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Thoughts'), array('action' => 'index'));?></li>
	</ul>
</div>
