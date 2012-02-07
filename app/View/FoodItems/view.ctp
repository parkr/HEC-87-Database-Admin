<div class="foodItems view">
<h2><?php  echo __('Food Item');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($foodItem['FoodItem']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Menus'); ?></dt>
		<dd>
			<?php echo $this->Html->link($foodItem['Menus']['name'], array('controller' => 'menus', 'action' => 'view', $foodItem['Menus']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($foodItem['FoodItem']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($foodItem['FoodItem']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Food Item'), array('action' => 'edit', $foodItem['FoodItem']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Food Item'), array('action' => 'delete', $foodItem['FoodItem']['id']), null, __('Are you sure you want to delete # %s?', $foodItem['FoodItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Food Items'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Food Item'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menus'), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menus'), array('controller' => 'menus', 'action' => 'add')); ?> </li>
	</ul>
</div>
