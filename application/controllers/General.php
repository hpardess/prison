<?php defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {
	var $language = 'english';
	
	public function __construct()
	{
		parent::__construct();

		if( !$this->session->userdata('isLoggedIn') ) {
			redirect('/login');
		}
		$this->load->model('prisoner_model');
		$this->load->model("province_model");
		$this->load->model('district_model');
		$this->load->model('marital_status_model');
		$this->load->model('crime_type_model');
		$this->load->model('crime_model');
		$this->load->model('court_session_model');
		$this->load->model('court_decision_type_model');
		$this->load->library('my_authentication');

		$this->language = $this->session->userdata('language');
		log_message('debug', 'selected language: ' . $this->language);
		$this->lang->load($this->language, $this->language);
	}

	public function index()
	{
		$data['provincesList'] = $this->province_model->get_all();
		$data['districtsList'] = $this->district_model->get_all();
		$data['maritalStatusList'] = $this->marital_status_model->get_all();
		$data['courtDecisionTypeList'] = $this->court_decision_type_model->get_all();

	    $this->load->view('general_list', $data);
	}

	public function new_case()
	{
		$data['provincesList'] = $this->province_model->get_all('id, name_' . $this->language .' AS name');
		$data['districtsList'] = $this->district_model->get_all('id, name_' . $this->language .' AS name, province_id');
		$data['crimeTypeList'] = $this->crime_type_model->get_all('id, type_name_' . $this->language .' AS type_name');
		$data['courtDecisionTypeList'] = $this->court_decision_type_model->get_all('id, decision_type_name_' . $this->language .' AS decision_type_name');
		$data['maritalStatusList'] = $this->marital_status_model->get_all('id, status_' . $this->language .' AS status');

	    $this->load->view('new_case', $data);
	}

	public function general_list()
	{
		$this->load->model("datatables_post_model");
		$tableName = 'general_view';

		// echo print_r($_SERVER);
		// echo print_r($_SESSION);
		// echo print_r($_POST);
		// echo print_r($_GET);

		$aColumns = array(
			'prisoner_id',
			'name',
			'father_name',
			'grand_father_name',
			'age',
			'criminal_history',
			'marital_status_' . $this->language,
			'num_of_children',
			'present_province_' . $this->language,
			'present_district_' . $this->language,
			'permanent_province_' . $this->language,
			'permanent_district_' . $this->language,
			'profile_pic',

			'crime_id',
			'case_number',
			'crime_date',
			'crime_location',
			'arrest_location',
			'police_custody',
			'crime_province_' . $this->language,
			'crime_district_' . $this->language,
			'arrest_province_' . $this->language,
			'arrest_district_' . $this->language,
			'time_spent_in_prison',
			'remaining_jail_term',
			'use_benefit_forgiveness_presidential',
			'command_issue_date',
			'commission_proposal',
			'prisoner_request',
			'commission_member');
 
        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

        $results = $this->datatables_post_model->get_data_list($tableName, $sIndexColumn, $aColumns);

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

	public function new_crime()
	{
		$provinceList = $this->province_model->get_all();
        echo json_encode($provinceList);
	}

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
    	$response['success'] = TRUE;
    	$response['message'] = '';
    	$response['result'] = '';

    	// start of transaction
		$this->db->trans_begin();

        $data1 = array(
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
        // $crimeId = $this->crime_model->create($data);

        $courtSession = array();
        for ($i=0; $i < 3; $i++) { 
        	$courtSession[$i] = array(
                // 'crime_id' => $this->input->post('crimeId')[$i],
                // 'court_decision_type_id' => $this->input->post('courtDecisionType')[$i],
                'decision_date' => $this->input->post('decisionDate')[$i],
                'decision' => $this->input->post('decision')[$i],
                'defence_lawyer_name' => $this->input->post('defenceLawyerName')[$i],
                'defence_lawyer_certificate_id' => $this->input->post('defenceLawyerCertificateId')[$i],
                'sentence_execution_date' => $this->input->post('sentenceExecutionDate')[$i]
            );

            if(count(array_filter($courtSession[$i])) != 0) {
            	// $courtSession[$i]['crime_id'] = $crimeId;
            	$courtSession[$i]['court_decision_type_id'] = $this->input->post('courtDecisionType')[$i];

            	print_r($courtSession[$i]);
            	// $this->court_session_model->create($courtSession[$i]);
            }
        }
        // $data2 = array(
        //         'crime_id' => $this->input->post('crimeId'),
        //         'court_decision_type_id' => $this->input->post('courtDecisionType'),
        //         'decision_date' => $this->input->post('decisionDate'),
        //         'decision' => $this->input->post('decision'),
        //         'defence_lawyer_name' => $this->input->post('defenceLawyerName'),
        //         'defence_lawyer_certificate_id' => $this->input->post('defenceLawyerCertificateId'),
        //         'sentence_execution_date' => $this->input->post('sentenceExecutionDate')
        //     );
        // $insert = $this->court_session_model->create($data);

        // print_r($data1);
        // print_r($courtSession);
        // print_r($data2);
        print_r($_POST);

        if ($this->db->trans_status() === FALSE)
		{
			$response['success'] = FALSE;
			$response['message'] = 'Falied to save the data.';

			// rollback transaction
			$this->db->trans_rollback();
		}
		else
		{
			// commit transaction
			$this->db->trans_commit();
		}
        
        echo json_encode($response);
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
        echo json_encode(array("status" => TRUE));
    }
}
