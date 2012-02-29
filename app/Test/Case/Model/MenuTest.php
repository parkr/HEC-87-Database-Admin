<?php
/* Menu Test cases generated on: 2012-02-29 00:27:21 : 1330493241*/
App::uses('Menu', 'Model');

/**
 * Menu Test Case
 *
 */
class MenuTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.menu', 'app.event', 'app.speaker', 'app.user', 'app.hash', 'app.events_user', 'app.food_item');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Menu = ClassRegistry::init('Menu');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Menu);

		parent::tearDown();
	}

}
