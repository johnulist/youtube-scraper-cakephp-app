<?php
class AppController extends Controller {

	public $helpers = array('Html', 'Form', 'Session', 'Text');
	public $components = array('Session', 'Auth');

	public function beforeFilter() {

		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login', 'admin' => false);
		$this->Auth->loginRedirect = array('controller' => 'videos', 'action' => 'index', 'admin' => true);
		$this->Auth->logoutRedirect = array('controller' => 'videos', 'action' => 'index', 'admin' => false);

		if(isset($this->request->params['admin']) && ($this->request->params['prefix'] == 'admin')) {
			$this->layout = 'admin';
		} else {
			$this->Auth->allow('*');
		}

	}

}