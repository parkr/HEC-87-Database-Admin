<?php
App::uses('AppController', 'Controller');
/**
 * Thoughts Controller
 *
 * @property Thought $Thought
 */
class ThoughtsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Thought->recursive = 0;
		$this->set('thoughts', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Thought->id = $id;
		if (!$this->Thought->exists()) {
			throw new NotFoundException(__('Invalid thought'));
		}
		$this->set('thought', $this->Thought->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Thought->create();
			if ($this->Thought->save($this->request->data)) {
				$this->Session->setFlash(__('The thought has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The thought could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Thought->id = $id;
		if (!$this->Thought->exists()) {
			throw new NotFoundException(__('Invalid thought'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Thought->save($this->request->data)) {
				$this->Session->setFlash(__('The thought has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The thought could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Thought->read(null, $id);
		}
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
		$this->Thought->id = $id;
		if (!$this->Thought->exists()) {
			throw new NotFoundException(__('Invalid thought'));
		}
		if ($this->Thought->delete()) {
			$this->Session->setFlash(__('Thought deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Thought was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
