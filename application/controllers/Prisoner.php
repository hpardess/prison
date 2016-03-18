<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Prisoner extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();

		if( !$this->session->userdata('isLoggedIn') ) {
			redirect('/login');
		}
		$this->load->model('prisoner_model');
	}

	public function index()
	{
	    $this->load->view('prisoner_list');
	}

	public function prisoner_list()
	{
		$this->load->model("datatables_model");
		$tableName = 'prisoner';

		$aColumns = array(
			'id',
			'marital_status_id',
			'present_province_id',
			'present_district_id',
			'permanent_province_id',
			'permanent_district_id',
			'name',
			'father_name',
			'grand_father_name',
			'age',
			'criminal_history',
			'num_of_children',
			'profile_pic');
 
        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

        $results = $this->datatables_model->get_data_list($tableName, $sIndexColumn, $aColumns);

        $filteredDataArray = [];
        foreach ($results['data'] as $dataRow) {
            $dataRow[] = '<a class="btn btn-xs btn-warning" title="Lock" onclick="lock_record('."'".$dataRow[0]."'".')"><i class="glyphicon glyphicon-lock"></i>|</a>
            			<a class="btn btn-xs btn-primary" title="View" onclick="view_record('."'".$dataRow[0]."'".')"><i class="glyphicon glyphicon-list"></i>|</a>
                    <a class="btn btn-xs btn-primary" title="Edit" onclick="edit_record('."'".$dataRow[0]."'".')"><i class="glyphicon glyphicon-pencil"></i>|</a>
                  <a class="btn btn-xs btn-danger" title="Delete" onclick="delete_record('."'".$dataRow[0]."'".')"><i class="glyphicon glyphicon-trash"></i>|</a>';

            $filteredDataArray[] = $dataRow;
        }

        $results['data'] = $filteredDataArray;
	    echo json_encode($results);
	}

	public function new_prisoner()
	{
		$this->load->model('province_model');
		$provinceList = $this->province_model->get_all();
        echo json_encode($provinceList);
	}
}
