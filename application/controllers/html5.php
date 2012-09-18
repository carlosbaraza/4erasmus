<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Html5 extends CI_Controller {

	public function Html5() {
		parent::__construct();
		// HEAD
		$this->template->title('Html5');
		$this->template->add_js('jquery.js');
	//	$this->template->add_js('html5.js');
	//	$this->template->add_css('html5.css');
		$this->template->add_css('canvas.css');
		$this->template->add_js('canvas.js');
		$this->template->add_js('J3DI.js');
		$this->template->add_js('J3DIMath.js');
		$this->template->add_js('glMatrix-0.9.5.min.js');
		$this->template->add_js('webgl-utils.js');
	}

	public function index() {
		// BODY





		// DISPLAY
		$this->template->write_view('header', 'common/header');
		$this->template->write_view('footer', 'common/footer');
	//	$this->template->parse_view('content', 'html5');
		$this->template->write_view('content', 'canvas');
		$this->template->render();
	}

}