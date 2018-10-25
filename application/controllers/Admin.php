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
                'faculties' => $this->faculty_model->get_faculties()
            );

            $this->load->view('templates/header');
            $this->load->view('templates/top_header');
            $this->load->view('admin/sidenav');
            $this->load->view('admin/institution',$data);
            $this->load->view('templates/footer');
        }

        /**
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
    }