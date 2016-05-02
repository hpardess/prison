<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Hameedullah Pardess <hameedullah.pardess@gmail.com>
 *
 */

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
		$data['total_prisoners'] = $this->prisoner_model->count_all();
		$data['total_court_sessions'] = $this->court_session_model->count_all();
		// 1 = فیصله ابتدایی
		$data['total_court_sessions_primary'] = $this->court_session_model->count_by_court_decision_type(1);
		// 2 = فیصله استیناف
		$data['total_court_sessions_appellate'] = $this->court_session_model->count_by_court_decision_type(2);
		// 3 = فیصله تمیز
		$data['total_court_sessions_supreme'] = $this->court_session_model->count_by_court_decision_type(3);
		$data['total_users'] = $this->user_model->count_all();
		$data['total_groups'] = $this->group_model->count_all();

	    $this->load->view('dashboard_view', $data);
	}

	public function get_prisoners_status_data()
	{
		
		// $data = $this-&gt;data-&gt;get_data();

		// $category = array();
		// $category['name'] = 'Category';

		// $series1 = array();
		// $series1['name'] = 'WordPress';

		// $series2 = array();
		// $series2['name'] = 'Code Igniter';

		// $series3 = array();
		// $series3['name'] = 'Highcharts';

		// foreach ($data as $row)
		// {
		// $category['data'][] = $row-&gt;month;
		// $series1['data'][] = $row-&gt;wordpress;
		// $series2['data'][] = $row-&gt;codeigniter;
		// $series3['data'][] = $row-&gt;highcharts;
		// }

		// $result = array();
		// array_push($result,$category);
		// array_push($result,$series1);
		// array_push($result,$series2);
		// array_push($result,$series3);

		// print json_encode($result, JSON_NUMERIC_CHECK);
	}
}
