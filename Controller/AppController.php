<?php
class AppController extends Controller {

	public $helpers = array('Html', 'Form', 'Session', 'Text', 'Js' => array('Jquery'));
	public $components = array('Session', 'Auth');

	public function beforeFilter() {
		
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login', 'admin' => false);
        $this->Auth->loginRedirect = array('controller' => 'videos', 'action' => 'index', 'admin' => true);
        $this->Auth->logoutRedirect = array('controller' => 'videos', 'action' => 'index', 'admin' => false);

        // $this->Auth->authenticate = array(
        //     AuthComponent::ALL => array(
        //         'fields' => array(
        //             'username' => 'username',
        //             'password' => 'password'),
        //         'userModel' => 'Users.User'
        //     ), 'Form'
        // );

        // $this->current_user = $this->Auth->user();

		if(isset($this->request->params['admin']) && ($this->request->params['prefix'] == 'admin')) {
			$this->layout = 'admin';
		} else {
			$this->Auth->allow('*');
		}
		
		if(!$this->Session->check('referer')) {
			$this->Session->write('referer', env('HTTP_REFERER'));
			// $data['Referer']['referer'] = env('HTTP_REFERER');
			// $data['Referer']['http_user_agent'] = env('HTTP_USER_AGENT');
			// $data['Referer']['url'] = $this->here;
			// if(!empty($data['Referer']['referer'])) {
			// 	$data['Referer']['ip_address'] = env('REMOTE_ADDR');
			// 	ClassRegistry::init('Referer')->save($data, false);
			// }
		}
	}
	
	
	// public function beforeRender() {
	// 	$this->set('current_user', $this->current_user);
	// }
    

}