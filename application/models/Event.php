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
	public $userid;
	public $username;
	public $eventstart;
	public $eventfinish;
	public $views;
	public $adddate;
	public $lastupdate;
	public $thumbnailurl;
	public $followers;
	public $latitude;
	public $longitude;
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
	}

	public function create() {
		$insert = array();
		$userobj = get_object_vars($this);
		foreach ($userobj as $key => $value) {
			if( !empty($value)) 
				$insert[$key] = $value;
		}
		$this->db->insert('events', $insert);
	}

	public function update() {
		$update = array();
		$eventobj = get_object_vars($this);
		foreach ($eventobj as $key => $value) {
			if( !empty($value)) 
				$update[$key] = $value;
		}
		$this->db->where('eventid', $this->eventids);
		$this->db->update('events', $update);
	}

	public function load($condition) {
		$query = $this->db->get_where('events', $condition, 1);
		$event = $query->first_row();

		// Pass Variables
		$eventobj = get_object_vars($event);
		foreach ($eventobj as $key => $value) {
			$this->{$key} = $eventobj->{$key};
		}
	}
}