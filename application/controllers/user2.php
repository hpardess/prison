<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class User2 extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_ajax','userModel');
    }
 
    public function index()
    {
        // $this->load->helper('url');
        $this->load->view('user_ajax/userView');
    }
 
    public function ajax_list()
    {
        $list = $this->userModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $no++;
            $row = array();
            $row[] = $user->firstname;
            $row[] = $user->lastname;
            $row[] = $user->username;
            $row[] = $user->isadmin;
            $row[] = $user->email;
 
            //add html for action
            $row[] = '<a class="btn btn-xs btn-primary" title="Edit" onclick="view_user('."'".$user->id."'".')"><i class="glyphicon glyphicon-list"></i> View</a>
                    <a class="btn btn-xs btn-primary" title="Edit" onclick="edit_user('."'".$user->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-xs btn-danger" href="javascript:void();" title="Hapus" onclick="delete_user('."'".$user->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->userModel->count_all(),
                        "recordsFiltered" => $this->userModel->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id)
    {
        $data = $this->userModel->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $data = array(
                'firstname' => $this->input->post('firstName'),
                'lastname' => $this->input->post('lastName'),
                'username' => $this->input->post('username'),
                'isadmin' => $this->input->post('isAdmin'),
                'email' => $this->input->post('email'),
            );
        $insert = $this->person->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        $data = array(
                'firstname' => $this->input->post('firstName'),
                'lastname' => $this->input->post('lastName'),
                'username' => $this->input->post('username'),
                'isadmin' => $this->input->post('isAdmin'),
                'email' => $this->input->post('email'),
            );
        $this->person->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id)
    {
        $this->person->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
}
