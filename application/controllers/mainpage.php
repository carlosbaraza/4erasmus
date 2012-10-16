<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mainpage extends CI_Controller {

	public function Mainpage() {
		parent::__construct();
		$this->data = new StdClass();
		$this->template->title('4erasmus');
		//JQuery + JQuary UI with Flick Theme
		$this->template->js('jquery');
		$this->template->js('jquery-ui');
		//$this->template->css('flick/jquery-ui-1.8.23.custom');
		$this->template->js('jquery-ui-timepicker-addon');

		//mousewheel plugin for jquery
		$this->template->js('jquery.mousewheel.min');

		//custom scroll for the add event pic gallery
		$this->template->js('jquery.mCustomScrollbar');
		$this->template->css('jquery.mCustomScrollbar');

		// Bootstrap CSS framework
		$this->template->js('common/bootstrap.min');
		$this->template->js('common/bootstrap-typeahead');
		//$this->template->css('common/bootstrap.min');

		//CSS of mainpage
		//$this->template->css('mainPage');

		// Add LESS with template library mod for codeigniter
		$this->template->less('4erasmus');

		//$this->template->js('less-1.3.0.min');
		// Gallery plugin CSS
		$this->template->css('addEventGalleryPlugin');

		//JS 
		$this->template->js('api4');
		$this->template->js('jsapi4');

		// Facebook Login
		if( $this->input->ip_address() == '127.0.0.1') {
			$this->user->select(array('username' => 'ozan'));
			$this->user->seslogin();
			$this->data->username = $this->user->username;
		}
		else {
			$this->user->fblogin();
		}
		define('FULLRESOURCEPATH', base_url() . RESOURCEPATH);
		$folder = RESOURCEPATH . 'img/GallerysDefPics/Misc/';
		$this->data->defaultEventImages = glob( $folder . '*.{jpg,jpeg,gif,png}', GLOB_BRACE);
		foreach ($this->data->defaultEventImages as $key => $value) {
			$this->data->defaultEventImages[$key] = base_url() . $value;
		}
	}

	public function index() {


		$this->template->write_view('leftcontainer', 'common/leftcontainer', get_object_vars($this->data));
		$this->template->write_view('loginbar', 'common/loginbar', get_object_vars($this->data));
		$this->template->write_view('events', 'eventIndex/events', get_object_vars($this->data));
		$this->template->write_view('wall', 'eventIndex/wall', get_object_vars($this->data));
		$this->template->write_view('addEventDialog', 'eventIndex/addEventDialog', get_object_vars($this->data));
		//$this->template->write_view('content', 'mainPage_view', get_object_vars($this->data));
		$this->template->render();
	}

	public function school($id = null) {

		$this->template->write_view('leftcontainer', 'common/leftcontainer', get_object_vars($this->data));
		$this->template->write_view('loginbar', 'common/loginbar', get_object_vars($this->data));
		$this->template->write_view('schoolProfile', 'schoolProfile/schoolProfile', get_object_vars($this->data));
		$this->template->write_view('wall', 'eventIndex/wall', get_object_vars($this->data));
		$this->template->render();
	}
}
