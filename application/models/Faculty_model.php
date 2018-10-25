<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
    class Faculty_model extends CI_Model{
        //!Faculty
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

        //!Invigilator
        /**
         * Invigilator add
         */
        public function add_invigilator($fname,$lname,$faculty_code,$status){
            $data = array(
                'first_name' => $fname,
                'last_name' => $lname,
                'faculty_code' => $faculty_code,
                'status' => $status=="on" ? 1 : 0
            );
            return $this->db->insert('invigilators',$data);
        }

        /**
         * Invigilator edit
         */
        public function edit_invigilator($fname,$lname,$faculty_code,$status,$id){
            $data = array(
                'first_name' => $fname,
                'last_name' => $lname,
                'faculty_code' => $faculty_code,
                'status' => $status=="on" ? 1 : 0
            );
            $this->db->where('id',$id);
            return $this->db->update('invigilators',$data);
        }

        /**
         * Invigilator delete
         */
        public function delete_invigilator($id){
            return $this->db->delete('invigilators',array('id'=>$id));
        }

        /**
         * Invigilator get all
         */
        public function get_invigilators(){
            $this->db->select('invigilators.*, faculty.name AS faculty');
            $this->db->join('faculty','faculty.faculty_code = invigilators.faculty_code');
            $result = $this->db->get('invigilators');
            return $result->result_array();
        }

        //!Course type
        /**
         * Add course type
         */
        public function add_course_type($name){
            return $this->db->insert('course_type',array('name'=>$name));
        }

        /**
         * Edit course type
         */
        public function edit_course_type($id,$name){
            $this->db->where('id',$id);
            return $this->db->update('course_type',array('name'=>$name));
        }

        /**
         * Delete course type
         */
        public function delete_course_type($id){
            $this->db->where('id',$id);
            return $this->db->delete('course_type');
        }

        /**
         * Check course type name
         */
        public function validate_course_type($name,$edit=false,$id=false){
            if($edit){
                $this->db->where('id !=',$id);
            }
            $this->db->where('name',$name);
            $result = $this->db->get('course_type');
            return $result->num_rows() === 0;
        }

        /**
         * Get course types
         */
        public function get_course_types(){
            return $this->db->get('course_type')->result_array();
        }

        //!Intakes
        /**
         * Add intake
         */
        public function add_intake($name,$course_type){
            $data = array(
                'name' => $name,
                'course_type' => $course_type
            );
            return $this->db->insert('intake',$data);
        }

        /**
         * Edit intake
         */
        public function edit_intake($id,$name,$course_type){
            $this->db->where('id',$id);
            return $this->db->update('intake',array('name'=>$name,'course_type'=>$course_type));
        }

        /**
         * Delete intake
         */
        public function delete_intake($id){
            $this->db->where('id',$id);
            return $this->db->delete('intake');
        }

        /**
         * Validates intake
         */
        public function validate_intake($name,$course_type,$edit=false,$id=false){
            if($edit){
                $this->db->where('id !=',$id);
            }
            $this->db->where('name',$name);
            $this->db->where('course_type',$course_type);
            $result = $this->db->get('intake');
            return $result->num_rows() === 0;
        }

        /**
         * Get all intakes
         */
        public function get_intakes(){
            $this->db->select('intake.*, course_type.name AS type_name');
            $this->db->join('course_type','course_type.id = intake.course_type');
            return $this->db->get('intake')->result_array();
        }
    }