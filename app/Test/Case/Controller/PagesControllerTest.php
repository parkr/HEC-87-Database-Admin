<?php
/* Pages Test cases generated on: 2012-02-07 03:07:03 : 1328602023*/
App::uses('PagesController', 'Controller');

/**
 * TestPagesController *
 */
class TestPagesController extends PagesController {
/**
 * Auto render
 *
 * @var boolean
 */
	public $autoRender = false;

/**
 * Redirect action
 *
 * @param mixed $url
 * @param mixed $status
 * @param boolean $exit
 * @return void
 */
	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

/**
 * PagesController Test Case
 *
 */
class PagesControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.page');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Pages = new TestPagesController();
		$this->Pages->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Pages);

		parent::tearDown();
	}

}
