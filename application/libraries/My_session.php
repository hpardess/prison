<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Hameedullah Pardess <hameedullah.pardess@gmail.com>
 *
 */

class My_Session {
	var $CI;

	public function __construct()
	{
		$this->CI = &get_instance();
	}

	function update_session() {
        $this->CI->load->model('user_model');
        $this->CI->load->model('group_model');
        $userId = $this->session->userdata('id');
        $this->set_session($this->CI->user_model->get_by_id($userId));


    }

    function set_session($user_details) {
        // session->set_userdata is a CodeIgniter function that
        // stores data in CodeIgniter's session storage.  Some of the values are built in
        // to CodeIgniter, others are added.  See CodeIgniter's documentation for details.
        
        $this->CI->session->set_userdata( array(
                'id'=>$user_details->id,
                'name'=> $user_details->firstname . ' ' . $user_details->lastname,
                'username'=>$user_details->username,
                'email'=>$user_details->email,
                'isAdmin'=>$user_details->isadmin,
                'isLoggedIn'=>true,
                'language'=>'english',
                'direction'=>'ltr'
            )
        );
    }

    function set_session_group_with_permissions($groupWithPermissions) {
    	$this->CI->session->set_userdata('group', $groupWithPermissions);
    }
}
