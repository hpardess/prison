<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Hameedullah Pardess <hameedullah.pardess@gmail.com>
 *
 */

class Group_model extends CI_Model {

    // table name
    private $tableName= 'groups';

    function __construct() {
        parent::__construct();
    }

    // get number of records in database
    function count_all(){
        return $this->db->count_all($this->tableName);
    }

    // get record by id
    function get_by_id($id, $column_list = '*'){
        $this->db->select($column_list);
        $this->db->from($this->tableName);
        $this->db->where('id',$id);
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
    function delete_by_id($id){
        $this->db->where('id', $id);
        $this->db->delete($this->tableName);
    }
}