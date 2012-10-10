<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function Home() {
		parent::__construct();

	}

	public function index() {
		// BODY
		set_time_limit(0);

		for($i = 500000; $i < 3000000; $i++) {	
			$insert = array();
			$insert['userid'] 	  = $i / 1000 + 4;
			$insert['targetid']   = $i;
			$insert['actiontype'] = 'follow';
			$insert['targettype'] = 'event';
			$insert['actiondate'] = date('Y-m-d H:m:s', strtotime('+'. $i/10000 . ' DAYS'));
			$this->db->insert('actions', $insert);
		}
	}

}