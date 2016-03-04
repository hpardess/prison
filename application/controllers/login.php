<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
class Login extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
  
    function index() {
        if( $this->session->userdata('isLoggedIn') ) {
            redirect(base_url('index.php/home'), 'refresh');
        } else {

            log_message('debug', 'login.php index().');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
      
            if($this->form_validation->run() == FALSE) {
                log_message('debug', 'form validation failed.');
                $this->load->view('login');
            } else {
                log_message('debug', 'form validation success.');
                redirect(base_url('index.php/home'), 'refresh');
            }
        }  
     }
  
    function check_database($password) {
        $this->load->model('user', 'userModel');
        $username = $this->input->post('username');
        if( $username && $password && $this->userModel->validate_user($username,$password)) {
            return TRUE;
        } else {
            // Otherwise show the login screen with an error message.
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return FALSE;
        }
      }

    function logout_user() {
      $this->session->sess_destroy();
      $this->index();
    }




}