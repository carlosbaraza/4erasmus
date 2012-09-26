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
		echo '<link rel="stylesheet/less" type="text/css" href="extras/less/4erasmus.less">';
		echo '
		<script type="text/javascript">
		     less.env = "development";
		     less.watch();
		</script>
		';
		echo '<script src="extras/js/less-1.3.0.min.js" type="text/javascript"></script>';
		//$this->template->js('less-1.3.0.min');
		// Gallery plugin CSS
		$this->template->css('addEventGalleryPlugin');

		//JS 
		$this->template->js('api4');
		$this->template->js('jsapi4');
	}

	public function index()
	{
		$this->user->select(array('username' => 'ozan'));
		$this->user->seslogin();
		$this->data->username = $this->user->username;

		$this->template->write_view('content', 'mainPage_view', get_object_vars($this->data));
		$this->template->render();
	}
}
