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
         * Gets the faculty details
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
         * Gets the total courses per faculty
         */
        public function get_course_count($faculty_id){
            $rep_id = $this->session->userdata('user_id');
            $this->db->from('course');
            $this->db->join('faculty','faculty.id = course.faculty_id');
            $this->db->where(array('faculty_id'=>$faculty_id));
            // $query = $this->db->get();
            return $this->db->count_all_results();
        }
        /**
         *  Gets the total units per faculty
         */
        public function get_unit_count($faculty_id){
            $sql = "SELECT course.id AS course, COUNT(unit.id) AS units
            FROM unit
            INNER JOIN
            course ON course.id = unit.course_id
            WHERE course.faculty_id = ?
            GROUP BY (course.id)";
            $result = $this->db->query($sql, array($faculty_id));
            return $result->row_array();
            
        }

        /**
         *  Updates the courses table
        */
        public function add_course($faculty_id){
            $data = array(
                'abbrev' => $this->input->post('abbrev'),
                'name' => $this->input->post('name'),
                'faculty_id' => $faculty_id
            );
            $course_insert = $this->db->insert('course',$data);

            return $course_insert;
        }

        /*
         * Gets the course id
         */
        public function get_total_course($faculty_id){
            $sql = "SELECT * FROM course WHERE faculty_id = ?";
            $result = $this->db->query($sql, array($faculty_id));
            return $result->row_array();
            // $get_total_course = $this->db->get_where('course', array('faculty_id' => $faculty_id));
            // return $get_total_course->row_array();
        }
    }