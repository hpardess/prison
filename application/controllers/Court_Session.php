<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Court_Session extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();

		if( !$this->session->userdata('isLoggedIn') ) {
			redirect('/login');
		}
		$this->load->model('court_session_model');
		$this->load->model('court_decision_type_model');

		$idiom = $this->session->userdata('language');
		log_message('debug', 'selected language: ' . $idiom);
		$this->lang->load($idiom, $idiom);
	}

	public function index()
	{
		// $data['provincesList'] = $this->province_model->get_all();
		// $data['districtsList'] = $this->district_model->get_all();
		$data['courtDecisionTypeList'] = $this->court_decision_type_model->get_all();
	    $this->load->view('court_session_list', $data);
	}

	public function court_session_list()
	{
		$this->load->model("datatables_model");
		$tableName = 'court_session_view';

		$aColumns = array(
			'id',
			'crime_id',
			'court_decision_type',
			'decision_date',
			'decision',
			'defence_lawyer_name',
			'defence_lawyer_certificate_id',
			'sentence_execution_date');
 
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
		$result = $this->court_session_model->get_by_id_with_joins($id);
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
        echo json_encode(array("status" => TRUE));
    }
}
