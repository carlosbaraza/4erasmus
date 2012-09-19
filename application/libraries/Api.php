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

class Api {
   /**
	 * Constructor
	 *
	 *
	 * @access	public
	 * @param
	*/
	public function __construct() {
		// Set the super object to a local variable for use throughout the class
		$this->ci =& get_instance();
	}

	public function login($username, $password) {
		$this->CI->db->select()->from('users')->where(array('username' => $username, 'password' => md5($password)))->limit(1);
		$query = $this->CI->db->get();
		return $query->first_row();
	}

	public function register($username, $password) {
		$insert = array(
			'username' => $username,
			'password' => md5($password),
			'signdate' => date('Y-m-d H:i:s')
		);
		$this->CI->db->insert('users', $insert);
	}

	public function eventsOfDate($date, $start, $limit) {
		$this->ci->load->model('event');
		$this->ci->db->select()->from('events')->where(array('eventstart >' => $date.' 00:00:00', 'eventstart <' => date('Y:m:d H:m:s', strtotime($date) + 86400)))->limit($start, $limit);
		$query = $this->ci->db->get();
		return $query->result();
	}

}