<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Face extends CI_Controller {

	public function Face() {
		parent::__construct();
		$this->load->model('user');
		$this->data = new StdClass();

		// HEAD
		$this->template->title('Facebook API');
		$this->template->js('common/jquery');
		$this->template->js('common/common');
		$this->template->css('common/bootstrap.min');
		$this->template->css('common/bootstrap-responsive.min');
		$this->template->css('common/common');
	}

	public function index() {
		// BODY
		$newUser = $this->user;
		if( !$newUser->select(array('username' => 'ozantunca')) && $newUser->register('ozantunca', 'ozantunca')) {
			echo 'Arright!';
		} else {
			echo 'God Dammit!';
		}




		// DISPLAY
		$this->template->write_view('header', 'common/header');
		$this->template->write_view('footer', 'common/footer');
		$this->template->write_view('content', 'facebook', get_object_vars($this->data));
		$this->template->render();
	}

}