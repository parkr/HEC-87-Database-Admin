<?php
App::uses('AppController', 'Controller');
/**
 * Pages Controller
 *
 * @property Page $Page
 */
class PagesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Page->recursive = 0;
		$this->set('pages', $this->paginate());
	}
	
	public function display(){
		$this->set('title_for_layout', 'Home');
	}

}
