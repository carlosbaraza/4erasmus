<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');


require RESOURCEPATH.'inc/base_facebook.php';

class Fb extends Facebook {
   /**
	 * Constructor
	 *
	 *
	 * @access	public
	 * @param
	*/
   	protected $appId;
   	protected $secret;

	public function __construct($params) {
		var_dump($params);
		//parent::__construct($params);
	}

}