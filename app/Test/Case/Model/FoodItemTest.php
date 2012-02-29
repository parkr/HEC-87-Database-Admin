<?php
/* FoodItem Test cases generated on: 2012-02-29 00:33:27 : 1330493607*/
App::uses('FoodItem', 'Model');

/**
 * FoodItem Test Case
 *
 */
class FoodItemTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.food_item', 'app.menu', 'app.event', 'app.speaker', 'app.user', 'app.hash', 'app.events_user');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->FoodItem = ClassRegistry::init('FoodItem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FoodItem);

		parent::tearDown();
	}

}
