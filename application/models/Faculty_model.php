<?php defined('BASEPATH') OR exit('No direct script access allowed');
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

        /**
         * TODO: Requires more data
         * Get faculty where rep is incharge
         */
        public function get_faculty($rep){
            $res = array();
            $res['stats'] = array();

            $this->db->from('faculty_rep');
            $this->db->where('rep_id',$rep);
            $this->db->join('faculty','faculty.faculty_code = faculty_rep.faculty_code');
            $res['overview'] = $this->db->get()->result_array()[0];

            //Courses and Invigilators
            $this->db->where('faculty_code',$res['overview']['faculty_code']);
            $res['courses'] = $this->db->get('course')->result_array();
            $res['stats']['invigilators'] = $this->db->get('invigilators')->num_rows();
            $res['invigilators'] = $this->db->get('invigilators')->result_array();

            //Units
            $res['units'] = array();
            $res['unit_tags'] = array();
            $res['student_groups'] = array();
            $res['student_tags'] = array();
            $total_units = 0;
            foreach ($res['courses'] as $course) {
                $this->db->where('course_code',$course['course_code']);
                $res['units'][$course['course_code']] = $this->db->get('unit')->result_array();
                $total_units += sizeof($res['units'][$course['course_code']]);

                foreach($res['units'][$course['course_code']] as $unit){
                    $this->db->where('unit_code',$unit['unit_code']);
                    $res['unit_tags'][$unit['unit_code']] = $this->db->get('tagmap')->result_array();
                }
                //Groups
                $this->db->select('student_group.*, intake.name as intake_name, course_type.name as course_type');
                $this->db->where('course_code',$course['course_code']);
                $this->db->join('intake','intake.id = student_group.intake_id');
                $this->db->join('course_type','intake.course_type = course_type.id');
                $res['student_groups'][$course['course_code']] = $this->db->get('student_group')->result_array();

                //Group tags
                foreach($res['student_groups'][$course['course_code']] as $group){
                    $this->db->where('group_id',$group['group_id']);
                    $res['student_tags'][$group['name']] = $this->db->get('student_tagmap')->result_array();
                }
        }


            //Stats
            $res['stats']['courses'] = sizeof($res['courses']);
            $res['stats']['units'] = $total_units;

            return $res;
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

        //!Courses
        /**
         * Add course
         */
        public function add_course($data){
            return $this->db->insert('course',$data);
        }

        /**
         * Edit course
         */
        public function edit_course($course_code,$data){
            $this->db->where('course_code',$course_code);
            return $this->db->update('course',$data);
        }

        /**
         * Delete course
         */
        public function delete_course($course_code){
            $this->db->where('course_code',$course_code);
            return $this->db->delete('course');
        }

        /**
         * Validate course entry
         */
        public function validate_course($course_code=false,$course_name=false,$course_type=false,$edit=false){
            if($edit){
                $this->db->where('course_code !=',$course_code);
                $this->db->where('name',$course_name);
                $this->db->where('course_type',$course_type);

            }else{
                if($course_code){
                    $this->db->where('course_code',$course_code);
                }else if($course_name){
                    $this->db->where('name',$course_name);
                }
            }

            $result = $this->db->get('course');
            return $result->num_rows() == 0;
        }


        //!Units
        /**
         * Add unit
         */
        public function add_unit($data,$tags){
            $insert_tags = array();
            foreach ($tags as $tag) {
                $insert_tags[] = array(
                    'unit_code' => $data['unit_code'],
                    'tag_id' => $tag
                );
            }
            return $this->db->insert('unit',$data) && $this->db->insert_batch('tagmap',$insert_tags);
        }

         /**
         * Edit unit
         */
        public function edit_unit($unit_code,$data,$tags){
            $insert_tags = array();
            if(!empty($tags)){
                foreach ($tags as $tag) {
                    $insert_tags[] = array(
                        'unit_code' => $unit_code,
                        'tag_id' => $tag
                    );
                }
            }
            //Remove unit tags first then update
            $this->db->where('unit_code',$unit_code);
            $this->db->delete('tagmap');
            $this->db->insert_batch('tagmap',$insert_tags);       

            $this->db->where('unit_code',$unit_code);
            return $this->db->update('unit',$data);
        }

         /**
         * Delete unit
         */
        public function delete_unit($unit_code){
            $this->db->where('unit_code',$unit_code);
            return $this->db->delete('unit');
        }

        /**
         * Validate unit
         */
        public function validate_unit($unit_code=false,$name=false,$course=false,$edit=false){
            if($edit){
                $this->db->where('unit_code !=',$unit_code);
                $this->db->where('name',$name);
                $this->db->where('course_code',$course);
            }else {
                if($name && $course){
                    $this->db->where('name',$name);
                    $this->db->where('course_code',$course);
                }else if($unit_code){
                    $this->db->where('unit_code',$unit_code);
                }
            }            
            
            $result = $this->db->get('unit');
            return $result->num_rows() === 0;
        }

        //!Tags
        /**
         * Get all tags
         */
        public function get_tags(){
            $res = array();
            $this->db->where('tag_group','year');
            $res['year'] = $this->db->get('tag')->result_array();

            $this->db->where('tag_group','semester');
            $res['semester'] = $this->db->get('tag')->result_array();
            return $res;
        }

        //!Student groups
        /**
         * Add student group
         */
        public function add_student_group($data,$tag){
            $this->db->insert('student_group',$data);
            $this->db->where('name',$data['name']);
            $this->db->where('course_code',$data['course_code']);
            $this->db->where('intake_id',$data['intake_id']);
            $group = $this->db->get('student_group')->row_array();
            $tag_data = array(
                'group_id' => $group['group_id'],
                'tag_id' => $tag
            );

            return $this->db->insert('student_tagmap',$tag_data);
        }

        /**
         * Edit student group
         */
        public function edit_student_group($group_id,$data,$tag){
            $this->db->where('group_id',$group_id);
            $this->db->update('student_tagmap',array('tag_id'=>$tag));
            $this->db->where('group_id',$group_id);
            return $this->db->update('student_group',$data);
        }

        /**
         * Delete student group
         */
        public function delete_student_group($group_id){
            $this->db->where('group_id',$group_id);
            return $this->db->delete('student_group');
        }

        /**
         * Validate group
         */
        public function validate_group($group_name=false,$course_code=false,$intake_id=false,$edit=false,$group_id=false){
            if($edit){
                $this->db->where('group_id !=',$group_id);
            }
            $this->db->where('name',$group_name);
            $this->db->where('course_code',$course_code);
            $this->db->where('intake_id',$intake_id);
            return $this->db->get('student_group')->num_rows() === 0;
        }
    }