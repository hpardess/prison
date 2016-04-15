<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Hameedullah Pardess <hameedullah.pardess@gmail.com>
 *
 */

class Group extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if( !$this->session->userdata('isLoggedIn') ) {
			redirect('/login');
		}
		$this->load->model('group_model');

		$idiom = $this->session->userdata('language');
		log_message('debug', 'selected language: ' . $idiom);
		$this->lang->load($idiom, $idiom);
	}

	public function index()
	{
		$is_admin = $this->session->userdata('isAdmin');

	    $this->load->view('group_list');
	}

	public function group_list()
	{
		$this->load->model("datatables_model");
		$tableName = 'groups';
		$aColumns = array(
			'id',
			'group_name',
			'prisoner_new',
			'prisoner_view',
			'prisoner_edit',
			'prisoner_delete',
			'prisoner_unlock',
			'crime_new',
			'crime_view',
			'crime_edit',
			'crime_delete',
			'crime_unlock',
			'court_session_new',
			'court_session_view',
			'court_session_edit',
			'court_session_delete',
			'court_session_unlock');
 
        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

        $results = $this->datatables_model->get_data_list($tableName, $sIndexColumn, $aColumns);

        $filteredDataArray = [];
        foreach ($results['data'] as $dataRow) {
            $dataRow[] = '<a class="btn btn-xs btn-primary" title="View" onclick="view_record('."'".$dataRow[0]."'".')"><i class="glyphicon glyphicon-list"></i>|</a>
                    <a class="btn btn-xs btn-primary" title="Edit" onclick="edit_record('."'".$dataRow[0]."'".')"><i class="glyphicon glyphicon-pencil"></i>|</a>
                  <a class="btn btn-xs btn-danger" title="Delete" onclick="delete_record('."'".$dataRow[0]."'".')"><i class="glyphicon glyphicon-trash"></i>|</a>';

            $filteredDataArray[] = $dataRow;
        }

        $results['data'] = $filteredDataArray;
	    echo json_encode($results);
	}

	public function new_group()
	{
		$groupList = $this->group_model->get_all('id, group_name');
        echo json_encode($groupList);
	}

	public function view($id)
	{
		$result = $this->group_model->get_by_id($id);
        echo json_encode($result);
	}

	public function edit($id)
	{
		$result = $this->group_model->get_by_id($id);
        echo json_encode($result);
	}

	public function delete($id)
	{
		$this->group_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
	}

	// add new record
	public function add()
    {
		$prisoner_new = $this->input->post('prisoner_new');
		$prisoner_view = $this->input->post('prisoner_view');
		$prisoner_edit = $this->input->post('prisoner_edit');
		$prisoner_delete = $this->input->post('prisoner_delete');
		$prisoner_unlock = $this->input->post('prisoner_unlock');

		$crime_new = $this->input->post('crime_new');
		$crime_view = $this->input->post('crime_view');
		$crime_edit = $this->input->post('crime_edit');
		$crime_delete = $this->input->post('crime_delete');
		$crime_unlock = $this->input->post('crime_unlock');

		$court_session_new = $this->input->post('court_session_new');
		$court_session_view = $this->input->post('court_session_view');
		$court_session_edit = $this->input->post('court_session_edit');
		$court_session_delete = $this->input->post('court_session_delete');
		$court_session_unlock = $this->input->post('court_session_unlock');

        $data = array(
                'group_name' => $this->input->post('groupName'),
                'prisoner_new' => isset($prisoner_new)? 1: 0,
                'prisoner_view' => isset($prisoner_view)? 1: 0,
                'prisoner_edit' => isset($prisoner_edit)? 1: 0,
                'prisoner_delete' => isset($prisoner_delete)? 1: 0,
                'prisoner_unlock' => isset($prisoner_unlock)? 1: 0,

                'crime_new' => isset($crime_new)? 1: 0,
                'crime_view' => isset($crime_view)? 1: 0,
                'crime_edit' => isset($crime_edit)? 1: 0,
                'crime_delete' => isset($crime_delete)? 1: 0,
                'crime_unlock' => isset($crime_unlock)? 1: 0,

                'court_session_new' => isset($court_session_new)? 1: 0,
                'court_session_view' => isset($court_session_view)? 1: 0,
                'court_session_edit' => isset($court_session_edit)? 1: 0,
                'court_session_delete' => isset($court_session_delete)? 1: 0,
                'court_session_unlock' => isset($court_session_unlock)? 1: 0
            );
        $insert = $this->group_model->create($data);
        // log_message('debug', 'insert: ' . $insert);
        echo json_encode(array("status" => TRUE));
    }
 
 	// update exisitn record
    public function update()
    {
    	$prisoner_new = $this->input->post('prisoner_new');
		$prisoner_view = $this->input->post('prisoner_view');
		$prisoner_edit = $this->input->post('prisoner_edit');
		$prisoner_delete = $this->input->post('prisoner_delete');
		$prisoner_unlock = $this->input->post('prisoner_unlock');

		$crime_new = $this->input->post('crime_new');
		$crime_view = $this->input->post('crime_view');
		$crime_edit = $this->input->post('crime_edit');
		$crime_delete = $this->input->post('crime_delete');
		$crime_unlock = $this->input->post('crime_unlock');

		$court_session_new = $this->input->post('court_session_new');
		$court_session_view = $this->input->post('court_session_view');
		$court_session_edit = $this->input->post('court_session_edit');
		$court_session_delete = $this->input->post('court_session_delete');
		$court_session_unlock = $this->input->post('court_session_unlock');

        $data = array(
                'group_name' => $this->input->post('groupName'),
                'prisoner_new' => isset($prisoner_new)? 1: 0,
                'prisoner_view' => isset($prisoner_view)? 1: 0,
                'prisoner_edit' => isset($prisoner_edit)? 1: 0,
                'prisoner_delete' => isset($prisoner_delete)? 1: 0,
                'prisoner_unlock' => isset($prisoner_unlock)? 1: 0,

                'crime_new' => isset($crime_new)? 1: 0,
                'crime_view' => isset($crime_view)? 1: 0,
                'crime_edit' => isset($crime_edit)? 1: 0,
                'crime_delete' => isset($crime_delete)? 1: 0,
                'crime_unlock' => isset($crime_unlock)? 1: 0,

                'court_session_new' => isset($court_session_new)? 1: 0,
                'court_session_view' => isset($court_session_view)? 1: 0,
                'court_session_edit' => isset($court_session_edit)? 1: 0,
                'court_session_delete' => isset($court_session_delete)? 1: 0,
                'court_session_unlock' => isset($court_session_unlock)? 1: 0
            );
        $affected_rows = $this->group_model->update(array('id' => $this->input->post('id')), $data);
        // log_message('debug', 'affected rows: ' . $affected_rows);
        echo json_encode(array("status" => TRUE));
    }
}
