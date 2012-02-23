<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
	public $account_types = array('student', 'attendee');
	public $account_types_plural = array('students', 'attendees');
	public $invite_codes = array('hecstudent', 'hecattendee', 'bod');
	public $alias = "Profiles";
	public $uploadsFolder = "profiles";
	public $uploadsFileTypes = array('image/jpeg', 'image/png', 'image/gif');
	public $maxFileSize = 1000000;
	
	/**
	 * Upload File Function
	 * 
	 * @param $data - the request data submitted from the form
	 * @return new file url, or a blank string if something went wrong
	 */
	private function _uploadFile($data){
		if(array_key_exists('picture', $data['User'])){
			$photo = $data['User']['picture'];
			if($photo['name'] == ""){ // Don't reset.
				return $data['User']['photo'];
			}
		
			// Validate the file's type
			if(!in_array($photo['type'], $this->uploadsFileTypes)){
				$this->Session->setFlash('You may only upload image files. The rest of your data was saved.');
				return "";
			}
		
			// Validate the file's size
			if($photo['size'] > $this->maxFileSize){
				$this->Session->setFlash('Your upload cannot exceed '. ($this->maxFileSize/1000) .'KB. Please try a smaller photo.');
				return "";
			}
		
			// Hash filename
			$filename = substr($photo['name'], 0, strrpos($photo['name'], '.'));
			$extension = substr($photo['name'], strrpos($photo['name'], '.'));
			$hashedName = md5($filename) . $extension;
		
			// Create paths
			$path = DS . $this->uploadsFolder . DS . $hashedName;
			$fullpath = realpath(dirname(__FILE__) . DS . '..' . DS . 'webroot') . $path;
		
			// Insure that directories are there.
			if(!file_exists(dirname($fullpath))){
				mkdir(dirname($fullpath), 0777, true);
			}
			
			// Move files & return file path
			if(move_uploaded_file($photo['tmp_name'], $fullpath)){
				$this->Session->setFlash('Your file was uploaded successfully.');
				return $path;
			}else{
				$this->Session->setFlash('Your file could not be uploaded.');
				return "";
			}
		}
		return "";
	}
	
	public function login() {
		$this->set('title_for_layout', 'Login');
		$this->set('prevpage_for_layout', array('title' => "Home", 'routing' => '/'));
		if ($this->request->is('post')) {
			$user = $this->User->findByEmail($this->request->data['User']['email']);
			if ($user['User']['role'] == 'admin' && $this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Username or password is incorrect, you are not a registered user, or you do not have an admin account.'), 'default', array(), 'auth');
			}
		}
	}
	public function logout() {
		$this->set('prevpage_for_layout', array('title' => "Home", 'routing' => '/'));
		$redirect_to = $this->Auth->logout();
		if($redirect_to){
			$this->Session->setFlash('You have been successfully logged out.');
			$this->redirect($redirect_to);
		}else{
			$this->Session->setFlash('You could not be logged out.');
			$this->redirect($redirect_to);
		}
	}


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			
			$this->request->data['User']['photo'] = $this->_uploadFile($this->request->data);
			$this->request->data['User']['date_created'] = date("Y-m-d H:i:s");
			
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$events = $this->User->Event->find('list');
		$this->set(compact('events'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$fieldList = array('name', 'show_contact_info', 'email', 'phone_number', 'graduation_year', 'company', 'position', 'bio', 'photo');
			$this->request->data['User']['photo'] = $this->_uploadFile($this->request->data);
			
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$events = $this->User->Event->find('list');
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
