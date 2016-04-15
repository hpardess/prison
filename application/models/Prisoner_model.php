<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Hameedullah Pardess <hameedullah.pardess@gmail.com>
 *
 */

class Prisoner_model extends CI_Model {

    // table name
    private $tableName= 'prisoner';

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

    // get record by id with joins
    function get_by_id_with_joins($id, $language){
        $this->db->select('`prisoner`.`id` AS `id`, `prisoner`.`tazkira_number` AS `tazkira_number`, `prisoner`.`marital_status_id` AS `marital_status_id`,`marital_status`.`status_' . $language . '` AS `marital_status`,`prisoner`.`present_province_id` AS `present_province_id`,`present_province`.`name_' . $language . '` AS `present_province`,`prisoner`.`present_district_id` AS `present_district_id`,`present_district`.`name_' . $language . '` AS `present_district`,`prisoner`.`permanent_province_id` AS `permanent_province_id`,`permanent_province`.`name_' . $language . '` AS `permanent_province`,`prisoner`.`permanent_district_id` AS `permanent_district_id`,`permanent_district`.`name_' . $language . '` AS `permanent_district`,`prisoner`.`name` AS `name`,`prisoner`.`father_name` AS `father_name`,`prisoner`.`grand_father_name` AS `grand_father_name`,`prisoner`.`age` AS `age`,`prisoner`.`criminal_history` AS `criminal_history`,`prisoner`.`num_of_children` AS `num_of_children`,`prisoner`.`profile_pic` AS `profile_pic`');
        $this->db->from($this->tableName);
        $this->db->join('marital_status AS marital_status', 'marital_status.id = ' . $this->tableName . '.marital_status_id', 'inner');
        $this->db->join('province AS present_province', 'present_province.id = ' . $this->tableName . '.present_province_id', 'inner');
        $this->db->join('district AS present_district', 'present_district.id = ' . $this->tableName . '.present_district_id', 'inner');
        $this->db->join('province AS permanent_province', 'permanent_province.id = ' . $this->tableName . '.permanent_province_id', 'inner');
        $this->db->join('district AS permanent_district', 'permanent_district.id = ' . $this->tableName . '.permanent_district_id', 'inner');
        $this->db->where($this->tableName . '.id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    // get record by id with joins
    function get_by_crime_id_with_joins($crime_id, $language){
        $this->db->select('`prisoner`.`id` AS `id`, `prisoner`.`tazkira_number` AS `tazkira_number`, `prisoner`.`marital_status_id` AS `marital_status_id`,`marital_status`.`status_' . $language . '` AS `marital_status`,`prisoner`.`present_province_id` AS `present_province_id`,`present_province`.`name_' . $language . '` AS `present_province`,`prisoner`.`present_district_id` AS `present_district_id`,`present_district`.`name_' . $language . '` AS `present_district`,`prisoner`.`permanent_province_id` AS `permanent_province_id`,`permanent_province`.`name_' . $language . '` AS `permanent_province`,`prisoner`.`permanent_district_id` AS `permanent_district_id`,`permanent_district`.`name_' . $language . '` AS `permanent_district`,`prisoner`.`name` AS `name`,`prisoner`.`father_name` AS `father_name`,`prisoner`.`grand_father_name` AS `grand_father_name`,`prisoner`.`age` AS `age`,`prisoner`.`criminal_history` AS `criminal_history`,`prisoner`.`num_of_children` AS `num_of_children`,`prisoner`.`profile_pic` AS `profile_pic`');
        $this->db->from($this->tableName);
        $this->db->join('marital_status AS marital_status', 'marital_status.id = ' . $this->tableName . '.marital_status_id', 'inner');
        $this->db->join('province AS present_province', 'present_province.id = ' . $this->tableName . '.present_province_id', 'inner');
        $this->db->join('district AS present_district', 'present_district.id = ' . $this->tableName . '.present_district_id', 'inner');
        $this->db->join('province AS permanent_province', 'permanent_province.id = ' . $this->tableName . '.permanent_province_id', 'inner');
        $this->db->join('district AS permanent_district', 'permanent_district.id = ' . $this->tableName . '.permanent_district_id', 'inner');
        
        $this->db->join('crime_prisoner AS crime_prisoner', 'crime_prisoner.prisoner_id = ' . $this->tableName . '.id', 'inner');
        $this->db->where('crime_prisoner.crime_id',$crime_id);
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