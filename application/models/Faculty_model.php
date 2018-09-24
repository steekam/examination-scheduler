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

        /**
         * Gets the faculty rep
         */
        public function get_faculty_rep(){
            $rep_id = $this->session->userdata('user_id');
            // $this->db->select('*');
            $this->db->from('faculty');
            $this->db->join('faculty_rep','faculty.id = faculty_rep.faculty_id');
            $this->db->where(array('rep_id'=>$rep_id));
            $query = $this->db->get();
            return $query->row_array();
        }
        /**
         *  Updates the courses table
        */
        public function add_course(){
            // Stores the course details to be passed to the database
            $data = array(
                'course_code' => $this->input->post('course_id'),
                'name' => $this->input->post('name'),
                'faculty_id' => $this->input->post('faculty_id')
            );
            return $this->db->insert('course',$data);
        }
    }