<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function Home() {
		parent::__construct();
//		$this->load->library('raintpl');
		// VARIABLES
		$this->img_base = RESOURCEPATH.'img/';
		// HEAD
		$this->template->title('Home');
		$this->template->add_js('common/jquery');
		$this->template->add_js('common/bootstrap.min');
		$this->template->add_js('common/bootstrap-typeahead');
		$this->template->add_css('common/bootstrap.min');
		$this->template->add_css('home');
		$this->template->add_css('4erasmus');
		$this->template->add_css('blueprint/screen');
	}

	public function index() {
		// BODY




		// DISPLAY
		$this->template->write_view('header', 'common/header');
		$this->template->write_view('footer', 'common/footer');
		$this->template->write_view('content', 'home', get_object_vars($this));
		$this->template->render();
	}

}