<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Prisoner extends CI_Controller {
	
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

		$idiom = $this->session->userdata('language');
		log_message('debug', 'selected language: ' . $idiom);
		$this->lang->load($idiom, $idiom);
	}

	public function index()
	{
		$data['provincesList'] = $this->province_model->get_all();
		$data['districtsList'] = $this->district_model->get_all();
		$data['maritalStatusList'] = $this->marital_status_model->get_all();
	    $this->load->view('prisoner_list', $data);
	}

	public function prisoner_list()
	{
		$this->load->model("datatables_model");
		$tableName = 'prisoner_view';

		$aColumns = array(
			'id',
			'name',
			'father_name',
			'grand_father_name',
			'age',
			'marital_status',
			'num_of_children',
			'criminal_history',
			'permanent_province',
			'permanent_district',
			'present_province',
			'present_district',
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

	// public function new_prisoner()
	// {
	// 	$this->load->model('province_model');
	// 	$provinceList = $this->province_model->get_all();
 //        echo json_encode($provinceList);
	// }

	public function view($id)
	{
		$result = $this->prisoner_model->get_by_id_with_joins($id);
        echo json_encode($result);
	}

	public function edit($id)
	{
		$prisoner = $this->prisoner_model->get_by_id($id);

		$result = array();
		$result['prisoner'] = $prisoner;
		$result['permanentDistricts'] = $this->district_model->get_by_province_id($prisoner->permanent_province_id);
		$result['presentDistricts'] = $this->district_model->get_by_province_id($prisoner->present_province_id);

        echo json_encode($result);
	}

	public function delete($id)
	{
		$this->prisoner_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
	}

	// add new record
	public function add()
    {
		// $attachment_file=$_FILES["attachment_file"];
		// $output_dir = "upload/";
		// $fileName = $_FILES["attachment_file"]["name"];
		// move_uploaded_file($_FILES["attachment_file"]["tmp_name"],$output_dir.$fileName);
		// echo "File uploaded successfully";

    	$response['success'] = TRUE;
    	$response['message'] = '';
    	$response['result'] = '';

		// start of transaction
		$this->db->trans_begin();

		$criminal_history = $this->input->post('criminalHistory');

        $data = array(
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
        $record_id = $this->prisoner_model->create($data);
        log_message('debug', 'insert ID: ' . $record_id);

		if ($this->db->trans_status() === FALSE)
		{
			$response['success'] = FALSE;
			$response['message'] = 'Falied to save the data.';
			$this->db->trans_rollback();
		}
		else
		{
			$extension = 'jpg';
			if($_FILES['profilePic'] && $_FILES['profilePic']['size'] > 0)
			{
				$image = $_FILES['profilePic'];
				log_message('debug', 'file name: ' . $image['name']);
				$path_info = pathinfo($image['name']);
				$extension = $path_info['extension'];

				$file_new_name = $record_id . '.' . $extension;
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
					$this->prisoner_model->update_by_id($record_id, $dataUpdate);

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
        echo json_encode($response);
    }
 
 	// update exisitn record
    public function update()
    {
    	$response['success'] = TRUE;
    	$response['message'] = '';
    	$response['result'] = '';

    	// start of transaction
		$this->db->trans_begin();

    	$criminal_history = $this->input->post('criminalHistory');

        $data = array(
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
        $affected_rows = $this->prisoner_model->update(array('id' => $this->input->post('id')), $data);
        // log_message('debug', 'affected rows: ' . $affected_rows);

        $record_id = $this->input->post('id');

        if ($this->db->trans_status() === FALSE)
		{
			$response['success'] = FALSE;
			$response['message'] = 'Falied to save the data.';
			$this->db->trans_rollback();
		}
		else
		{
			$extension = 'jpg';
			if($_FILES['profilePic'] && $_FILES['profilePic']['size'] > 0)
			{
				$image = $_FILES['profilePic'];
				log_message('debug', 'file name: ' . $image['name']);
				$path_info = pathinfo($image['name']);
				$extension = $path_info['extension'];

				$file_new_name = $record_id . '.' . $extension;
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
					$this->prisoner_model->update_by_id($record_id, $dataUpdate);

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
        echo json_encode($response);
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
}
