<div class="sponsors form">
<?php echo $this->Form->create('Sponsor');?>
	<fieldset>
		<legend><?php echo __('Add Sponsor'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('giving_level');
		echo $this->Form->input('photo_url');
		echo $this->Form->input('website');
		echo $this->Form->input('details');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Sponsors'), array('action' => 'index'));?></li>
	</ul>
</div>
