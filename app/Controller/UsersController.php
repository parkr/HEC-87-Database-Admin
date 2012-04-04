<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
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
			if($user && $user['User'] && $user['User']['email']){
				if ($user['User']['role'] == 'admin'){
					if($this->Auth->login()){
						return $this->redirect($this->Auth->redirect());
					}else{
						$this->Session->setFlash(__('Your username and/or password is incorrect.'), 'default', array(), 'auth');
					}
				}else{
					$this->Session->setFlash(__('Your account is not an admin account. You are not authorized to use this site.'), 'default', array(), 'auth');
				}
			}else{
				$this->Session->setFlash(__('The email entered has not been registered.'), 'default', array(), 'auth');
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
			if($this->request->data['User']['password'] != $this->request->data['User']['confirm_password']){
				$this->Session->setFlash(__('The passwords do not match.'));
			} else {
				if($this->User->emailExists($this->request->data['User']['email'])){
					$this->Session->setFlash(__('The email you entered is already associated with another user.'));
				}else{
					$this->request->data['User']['role'] = "user";
					$this->request->data['User']['date_created'] = date("Y-m-d H:i:s");
					$this->request->data['User']['email'] = trim($this->request->data['User']['email']);
					$this->request->data['User']['photo'] = $this->_uploadFile($this->request->data);
					$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
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
		$this->request->data['User']['confirm_password'] = "";
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
			
			if($this->request->data['User']['password'] != ""){
				// something entered. rehash and save password!
				$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
				$fieldList[] = 'password';
			}
			
			if($this->request->data['User']['password'] == $this->request->data['User']['confirm_password']){
				if ($this->User->save($this->request->data, true, $fieldList)) {
					$this->Session->setFlash(__('The user has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			}else{
				$this->Session->setFlash(__('The passwords do not match.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
			$this->request->data['User']['password'] = "";
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
	
/**
 * email method
 * sends an email to a group of users
 *
 * @return void
 */
	public function email(){
		if ($this->request->is('post') || $this->request->is('put')) {
			$data = $this->request->data;
			if($data['Email']['subject'] != ""){
				if($data['Email']['body'] != ""){
					
					$email = new CakeEmail();
					$email->from(array('noreply@hotelezracornell.com' => 'Hotel Ezra Cornell IT Manager'));
					$email->replyTo(($data['Email']['reply_to'] != "") ? ($data['Email']['reply_to']) : (array('hec@cornell.edu' => 'Hotel Ezra Cornell')));
					$email->subject($data['Email']['subject']);
					$special_keys = array(
						'%%NAME%%', 
						'%%FIRST_NAME%%', 
						'%%LAST_NAME%%', 
						'%%EMAIL%%', 
						'%%GRAD_YEAR%%', 
						'%%POSITION%%', 
						'%%COMPANY%%', 
						'%%DATE_PROFILE_CREATED%%', 
						'%%BIO%%'
					);
					
					$date_created_sql_cond = 'User.date_created '.$data['Email']['date_created_comparator'];
					$params = array(
						'conditions' => array('User.type' => $data['Email']['group'], $date_created_sql_cond => $data['Email']['date_created'])
					);
					$users = $this->User->find('all', $params);
						
					foreach($users as $user){
						$email->to(array($user['User']['email'] => $user['User']['name']));
						$user_information = array(
							$user['User']['name'],
							$user['User']['first_name'],
							$user['User']['last_name'],
							$user['User']['email'],
							$user['User']['graduation_year'],
							$user['User']['position'],
							$user['User']['company'],
							$user['User']['date_created'],
							$user['User']['bio']
						);
						$email_text = str_replace($special_keys, $user_information, $data['Email']['body']);
						$email->send($email_text);
					
					}
					$this->Session->setFlash(__("Your emails were sent."));
				}else{
					$this->Session->setFlash(__("You must supply body text for your email."));
				}
			}else{
				$this->Session->setFlash(__("You must supply a subject for your email."));
			}
			pr($this->request->data);
		}else{
			$this->set('groups', array('students', 'attendees', 'all'));
		}
	}
}
