<div class="menus view">
<h2><?php  echo __('Menu');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Events'); ?></dt>
		<dd>
			<?php echo $this->Html->link($menu['Events']['name'], array('controller' => 'events', 'action' => 'view', $menu['Events']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Boh Fm'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['boh_fm']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['location']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Menu'), array('action' => 'edit', $menu['Menu']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Menu'), array('action' => 'delete', $menu['Menu']['id']), null, __('Are you sure you want to delete # %s?', $menu['Menu']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Menus'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Events'), array('controller' => 'events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Food Items'), array('controller' => 'food_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Food Item'), array('controller' => 'food_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Food Items');?></h3>
	<?php if (!empty($menu['FoodItem'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Menu Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($menu['FoodItem'] as $foodItem): ?>
		<tr>
			<td><?php echo $foodItem['id'];?></td>
			<td><?php echo $foodItem['menu_id'];?></td>
			<td><?php echo $foodItem['name'];?></td>
			<td><?php echo $foodItem['description'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'food_items', 'action' => 'view', $foodItem['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'food_items', 'action' => 'edit', $foodItem['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'food_items', 'action' => 'delete', $foodItem['id']), null, __('Are you sure you want to delete # %s?', $foodItem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Food Item'), array('controller' => 'food_items', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
