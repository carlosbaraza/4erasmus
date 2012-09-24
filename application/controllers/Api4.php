<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Api4 extends CI_Controller {

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
		else {
			echo 'wrong';
		}
	}

	public function newEvent() {
		// Is AJAX Validation
		if( !$this->input->is_ajax_request())
			exit;
		// Session Validation
		if( !$this->session->userdata('session_id')) 
			exit;
		// Access Token Validation
		if( $this->input->post('access_token', true) != $this->session->userdata('session_id'))
			exit;
		// Include Stuff
		$this->load->model('place');
		$this->load->model('event');
		$this->load->library('validate');
		// Receive Post Data
		$eventname  = $this->input->post('eventname', true);
		$eventdesc  = $this->input->post('eventdesc', true);
		$placename  = $this->input->post('place'	, true);
		$eventstart = $this->input->post('eventdate', true);
		$privacy	= $this->input->post('sharewith', true);
		$category	= $this->input->post('category'	, true);
		$imagename	= $this->input->post('imagename', true);
		$imagename 	= $imagename ? RESOURCEPATH . 'img/GalleryDefPics/'. $imagename : exit;

		// All Info Received Validation
		if( !$eventname || !$placename || !$eventstart || !$privacy || !$category || !$this->validate->privacy($privacy) || !$this->validate->category($category)) {
			$this->result('fail');
		}
		// Place Validation | Creation
		if( !$this->place->select(array('placename' => $placename))) {
			$this->place->placename = $placename;
			$this->place->create();
		}
		// Create Event
		$this->event->eventname  = $eventname;
		$this->event->eventdesc  = $eventdesc != false ? $eventdesc : NULL;
		$this->event->placeid	 = $this->place->placeid;
		$this->event->privacy 	 = $privacy;
		$this->event->category	 = $category;

		if( !file_exists($imagename))
			$this->result('fail');
		$this->event->imageurl = $imagename;
		if( !$eventstart = $this->validate->eventDate($eventstart)) 
			$this->result('fail');
		$this->event->eventstart = $eventstart;
		$this->event->create();
		$this->result('success');
	}

	public function result($msg) {
		$res = array();
		$res['status'] = $msg;
		die(json_encode($res));
	}
}