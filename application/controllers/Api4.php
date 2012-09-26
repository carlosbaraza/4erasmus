<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api4 extends CI_Controller {

	public function index() {
		// BODY
		die('it works!');
	}

	public function eventsOfDate() {
		// Validate Request
		$this->validateRequest();
		// Variables
		$start = $this->input->get('start', true);
		$limit = $this->input->get('limit', true);
		$date  = $this->input->get('date', true);

		if( (!empty($start) || $start == 0) && !empty($limit) && !empty($date)) {
			$this->ci->db->select()->from('events')->where(array('eventstart >' => $date.' 00:00:00', 'eventstart <' => date('Y:m:d H:m:s', strtotime($date) + 86400)))->limit($limit, $start);
			$query = $this->ci->db->get();
			$result = $query->result();
			echo json_encode($result);
		}
		else {
			echo 'wrong';
		}
	}

	public function newEvent() {
		// Validate Request
		$this->validateRequest();
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

		// All Info Received Validation
		if( !$eventname || !$placename || !$eventstart || !$privacy || !$category || !$imagename || !$this->validate->privacy($privacy) || !$this->validate->category($category)) {
			$this->result('info fail');
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

		if( !file_exists(RESOURCEPATH . 'img/GallerysDefPics/'. $imagename))
			$this->result('image fail '.$imagename);
		$this->event->imageurl = $imagename;
		if( !$eventstart = $this->validate->eventDate($eventstart)) 
			$this->result('date fail');
		$this->event->eventstart = $eventstart;
		$this->event->create();
		$this->result('success');
	}

	protected function result($msg) {
		$res = array();
		$res['status'] = $msg;
		die(json_encode($res));
	}

	public function autocompletePlace() {
		// Validate Request
		$this->validateRequest();
		// Variables
		$needle = $this->input->get('needle', true);
		$this->db->select('placename')->from('places')->like('placename', $needle)->order_by('peoplewashere + eventswashere', 'desc')->limit(5);
		$query = $this->db->get();
		echo json_encode($query->result());
	}

	protected function validateRequest() {
		// Is AJAX Validation
		if( !$this->input->is_ajax_request())
			exit;
		// Session Validation
		$sessid = $this->session->userdata('session_id');
		if( !$sessid) 
			exit;
		// Access Token Validation
		if( $this->input->get('access_token', true) != $sessid)
			exit;
	}
}