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
		return "";
	}

	/** 
	 * Auth Methods
	 */
	public function login() {
		$this->set('title_for_layout', 'Login');
		$this->set('prevpage_for_layout', array('title' => "Home", 'routing' => '/'));
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Username or password is incorrect or you are not a registered user.'), 'default', array(), 'auth');
			}
		}
	}
	public function forgot() {
		$this->set('title_for_layout', 'Forgot Password?');
		$this->set('prevpage_for_layout', array('title' => "Login", 'routing' => array('action' => 'login')));
		if($this->request->is('post')){
			// Store hash
			$this->User->Hash->create();
			$user = $this->User->findByEmail($this->request->data['User']['email']);
			$hash = array(
				'Hash' => array(
					'user_id' => $user['User']['id'],
					'hash' => $this->User->Hash->generateNew($user['User']['email']),
					'expires' => date('Y-m-d H:i:s', mktime(date("H"), date("i"), date("s"), date("n"), (date("j")+14), date("Y")))." EST" // 14 days to use.
				)
			);
			if($this->User->Hash->save($hash)){
				// Send email
				$email = new CakeEmail();
				$email->from(array('noreply@hotelezracornell.com' => 'Hotel Ezra Cornell IT'));
				$email->to($user['User']['email']);
				$email->subject('Reset your password');
				$email->send("Hello,\n\nYou just requested to reset your password. You may do so here: ".$this->User->Hash->getLink($hash, $user['User']['email'])."\n\nSincerely,\nIT Manager\nHotel Ezra Cornell");
				$this->Session->setFlash('Your request has been processed. Please check your email.');
				$this->redirect(array('action' => 'forgot'));
			}else{
				$this->Session->setFlash('Something went wrong with your request. Please try again.');
			}
		}
	}
	public function reset($email, $hash_code) {
		$user = $this->User->findByEmail($email);
		$hash = $this->User->Hash->findByHash($hash_code);
		//if($user['User']['id'] == $hash['Hash']['user_id'] && !$this->User->Hash->hasExpired($hash)){
			//
			//}
		// TODO: Check hash
		$this->set('title_for_layout', 'Forgot Password?');
		$this->set('prevpage_for_layout', array('title' => "Login", 'routing' => array('action' => 'login')));
		if($this->request->is('post')){
			// Hash password
			// Set new password
			// Login
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
	public function register() {
		$this->set('title_for_layout', 'Register');
		$this->set('prevpage_for_layout', array('title' => "Home", 'routing' => '/'));
		
		// Check for invalidity.
		if($this->Auth->loggedIn()){
			$this->Session->setFlash('You are already logged in.');
			$this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('id')));
		}
		if(isset($this->params->query) && isset($this->params->query['invite']) && in_array($this->params->query['invite'], $this->invite_codes)){
			$this->set('type', (isset($this->params->query['type']) && $this->params->query['type'] != "" && in_array($this->params->query['type'], $this->account_types)) ? $this->params->query['type'] : "student");
			if ($this->request->is('post')) {
				$this->User->create();
				if($this->request->data['User']['password'] != $this->request->data['User']['confirm_password']){
					$this->Session->setFlash(__('Your passwords do not match.'));
				} else {
					if($this->User->emailExists($this->request->data['User']['email'])){
						$this->Session->setFlash(__('The email you entered is already associated with another user.'));
					}else{
						$this->request->data['User']['role'] = "user";
						$this->request->data['User']['date_created'] = date("Y-m-d H:i:s");
						if($this->request->data['User']['type'] == 'student'){
							$this->request->data['User']['company'] = "Hotel Ezra Cornell ".$this->_currentHECYear();
						}
						$this->request->data['User']['photo'] = $this->_uploadFile($this->request->data);
						if ($this->User->save($this->request->data)) {
							$id = $this->User->id;
							$this->request->data['User'] = array_merge($this->request->data["User"], array('id' => $id));
							$this->Auth->login($this->request->data['User']);
							$this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('id')));
						} else {
							$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
						}
					}
				}
			}
		}else{
			$this->Session->setFlash('You must have a valid invite code to be qualified to register.');
			$this->redirect(array('controller' => 'pages', 'action' => 'home'));
		}
	}
	
	private function _currentHECYear(){
		$base_year = 2012;
		$base_hec_year = 87;
		if( ((int) date("m")) >= 6 ){
			// It's June. We're thinking about next year.
			return $base_year - 1924;
		}else{
			return $base_year - 1925;
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
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
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
