<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Hameedullah Pardess <hameedullah.pardess@gmail.com>
 *
 */

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if( !$this->session->userdata('isLoggedIn') ) {
			redirect('/login');
		}
		$this->load->model('user_model');

        $idiom = $this->session->userdata('language');
        log_message('debug', 'selected language: ' . $idiom);
        $this->lang->load($idiom, $idiom);
	}

	public function index()
	{
		$is_admin = $this->session->userdata('isAdmin');

	    $this->load->view('user_list');
	}

	public function user_list()
	{
		$this->load->model("datatables_model");
		$tableName = 'user_view';
		$aColumns = array(
            'id',
            'firstname',
            'lastname',
            'username',
            'email',
            'isadmin',
            'group_name');
 
        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

        $results = $this->datatables_model->get_data_list($tableName, $sIndexColumn, $aColumns);

        $filteredDataArray = [];
        foreach ($results['data'] as $dataRow) {
            $dataRow[] = '<a class="btn btn-xs btn-primary" title="Change Password" onclick="view_record_password('."'".$dataRow[0]."'".')"><i class="glyphicon glyphicon-pushpin"></i>|</a>
                        <a class="btn btn-xs btn-primary" title="View" onclick="view_record('."'".$dataRow[0]."'".')"><i class="glyphicon glyphicon-list"></i>|</a>
                    <a class="btn btn-xs btn-primary" title="Edit" onclick="edit_record('."'".$dataRow[0]."'".')"><i class="glyphicon glyphicon-pencil"></i>|</a>
                  <a class="btn btn-xs btn-danger" title="Delete" onclick="delete_record('."'".$dataRow[0]."'".')"><i class="glyphicon glyphicon-trash"></i>|</a>';

            $filteredDataArray[] = $dataRow;
        }

        $results['data'] = $filteredDataArray;
	    echo json_encode($results);
	}

	public function new_user()
	{
		$this->load->model('group_model');
		$groupList = $this->group_model->get_all('id, group_name');
        echo json_encode($groupList);
	}

	public function view($id)
	{
		$this->load->model('group_model');
		$userData = $this->user_model->get_by_id($id);
		$groupData = $this->group_model->get_by_id($userData->groups_id, 'id, group_name');
		$result = array();
		$result['user'] = $userData;
		$result['group'] = $groupData;
        echo json_encode($result);
	}

	public function edit($id)
	{
		$this->load->model('group_model');
		$userData = $this->user_model->get_by_id($id);
		$groupList = $this->group_model->get_all('id, group_name');
		$result = array();
		$result['user'] = $userData;
		$result['groups'] = $groupList;
        echo json_encode($result);
	}

	public function delete($id)
	{
		$this->user_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
	}

	// add new record
	public function add()
    {
    	$isAdmin = $this->input->post('isAdmin');
        $data = array(
                'firstname' => $this->input->post('firstName'),
                'lastname' => $this->input->post('lastName'),
                'username' => $this->input->post('username'),
                'isadmin' => isset($isAdmin)? 1: 0,
                'email' => $this->input->post('email'),
                'groups_id' => $this->input->post('group')
            );
        $insert = $this->user_model->create($data);
        // log_message('debug', 'insert: ' . $insert);
        echo json_encode(array("status" => TRUE));
    }
 
 	// update exisitn record
    public function update()
    {
    	$isAdmin = $this->input->post('isAdmin');
        $data = array(
                'firstname' => $this->input->post('firstName'),
                'lastname' => $this->input->post('lastName'),
                'username' => $this->input->post('username'),
                'isadmin' => isset($isAdmin)? 1: 0,
                'email' => $this->input->post('email'),
                'groups_id' => $this->input->post('group')
            );
        $affected_rows = $this->user_model->update(array('id' => $this->input->post('id')), $data);
        // log_message('debug', 'affected rows: ' . $affected_rows);
        echo json_encode(array("status" => TRUE));
    }

    // this function is called form menu bar 
    public function change_password()
    {
        $response['success'] = TRUE;
        $response['message'] = '';
        $response['result'] = '';

        $username = $this->session->userdata('username');
        $currentPass = $this->input->post("curPsw");
        $newPass = $this->input->post("newPsw");
        $confirmNewPass = $this->input->post("confNewPsw");

        if ($newPass == $confirmNewPass && $this->user_model->check_user($username, $currentPass))
        {
            log_message('debug', 'user change_password username: ' . $username);
            $data = array(
                    'password' => md5($newPass)
                );
            $affected_rows = $this->user_model->update(array('id' => $this->session->userdata('id')), $data);
            echo json_encode($response);
        }
        else
        {
            $response['success'] = FALSE;
            $response['message'] = 'Authentication failed. Try again';
            echo json_encode($response);
        }
    }

    // this function is called from user list table
    public function change_user_password()
    {
        $response['success'] = TRUE;
        $response['message'] = '';
        $response['result'] = '';

        log_message('debug', 'user change_user_password isAdmin: ' . $this->session->userdata('isAdmin'));
        if($this->session->userdata('isAdmin') == '1' || $this->session->userdata('isAdmin') == 1)
        {
            $id = $this->input->post('id');
            $newPass = $this->input->post("newPsw");
            $confirmNewPass = $this->input->post("confNewPsw");

            log_message('debug', 'user change_user_password userId: ' . $id);
            log_message('debug', 'user change_user_password newPass: ' . $newPass);
            log_message('debug', 'user change_user_password confirmNewPass: ' . $confirmNewPass);
            if ($newPass == $confirmNewPass)
            {
                $data = array(
                        'password' => md5($newPass)
                    );
                $affected_rows = $this->user_model->update(array('id' => $id), $data);
                echo json_encode($response);
            }
            else
            {
                $response['success'] = FALSE;
                $response['message'] = 'New Password and Confirm Password are not same.';
                echo json_encode($response);
            }
        }
        else
        {
            log_message('DEBUG', 'crime edit false');
            $response['success'] = FALSE;
            $response['message'] = 'You are unauthrized. Please contact system administrator.';
            echo json_encode($response);
        }
    }

    function switch_language($language="english")
    {
        $direction = 'ltr';
        if($language == 'pashto' || $language == 'dari')
        {
            $direction = 'rtl';
        }
        $this->session->set_userdata('language', $language);
        $this->session->set_userdata('direction', $direction);
        // redirect($_SERVER['HTTP_REFERER']);
        echo json_encode(array("success" => TRUE));
    }
}
