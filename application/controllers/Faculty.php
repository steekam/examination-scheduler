<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Faculty extends CI_Controller{
        //?Faculty reps only
        var $user = 2;
        /**
         * Index function for the faculty representative
         */
        public function index(){
            is_logged_in($this->user);

            $data = array(
                'faculty' => $this->faculty_model->get_faculty($this->session->userdata('user_id')),
                'options' => array(
                    'course_types' => $this->faculty_model->get_course_types()
                ),
                'tags' => $this->faculty_model->get_tags()
            );
            $this->load->view('templates/header');
            $this->load->view('templates/top_header');
            $this->load->view('faculty/sidenav');
            $this->load->view('faculty/index',$data);
            $this->load->view('templates/footer');
        }

        //?Courses
        /**
         * Add course
         */
        public function add_course(){
            is_logged_in($this->user);
            $res=array();
            $data = array(
                'course_code' => $this->input->post('course_code'),
                'name' => $this->input->post('course_name'),
                'faculty_code' => $this->input->post('faculty_code'),
                'course_type' => $this->input->post('course_type')
            );
            if($this->faculty_model->add_course($data)){
                $res = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Course added successfully"
                );
            }else{
                $res = array(
                    "icon" => "zmdi zmdi-alert-circle-o",
                    "type" => "danger",
                    "message" => "Could not complete request"
                );
            }
            echo json_encode($res);
        }

        /**
         * Edit course
         */
        public function edit_course(){
            is_logged_in($this->user);
            $res=array();
            $data = array(
                'name' => $this->input->post('course_name'),
                'faculty_code' => $this->input->post('faculty_code'),
                'course_type' => $this->input->post('course_type')
            );
            if($this->faculty_model->edit_course($this->input->post('course_code_edit'),$data)){
                $res = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Course edited successfully"
                );
            }else{
                $res = array(
                    "icon" => "zmdi zmdi-alert-circle-o",
                    "type" => "danger",
                    "message" => "Could not complete request"
                );
            }
            echo json_encode($res);
        }

        /**
         * Delete course
         */
        public function delete_course(){
            is_logged_in($this->user);

            $res = array();
            $code = $this->input->post('course_code');
            if($this->faculty_model->delete_course($code)){
                $res = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Course deleted successfully"
                );
            }else{
                $res = array(
                    "icon" => "zmdi zmdi-alert-circle-o",
                    "type" => "danger",
                    "message" => "Could not complete request"
                );
            }
            echo json_encode($res);
        }

        /**
         * Validate course entry
         */
        public function validate_course($code){
            is_logged_in($this->user);
            if($code == "true"){
                $course_code = $this->input->post('course_code');
                echo json_encode($this->faculty_model->validate_course($course_code));

            }else{
                $course_name = $this->input->post('course_name');
                echo json_encode($this->faculty_model->validate_course(false,$course_name));
            }
        }

        /**
         * Validate edit course
         */
        public function validate_edit_course(){
            is_logged_in($this->user);
            $course_name = $this->input->post('course_name');
            $course_code = $this->input->post('course_code');
            $course_type = $this->input->post('course_type');
            echo json_encode($this->faculty_model->validate_course($course_code,$course_name,$course_type,true));
        }

        //?Units
        /**
         * Add unit
         */
        public function add_unit(){
            is_logged_in($this->user);
            $res=array();

            $data = array(
                'unit_code' => $this->input->post('unit_code'),
                'name' => $this->input->post('unit_name'),
                'course_code' => $this->input->post('course_code'),
                'pref_invigilator' => $this->input->post('pref_invigilator'),
                'exam_duration' => $this->set_duration($this->input->post('exam_duration'))
            );
            $tags = $this->input->post('unit_tags[]');

            if($this->faculty_model->add_unit($data,$tags)){
                $res = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Unit added successfully"
                );
            }else{
                $res = array(
                    "icon" => "zmdi zmdi-alert-circle-o",
                    "type" => "danger",
                    "message" => "Could not complete request"
                );
            }
            echo json_encode($res);
        }

        /**
         * Edit unit
         */
        public function edit_unit(){
            is_logged_in($this->user);
            $res=array();

            $data = array(
                'name' => $this->input->post('unit_name'),
                'course_code' => $this->input->post('course_code'),
                'pref_invigilator' => $this->input->post('pref_invigilator'),
                'exam_duration' => $this->set_duration($this->input->post('exam_duration'))
            );
            $tags = $this->input->post('unit_tags[]');

            if($this->faculty_model->edit_unit($this->input->post('unit_code_edit'),$data,$tags)){
                $res = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Unit edited successfully"
                );
            }else{
                $res = array(
                    "icon" => "zmdi zmdi-alert-circle-o",
                    "type" => "danger",
                    "message" => "Could not complete request"
                );
            }
            echo json_encode($res);
            
        }

        /**
         * Delete unit
         */
        public function delete_unit(){
            is_logged_in($this->user);
            $res=array();

            $code = $this->input->post('unit_code');
            if($this->faculty_model->delete_unit($code)){
                $res = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Unit deleted successfully"
                );
            }else{
                $res = array(
                    "icon" => "zmdi zmdi-alert-circle-o",
                    "type" => "danger",
                    "message" => "Could not complete request"
                );
            }
            echo json_encode($res);
        }

        /**
         * Validate unit entry
         */
        public function validate_unit($code){
            is_logged_in($this->user);
            if($code=="true"){
                $unit_code = $this->input->post('unit_code');
                echo json_encode($this->faculty_model->validate_unit($unit_code));

            }else{
                $unit_name = $this->input->post('unit_name');
                $course_code = $this->input->post('course_code');
                echo json_encode($this->faculty_model->validate_unit(false,$unit_name,$course_code));
            }
        }

        /**
         * Validate unit edit
         */
        public function validate_edit_unit(){
            is_logged_in($this->user);

            $unit_code = $this->input->post('unit_code');
            $unit_name = $this->input->post('unit_name');
            $course_code = $this->input->post('course_code');
            echo json_encode($this->faculty_model->validate_unit($unit_code,$unit_name,$course_code,true));

        }

        /**
         * Validate exam duration set
         */
        public function validate_duration(){
            $duration = $this->input->post('exam_duration');
            $dur = explode(":",$duration);
            if(sizeof($dur) > 1){
                echo json_encode((int)$dur[0] <= 4 && (int)$dur[1] < 60);
            }else{
                echo json_encode(false);
            }
        }

        /**
         * Sets the time to double based on input
         */
        public function set_duration($duration){
            $dur = explode(":",$duration);
            $mins = ((int)$dur[0] * 60) + (int)$dur[1];
            return (double)($mins/60);
        }
    }