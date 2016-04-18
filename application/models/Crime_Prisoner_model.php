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
        $this->db->where('crime_id', $crime_id);
        $this->db->delete($this->tableName);
    }


}