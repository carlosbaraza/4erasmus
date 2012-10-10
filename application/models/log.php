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

class Log extends CI_Model {

	public $logid;
	public $logtitle;
	public $keyword;
	public $logmsg;
	public $ip_address;
	public $adddate;
	public $ci;
   /**
	 * Constructor
	 *
	 *
	 * @access	public
	 * @param
	*/
	public function __construct() {
	   	parent::__construct();
		// Set the super object to a local variable for use throughout the class
	   	$this->ci =& get_instance();
	}

	public function log() {
		$log = $this->instance();
		$log->adddate = date('Y-m-d H:m:s'); 
		
		unset($log->ci);
		$log->logtitle = ucfirst($log->logtitle);
		$insert = get_object_vars($log);
		$this->ci->db->insert('logs', $insert);
		$this->select(array('logtitle' => $log->logtitle));
	}

	public function select($condition) {
		$query = $this->db->get_where('logs', $condition, 1);
		$log = $query->first_row();

		if( $log) {
			// Pass Variables
			$logobj = get_object_vars($log);
			foreach ($logobj as $key => $value) {
				$this->{$key} = $logobj[$key];
			}
			$this->keyword = json_decode($this->keyword);
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
}