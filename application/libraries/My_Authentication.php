<?php defined('BASEPATH') OR exit('No direct script access allowed');

class My_Authentication {
	var $CI;

	public function __construct()
	{
		$this->CI = &get_instance();
	}
}