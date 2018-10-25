<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
    class Faculty_model extends CI_Model{

       /**
        * Adds faculties
        */
        public function add_faculty($code,$name){
            $data = array(
                'faculty_code' => $code,
                'name' => $name
            );
            return $this->db->insert('faculty',$data);
        }

        /**
        * Edit faculty details
        */
        public function edit_faculty($code,$name){
            $data = array(
                'name' => $name
            );
            $this->db->where('faculty_code',$code);
            return $this->db->update('faculty',$data);
        }

        /**
         * Delete faculty
         */
        public function delete_faculty($code){
            $this->db->where('faculty_code',$code);
            return $this->db->delete('faculty');
        }

        /**
         * check validity of faculty details
         */
        public function validate_faculty($code = false,$name = false,$edit=false,$code_skip=false){
            if($edit){
                if($code_skip){
                    return true;
                }
                $this->db->where('faculty_code !=',$code);
                $this->db->where('name',$name);
            }else{
                if($code){
                    $this->db->where('faculty_code',$code);
                }else if($name){
                    $this->db->where('name',$name);
                }
            }
            $result = $this->db->get('faculty');
            return $result->num_rows() === 0;
        }

        /**
         * Gets all the faculty details
         */
        public function get_faculties(){
            $result = $this->db->get('faculty');
            return $result->result_array();
        }
    }