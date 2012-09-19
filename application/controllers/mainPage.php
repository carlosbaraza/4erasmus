<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mainPage extends CI_Controller {

	public function index()
	{
<<<<<<< HEAD
		$this->template->js('common/jquery');
=======
		//JQuery + JQuary UI with Flick Theme
		$this->template->js('jquery-1.8.0.min');
		$this->template->js('jquery-ui-1.8.23.custom.min');
		$this->template->css('Flick/jquery-ui-1.8.23.custom');

		// Bootstrap CSS framework
>>>>>>> JQuery, JQuery UI + Flick Theme and Calendar Widget added.
		$this->template->js('common/bootstrap.min');
		$this->template->css('common/bootstrap.min');

		//CSS of mainpage
		$this->template->css('mainPage');
		$this->template->write_view('content', 'mainPage_view');
		$this->template->render();
	}
}

?>