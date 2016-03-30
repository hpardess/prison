<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Crime extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();

		if( !$this->session->userdata('isLoggedIn') ) {
			redirect('/login');
		}
		$this->load->model('crime_model');
		$this->load->model("province_model");
		$this->load->model('district_model');
		$this->load->library('my_authentication');

		$idiom = $this->session->userdata('language');
		log_message('debug', 'selected language: ' . $idiom);
		$this->lang->load($idiom, $idiom);
	}

	public function index()
	{
		$data['provincesList'] = $this->province_model->get_all();
		$data['districtsList'] = $this->district_model->get_all();
	    $this->load->view('crime_list', $data);
	}

	public function crime_list()
	{
		$this->load->model("datatables_model");
		$tableName = 'crime_view';

		$aColumns = array(
			'id',
			'case_number',
			'crime_date',
			'police_custody',
			'crime_location',
			'crime_district',
			'crime_province',
			'arrest_location',
			'arrest_district',
			'arrest_province');
 
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

	// public function new_crime()
	// {
	// 	$provinceList = $this->province_model->get_all();
 //        echo json_encode($provinceList);
	// }

	public function view($id)
	{
		$result = $this->crime_model->get_by_id_with_joins($id);
        echo json_encode($result);
	}

	public function edit($id)
	{
		if(!$this->my_authentication->isGroupMemberAllowed($this->session->userdata('isadmin'), $this->session->userdata('group'), 'crime_edit'))
		{
			log_message('DEBUG', 'crime edit false');
		}

		$crime = $this->crime_model->get_by_id($id);

		$result = array();
		$result['crime'] = $crime;
		$result['crimeDistricts'] = $this->district_model->get_by_province_id($crime->crime_province_id);
		$result['arrestDistricts'] = $this->district_model->get_by_province_id($crime->arrest_province_id);

        echo json_encode($result);
	}

	public function delete($id)
	{
		$this->crime_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
	}

	// add new record
	public function add()
    {
        $data = array(
                'crime_date' => $this->input->post('crimeDate'),
                'case_number' => $this->input->post('caseNumber'),
                'police_custody' => $this->input->post('policeCustody'),
                'crime_province_id' => $this->input->post('crimeProvince'),
                'crime_district_id' => $this->input->post('crimeDistrict'),
                'crime_location' => $this->input->post('crimeLocation'),
                'arrest_province_id' => $this->input->post('arrestProvince'),
                'arrest_district_id' => $this->input->post('arrestDistrict'),
                'arrest_location' => $this->input->post('arrestLocation')
            );
        $insert = $this->crime_model->create($data);
        // log_message('debug', 'insert: ' . $insert);
        echo json_encode(array("status" => TRUE));
    }
 
 	// update exisitn record
    public function update()
    {
        $data = array(
        		'case_number' => $this->input->post('caseNumber'),
                'crime_date' => $this->input->post('crimeDate'),
                'police_custody' => $this->input->post('policeCustody'),
                'crime_province_id' => $this->input->post('crimeProvince'),
                'crime_district_id' => $this->input->post('crimeDistrict'),
                'crime_location' => $this->input->post('crimeLocation'),
                'arrest_province_id' => $this->input->post('arrestProvince'),
                'arrest_district_id' => $this->input->post('arrestDistrict'),
                'arrest_location' => $this->input->post('arrestLocation')
            );
        $affected_rows = $this->crime_model->update(array('id' => $this->input->post('id')), $data);
        // log_message('debug', 'affected rows: ' . $affected_rows);
        echo json_encode(array("status" => TRUE));
    }
}
