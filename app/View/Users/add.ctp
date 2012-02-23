<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('role', array(
			'type' => 'select',
			'selected' => 'user',
			'options' => array(
				'user' => 'user', 
				'admin' => 'admin'
			)
		));
		echo $this->Form->input('type', array(
			'type' => 'select',
			'selected' => 'attendee',
			'options' => array(
				'attendee' => 'attendee', 
				'student' => 'student'
			)
		));
		echo $this->Form->input('name');
		echo $this->Form->input('password');
		echo $this->Form->input('email');
		echo $this->Form->input('phone_number');
		echo $this->Form->input('show_contact_info');
		echo $this->Form->input('graduation_year');
		echo $this->Form->input('position');
		echo $this->Form->input('company');
		echo $this->Form->input('bio');
		echo $this->Form->input('picture', array('type' => 'file'));
		echo $this->Form->input('Event', array(
			'disabled' => 'disabled'
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Hashes'), array('controller' => 'hashes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Hash'), array('controller' => 'hashes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
	</ul>
</div>
