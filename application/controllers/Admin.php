<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
    class Admin extends CI_Controller{

        /**Accepted user type for this page (Administrator) */
        var $user = 1;        
        /**
         * Loads default view of the admin dashboard
         */
        public function index(){
            if(!$this->session->userdata('logged_in')){
                redirect(base_url());
            }

            $this->load->view('templates/header');
            $this->load->view('templates/top_header');
            $this->load->view('admin/sidenav');
            $this->load->view('admin/index');
            $this->load->view('templates/footer');
        }

        /**
         * Deals with registration of new users
         */
        public function register_user(){
            if(!$this->session->userdata('logged_in')){
                redirect(base_url());
            }

            //Set form validations
            $this->form_validation->set_rules('first_name','First Name','trim|required');
            $this->form_validation->set_rules('last_name','Last Name','trim|required');
            $this->form_validation->set_rules('username','Username','trim|required|is_unique[users.username]',array(
                'is_unique' => 'This %s already exists'
            ));
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.email]',array(
                'is_unique' => 'This %s already exists'
            ));


            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->load->view('templates/top_header');
                $this->load->view('admin/sidenav');
                $this->load->view('admin/register_user');
                $this->load->view('templates/footer');
            } else {
                //Encrypt password
                $gen_password = random_string('alnum', 12);
                $enc_password = password_hash($gen_password,PASSWORD_BCRYPT);

                $data = array(
                    'name' => $this->input->post('first_name').' '.$this->input->post('last_name'),
                    'username' => $this->input->post('username'),
                    'password' => $gen_password,
                    'role' => $this->input->post('role')
                );
                $body = '
                <p>Dear '.$data['name'].',</p>
                <p>You have been registered to the Examination Scheduler as a/an '.$data['role'].'.</p>
                <p>These are your credentials: <br>
                <strong>Username: </strong> '.$data['username'].'<br>
                <strong>Passwordd: </strong>'.$data['password'].'</p>
                <p>You will be prompted to change your password on first login.</p>
                <a href="'.base_url().'">Click here to login</a> 
                
                ';
                $settings = array(
                    'to' => $this->input->post('email'),
                    'subject' => 'ACCOUNT REGISTRATION',
                    'body' => $body
                );

                // Send email to user
                $sent = send_email($settings);
                if($sent){
                    $this->user_model->register($enc_password);

                    //Set session message
                    $this->session->set_flashdata('user_registered','New user has been registered');
                }else{
                    //Set session message
                    $this->session->set_flashdata('failed_register','Could not finish registration. Try again later');
                }
                redirect('admin/register_user');
            }
            
        }

        /**
         * 
         * Checks if the email input is a valid strathmore.edu email.
         * 
         * @param string $email Input passeddeldel in the form.
         * 
         * @return boolean Indicates whether email is valid.
         */
        public function check_email($email){
            $this->form_validation->set_message('check_email','Email does not belong to strathmore.edu');

            return (strpos($email, 'strathmore.edu') !== FALSE);
        }

        /**
         *  Deatails required by the institution
         */
        public function institution(){
            if(!$this->session->userdata('logged_in')){
                redirect(base_url());
            }

            $data = array(
                'faculties' => $this->faculty_model->get_faculties(),
                'invigilators' => $this->faculty_model->get_invigilators(),
                'course_types' => $this->faculty_model->get_course_types(),
                'intakes' => $this->faculty_model->get_intakes()
            );

            $this->load->view('templates/header');
            $this->load->view('templates/top_header');
            $this->load->view('admin/sidenav');
            $this->load->view('admin/institution',$data);
            $this->load->view('templates/footer');
        }

        /**
         * !Faculty
         * Call to add faculty
         */
        public function add_faculty(){
            is_logged_in();

            $res = array();
            $code = $this->input->post('faculty_code');
            $name = $this->input->post('faculty_name');
            if($this->faculty_model->add_faculty($code,$name)){
                $res = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Faculty added successfully"
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
         * Call to edit faculty
         */
        public function edit_faculty(){
            is_logged_in();

            $res = array();
            $code = $this->input->post('faculty_code');
            $name = $this->input->post('faculty_name');
            if($this->faculty_model->edit_faculty($code,$name)){
                $res = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Faculty edited successfully"
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
         * Call to delete faculty
         */
        public function delete_faculty(){
            is_logged_in();

            $res = array();
            $code = $this->input->post('faculty_code');
            if($this->faculty_model->delete_faculty($code)){
                $res = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Faculty deleted successfully"
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
         * Check faculty code
         */
        public function check_faculty_code(){
            $code = $this->input->post('code');
            echo json_encode($this->faculty_model->validate_faculty($code));
        }

        /**
         * Check faculty name
         */
        public function check_faculty_name(){
            $name = $this->input->post('name');
            echo json_encode($this->faculty_model->validate_faculty(false,$name));            
        }

        /**
         * Checks faculty name on edit
         */
        public function check_faculty_name_edit(){
            $name = $this->input->post('name');
            $code = $this->input->post('code');
            echo json_encode($this->faculty_model->validate_faculty($code,$name,true));
        }

        /**
         * Checks faculty code on edit
         */
        public function check_faculty_code_edit(){
            $code = $this->input->post('code');
            echo json_encode($this->faculty_model->validate_faculty($code,false,true,true));
        }

        //!Invigilators
        /**
         * Add invigilator
         */
        public function add_invigilator(){
            is_logged_in();

            $res = array();
            $fname = $this->input->post('first_name');
            $lname = $this->input->post('last_name');
            $faculty_code = $this->input->post('faculty_code');
            $status = $this->input->post('status');
            if($this->faculty_model->add_invigilator($fname,$lname,$faculty_code,$status)){
                $res = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Invigilator added successfully"
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
         * Edit invigilator
         */
        public function edit_invigilator(){
            is_logged_in();

            $res = array();
            $fname = $this->input->post('first_name');
            $lname = $this->input->post('last_name');
            $faculty_code = $this->input->post('faculty_code');
            $status = $this->input->post('status');
            $id = $this->input->post('id');
            if($this->faculty_model->edit_invigilator($fname,$lname,$faculty_code,$status,$id)){
                $res = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Record edited successfully"
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
         * Delete invigilator
         */
        public function delete_invigilator(){
            is_logged_in();

            $res = array();
            $id = $this->input->post('id');
            if($this->faculty_model->delete_invigilator($id)){
                $res = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Record deleted successfully"
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

        //!Course types
        /**
         * Add course type
         */
        public function add_course_type(){
            is_logged_in();

            $name = $this->input->post('type_name');
            if($this->faculty_model->add_course_type($name)){
                $res = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Course type added successfully"
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
         * Edit course type
         */
        public function edit_course_type(){
            is_logged_in();

            $id = $this->input->post('id');
            $name = $this->input->post('type_name');
            if($this->faculty_model->edit_course_type($id,$name)){
                $res = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Course type edited successfully"
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
         * Delete course type
         */
        public function delete_course_type(){
            is_logged_in();

            $id = $this->input->post('id');
            if($this->faculty_model->delete_course_type($id)){
                $res = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Record deleted successfully"
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
         * Validate course type name
         */
        public function validate_type_name(){
            is_logged_in();

            $name = $this->input->post('type_name');
            echo json_encode($this->faculty_model->validate_course_type($name));
        }

        /**
         * Validate  course type name edit 
         */
        public function validate_type_name_edit(){
            is_logged_in();

            $name = $this->input->post('type_name');
            $id = $this->input->post('id');
            echo json_encode($this->faculty_model->validate_course_type($name,true,$id));
        }

        //!Intakes
        /**
         * Add intake
         */
        public function add_intake(){
            is_logged_in();
            
            $name = $this->input->post('name');
            $course_type = $this->input->post('course_type');
            if($this->faculty_model->add_intake($name,$course_type)){
                $res = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Intake added successfully"
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
         * Edit intake
         */
        public function edit_intake(){
            is_logged_in();

            $name = $this->input->post('name');
            $course_type = $this->input->post('course_type');
            $id = $this->input->post('id');
            if($this->faculty_model->edit_intake($id,$name,$course_type)){
                $res = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Intake edited successfully"
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
         * Delete intake
         */
        public function delete_intake(){
            is_logged_in();
            $id = $this->input->post('id');
            if($this->faculty_model->delete_intake($id)){
                $res = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Intake deleted successfully"
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
         * Validate intake name and course type
         */
        public function validate_intake(){
            is_logged_in();
            $name = $this->input->post('name');
            $course_type = $this->input->post('course_type');
            echo json_encode($this->faculty_model->validate_intake($name,$course_type));
        }

        /**
         * Validate intake on edit
         */
        public function validate_intake_edit(){
            is_logged_in();
            $name = $this->input->post('name');
            $course_type = $this->input->post('course_type');
            $id = $this->input->post('id');
            echo json_encode($this->faculty_model->validate_intake($name,$course_type,true,$id));
        }
    }