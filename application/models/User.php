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

class User extends CI_Model {

	public $userid;
	public $username;
	public $password;
	public $followers;
	public $signdate;
	public $lastupdate;
	public $avatarurl;
	public $follows;
	public $latitude;
	public $longitude;
	public $settings;
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

	public function login($username, $password) {

		$this->load(array('username' => $username, 'password' => $password));
	}

	public function register($username, $password) {
		$insert = array();
		$userobj = get_object_vars($this);
		foreach ($userobj as $key => $value) {
			if( !empty($value)) 
				$insert[$key] = $value;
		}
		$insert['username'] = $username;
		$insert['password'] = md5($password);
		$insert['signdate'] = date('Y-m-d H:i:s');
		$this->db->insert('users', $insert);
	}

	public function update() {
		$update = array();
		$userobj = get_object_vars($this);
		foreach ($userobj as $key => $value) {
			if( !empty($value)) 
				$update[$key] = $value;
		}
		$this->db->where('userid', $this->userid);
		$this->db->update('users', $update);
	}

	public function load($condition) {
		$query = $this->db->get_where('users', $condition, 1);
		$user = $query->first_row();

		// Pass Variables
		$userobj = get_object_vars($user);
		foreach ($userobj as $key => $value) {
			$this->{$key} = $userobj->{$key};
		}









/*

			$stdin = fopen('php://stdin', 'r');
			fscanf($stdin, "%d %d\n", $n, $k);

			$line = trim(fgets($stdin));
			$init = explode(' ', $line);

			$all = array();
			for($i = 1; $i <= $n; $i++) {
				$all[$i] = array();
			}
			for($i = $n; $i > 0; $i--) {
				$all[$init[$i-1]][] = $i;
			}

			$line = trim(fgets($stdin));
			$final = explode(' ', $line);

			$count = 0; 
			$string = '';

			for($i = $n; $i >= 0; $i--) {
				if( $init[$i] != $final[$i]) {
					if( array_search($i, $all[$final[$i]]) == 0) {
						$count++;
						$all[$final[$i]]
						$string .= '';
					}
				}
			}*/
	}

	function separate($all, $final, $init, $i) {
		
	}
}