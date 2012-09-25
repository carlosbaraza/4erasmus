<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gitupdate extends CI_Controller {
	
	public function index() {
		echo '<pre>'.shell_exec('git pull').'</pre>';
	}
}