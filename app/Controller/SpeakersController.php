<?php
App::uses('AppController', 'Controller');
/**
 * Speakers Controller
 *
 * @property Speaker $Speaker
 */
class SpeakersController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Speaker->recursive = 0;
		$this->set('speakers', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Speaker->id = $id;
		if (!$this->Speaker->exists()) {
			throw new NotFoundException(__('Invalid speaker'));
		}
		$this->set('speaker', $this->Speaker->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Speaker->create();
			if ($this->Speaker->save($this->request->data)) {
				$this->Session->setFlash(__('The speaker has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The speaker could not be saved. Please, try again.'));
			}
		}
		$events = $this->Speaker->Event->find('list');
		$this->set(compact('events'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Speaker->id = $id;
		if (!$this->Speaker->exists()) {
			throw new NotFoundException(__('Invalid speaker'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Speaker->save($this->request->data)) {
				$this->Session->setFlash(__('The speaker has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The speaker could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Speaker->read(null, $id);
		}
		$events = $this->Speaker->Event->find('list');
		$this->set(compact('events'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Speaker->id = $id;
		if (!$this->Speaker->exists()) {
			throw new NotFoundException(__('Invalid speaker'));
		}
		if ($this->Speaker->delete()) {
			$this->Session->setFlash(__('Speaker deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Speaker was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
