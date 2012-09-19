<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Face extends CI_Controller {

	public function Face() {
		parent::__construct();
		$this->data = new StdClass();
		$this->ci =& get_instance();

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
		$this->user->fblogin();




		// DISPLAY
		$this->template->write_view('header', 'common/header');
		$this->template->write_view('footer', 'common/footer');
		$this->template->write_view('content', 'facebook', get_object_vars($this->ci->data));
		$this->template->render();
	}

}