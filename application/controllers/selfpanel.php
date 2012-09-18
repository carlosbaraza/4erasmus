<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Selfpanel extends CI_Controller {

	public function Selfpanel() {
		parent::__construct();
		$this->output->enable_profiler(TRUE);
		$this->load->library('template');
		$this->load->library('raintpl');
		$this->load->library('api');
		$this->load->library('validate');
		$this->load->model('user');
		// HEAD
		$this->template->title('Configuration Panel');
		$this->template->add_js('jquery.js');
		$this->template->add_js('commmon/common.js');
		$this->template->add_css('common/bootstrap.min.css');
		$this->template->add_css('common/bootstrap-responsive.min.css');
		$this->template->add_css('commmon/common.css');
	}

	public function index() {
		// BODY
		var_dump(get_object_vars($this->user));





		// DISPLAY
		$this->template->parse_view('header', 'common/header');
		$this->template->parse_view('footer', 'common/footer');
		$this->template->parse_view('content', 'selfpanel');
		$this->template->render();
	}

}