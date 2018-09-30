<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
    class Faculty_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        /**
         * Updates the faculty table
         */
        public function add_faculty($name){
            return $this->db->insert('faculty',array('name'=>$name));
        }

        /**
         * Gets all the faculties
         */
        public function get_faculties(){
            $result = $this->db->get('faculty');
            return $result->result_array();
        }
    }