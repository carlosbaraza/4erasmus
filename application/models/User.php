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
		// Facebook PHP-SDK
		require_once RESOURCEPATH.'inc/facebook.php';
		// Initialize Facebook
		$this->facebook = new Facebook(array(
			'appId'  => '529250917090161',
			'secret' => 'edce64e3900bacef0ef4ba653c711de6'
		));
		// Check if user logged in
		$fbid = $this->facebook->getUser();
		if ($fbid) {
			try {
			    // Proceed knowing you have a logged in user who's authenticated.
				$user_profile = $this->facebook->api('/me');
				$user = $this->ci->user;
				echo '<pre>Welcome '.$user_profile['name'].'<br>'.$user_profile['id'].'</pre>';
				if( !$user->select(array('fbid' => $fbid))) {
					$user->fbid = $fbid;
					$user->register($user_profile['name'], md5(uniqid(rand())));
				}
				$this->ci->data->facebook = $this->facebook;
				$this->ci->data->fbid = $fbid;
			} catch (FacebookApiException $e) {
			    echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
			    $user = null;
			}
		}
	}

	public function login($username, $password) {
		if( $this->ci->validate->username($username)) {
			$this->select(array('username' => $username, 'password' => $password));
		}
	}

	public function register($username, $password) {
		$insert = array();
		$userobj = get_object_vars($this);
		unset($userobj['ci']);
		unset($userobj['facebook']);
		foreach ($userobj as $key => $value) {
			if( !empty($value)) 
				$insert[$key] = $value;
		}
		$insert['username'] = $username;
		$insert['password'] = md5($password);
		$insert['signdate'] = date('Y-m-d H:i:s');
		try {
			$this->ci->db->insert('users', $insert);
		} catch(Exception $e) {
			return FALSE;
		}
		return TRUE;
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

}