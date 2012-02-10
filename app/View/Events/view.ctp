<div class="events view">
<h2><?php  echo __('Event');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($event['Event']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($event['Event']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($event['Event']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Time'); ?></dt>
		<dd>
			<?php echo h($event['Event']['start_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Time'); ?></dt>
		<dd>
			<?php echo h($event['Event']['end_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo h($event['Event']['location']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Photo'); ?></dt>
		<dd>
			<?php echo h($event['Event']['photo']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Event'), array('action' => 'edit', $event['Event']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Event'), array('action' => 'delete', $event['Event']['id']), null, __('Are you sure you want to delete # %s?', $event['Event']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menus'), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Speakers'), array('controller' => 'speakers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Speaker'), array('controller' => 'speakers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Menus');?></h3>
	<?php if (!empty($event['Menu'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Event Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Boh Fm'); ?></th>
		<th><?php echo __('Location'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($event['Menu'] as $menu): ?>
		<tr>
			<td><?php echo $menu['id'];?></td>
			<td><?php echo $menu['event_id'];?></td>
			<td><?php echo $menu['name'];?></td>
			<td><?php echo $menu['boh_fm'];?></td>
			<td><?php echo $menu['location'];?></td>
			<td><?php echo $menu['date'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'menus', 'action' => 'view', $menu['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'menus', 'action' => 'edit', $menu['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'menus', 'action' => 'delete', $menu['id']), null, __('Are you sure you want to delete # %s?', $menu['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Speakers');?></h3>
	<?php if (!empty($event['Speaker'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Event Id'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('Position'); ?></th>
		<th><?php echo __('Company'); ?></th>
		<th><?php echo __('Bio'); ?></th>
		<th><?php echo __('Photo'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($event['Speaker'] as $speaker): ?>
		<tr>
			<td><?php echo $speaker['id'];?></td>
			<td><?php echo $speaker['event_id'];?></td>
			<td><?php echo $speaker['first_name'];?></td>
			<td><?php echo $speaker['last_name'];?></td>
			<td><?php echo $speaker['position'];?></td>
			<td><?php echo $speaker['company'];?></td>
			<td><?php echo $speaker['bio'];?></td>
			<td><?php echo $speaker['photo'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'speakers', 'action' => 'view', $speaker['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'speakers', 'action' => 'edit', $speaker['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'speakers', 'action' => 'delete', $speaker['id']), null, __('Are you sure you want to delete # %s?', $speaker['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Speaker'), array('controller' => 'speakers', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Users');?></h3>
	<?php if (!empty($event['User'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Role'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Show Contact Info'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Phone Number'); ?></th>
		<th><?php echo __('Graduation Year'); ?></th>
		<th><?php echo __('Position'); ?></th>
		<th><?php echo __('Company'); ?></th>
		<th><?php echo __('Bio'); ?></th>
		<th><?php echo __('Photo'); ?></th>
		<th><?php echo __('Last Login'); ?></th>
		<th><?php echo __('Date Created'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($event['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id'];?></td>
			<td><?php echo $user['role'];?></td>
			<td><?php echo $user['type'];?></td>
			<td><?php echo $user['name'];?></td>
			<td><?php echo $user['password'];?></td>
			<td><?php echo $user['show_contact_info'];?></td>
			<td><?php echo $user['email'];?></td>
			<td><?php echo $user['phone_number'];?></td>
			<td><?php echo $user['graduation_year'];?></td>
			<td><?php echo $user['position'];?></td>
			<td><?php echo $user['company'];?></td>
			<td><?php echo $user['bio'];?></td>
			<td><?php echo $user['photo'];?></td>
			<td><?php echo $user['last_login'];?></td>
			<td><?php echo $user['date_created'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
