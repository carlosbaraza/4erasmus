<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once RESOURCEPATH.'inc/facebook.php';

class Face extends CI_Controller {

	public function Face() {
		parent::__construct();
	//	$this->output->enable_profiler(TRUE);
	//	$this->load->library('raintpl');
	//	$this->load->library('api');
	//	$this->load->library('validate');
	//	$this->load->model('user');
		/*
		$this->load->library('fb', array(
			'appId'  => '529250917090161',
			'secret' => 'edce64e3900bacef0ef4ba653c711de6'
		));
		*/

		// HEAD
		$this->template->title('Facebook API');
		$this->template->add_js('common/jquery');
		$this->template->add_js('common/common');
		$this->template->add_css('common/bootstrap.min');
		$this->template->add_css('common/bootstrap-responsive.min');
		$this->template->add_css('common/common');
	}

	public function index() {
		// BODY
		$this->facebook = new Facebook(array(
			'appId'  => '529250917090161',
			'secret' => 'edce64e3900bacef0ef4ba653c711de6'
		));
		$fbuser = $this->facebook->getUser();

		if ($fbuser) {
			try {
			    // Proceed knowing you have a logged in user who's authenticated.
				$user_profile = $this->facebook->api('/me');
				echo '<pre>Welcome '.$user_profile['name'].'<br>'.$user_profile['id'].'</pre>';
				$this->userid = $user_profile['id'];
			} catch (FacebookApiException $e) {
			    echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
			    $user = null;
			}
		}




		// DISPLAY
		$this->template->write_view('header', 'common/header');
		$this->template->write_view('footer', 'common/footer');
		$this->template->write_view('content', 'facebook', get_object_vars($this));
		$this->template->render();
	}

}