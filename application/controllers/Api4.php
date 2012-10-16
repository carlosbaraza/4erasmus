<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api4 extends CI_Controller {

	public function index() {
		// BODY
		die('it works!');
	}

	public function readComments() {
		// Validate Request
		$this->validateRequest();
		// Variables
		$targetid 	= $this->input->get('targetid', true);
		$targettype = $this->input->get('targettype', true);
		$limit 		= $this->input->get('limit', true);
		$start  	= $this->input->get('start' , true);

		if( !$targetid || !$targettype || !$limit || (!$start && $start != 0) || $this->validate->commenttarget($targettype) ) {
			show_error('missing info');
			$this->result('error');
		}
		else {
			$this->db->select()->from('comments')->where(array( 'targetid' => $targetid, 'targettype' => $targettype
			))->order_by('adddate', 'desc')->limit($limit, $start);
			$query = $this->db->get();

			// Structure Output
			$result 		= new StdClass();
			$result->data 	= $query->result();
			$result->status = 'success';
			array_walk($result->data, array($this, 'commentHook'));
			echo json_encode($result);
		}
	}

	protected function commentHook(&$comment, $key) {
		$this->load->model('user');
		$this->user->select(array('userid' => $comment->userid));
		unset($comment->userid);
		$comment->user = $this->user->instance();
	}

	public function eventsOfDate() {
		// Validate Request
		$this->validateRequest();
		// Variables
		$start = $this->input->get('start', true);
		$limit = $this->input->get('limit', true);
		$date  = $this->input->get('date' , true);

		if( (!empty($start) || $start == 0) && !empty($limit) && !empty($date)) {
			$this->db->select()->from('events')->where(array(
				'eventstart >=' => date('Y-m-d', strtotime($date)).' 00:00:00', 
				'eventstart <=' => date('Y-m-d', strtotime($date) + 86400).' 00:00:00'))
			//	'eventstart >=' => date('Y-m-d H:m:s', $date), 
			//	'eventstart <=' => date('Y-m-d H:m:s', $date + 86400)))
			->limit(EVENT_REQUEST_LIMIT, $start);
			$query  = $this->db->get();

			// Structure Output
			$result 		= new StdClass();
			$result->data   = $query->result();
			$result->status = 'success';
			array_walk($result->data, array($this, 'eventHook'));
			echo json_encode($result);
		}
		else {
			show_error('missing info');
			$this->result('error');
		}
	}

	protected function eventHook(&$event, $key) {
		$this->load->model('place');
		$this->load->helper('url');
		$event->imageurl = base_url() . RESOURCEPATH . 'img/GallerysDefPics/'. $event->imageurl;
		$this->place->select(array('placeid' => $event->placeid));
		unset($event->placeid);
		$event->place = $this->place->instance();
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

		// Update Place
		$this->place->eventswashere = intval($this->place->eventswashere) + 1;
		$this->place->update();
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
			die('not ajax');
		// Session Validation
		$sessid = $this->session->userdata('session_id');
		if( !$sessid) 
			die('no sessid');
		// Access Token Validation
		if( $this->input->get('access_token', true) != $sessid) 
			die('access denied');
	}

	public function newAction() {
		// Validate Request
		$this->validateRequest();
		$this->load->library('validate');
		// Variables
		$targetid 	= $this->input->post('targetid'	 , true);
		$targettype = $this->input->post('targettype', true);
		$actiontype = $this->input->post('actiontype', true);
		// Load Target Type Model
		$this->load->model($targettype);
		// Specific Validation
		if( !$targetid || !$this->validate->actiontarget($targettype) || !$this->{$targettype}->select(array($targettype.'id' => $targetid)) || !$this->validate->actiontype($actiontype)) {
			show_error('missing target info');
			$this->result('error');
		}
		$insert = array();
		$insert['userid'] 	  = $this->session->userdata('userid');
		$insert['targetid']   = $targetid;
		$insert['targettype'] = $targettype;
		$insert[$actiontype.'date'] = date('Y-m-d H:m:s');
		$this->db->insert($actiontype.'s', $insert);
		$this->result('success');
	}

	public function newComment() {
		// Validate Request
		$this->validateRequest();
		$this->load->library('validate');
		// Variables
		$targetid 	= $this->input->post('targetid'	 , true);
		$targettype = $this->input->post('targettype', true);
		$commentmsg = $this->input->post('commentmsg', true);
		// Load Target Type Model
		$this->load->model($targettype);
		// Specific Validation
		if( !$targetid || !$this->validate->commenttarget($targettype) || !$this->{$targettype}->select(array($targettype.'id' => $targetid))  || !$commentmsg ) {
			show_error('missing target info');
			$this->result('error');
		}
		$insert = array();
		$insert['userid'] 	  = $this->session->userdata('userid');
		$insert['targetid']   = $targetid;
		$insert['targettype'] = $targettype;
		$insert['commentmsg'] = $commentmsg;
		$insert['adddate'] = date('Y-m-d H:m:s');
		$this->db->insert('comments', $insert);
		$this->result('success');
	}

	public function addEventDialogUploadPicture() {
		// list of valid extensions, ex. array("jpeg", "xml", "bmp")
		$allowedExtensions = array("jpg","jpeg","png","bmp","pdf");
		// max file size in bytes
		$sizeLimit = 10 * 1024 * 1024;

		//$this->load->library(array('qqUploadedFileXhr','qqUploadedFileForm','qqFileUploader'));
		require(RESOURCEPATH . 'inc/fileuploader.php');
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);

		// Call handleUpload() with the name of the folder, relative to PHP's getcwd()
		$result = $uploader->handleUpload('extras/img/GallerysDefPics/Users/ozan/');

		// to pass data through iframe you will need to encode all html tags
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);

		/*$res = array();
		$res['success'] = 'true';
		die(json_encode($res));*/
	}
}