<?php
App::uses('AppController', 'Controller');
/**
 * Sponsors Controller
 *
 * @property Sponsor $Sponsor
 */
class SponsorsController extends AppController {

	public $givingLevels = array('platinum', 'gold', 'silver', 'bronze', 'friends');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Sponsor->recursive = 0;
		$this->set(array(
			'sponsors', $this->paginate(),
			'givingLevels' => $givingLevels
		));
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Sponsor->id = $id;
		if (!$this->Sponsor->exists()) {
			throw new NotFoundException(__('Invalid sponsor'));
		}
		$this->set('sponsor', $this->Sponsor->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Sponsor->create();
			if ($this->Sponsor->save($this->request->data)) {
				$this->Session->setFlash(__('The sponsor has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sponsor could not be saved. Please, try again.'));
			}
		}
		$this->set('givingLevels', $givingLevels);
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Sponsor->id = $id;
		if (!$this->Sponsor->exists()) {
			throw new NotFoundException(__('Invalid sponsor'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Sponsor->save($this->request->data)) {
				$this->Session->setFlash(__('The sponsor has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sponsor could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Sponsor->read(null, $id);
		}
		$this->set('givingLevels', $givingLevels);
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
		$this->Sponsor->id = $id;
		if (!$this->Sponsor->exists()) {
			throw new NotFoundException(__('Invalid sponsor'));
		}
		if ($this->Sponsor->delete()) {
			$this->Session->setFlash(__('Sponsor deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Sponsor was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
