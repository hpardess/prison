<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Hameedullah Pardess <hameedullah.pardess@gmail.com>
 *
 */

class User_model extends CI_Model {

    // table name
    private $tableName= 'user';
    var $details;

    function __construct() {
        parent::__construct();
    }

    // get number of records in database
    function count_all(){
        return $this->db->count_all($this->tableName);
    }

    // get record by id
    function get_by_id($id){
        $this->db->select('id, firstname, lastname, username, email, isadmin, groups_id');
        $this->db->from($this->tableName);
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    // get record by id
    function get_by_id_with_joins($id){
        $this->db->select('`user`.`id` AS `id`,`user`.`firstname` AS `firstname`,`user`.`lastname` AS `lastname`,`user`.`username` AS `username`,`user`.`password` AS `password`,`user`.`email` AS `email`,`user`.`isadmin` AS `isadmin`,`user`.`groups_id` AS `groups_id`,`groups`.`group_name` AS `group`');
        $this->db->from($this->tableName);
        $this->db->join('groups', 'groups.id = user.groups_id', 'inner');
        $this->db->where($this->tableName . '.id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    // get all records
    function get_all($column_list = '*'){
        $this->db->select($column_list);
        $this->db->from($this->tableName);
        $query = $this->db->get();
        return $query->result();
    }

    // add new record
    function create($record){
        $this->db->insert($this->tableName, $record);
        return $this->db->insert_id();
    }

    // update the record by id
    function update_by_id($id, $record){
        $this->db->where('id', $id);
        $this->db->update($this->tableName, $record);
    }

    public function update($where, $data)
    {
        $this->db->update($this->tableName, $data, $where);
        return $this->db->affected_rows();
    }

    // delete record by id
    function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->tableName);
    }

    public function check_user($username, $password)
    {
        log_message('debug', 'username: '. $username .' newPassword: '. $password);

        $this->db->from($this->tableName);
        $this->db->where('username',$username );
        $this->db->where( 'password', md5($password) );
        $result = $this->db->get()->result();
        if ( is_array($result) && count($result) == 1 ) {
            $this->details = $result[0];
            log_message('debug', 'User_model check_user passed');
            return true;
        }
        return false;
    }

// ---------------------------------------------------------

    // get records with paging
    function get_paged_list($limit = 10, $offset = 0){
        $this->db->order_by('id','asc');
        return $this->db->get($this->tableName, $limit, $offset);
    }



    // function validate_user( $username, $password ) {
    //     // Build a query to retrieve the user's details
    //     // based on the received username and password
    //     log_message('debug', 'username: '. $username .' password: '. $password);

    //     $this->db->from($this->tableName);
    //     $this->db->where('username',$username );
    //     $this->db->where( 'password', md5($password) );
    //     $login = $this->db->get()->result();
    //     // The results of the query are stored in $login.
    //     // If a value exists, then the user account exists and is validated
    //     if ( is_array($login) && count($login) == 1 ) {
    //         // Set the users details into the $details property of this class
    //         $this->details = $login[0];
    //         // log_message('debug', print_r($login[0]));
    //         // Call set_session to set the user's session vars via CodeIgniter
    //         $this->set_session();
    //         return true;
    //     }
    //     return false;
    // }

    // function set_session() {
    //     // session->set_userdata is a CodeIgniter function that
    //     // stores data in CodeIgniter's session storage.  Some of the values are built in
    //     // to CodeIgniter, others are added.  See CodeIgniter's documentation for details.
    //     $this->session->set_userdata( array(
    //             'id'=>$this->details->id,
    //             'name'=> $this->details->firstname . ' ' . $this->details->lastname,
    //             'username'=>$this->details->username,
    //             'email'=>$this->details->email,
    //             'isAdmin'=>$this->details->isadmin,
    //             'isLoggedIn'=>true,
    //             'language'=>'english',
    //             'direction'=>'ltr'
    //         )
    //     );
    // }

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