<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mainPage extends CI_Controller {

	public function index()
	{
		$this->template->add_css('mainPage');
		$this->template->write_view('content', 'mainPage_view');
		$this->template->render();
	}
}

?>