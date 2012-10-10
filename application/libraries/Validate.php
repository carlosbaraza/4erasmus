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

class Validate {
   /**
	 * Constructor
	 *
	 *
	 * @access	public
	 * @param
	*/
	public function __construct() {
		// Set the super object to a local variable for use throughout the class
		$this->CI =& get_instance();
	}

	public function username($username) {
		if( is_string($username) && !empty($username)) {
			return true;
		}
		else {
			return false;
		}
	}

	public function eventDate($date) {
		$reg = '@([0-9]+)\/([0-9]+)\/([0-9]+) ([0-9]+):([0-9]+)@';
		if( !preg_match($reg, $date, $match))
			return false;
		else {
			if( checkdate($match[1], $match[2], $match[3]) && $match[4] < 24 && $match[4] >= 0 && $match[5] < 60 && $match[5] >= 0) {
				return $match[3].'-'.$match[1].'-'.$match[2].' '.$match[4].':'.$match[5].':00';
			}
			return false;
		}
	}

	public function privacy($privacy){
		return true;
	}

	public function category($category) {
		return true;
	}

	public function actiontarget($targettype) {
		return in_array($targettype, array(
			'group', 
			'event', 
			'place'
		));
	}

	public function commenttarget($targettype) {
		return in_array($targettype, array(
			'group', 
			'event', 
			'place'
		));
	}

	public function actiontype($actiontype) {
		return in_array($actiontype, array(
			'follow',
			'view'
		));
	}
}