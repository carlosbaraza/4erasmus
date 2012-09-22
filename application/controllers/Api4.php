<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Api4 extends CI_Controller {

	public function Face() {
		parent::__construct();
		$this->data = new StdClass();
		$this->user->select(array('username' => 'ozantunca'));
		$this->user->seslogin();

		// HEAD
		$this->template->title('4erasmus API');
		$this->template->js('common/jquery');
		$this->template->js('common/common');
		$this->template->css('common/bootstrap.min');
		$this->template->css('common/common');
	}

	public function index() {
		// BODY
		die('it works!');
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
	}

	public function newEvent() {
		$this->load->model('place');
		$this->load->model('event');
		$this->load->helper('date');
		$eventname  = $this->input->post('eventname', true);
		$eventdesc  = $this->input->post('eventdesc', true);
		$placename  = $this->input->post('placename', true);
		$eventstart = $this->input->post('eventstart', true);
		$privacy	= $this->input->post('privacy', true);

		if( !$eventname || !$eventdesc || !$placename || !$eventdate || !$privacy) {
			return;
		}
		if( !$this->place->select(array('placename' => $placename))) {
			$this->place->placename;
			$this->place->create();
		}
		$this->event->eventname  = $eventname;
		$this->event->eventdesc  = $eventdesc;
		$this->event->placeid	 = $this->place->placeid;
		$this->event->eventstart = $date->guiToMysql($eventstart);
		$this->event->privacy    = $privacy;
		$this->event->create();
	}
}