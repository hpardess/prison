<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Hameedullah Pardess <hameedullah.pardess@gmail.com>
 *
 */

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
		$this->load->model('crime_crime_type_model');
		$this->load->model('crime_model');
		$this->load->model('crime_prisoner_model');
		$this->load->model('court_session_model');
		$this->load->model('court_decision_type_model');
		$this->load->library('my_authentication');

		$this->language = $this->session->userdata('language');
		log_message('debug', 'selected language: ' . $this->language);
		$this->lang->load($this->language, $this->language);
	}

	public function index()
	{
	    $this->load->view('general_list');
	}

	public function new_case()
	{
		$response['success'] = TRUE;
    	$response['message'] = '';
    	$response['result'] = '';

		if(!$this->my_authentication->isGroupMemberAllowed($this->session->userdata('isAdmin'), $this->session->userdata('group'), array('crime_new', 'prisoner_new', 'court_session_new')))
		{
			show_error('You are unauthrized. Please contact system administrator.  <a href="'.base_url().'index.php/">Home</a>', 401, 'Unauthrized: 401');
		}
		else
		{
			$data['isEdit'] = FALSE;

			$data['provincesList'] = $this->province_model->get_all('id, name_' . $this->language .' AS name');
			$data['districtsList'] = $this->district_model->get_all('id, name_' . $this->language .' AS name, province_id');
			$data['crimeTypeList'] = $this->crime_type_model->get_all('id, type_name_' . $this->language .' AS type_name');
			$data['courtDecisionTypeList'] = $this->court_decision_type_model->get_all('id, decision_type_name_' . $this->language .' AS decision_type_name');
			$data['maritalStatusList'] = $this->marital_status_model->get_all('id, status_' . $this->language .' AS status');

		    $this->load->view('new_edit_case', $data);
		}
	}

	public function view_case($crimeId)
	{
		$response['success'] = TRUE;
    	$response['message'] = '';
    	$response['result'] = '';

		if(!$this->my_authentication->isGroupMemberAllowed($this->session->userdata('isAdmin'), $this->session->userdata('group'), array('crime_view', 'prisoner_view', 'court_session_view')))
		{
			show_error('You are unauthrized. Please contact system administrator.  <a href="'.base_url().'index.php/">Home</a>', 401, 'Unauthrized: 401');
		}
		else
		{
			$data['hasEditRight'] = $this->my_authentication->isGroupMemberAllowed($this->session->userdata('isAdmin'), $this->session->userdata('group'), 'crime_edit');

			$data['prisoner'] = $this->prisoner_model->get_by_crime_id_with_joins($crimeId, $this->language);
			$data['crime'] = $this->crime_model->get_by_id_with_joins($crimeId, $this->language);
			$data['crimeTypes'] = $this->crime_type_model->get_by_crime_id_with_join($crimeId, 'id, type_name_' . $this->language . ' AS type_name');
			$data['courtDecisionTypeList'] = $this->court_decision_type_model->get_all('id, decision_type_name_' . $this->language .' AS decision_type_name');

			$data['courtSessions'] = $this->court_session_model->get_by_crime_id($crimeId);

		    $this->load->view('view_case', $data);
		}
	}

	public function edit_case($crimeId)
	{
		$response['success'] = TRUE;
    	$response['message'] = '';
    	$response['result'] = '';

		if(!$this->my_authentication->isGroupMemberAllowed($this->session->userdata('isAdmin'), $this->session->userdata('group'), array('crime_edit', 'prisoner_edit', 'court_session_edit')))
		{
			show_error('You are unauthrized. Please contact system administrator.  <a href="'.base_url().'index.php/">Home</a>', 401, 'Unauthrized: 401');
		}
		else
		{
			$data['isEdit'] = TRUE;

			$data['provincesList'] = $this->province_model->get_all('id, name_' . $this->language .' AS name');
			$data['districtsList'] = $this->district_model->get_all('id, name_' . $this->language .' AS name, province_id');
			$data['crimeTypeList'] = $this->crime_type_model->get_all('id, type_name_' . $this->language .' AS type_name');
			$data['courtDecisionTypeList'] = $this->court_decision_type_model->get_all('id, decision_type_name_' . $this->language .' AS decision_type_name');
			$data['maritalStatusList'] = $this->marital_status_model->get_all('id, status_' . $this->language .' AS status');

			$data['prisoner'] = $this->prisoner_model->get_by_crime_id_with_joins($crimeId, $this->language);
			$data['crime'] = $this->crime_model->get_by_id_with_joins($crimeId, $this->language);
			$data['crimeTypes'] = $this->crime_type_model->get_by_crime_id_with_join($crimeId, 'id, type_name_' . $this->language . ' AS type_name');
			
			$data['courtSessions'] = $this->court_session_model->get_by_crime_id($crimeId);

		    $this->load->view('new_edit_case', $data);
		}
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
			'crime_date_shamsi',
			'arrest_date',
			'arrest_date_shamsi',
			'crime_type_' . $this->language,
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
			'command_issue_date_shamsi',
			'commission_proposal',
			'prisoner_request',
			'commission_member',
			'locked');
 
        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

        $results = $this->datatables_post_model->get_data_list($tableName, $sIndexColumn, $aColumns);

        $filteredDataArray = [];
        $aColumnsCount = count($aColumns);
        foreach ($results['data'] as $dataRow) {
        	$isLocked = $dataRow[$aColumnsCount - 1];
        	$buttons = '';

        	// lock
        	if($isLocked == '1')
        	{
        		if($this->my_authentication->isGroupMemberAllowed($this->session->userdata('isAdmin'), $this->session->userdata('group'), array('crime_unlock', 'prisoner_unlock', 'court_session_unlock')))
				{
					$buttons = $buttons . '<a class="btn btn-xs btn-warning" title="Unlock" onclick="unlock_record('."'".$dataRow[13]."'".')"><i class="glyphicon glyphicon-flash"></i>|</a>';
				}
        	}
        	else
        	{
        		$buttons = $buttons . '<a class="btn btn-xs btn-warning" title="Lock" onclick="lock_record('."'".$dataRow[13]."'".')"><i class="glyphicon glyphicon-lock"></i>|</a>';
        	}

			// view
			if($this->my_authentication->isGroupMemberAllowed($this->session->userdata('isAdmin'), $this->session->userdata('group'), array('crime_view', 'prisoner_view', 'court_session_view')))
			{
				$buttons = $buttons . '<a class="btn btn-xs btn-primary" title="View" href="'.base_url().'index.php/general/view_case/'.$dataRow[13].'"><i class="glyphicon glyphicon-list"></i>|</a>';
			}

			// edit
			if($this->my_authentication->isGroupMemberAllowed($this->session->userdata('isAdmin'), $this->session->userdata('group'), array('crime_edit', 'prisoner_edit', 'court_session_edit')))
			{
				$buttons = $buttons . '<a class="btn btn-xs btn-primary" title="Edit" href="'.base_url().'index.php/general/edit_case/'.$dataRow[13].'"><i class="glyphicon glyphicon-pencil"></i>|</a>';
			}

			// delete
			if($this->my_authentication->isGroupMemberAllowed($this->session->userdata('isAdmin'), $this->session->userdata('group'), array('crime_delete', 'prisoner_delete', 'court_session_delete')))
			{
				$buttons = $buttons . '<a class="btn btn-xs btn-danger" title="Delete" onclick="delete_record('."'".$dataRow[13]."'".')"><i class="glyphicon glyphicon-trash"></i>|</a>';
			}

            $dataRow[$aColumnsCount - 1] = $buttons;
            $filteredDataArray[] = $dataRow;
        }

        // $results['data'] = $filteredDataArray;
        // foreach ($results['data'] as $dataRow) {
        //     $dataRow[] = '<a class="btn btn-xs btn-primary" title="View" href="'.base_url().'index.php/general/view_case/'.$dataRow[13].'"><i class="glyphicon glyphicon-list"></i>|</a>';

        //     $filteredDataArray[] = $dataRow;
        // }

        $results['data'] = $filteredDataArray;
	    echo json_encode($results);
	}

	public function general_quick_list()
	{
		$this->load->model("datatables_post_model");
		$tableName = 'general_quick_view';

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
			'permanent_province_' . $this->language,
			'permanent_district_' . $this->language,

			'crime_id',
			'case_number',
			'crime_date',
			'crime_date_shamsi',
			'arrest_date',
			'arrest_date_shamsi',
			'police_custody',
			'time_spent_in_prison',
			'remaining_jail_term',
			'locked');
 
        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

        $results = $this->datatables_post_model->get_data_list($tableName, $sIndexColumn, $aColumns);

        $filteredDataArray = [];
        $aColumnsCount = count($aColumns);
        foreach ($results['data'] as $dataRow) {
        	$isLocked = $dataRow[$aColumnsCount - 1];
        	$buttons = '';
        	$referenceId = $dataRow[9];

        	// lock
        	if($isLocked == '1')
        	{
        		if($this->my_authentication->isGroupMemberAllowed($this->session->userdata('isAdmin'), $this->session->userdata('group'), array('crime_unlock', 'prisoner_unlock', 'court_session_unlock')))
				{
					$buttons = $buttons . '<a class="btn btn-xs btn-warning" title="Unlock" onclick="unlock_record('."'".$referenceId."'".')"><i class="glyphicon glyphicon-flash"></i>|</a>';
				}
        	}
        	else
        	{
        		$buttons = $buttons . '<a class="btn btn-xs btn-warning" title="Lock" onclick="lock_record('."'".$referenceId."'".')"><i class="glyphicon glyphicon-lock"></i>|</a>';
        	}

			// view
			if($this->my_authentication->isGroupMemberAllowed($this->session->userdata('isAdmin'), $this->session->userdata('group'), array('crime_view', 'prisoner_view', 'court_session_view')))
			{
				$buttons = $buttons . '<a class="btn btn-xs btn-primary" title="View" href="'.base_url().'index.php/general/view_case/'.$referenceId.'"><i class="glyphicon glyphicon-list"></i>|</a>';
			}

			// edit
			if($this->my_authentication->isGroupMemberAllowed($this->session->userdata('isAdmin'), $this->session->userdata('group'), array('crime_edit', 'prisoner_edit', 'court_session_edit')))
			{
				$buttons = $buttons . '<a class="btn btn-xs btn-primary" title="Edit" href="'.base_url().'index.php/general/edit_case/'.$referenceId.'"><i class="glyphicon glyphicon-pencil"></i>|</a>';
			}

			// delete
			if($this->my_authentication->isGroupMemberAllowed($this->session->userdata('isAdmin'), $this->session->userdata('group'), array('crime_delete', 'prisoner_delete', 'court_session_delete')))
			{
				$buttons = $buttons . '<a class="btn btn-xs btn-danger" title="Delete" onclick="delete_record('."'".$referenceId."'".')"><i class="glyphicon glyphicon-trash"></i>|</a>';
			}

            $dataRow[$aColumnsCount - 1] = $buttons;
            $filteredDataArray[] = $dataRow;
        }

        // $results['data'] = $filteredDataArray;
        // foreach ($results['data'] as $dataRow) {
        //     $dataRow[] = '<a class="btn btn-xs btn-primary" title="View" href="'.base_url().'index.php/general/view_case/'.$dataRow[13].'"><i class="glyphicon glyphicon-list"></i>|</a>';

        //     $filteredDataArray[] = $dataRow;
        // }

        $results['data'] = $filteredDataArray;
	    echo json_encode($results);
	}

	// public function new_crime()
	// {
	// 	$provinceList = $this->province_model->get_all();
 //        echo json_encode($provinceList);
	// }

	// public function view($id)
	// {
	// 	$result = $this->crime_model->get_by_id_with_joins($id);
 //        echo json_encode($result);
	// }

	// public function edit($id)
	// {
	// 	if(!$this->my_authentication->isGroupMemberAllowed($this->session->userdata('isadmin'), $this->session->userdata('group'), 'crime_edit'))
	// 	{
	// 		log_message('DEBUG', 'crime edit false');
	// 	}

	// 	$crime = $this->crime_model->get_by_id($id);

	// 	$result = array();
	// 	$result['crime'] = $crime;
	// 	$result['crimeDistricts'] = $this->district_model->get_by_province_id($crime->crime_province_id);
	// 	$result['arrestDistricts'] = $this->district_model->get_by_province_id($crime->arrest_province_id);

 //        echo json_encode($result);
	// }

	// add new record
	public function add()
    {
    	$response['success'] = TRUE;
    	$response['message'] = '';
    	$response['result'] = '';

    	if(!$this->my_authentication->isGroupMemberAllowed($this->session->userdata('isAdmin'), $this->session->userdata('group'), array('crime_new', 'prisoner_new', 'court_session_new')))
		{
			log_message('DEBUG', 'crime edit false');
			$response['success'] = FALSE;
    		$response['message'] = 'You are unauthrized. Please contact system administrator.';
			echo json_encode($response);
		}
		else
		{
	    	// start of transaction
			$this->db->trans_begin();

			$crimeData = array(
	                'crime_date_shamsi' => $this->input->post('crimeDate'),
		                'arrest_date_shamsi' => $this->input->post('arrestDate'),
		                'case_number' => $this->input->post('caseNumber'),
		                'police_custody' => $this->input->post('policeCustody'),
		                'crime_reason' => $this->input->post('crimeReason'),
		                'crime_supporter' => $this->input->post('crimeSupporter'),
		                'crime_province_id' => $this->input->post('crimeProvince'),
		                'crime_district_id' => $this->input->post('crimeDistrict'),
		                'crime_location' => $this->input->post('crimeLocation'),
		                'arrest_province_id' => $this->input->post('arrestProvince'),
		                'arrest_district_id' => $this->input->post('arrestDistrict'),
		                'arrest_location' => $this->input->post('arrestLocation'),
		                'time_spent_in_prison' => $this->input->post('timeSpentInPrison'),
		                'remaining_jail_term' => $this->input->post('remainingJailTerm'),
		                'use_benefit_forgiveness_presidential' => $this->input->post('useBenefitForgivenessPresidential'),
		                'command_issue_date_shamsi' => $this->input->post('commandIssueDate'),
		                'commission_proposal' => $this->input->post('commissionProposal'),
		                'prisoner_request' => $this->input->post('prisonerRequest'),
		                'commission_member' => $this->input->post('commissionMember')
	            );
	        $crime_id = $this->crime_model->create($crimeData);

	        $response['result'] = $crime_id;

	        $selectedCrimeTypes = $this->input->post('crimeType');
	        if (!empty($selectedCrimeTypes)) {
				$this->crime_crime_type_model->delete_by_crime_id($crime_id);

				foreach ($selectedCrimeTypes as $key => $value) {
					$this->crime_crime_type_model->create(array('crime_type_id'=> $value, 'crime_id'=> $crime_id));
				}
	        }

	        $courtSession = array();
	        for ($i=0; $i < 3; $i++) { 
	        	$courtSession[$i] = array(
	                // 'crime_id' => $this->input->post('crimeId')[$i],
	                // 'court_decision_type_id' => $this->input->post('courtDecisionType')[$i],
	                'decision_date_shamsi' => $this->input->post('decisionDate')[$i],
	                'decision' => $this->input->post('decision')[$i],
	                'defence_lawyer_name' => $this->input->post('defenceLawyerName')[$i],
	                'defence_lawyer_certificate_id' => $this->input->post('defenceLawyerCertificateId')[$i],
	                'sentence_execution_date_shamsi' => $this->input->post('sentenceExecutionDate')[$i]
	            );

	            if(count(array_filter($courtSession[$i])) != 0) {
	            	$courtSession[$i]['crime_id'] = $crime_id;
	            	$courtSession[$i]['court_decision_type_id'] = $this->input->post('courtDecisionType')[$i];

	            	// print_r($courtSession[$i]);
	            	$this->court_session_model->create($courtSession[$i]);
	            }
	        }



			$isNewPrisoner = $this->input->post('newPrisoner');
			$isNewPrisoner = isset($isNewPrisoner)? TRUE: FALSE;
			if($isNewPrisoner)
			{
				$criminal_history = $this->input->post('criminalHistory');

		        $prisonerData = array(
		        		'tazkira_number' => $this->input->post('tazkiraNumber'),
		                'name' => $this->input->post('name'),
		                'father_name' => $this->input->post('fatherName'),
		                'grand_father_name' => $this->input->post('grandFatherName'),
		                'age' => $this->input->post('age'),
		                'marital_status_id' => $this->input->post('maritalStatus'),
		                'num_of_children' => $this->input->post('numOfChildren'),
		                'criminal_history' => isset($criminal_history)? 1: 0,
		                'permanent_province_id' => $this->input->post('permanentProvince'),
		                'permanent_district_id' => $this->input->post('permanentDistrict'),
		                'present_province_id' => $this->input->post('presentProvince'),
		                'present_district_id' => $this->input->post('presentDistrict')
		                // 'profile_pic' => $this->input->post('profilePic')
		            );
		        $prisoner_id = $this->prisoner_model->create($prisonerData);
		        log_message('debug', 'insert ID: ' . $prisoner_id);


		        $this->db->insert('crime_prisoner', array(
	        											'crime_id' => $crime_id,
	        											'prisoner_id' => $prisoner_id));

				$extension = 'jpg';
				if($_FILES['profilePic'] && $_FILES['profilePic']['size'] > 0)
				{
					$image = $_FILES['profilePic'];
					log_message('debug', 'file name: ' . $image['name']);
					$path_info = pathinfo($image['name']);
					$extension = $path_info['extension'];

					$file_new_name = $prisoner_id . '.' . $extension;
					log_message('debug', 'new file name: ' . $file_new_name);

					if(!$this->upload_photo('profilePic', $file_new_name))
					{
						$response['success'] = FALSE;
						$response['message'] = $this->upload->display_errors();
						// rollback transaction
						$this->db->trans_rollback();
					}
					else
					{
						$dataUpdate = array(
				                'profile_pic' => $file_new_name
				            );
						$this->prisoner_model->update_by_id($prisoner_id, $dataUpdate);

						// commit transaction
						$this->db->trans_commit();
					}
				}
				else
				{
					// commit transaction
					$this->db->trans_commit();
				}
			}
			else
			{
				$prisoner_id = $this->input->post('prisoner_id');
				$this->db->insert('crime_prisoner', array(
	        											'crime_id' => $crime_id,
	        											'prisoner_id' => $prisoner_id));

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
			}
	        echo json_encode($response);
	    }
    }
 
 	// update exisitn record
    public function update()
    {
        $response['success'] = TRUE;
    	$response['message'] = '';
    	$response['result'] = '';

    	if(!$this->my_authentication->isGroupMemberAllowed($this->session->userdata('isAdmin'), $this->session->userdata('group'), array('crime_edit', 'prisoner_edit', 'court_session_edit')))
		{
			log_message('DEBUG', 'crime edit false');
			$response['success'] = FALSE;
    		$response['message'] = 'You are unauthrized. Please contact system administrator.';
			echo json_encode($response);
		}
		else
		{
	    	// start of transaction
			$this->db->trans_begin();

			$crime_id = $this->input->post('crimeId');
			$crimeData = array(
	                'crime_date_shamsi' => $this->input->post('crimeDate'),
	                'arrest_date_shamsi' => $this->input->post('arrestDate'),
	                'case_number' => $this->input->post('caseNumber'),
	                'police_custody' => $this->input->post('policeCustody'),
	                'crime_reason' => $this->input->post('crimeReason'),
	                'crime_supporter' => $this->input->post('crimeSupporter'),
	                'crime_province_id' => $this->input->post('crimeProvince'),
	                'crime_district_id' => $this->input->post('crimeDistrict'),
	                'crime_location' => $this->input->post('crimeLocation'),
	                'arrest_province_id' => $this->input->post('arrestProvince'),
	                'arrest_district_id' => $this->input->post('arrestDistrict'),
	                'arrest_location' => $this->input->post('arrestLocation'),
	                'time_spent_in_prison' => $this->input->post('timeSpentInPrison'),
	                'remaining_jail_term' => $this->input->post('remainingJailTerm'),
	                'use_benefit_forgiveness_presidential' => $this->input->post('useBenefitForgivenessPresidential'),
	                'command_issue_date_shamsi' => $this->input->post('commandIssueDate'),
	                'commission_proposal' => $this->input->post('commissionProposal'),
	                'prisoner_request' => $this->input->post('prisonerRequest'),
	                'commission_member' => $this->input->post('commissionMember')
	            );
			$affected_rows = $this->crime_model->update(array('id' => $crime_id), $crimeData);

	        $response['result'] = $crime_id;

	        $selectedCrimeTypes = $this->input->post('crimeType');
			$this->crime_crime_type_model->delete_by_crime_id($crime_id);

			if (!empty($selectedCrimeTypes)) {
				foreach ($selectedCrimeTypes as $key => $value) {
					$this->crime_crime_type_model->create(array('crime_type_id'=> $value, 'crime_id'=> $crime_id));
				}
			}

	        $courtSession = array();
	        for ($i=0; $i < 3; $i++) { 
	        	$courtSession[$i] = array(
	                'crime_id' => $crime_id,
	                'court_decision_type_id' => $this->input->post('courtDecisionType')[$i],
	                'decision_date_shamsi' => $this->input->post('decisionDate')[$i],
	                'decision' => $this->input->post('decision')[$i],
	                'defence_lawyer_name' => $this->input->post('defenceLawyerName')[$i],
	                'defence_lawyer_certificate_id' => $this->input->post('defenceLawyerCertificateId')[$i],
	                'sentence_execution_date_shamsi' => $this->input->post('sentenceExecutionDate')[$i]
	            );

	        	$courtSessionId = $this->input->post('courtSessionId')[$i];
	            if(!empty($courtSessionId)) {
	            	$this->court_session_model->update(array('id' => $courtSessionId), $courtSession[$i]);
	            }
	        }

	        $prisoner_id = $this->input->post('prisoner_id');
			$criminal_history = $this->input->post('criminalHistory');

	        $prisonerData = array(
	        		'tazkira_number' => $this->input->post('tazkiraNumber'),
	                'name' => $this->input->post('name'),
	                'father_name' => $this->input->post('fatherName'),
	                'grand_father_name' => $this->input->post('grandFatherName'),
	                'age' => $this->input->post('age'),
	                'marital_status_id' => $this->input->post('maritalStatus'),
	                'num_of_children' => $this->input->post('numOfChildren'),
	                'criminal_history' => isset($criminal_history)? 1: 0,
	                'permanent_province_id' => $this->input->post('permanentProvince'),
	                'permanent_district_id' => $this->input->post('permanentDistrict'),
	                'present_province_id' => $this->input->post('presentProvince'),
	                'present_district_id' => $this->input->post('presentDistrict')
	                // 'profile_pic' => $this->input->post('profilePic')
	            );
	        $affected_rows = $this->prisoner_model->update(array('id' => $prisoner_id), $prisonerData);
	        log_message('debug', 'prisoner update ID: ' . $prisoner_id);


	        // $this->db->insert('crime_prisoner', array(
        	// 										'crime_id' => $crime_id,
        	// 										'prisoner_id' => $prisoner_id));

			$extension = 'jpg';
			if($_FILES['profilePic'] && $_FILES['profilePic']['size'] > 0)
			{
				$image = $_FILES['profilePic'];
				log_message('debug', 'file name: ' . $image['name']);
				$path_info = pathinfo($image['name']);
				$extension = $path_info['extension'];

				$file_new_name = $prisoner_id . '.' . $extension;
				log_message('debug', 'new file name: ' . $file_new_name);

				if(!$this->upload_photo('profilePic', $file_new_name))
				{
					$response['success'] = FALSE;
					$response['message'] = $this->upload->display_errors();
					// rollback transaction
					$this->db->trans_rollback();
				}
				else
				{
					$dataUpdate = array(
			                'profile_pic' => $file_new_name
			            );
					$this->prisoner_model->update_by_id($prisoner_id, $dataUpdate);

					// commit transaction
					$this->db->trans_commit();
				}
			}
			else
			{
				// commit transaction
				$this->db->trans_commit();
			}
	        echo json_encode($response);
	    }
    }

    private function upload_photo($field, $file_new_name) {
    	// File upload config
		$config['upload_path'] = './photos/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']     = '4000';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$config['overwrite'] = TRUE;
		$config['file_name'] = $file_new_name;
		$this->load->library('upload', $config);

    	if(!$this->upload->do_upload($field))
		{
			log_message('debug', 'file upload: ' . var_export($this->upload->display_errors(), true));
			return FALSE;
		}
		
		log_message('debug', 'file upload: ' . var_export($this->upload->data(), true));
		return TRUE;
    }

    public function delete($crime_id)
	{
		$response['success'] = TRUE;
    	$response['message'] = '';
    	$response['result'] = '';

		if(!$this->my_authentication->isGroupMemberAllowed($this->session->userdata('isAdmin'), $this->session->userdata('group'), array('crime_delete', 'prisoner_delete', 'court_session_delete')))
		{
			log_message('DEBUG', 'crime edit false');
			$response['success'] = FALSE;
    		$response['message'] = 'You are unauthrized. Please contact system administrator.';
			echo json_encode($response);
		}
		else
		{
			// start of transaction
			$this->db->trans_begin();

			$prisoner_id = $this->crime_prisoner_model->get_prisoner_id_by_crime_id($crime_id);
			$this->crime_prisoner_model->delete_by_crime_id($crime_id);
			$this->court_session_model->delete_by_crime_id($crime_id);
			$this->crime_crime_type_model->delete_by_crime_id($crime_id);

			$this->crime_model->delete_by_id($crime_id);
			$this->prisoner_model->delete_by_id($prisoner_id);

			log_message('debug', 'deleted chain of crime_id: ' . $crime_id . ' prisoner_id: ' . $prisoner_id);

			if ($this->db->trans_status() === FALSE)
			{
				$response['success'] = FALSE;
				$response['message'] = 'Falied to delete the data.';
				$this->db->trans_rollback();
			}
			else
			{
				// commit transaction
				$this->db->trans_commit();
			}
			echo json_encode($response);
	    }
	}

	public function lock($id)
    {
    	$response['success'] = TRUE;
    	$response['message'] = '';
    	$response['result'] = '';

        $data = array(
                'locked' => 1
            );

        // start of transaction
		$this->db->trans_begin();

        $this->court_session_model->update(array('id' => $id), $data);
        $this->prisoner_model->update(array('id' => $id), $data);
        $this->crime_model->update(array('id' => $id), $data);

        if ($this->db->trans_status() === FALSE)
		{
			$response['success'] = FALSE;
			$response['message'] = 'Falied to lock the data.';
			$this->db->trans_rollback();
		}
		else
		{
			// commit transaction
			$this->db->trans_commit();
		}

        echo json_encode($response);
    }

    public function unlock($id)
    {
    	$response['success'] = TRUE;
    	$response['message'] = '';
    	$response['result'] = '';

        if(!$this->my_authentication->isGroupMemberAllowed($this->session->userdata('isAdmin'), $this->session->userdata('group'), array('crime_unlock', 'prisoner_unlock', 'court_session_unlock')))
		{
			log_message('DEBUG', 'crime edit false');
			$response['success'] = FALSE;
    		$response['message'] = 'You are unauthrized. Please contact system administrator.';
			echo json_encode($response);
		}
		else
		{
	        $data = array(
                'locked' => 0
            );

            // start of transaction
			$this->db->trans_begin();

            $this->court_session_model->update(array('id' => $id), $data);
        	$this->prisoner_model->update(array('id' => $id), $data);
	        $this->crime_model->update(array('id' => $id), $data);

	        if ($this->db->trans_status() === FALSE)
			{
				$response['success'] = FALSE;
				$response['message'] = 'Falied to unlock the data.';
				$this->db->trans_rollback();
			}
			else
			{
				// commit transaction
				$this->db->trans_commit();
			}
	        echo json_encode($response);
	    }
    }
}
