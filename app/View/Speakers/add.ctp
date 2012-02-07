<div class="speakers form">
<?php echo $this->Form->create('Speaker');?>
	<fieldset>
		<legend><?php echo __('Add Speaker'); ?></legend>
	<?php
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('position');
		echo $this->Form->input('company');
		echo $this->Form->input('bio');
		echo $this->Form->input('photo');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Speakers'), array('action' => 'index'));?></li>
	</ul>
</div>
