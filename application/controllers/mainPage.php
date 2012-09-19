<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mainpage extends CI_Controller {

	public function index()
	{
		$this->template->title('4erasmus');
		//JQuery + JQuary UI with Flick Theme
		$this->template->js('jquery');
		$this->template->js('jquery-ui');
		$this->template->css('Flick/jquery-ui-1.8.23.custom');

		// Bootstrap CSS framework
		$this->template->js('common/bootstrap.min');
		$this->template->css('common/bootstrap.min');

		//CSS of mainpage
		$this->template->css('mainPage');
		$this->template->write_view('content', 'mainPage_view');

		//JS
		$this->template->js('jsapi4');
		
		$this->template->render();
	}
}

?>