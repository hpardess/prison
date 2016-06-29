<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Hameedullah Pardess <hameedullah.pardess@gmail.com>
 *
 */

class Datatables_Post_model extends CI_Model {
 
    /* $tableName */

    /* Indexed column (used for fast and accurate table cardinality) 
    * $sIndexColumn
    */

    /* Array of table columns which should be read and sent back to DataTables. Use a space where
     * you want to insert a non-database field (for example a counter or static image)
     * $aColumns
     */
    

    function __construct() {
        
    }
 
    function get_data_list($tableName='', $sIndexColumn = "id", $aColumns = array('id')) {
        /* Total data set length */
        $sQuery = "SELECT COUNT('" . $sIndexColumn . "') AS row_count
            FROM $tableName";
        // log_message('debug', 'datatables query: ' . $sQuery);
        $rResultTotal = $this->db->query($sQuery);
        $aResultTotal = $rResultTotal->row();
        $iTotal = $aResultTotal->row_count;
 
        /*
         * Paging
         */
        $sLimit = "";
        $iDisplayStart = $this->input->get_post('start', true);
        $iDisplayLength = $this->input->get_post('length', true);
        if (isset($iDisplayStart) && $iDisplayLength != '-1') {
            $sLimit = "LIMIT " . intval($iDisplayStart) . ", " .
                    intval($iDisplayLength);
        }
 
        // $uri_string = $_SERVER['QUERY_STRING'];
        // $uri_string = preg_replace("/\%5B/", '[', $uri_string);
        // $uri_string = preg_replace("/\%5D/", ']', $uri_string);
 
        // $get_param_array = explode("&", $uri_string);
        // $arr = array();
        // foreach ($get_param_array as $value) {
        //     $v = $value;
        //     $explode = explode("=", $v);
        //     $arr[$explode[0]] = $explode[1];
        // }
 
        // $index_of_columns = strpos($uri_string, "columns", 1);
        // $index_of_start = strpos($uri_string, "start");
        // $uri_columns = substr($uri_string, 7, ($index_of_start - $index_of_columns - 1));
        // $columns_array = explode("&", $uri_columns);
        // $arr_columns = array();
        // foreach ($columns_array as $value) {
        //     $v = $value;
        //     $explode = explode("=", $v);
        //     if (count($explode) == 2) {
        //         $arr_columns[$explode[0]] = $explode[1];
        //     } else {
        //         $arr_columns[$explode[0]] = '';
        //     }
        // }
 
        /*
         * Ordering
         */
        $sOrder = "ORDER BY ";
        // $sOrderIndex = $arr['order[0][column]'];
        $sOrderIndex = $this->input->get_post('order', true)[0]['column'];
        // $sOrderDir = $arr['order[0][dir]'];
        $sOrderDir = $this->input->get_post('order', true)[0]['dir'];
        // $bSortable_ = $arr_columns['columns[' . $sOrderIndex . '][orderable]'];
        $bSortable_ = $this->input->get_post('columns', true)[$sOrderIndex]['orderable'];
        if ($bSortable_ == "true") {
            $sOrder .= $aColumns[$sOrderIndex] .
                    ($sOrderDir === 'asc' ? ' asc' : ' desc');
        }
 
        /*
         * Filtering
         */
        $sWhere = "";
        // $sSearchVal = $arr['search[value]'];
        $sSearchVal = $this->input->get_post('search', true)['value'];
        if (isset($sSearchVal) && $sSearchVal != '') {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($sSearchVal) . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }
 
        /* Individual column filtering */
        // $sSearchReg = $arr['search[regex]'];
        $sSearchReg = $this->input->get_post('search', true)['regex'];
        for ($i = 0; $i < count($aColumns); $i++) {
            // $bSearchable_ = $arr['columns[' . $i . '][searchable]'];
            $bSearchable_ = $this->input->get_post('columns', true)[$i]['searchable'];
            if (isset($bSearchable_) && $bSearchable_ == "true" && $sSearchReg != 'false') {
                // $search_val = $arr['columns[' . $i . '][search][value]'];
                $search_val = $this->input->get_post('columns', true)[$i]['search']['value'];
                if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_like_str($search_val) . "%' ";
            }
        }
 
 
        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
        FROM $tableName
        $sWhere
        $sOrder
        $sLimit
        ";

        // log_message('debug', 'datatables query: ' . $sQuery);
        $rResult = $this->db->query($sQuery);
 
        /* Data set length after filtering */
        $sQuery = "SELECT FOUND_ROWS() AS length_count";
        // log_message('debug', 'here is the datatables query: ' . $sQuery);
        $rResultFilterTotal = $this->db->query($sQuery);
        $aResultFilterTotal = $rResultFilterTotal->row();
        $iFilteredTotal = $aResultFilterTotal->length_count;
 
        /*
         * Output
         */
        $sEcho = $this->input->get_post('draw', true);
        $output = array(
            "draw" => intval($sEcho),
            "recordsTotal" => $iTotal,
            "recordsFiltered" => $iFilteredTotal,
            "data" => array()
        );
 
        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            foreach ($aColumns as $col) {
                $row[] = $aRow[$col];
            }
            $output['data'][] = $row;
        }
 
        return $output;
    }
 
}
 
/* End of file Datatables_Post_model.php */
