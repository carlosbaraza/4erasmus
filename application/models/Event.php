<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package CodeIgniter
 * @author  ExpressionEngine Dev Team
 * @copyright  Copyright (c) 2006, EllisLab, Inc.
 * @license http://codeigniter.com/user_guide/license.html
 * @link http://codeigniter.com
 * @since   Version 1.0
 * @filesource
 */

// --------------------------------------------------------------------

class Event extends CI_Model {

	public $eventid;
	public $eventname;
	public $eventdesc;
	public $creatorid;
	public $creatorname;
	public $eventstart;
	public $eventfinish;
	public $views;
	public $adddate;
	public $lastupdate;
	public $imageurl;
	public $followers;
	public $category;
	public $ci;
   /**
	 * Constructor
	 *
	 *
	 * @access	public
	 * @param
	*/
	public function __construct() {
		// Set the super object to a local variable for use throughout the class
	   	parent::__construct();
	   	$this->ci =& get_instance();
	}

	public function create() {
		$event = $this->instance();
		$event->creatorid 	= $this->session->userdata('userid');
		$event->creatorname = $this->session->userdata('username');
		$event->adddate		= date('Y-m-d H:m:s'); 
		
		unset($event->ci);
		$event->eventname = ucfirst($event->eventname);
		$insert = get_object_vars($event);
		$this->ci->db->insert('events', $insert);
		$this->select(array('eventname' => $event->eventname));
	}

	public function update() {
		$update = array();
		$eventobj = get_object_vars($this);
		foreach ($eventobj as $key => $value) {
			if( !empty($value)) 
				$update[$key] = $value;
		}
		$this->ci->db->where('eventid', $this->eventids);
		$this->ci->db->update('events', $update);
	}

	public function select($condition) {
		$query = $this->db->get_where('events', $condition, 1);
		$event = $query->first_row();

		if( $event) {
			// Pass Variables
			$eventobj = get_object_vars($event);
			foreach ($eventobj as $key => $value) {
				$this->{$key} = $eventobj[$key];
			}
			return true;
		} else {
			return false;
		}
	}

	public function instance() {
		$instance = new StdClass();
		foreach($this as $key => $value) {
			if( $value != NULL)
				$instance->{$key} = $value;
		}
		unset($instance->ci);
		return $instance;
	}
}