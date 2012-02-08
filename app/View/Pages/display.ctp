<div id="section_listing" class="actions">
<?php

echo $this->Html->tag('h1', 'Select a section to edit:');

$links = array(
	$this->Html->link('Program', array('controller' => 'events'), array('data-prefetch' => 'true')),
	$this->Html->link('Speakers', array('controller' => 'speakers'), array('data-prefetch' => 'true')),
	$this->Html->link('F&B', array('controller' => 'menus'), array('data-prefetch' => 'true')),
	$this->Html->link('Profiles', array('controller' => 'users'), array('data-prefetch' => 'true')),
	$this->Html->link('Updates', array('controller' => 'pages', 'action' => 'updates'), array('data-prefetch' => 'true')),
	$this->Html->link('Maps', array('controller' => 'maps'), array('data-prefetch' => 'true')),
	$this->Html->link('Sponsors', array('controller' => 'sponsors'), array('data-prefetch' => 'true')),
	$this->Html->link('Feedback', array('controller' => 'thoughts'), array('data-prefetch' => 'true')),
	$this->Html->link('FAQs', array('controller' => 'faqs'), array('data-prefetch' => 'true'))
);
if(AuthComponent::user('id') > 0){
	$links[] = $this->Html->link('Account', array('controller' => 'users', 'action' => 'edit', AuthComponent::user('id')), array('data-icon' => 'gear'));
}
echo $this->Html->nestedList($links, array(
	'id' => 'routing'
));
?>
</div>