<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Hameedullah Pardess <hameedullah.pardess@gmail.com>
 *
 */

class Crime_Prisoner_model extends CI_Model {

    // table name
    private $tableName= 'crime_prisoner';

    function __construct() {
        parent::__construct();
    }

    // get record by id
    function get_by_crime_id($crime_id, $column_list = '*'){
        $this->db->select($column_list);
        $this->db->from($this->tableName);
        $this->db->where('crime_id',$crime_id);
        $query = $this->db->get();
        return $query->row();
    }

    // as each crime record will have only one prisoner record associated
    function get_prisoner_id_by_crime_id($id, $column_list = '*'){
        $this->db->select($column_list);
        $this->db->from($this->tableName);
        $this->db->where('crime_id',$id);
        $result = $this->db->get()->result();
        log_message('debug', 'Crime_Prisoner_model get_prisoner_id_by_crime_id query: ' . $this->db->last_query());
        if ( is_array($result) && count($result) > 0 ) {
            return $result[0]->prisoner_id;
        }
        return -1;
    }

    // add new record
    function create($record){
        $this->db->insert($this->tableName, $record);
        return $this->db->insert_id();
    }

    // update the record by id
    function update_by_crime_id($crime_id, $person){
        $this->db->where('crime_id', $crime_id);
        $this->db->update($this->tableName, $person);
    }

    // delete person by id
    function delete_by_prisoner_id($prisoner_id){
        $this->db->where('prisoner_id', $prisoner_id);
        $this->db->delete($this->tableName);
    }

    // delete person by id
    function delete_by_crime_id($crime_id){
        log_message('debug', 'Crime_Prisoner_model delete_by_crime_id crime_id: ' . $crime_id);
        $this->db->where('crime_id', $crime_id);
        $this->db->delete($this->tableName);
        log_message('debug', 'Crime_Prisoner_model delete_by_crime_id Total Affected rows: ' . $this->db->affected_rows());
    }


}
