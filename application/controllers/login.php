<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Hameedullah Pardess <hameedullah.pardess@gmail.com>
 *
 */

class Login extends CI_Controller {
    function __construct() {
        parent::__construct();

        // $idiom = $this->session->userdata('language');
        // log_message('debug', 'selected language: ' . $idiom);
        // $this->lang->load($idiom, $idiom);
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
        $this->load->model('user_model');
        $this->load->model('group_model');
        $this->load->library('my_session');
        $username = $this->input->post('username');
        if( $username && $password && $this->user_model->check_user($username,$password)) {
            $this->user_model->details->language = 'english';
            $this->user_model->details->direction = 'ltr';

            $this->my_session->set_session($this->user_model->details);
            $this->my_session->set_session_group_with_permissions($this->group_model->get_by_id($this->user_model->details->groups_id));
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