<div class="sponsors form">
<?php echo $this->Form->create('Sponsor');?>
	<fieldset>
		<legend><?php echo __('Edit Sponsor'); ?></legend>
	<?php
		$options = array();
		foreach($givingLevels as $givingLevel){
			$options[$givingLevel] = $givingLevel;
		}
		echo $this->Form->input('name');
		echo $this->Form->input('giving_level', array(
			'options' => $options
		));
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Sponsor.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Sponsor.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Sponsors'), array('action' => 'index'));?></li>
	</ul>
</div>
