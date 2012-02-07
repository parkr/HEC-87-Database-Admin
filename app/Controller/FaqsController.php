<?php
App::uses('AppController', 'Controller');
/**
 * Faqs Controller
 *
 * @property Faq $Faq
 */
class FaqsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Faq->recursive = 0;
		$this->set('faqs', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Faq->id = $id;
		if (!$this->Faq->exists()) {
			throw new NotFoundException(__('Invalid faq'));
		}
		$this->set('faq', $this->Faq->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Faq->create();
			if ($this->Faq->save($this->request->data)) {
				$this->Session->setFlash(__('The faq has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The faq could not be saved. Please, try again.'));
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
		$this->Faq->id = $id;
		if (!$this->Faq->exists()) {
			throw new NotFoundException(__('Invalid faq'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Faq->save($this->request->data)) {
				$this->Session->setFlash(__('The faq has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The faq could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Faq->read(null, $id);
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
		$this->Faq->id = $id;
		if (!$this->Faq->exists()) {
			throw new NotFoundException(__('Invalid faq'));
		}
		if ($this->Faq->delete()) {
			$this->Session->setFlash(__('Faq deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Faq was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
