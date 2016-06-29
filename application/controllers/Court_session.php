<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Hameedullah Pardess <hameedullah.pardess@gmail.com>
 *
 */

class Court_Session extends CI_Controller {
	var $language = 'english';
	
	public function __construct()
	{
		parent::__construct();

		if( !$this->session->userdata('isLoggedIn') ) {
			redirect('/login');
		}
		$this->load->model('court_session_model');
		$this->load->model('court_decision_type_model');
		$this->load->library('my_authentication');

		$this->language = $this->session->userdata('language');
		log_message('debug', 'selected language: ' . $this->language);
		$this->lang->load($this->language, $this->language);
	}

	public function index()
	{
		// $data['provincesList'] = $this->province_model->get_all();
		// $data['districtsList'] = $this->district_model->get_all();
		$data['courtDecisionTypeList'] = $this->court_decision_type_model->get_all('id, decision_type_name_' . $this->language .' AS decision_type_name');
	    $this->load->view('court_session_list', $data);
	}

	public function court_session_list()
	{
		$this->load->model("datatables_model");
		$tableName = 'court_session_view';

		$aColumns = array(
			'id',
			'crime_id',
			'court_decision_type_' . $this->language,
			'decision_date',
			'decision_date_shamsi',
			'decision',
			'defence_lawyer_name',
			'defence_lawyer_certificate_id',
			'sentence_execution_date',
			'sentence_execution_date_shamsi',
			'locked');
 
        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

        $results = $this->datatables_model->get_data_list($tableName, $sIndexColumn, $aColumns);

        $filteredDataArray = [];
        $aColumnsCount = count($aColumns);
        foreach ($results['data'] as $dataRow) {
        	$isLocked = $dataRow[$aColumnsCount - 1];
        	$buttons = '';

        	// lock
        	if($isLocked == '1')
        	{
        		if($this->my_authentication->isGroupMemberAllowed($this->session->userdata('isAdmin'), $this->session->userdata('group'), 'court_session_unlock'))
				{
					$buttons = $buttons . '<a class="btn btn-xs btn-warning" title="Unlock" onclick="unlock_record('."'".$dataRow[0]."'".')"><i class="glyphicon glyphicon-flash"></i>|</a>';
				}
        	}
        	else
        	{
        		$buttons = $buttons . '<a class="btn btn-xs btn-warning" title="Lock" onclick="lock_record('."'".$dataRow[0]."'".')"><i class="glyphicon glyphicon-lock"></i>|</a>';
        	}

			// view
			if($this->my_authentication->isGroupMemberAllowed($this->session->userdata('isAdmin'), $this->session->userdata('group'), 'court_session_view'))
			{
				$buttons = $buttons . '<a class="btn btn-xs btn-primary" title="View" onclick="view_record('."'".$dataRow[0]."'".')"><i class="glyphicon glyphicon-list"></i>|</a>';
			}

			// edit
			if($this->my_authentication->isGroupMemberAllowed($this->session->userdata('isAdmin'), $this->session->userdata('group'), 'court_session_edit'))
			{
				$buttons = $buttons . '<a class="btn btn-xs btn-primary" title="Edit" onclick="edit_record('."'".$dataRow[0]."'".')"><i class="glyphicon glyphicon-pencil"></i>|</a>';
			}

			// delete
			if($this->my_authentication->isGroupMemberAllowed($this->session->userdata('isAdmin'), $this->session->userdata('group'), 'court_session_delete'))
			{
				$buttons = $buttons . '<a class="btn btn-xs btn-danger" title="Delete" onclick="delete_record('."'".$dataRow[0]."'".')"><i class="glyphicon glyphicon-trash"></i>|</a>';
			}

            $dataRow[$aColumnsCount - 1] = $buttons;
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
		$result = $this->court_session_model->get_by_id_with_joins($id, $this->language);
        echo json_encode($result);
	}

	public function edit($id)
	{
		$court_session = $this->court_session_model->get_by_id($id);

		$result = array();
		$result['courtSession'] = $court_session;
		// $result['courtDecisionTypes'] = $this->court_decision_type_model->get_all();
		
        echo json_encode($result);
	}

	public function delete($id)
	{
		$this->court_session_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
	}

	// add new record
	public function add()
    {
        $data = array(
                'crime_id' => $this->input->post('crimeId'),
                'court_decision_type_id' => $this->input->post('courtDecisionType'),
                'decision_date' => $this->input->post('decisionDate'),
                'decision' => $this->input->post('decision'),
                'defence_lawyer_name' => $this->input->post('defenceLawyerName'),
                'defence_lawyer_certificate_id' => $this->input->post('defenceLawyerCertificateId'),
                'sentence_execution_date' => $this->input->post('sentenceExecutionDate')
            );
        $insert = $this->court_session_model->create($data);
        // log_message('debug', 'insert: ' . $insert);
        echo json_encode(array("status" => TRUE));
    }
 
 	// update exisitn record
    public function update()
    {
    	$response['success'] = TRUE;
    	$response['message'] = '';
    	$response['result'] = '';
    	// try {
    		$data = array(
                'crime_id' => $this->input->post('crimeId'),
                'court_decision_type_id' => $this->input->post('courtDecisionType'),
                'decision_date' => $this->input->post('decisionDate'),
                'decision' => $this->input->post('decision'),
                'defence_lawyer_name' => $this->input->post('defenceLawyerName'),
                'defence_lawyer_certificate_id' => $this->input->post('defenceLawyerCertificateId'),
                'sentence_execution_date' => $this->input->post('sentenceExecutionDate')
            );
	        $affected_rows = $this->court_session_model->update(array('id' => $this->input->post('id')), $data);
	        // log_message('debug', 'affected rows: ' . $affected_rows);
	        echo json_encode($response);
    	// } catch (Exception $e) {
    	// 	$response = $e;
    	// 	echo json_encode($response);
    	// }
    }

        public function lock($id)
    {
    	$response['success'] = TRUE;
    	$response['message'] = '';
    	$response['result'] = '';

        $data = array(
                'locked' => 1
            );
        
        $affected_rows = $this->court_session_model->update(array('id' => $id), $data);
        // log_message('debug', 'affected rows: ' . $affected_rows);
        echo json_encode($response);
    }

    public function unlock($id)
    {
    	$response['success'] = TRUE;
    	$response['message'] = '';
    	$response['result'] = '';

        if(!$this->my_authentication->isGroupMemberAllowed($this->session->userdata('isAdmin'), $this->session->userdata('group'), 'court_session_unlock'))
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
	        $affected_rows = $this->court_session_model->update(array('id' => $id), $data);
	        // log_message('debug', 'affected rows: ' . $affected_rows);
	        echo json_encode($response);
	    }
    }
}
