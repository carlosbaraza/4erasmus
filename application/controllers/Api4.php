<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Api4 extends CI_Controller {

	public function Face() {
		parent::__construct();
		$this->data = new StdClass();

		// HEAD
		$this->template->title('4erasmus API');
		$this->template->js('common/jquery');
		$this->template->js('common/common');
		$this->template->css('common/bootstrap.min');
		$this->template->css('common/common');
	}

	public function index() {
		// BODY
	}

	public function eventsOfDate() {
		$this->load->library('api');
		$start = $this->input->get('start', true);
		$limit = $this->input->get('limit', true);
		$date  = $this->input->get('date', true);

		if( (!empty($start) || $start == 0) && !empty($limit) && !empty($date)) {
			$result = $this->api->eventsOfDate($date, $start, $limit);
			echo json_encode($result);
		}
		exit;
	}
}