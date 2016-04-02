<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();

		if( !$this->session->userdata('isLoggedIn') ) {
			redirect('/login');
		}
		$this->load->model('crime_model');
		$this->load->model('prisoner_model');
		$this->load->model('court_session_model');
		$this->load->model('user_model');
		$this->load->model('group_model');
		$this->load->library('my_authentication');

		$idiom = $this->session->userdata('language');
		log_message('debug', 'selected language: ' . $idiom);
		$this->lang->load($idiom, $idiom);
	}

	public function index()
	{
		$data['total_crimes'] = $this->crime_model->count_all();
		$data['total_prisoners'] = $this->crime_model->count_all();
		$data['total_court_sessions'] = $this->crime_model->count_all();
		$data['total_users'] = $this->user_model->count_all();
		$data['total_groups'] = $this->group_model->count_all();

	    $this->load->view('dashboard_view', $data);
	}
}
