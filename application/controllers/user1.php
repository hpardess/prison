<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User1 extends CI_Controller {

	// num of records per page
    private $limit = 10;
    
    function __construct() {
        parent::__construct();
        $this->load->model('user','userModel');
        // $this->load->library('validation');
    }

    // function User(){
    //     parent::Controller();  
    //     // load library
    //     $this->load->library(array('table','validation'));
    //     // load helper
    //     $this->load->helper('url');
    //     // load model
    //     $this->load->model('personModel','',TRUE);
    // }
     
    function index($offset = 0){
        // offset
        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);
         
        // load data
        $users = $this->userModel->get_paged_list($this->limit, $offset)->result();
         
        // generate pagination
        // $this->load->library('pagination');
        $config['base_url'] = site_url('person/index/');
        $config['total_rows'] = $this->userModel->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
         
        // generate table data
        // $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('Id', 'First Name', 'Last Name', 'Username', 'isAdmin', 'Email', 'Actions');
        $i = 0 + $offset;
        foreach ($users as $user){
        	// print_r($user);
            $this->table->add_row(++$i, $user->firstname, $user->lastname, $user->username, $user->isadmin, $user->email, 
                anchor('user1/view/'.$user->id,'view',array('class'=>'view')).' '.
                anchor('user1/update/'.$user->id,'update',array('class'=>'update')).' '.
                anchor('user1/delete/'.$user->id,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this user?')"))
            );
        }
        $data['table'] = $this->table->generate();
        // print_r($data);
        // load view
        $this->load->view('user1/userList', $data);
    }
     
    function add(){
        // set validation properties
        $this->_set_fields();
         
        // set common properties
        $data['title'] = 'Add new person';
        $data['message'] = '';
        $data['action'] = site_url('user1/addUser');
        $data['link_back'] = anchor('user1/index/','Back to list of persons',array('class'=>'back'));
     
        // load view
        $this->load->view('user1/userEdit', $data);
    }
     
    function addPerson(){
        // set common properties
        $data['title'] = 'Add new person';
        $data['action'] = site_url('user1/addUser');
        $data['link_back'] = anchor('user1/index/','Back to list of persons',array('class'=>'back'));
         
        // set validation properties
        $this->_set_fields();
        $this->_set_rules();
         
        // run validation
        if ($this->validation->run() == FALSE){
            $data['message'] = '';
        }else{
            // save data
            $person = array('name' => $this->input->post('name'),
                            'gender' => $this->input->post('gender'),
                            'dob' => date('Y-m-d', strtotime($this->input->post('dob'))));
            $id = $this->userModel->save($person);
             
            // set form input name="id"
            $this->validation->id = $id;
             
            // set user message
            $data['message'] = '<div class="success">add new person success</div>';
        }
         
        // load view
        $this->load->view('user1/userEdit', $data);
    }
     
    function view($id){
        // set common properties
        $data['title'] = 'User Details';
        $data['link_back'] = anchor('user1/index/','Back to list of persons',array('class'=>'back'));
         
        // get person details
        $data['person'] = $this->userModel->get_by_id($id)->row();
         
        // load view
        $this->load->view('user1/userView', $data);
    }
     
    function update($id){
        // set validation properties
        $this->_set_fields();
         
        // prefill form values
        $person = $this->userModel->get_by_id($id)->row();
        $this->validation->id = $id;
        $this->validation->name = $person->name;
        $_POST['gender'] = strtoupper($person->gender);
        $this->validation->dob = date('d-m-Y',strtotime($person->dob));
         
        // set common properties
        $data['title'] = 'Update person';
        $data['message'] = '';
        $data['action'] = site_url('user1/updatePerson');
        $data['link_back'] = anchor('user1/index/','Back to list of persons',array('class'=>'back'));
     
        // load view
        $this->load->view('user1/userEdit', $data);
    }
     
    function updatePerson(){
        // set common properties
        $data['title'] = 'Update person';
        $data['action'] = site_url('user1/updateUser');
        $data['link_back'] = anchor('user1/index/','Back to list of persons',array('class'=>'back'));
         
        // set validation properties
        $this->_set_fields();
        $this->_set_rules();
         
        // run validation
        if ($this->validation->run() == FALSE){
            $data['message'] = '';
        }else{
            // save data
            $id = $this->input->post('id');
            $person = array('name' => $this->input->post('name'),
                            'gender' => $this->input->post('gender'),
                            'dob' => date('Y-m-d', strtotime($this->input->post('dob'))));
            $this->userModel->update($id,$person);
             
            // set user message
            $data['message'] = '<div class="success">update person success</div>';
        }
         
        // load view
        $this->load->view('user1/userEdit', $data);
    }
     
    function delete($id){
        // delete person
        $this->userModel->delete($id);
         
        // redirect to person list page
        redirect('user1/index/','refresh');
    }
     
    // validation fields
    function _set_fields(){
        $fields['id'] = 'id';
        $fields['firstname'] = 'firstname';
        $fields['lastname'] = 'lastname';
        $fields['username'] = 'username';
        $fields['email'] = 'email';
        $fields['isadmin'] = 'isadmin';

        $this->validation->set_fields($fields);
    }
     
    // validation rules
    function _set_rules(){
    	$fields['id'] = 'trim|required';
        $fields['firstname'] = 'trim|required';
        $fields['lastname'] = 'trim|required';
        $fields['username'] = 'trim|required';
        $fields['email'] = 'email';
        $fields['isadmin'] = 'isadm';
         
        $this->validation->set_rules($rules);
         
        $this->validation->set_message('required', '* required');
        $this->validation->set_message('isset', '* required');
        $this->validation->set_error_delimiters('<p class="error">', '</p>');
    }
     
    // date_validation callback
    // function valid_date($str)
    // {
    //     if(!ereg("^(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-([0-9]{4})$", $str))
    //     {
    //         $this->validation->set_message('valid_date', 'date format is not valid. dd-mm-yyyy');
    //         return false;
    //     }
    //     else
    //     {
    //         return true;
    //     }
    // }
}
