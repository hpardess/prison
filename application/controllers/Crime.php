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
			'arrest_province',
			'time_spent_in_prison',
			'remaining_jail_term',
			'use_benefit_forgiveness_presidential',
			'command_issue_date',
			'commission_proposal',
			'prisoner_request',
			'commission_member');
 
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
		$response['success'] = TRUE;
    	$response['message'] = '';
    	$response['result'] = '';

		if(!$this->my_authentication->isGroupMemberAllowed($this->session->userdata('isadmin'), $this->session->userdata('group'), 'crime_view'))
		{
			log_message('DEBUG', 'crime edit false');
			$response['success'] = FALSE;
    		$response['message'] = 'You are unauthrized. Please contact system administrator.';
			echo json_encode($response);
		}
		else
		{
			$result = $this->crime_model->get_by_id_with_joins($id);
			$response['result'] = $result;
	        echo json_encode($response);
		}
	}

	public function edit($id)
	{
		$response['success'] = TRUE;
    	$response['message'] = '';
    	$response['result'] = '';

		if(!$this->my_authentication->isGroupMemberAllowed($this->session->userdata('isadmin'), $this->session->userdata('group'), 'crime_edit'))
		{
			log_message('DEBUG', 'crime edit false');
			$response['success'] = FALSE;
    		$response['message'] = 'You are unauthrized. Please contact system administrator.';
			echo json_encode($response);
		}
		else
		{
			$crime = $this->crime_model->get_by_id($id);

			$result = array();
			$result['crime'] = $crime;
			$result['crimeDistricts'] = $this->district_model->get_by_province_id($crime->crime_province_id);
			$result['arrestDistricts'] = $this->district_model->get_by_province_id($crime->arrest_province_id);
			$response['result'] = $result;

	        echo json_encode($response);
		}
	}

	public function delete($id)
	{
		$response['success'] = TRUE;
    	$response['message'] = '';
    	$response['result'] = '';

		if(!$this->my_authentication->isGroupMemberAllowed($this->session->userdata('isadmin'), $this->session->userdata('group'), 'crime_delete'))
		{
			log_message('DEBUG', 'crime edit false');
			$response['success'] = FALSE;
    		$response['message'] = 'You are unauthrized. Please contact system administrator.';
			echo json_encode($response);
		}
		else
		{
			$this->crime_model->delete_by_id($id);
	        echo json_encode($response);
	    }
	}

	// add new record
	public function add()
    {
    	$response['success'] = TRUE;
    	$response['message'] = '';
    	$response['result'] = '';

		if(!$this->my_authentication->isGroupMemberAllowed($this->session->userdata('isadmin'), $this->session->userdata('group'), 'crime_new'))
		{
			log_message('DEBUG', 'crime edit false');
			$response['success'] = FALSE;
    		$response['message'] = 'You are unauthrized. Please contact system administrator.';
			echo json_encode($response);
		}
		else
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
	                'arrest_location' => $this->input->post('arrestLocation'),
	                'time_spent_in_prison' => $this->input->post('timeSpentInPrison'),
	                'remaining_jail_term' => $this->input->post('remainingJailTerm'),
	                'use_benefit_forgiveness_presidential' => $this->input->post('useBenefitForgivenessPresidential'),
	                'command_issue_date' => $this->input->post('commandIssueDate'),
	                'commission_proposal' => $this->input->post('commissionProposal'),
	                'prisoner_request' => $this->input->post('prisonerRequest'),
	                'commission_member' => $this->input->post('commissionMember')
	            );
	        $insert = $this->crime_model->create($data);
	        // log_message('debug', 'insert: ' . $insert);
			echo json_encode($response);
	    }
    }
 
 	// update exisitn record
    public function update()
    {
    	$response['success'] = TRUE;
    	$response['message'] = '';
    	$response['result'] = '';

		if(!$this->my_authentication->isGroupMemberAllowed($this->session->userdata('isadmin'), $this->session->userdata('group'), 'crime_edit'))
		{
			log_message('DEBUG', 'crime edit false');
			$response['success'] = FALSE;
    		$response['message'] = 'You are unauthrized. Please contact system administrator.';
			echo json_encode($response);
		}
		else
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
	                'arrest_location' => $this->input->post('arrestLocation'),
	                'time_spent_in_prison' => $this->input->post('timeSpentInPrison'),
	                'remaining_jail_term' => $this->input->post('remainingJailTerm'),
	                'use_benefit_forgiveness_presidential' => $this->input->post('useBenefitForgivenessPresidential'),
	                'command_issue_date' => $this->input->post('commandIssueDate'),
	                'commission_proposal' => $this->input->post('commissionProposal'),
	                'prisoner_request' => $this->input->post('prisonerRequest'),
	                'commission_member' => $this->input->post('commissionMember')
	            );
	        $affected_rows = $this->crime_model->update(array('id' => $this->input->post('id')), $data);
	        // log_message('debug', 'affected rows: ' . $affected_rows);
	        echo json_encode($response);
	    }
    }
}
