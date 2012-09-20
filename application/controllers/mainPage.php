<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mainpage extends CI_Controller {

	public function Mainpage() {
		parent::__construct();
		$this->data = new StdClass();
		$this->template->title('4erasmus');
		//JQuery + JQuary UI with Flick Theme
		$this->template->js('jquery');
		$this->template->js('jquery-ui');
		$this->template->css('flick/jquery-ui-1.8.23.custom');
		$this->template->js('jquery-ui-timepicker-addon');


		// Bootstrap CSS framework
		$this->template->js('common/bootstrap.min');
		$this->template->css('common/bootstrap.min');

		//CSS of mainpage
		$this->template->css('mainPage');

		//JS
		$this->template->js('jsapi4');
	}

	public function index()
	{
		$this->user->fblogin();

		$this->template->write_view('content', 'mainPage_view', get_object_vars($this->data));
		$this->template->render();
	}
}

?>