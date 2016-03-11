<?php defined('BASEPATH') OR exit('No direct script access allowed');
   
class User extends CI_Model {

    // table name
    private $tableName= 'user';
    var $details;

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // get number of records in database
    function count_all(){
        return $this->db->count_all($this->tableName);
    }

    // get records with paging
    function get_paged_list($limit = 10, $offset = 0){
        $this->db->order_by('id','asc');
        return $this->db->get($this->tableName, $limit, $offset);
    }

    // get record by id
    function get_by_id($id){
        $this->db->where('id', $id);
        return $this->db->get($this->tableName);
    }

    // add new record
    function save($record){
        $this->db->insert($this->tableName, $record);
        return $this->db->insert_id();
    }

    // update the record by id
    function update($id, $person){
        $this->db->where('id', $id);
        $this->db->update($this->tableName, $person);
    }

    // delete person by id
    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete($this->tableName);
    }

    function validate_user( $username, $password ) {
        // Build a query to retrieve the user's details
        // based on the received username and password
        log_message('debug', 'username: '. $username .' password: '. $password);

        $this->db->from($this->tableName);
        $this->db->where('username',$username );
        $this->db->where( 'password', md5($password) );
        $login = $this->db->get()->result();
        // The results of the query are stored in $login.
        // If a value exists, then the user account exists and is validated
        if ( is_array($login) && count($login) == 1 ) {
            // Set the users details into the $details property of this class
            $this->details = $login[0];
            // log_message('debug', print_r($login[0]));
            // Call set_session to set the user's session vars via CodeIgniter
            $this->set_session();
            return true;
        }
        return false;
    }

    function set_session() {
        // session->set_userdata is a CodeIgniter function that
        // stores data in CodeIgniter's session storage.  Some of the values are built in
        // to CodeIgniter, others are added.  See CodeIgniter's documentation for details.
        $this->session->set_userdata( array(
                'id'=>$this->details->id,
                'name'=> $this->details->firstname . ' ' . $this->details->lastname,
                'username'=>$this->details->username,
                'email'=>$this->details->email,
                'isAdmin'=>$this->details->isadmin,
                'isLoggedIn'=>true
            )
        );
    }
    function  create_new_user( $userData ) {
      $data['firstname'] = $userData['firstname'];
      $data['lastname'] = $userData['lastname'];
      $data['username'] = $userData['username'];
      $data['isadmin'] = (int) $userData['isadmin'];
      $data['email'] = $userData['email'];
      $data['password'] = md5($userData['password']);
      return $this->db->insert('user',$data);
    }
}