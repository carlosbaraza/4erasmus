<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api4 extends CI_Controller {
	
	public function index() {
		echo '<pre>' . shell_exec('git pull') . '</pre>';
	}
}