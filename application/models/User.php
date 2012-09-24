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

	protected $password;
	public $userid;
	public $username;
	public $fbname;
	public $followers;
	public $signdate;
	public $lastupdate;
	public $avatarurl;
	public $follows;
	public $latitude;
	public $longitude;
	public $settings;
	public $hometown;
	public $onlineStatus;
	public $fbid;
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

	public function fblogin() {
		if( $this->ci->session->userdata('userid')) {
			return;
		}
		// Facebook PHP-SDK
		require_once RESOURCEPATH.'inc/facebook.php';
		// Initialize Facebook
		$this->facebook = new Facebook(array(
			'appId'  => '529250917090161',
			'secret' => 'edce64e3900bacef0ef4ba653c711de6'
		));
		// Check if user logged in
		$fbid = $this->facebook->getUser();
		$this->ci->data->facebook = $this->facebook;
		$this->ci->data->fbid = $fbid;
		if ($fbid) {
			try {
			    // Proceed knowing you have a logged in user who's authenticated.
				$user_profile = $this->facebook->api('/me');
				if( !$this->select(array('fbid' => $fbid))) {
					$this->fbid = $fbid;
					$this->register($user_profile['name'], null);
				}
				$this->ci->data->username = $this->fbname;
				$this->seslogin();
			} catch (FacebookApiException $e) {
				echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
			}
		}
	}

	public function seslogin() {
		$user = $this->instance();
		$this->ci->data->access_token = $this->ci->session->userdata('session_id');
		$this->ci->session->set_userdata(get_object_vars($user));
	}

	public function login($username, $password) {
		if( $this->ci->validate->username($username)) {
			$this->select(array('username' => $username, 'password' => $password));
		}
	}

	public function register($username, $password) {
		$insert = get_object_vars($this->instance());
		if( $this->fbid != null) {
			$insert['username'] = 'fb-'.$this->fbid;
			$insert['password'] = md5(uniqid(rand()));
			$insert['fbname']   = $username;
		} 
		else {
			$insert['username'] = $username;
			$insert['password'] = md5($password);
		}
		$insert['signdate'] = date('Y-m-d H:i:s');
		try {
			$this->ci->db->insert('users', $insert);
		} catch(Exception $e) {
			return false;
		}
		return true;
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

	public function select($condition) {
		$query = $this->ci->db->get_where('users', $condition, 1);
		$user = $query->first_row();

		if( $user) {
			// Pass Variables
			$userobj = get_object_vars($user);
			foreach ($userobj as $key => $value) {
				$this->{$key} = $userobj[$key];
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
		unset($instance->facebook);
		unset($instance->password);
		return $instance;
	}

}