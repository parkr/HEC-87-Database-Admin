<?php
class AppController extends Controller {

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'pages', 'action' => 'display'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
			'authorize' => array('Controller'),
			'authenticate' => array(
				'Form' => array(
					'fields' => array('username' => 'email')
				)
			)
        )
    );
	
	public function isAuthorized($user) {
		//if (isset($user['role']) && $user['role'] === 'admin') {
			//return true;
		//}
		return true;
	}

    function beforeFilter() {
		$this->Auth->allow('login');
    }
	
}
