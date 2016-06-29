<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Hameedullah Pardess <hameedullah.pardess@gmail.com>
 *
 */

class Crime_Crime_Type_model extends CI_Model {

    // table name
    private $tableName= 'crime_crime_type';

    function __construct() {
        parent::__construct();
    }

    // add new record
    function create($record){
        $this->db->insert($this->tableName, $record);
        return $this->db->insert_id();
    }

    // delete person by id
    function delete_by_id($id){
        $this->db->where('id', $id);
        $this->db->delete($this->tableName);
    }

    // delete person by id
    function delete_by_crime_id($crime_id){
        $this->db->where('crime_id', $crime_id);
        $this->db->delete($this->tableName);
    }
}
