<?php /*

	This is the main page controller for the project 4Erasmus

*/ ?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mainPage extends CI_Controller {

	public function index()
	{
		$this->load->view('mainPage_view');
	}
}

?>