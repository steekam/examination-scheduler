<?php 
    class User extends CI_Controller {
        
        /**
         * Deals with user login
         */
        public function login(){
            //Check for cookies
            // die(print_r($_COOKIE));
            if(isset($_COOKIE['user_id'])){
                //Create session
                $user = $this->user_model->get_user($_COOKIE['user_id'],FALSE);
                $user_data = array(
                    'user_id' => $user['id'],
                    'name' => $user['first_name'].' '.$user['last_name'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                    'logged_in' => true
                );
                $this->session->set_userdata($user_data);
                $this->user_redirect($this->session->userdata('role'));
            }

            //Form validation
            $this->form_validation->set_rules('username','Username','trim|required');
            $this->form_validation->set_rules('password','Password','trim|required');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->load->view('user/login');
                $this->load->view('templates/footer');
            }else {
                //Login user
                $user = $this->user_model->login();
                $remember_me = $this->input->post('remember_me');

                if($user){
                    //Create session
                    $user_data = array(
                        'user_id' => $user->id,
                        'name' => $user->first_name.' '.$user->last_name,
                        'email' => $user->email,
                        'role' => $user->role,
                        'logged_in' => true
                    );

                    $this->session->set_userdata($user_data);

                    if($remember_me){
                        //Create cookie
                        setcookie('user_id', $user_data['user_id'], time() + (86400 * 30), "/");
                    }

                    //Set session message
                    $this->session->set_flashdata('user_logged_in','Welcome '.$user_data['name']);

                    //Check if the user is activated
                    if($user->activated == "true"){
                        $this->user_redirect($user->role);
                    }else{
                        //Prompt password change
                        redirect(base_url('password_reset'));
                    }

                    

                }else {                    
                    //Set error message
                    $this->session->set_flashdata('login_failed','Invalid credentials');
                    redirect(base_url());
                }                
            }
        }

        /**
         * Logs out the user
         * Clears the sessions and cookies [if any]
         */
        public function logout(){
            $this->session->unset_userdata(array('user_id','logged_in','name','email','role'));

            //delete cookie
            if(isset($_COOKIE['user_id'])){
                setcookie("user_id", $user_id, time() - 36000, "/");
            }

            $this->session->set_flashdata('user_logged_out','You are now logged out');
            redirect(base_url());
        }

        /**
         * Prompts deals with the password reset function
         */
        public function password_reset($user_id = FALSE,$reset_code = FALSE){
            if(!$this->session->userdata('user_id')){
                redirect(base_url());
            }

            //Form validation
            $this->form_validation->set_rules('password','Password','trim|required');
            $this->form_validation->set_rules('password2','Confirm Password','trim|required|matches[password]',array(
                'matches' => "Passwords do not match"
            ));

            if($this->form_validation->run() == FALSE){
                $this->load->view('templates/header');
                $this->load->view('user/password_reset');
                $this->load->view('templates/footer');
            }else{
                $enc_password = password_hash($this->input->post('password'),PASSWORD_BCRYPT);

                $this->user_model->update_password($enc_password);
                $this->session->set_flashdata('updated_password','Password successfully updated');
                $this->user_redirect($this->session->userdata('role'));
            } 
        }

        /**
         * Forgot password funtion
         */
        public function forgot_password(){
            //validation
            $this->form_validation->set_rules('email','Email','trim|required|callback_check_email_exists');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable">', '</div>');

            $data = array(
                'forgot_trigger' => 'true'
            );
            if($this->form_validation->run() == FALSE){
                $this->load->view('templates/header');
                $this->load->view('user/login');
                $this->load->view('templates/footer',$data);
            }else{
                //Send email to user with a reset link
                $reset_code = random_string('sha1');

                $user = $this->user_model->get_user(FALSE,$this->input->post('email'));


                $body = '<p>Dear '.$user['first_name'].',</p>
                <p>Use the link below to reset your password. If you have not requested for a password
                reset, please check your account for security reasons.</p>
                <a href="'.base_url('password_reset/'.$user['id'].'/'.$reset_code).'">Reset Password</a>
                <p>This link will expire in 48 hours</p>';
                
                $settings = array(
                    'to' => $this->input->post('email'),
                    'subject' => 'PASSWORD RESET',
                    'body' => $body
                );

                // Send email to user
                $sent = send_email($settings);
                if($sent){
                    //Update reset code to database
                    $this->user_model->set_reset_code($reset_code,$user['id']);

                    $this->session->set_flashdata('reset_email_sent','Reset link sent to your email');
                    redirect(base_url('user/forgot_password'));

                }else{
                    //Set session message
                    $this->session->set_flashdata('failed_email','Email could not be sent. Please try again later');
                    redirect(base_url());
                }
            }
        }

        /**
         * Callback custom validation to check email exists
         */
        public function check_email_exists($email){
            $this->form_validation->set_message('check_email_exists','Email is not registered');

            return $this->user_model->check_email($email);
        }

        //Helps with the redirect based on user type 
        public function user_redirect($role){
            switch($role){
                case 'administrator':
                    redirect('admin');
                    break;
                case 'faculty representative':
                    redirect();
                    break;
                case 'scheduler manager':
                    redirect();
                    break;
                default:
                    redirect(base_url());
                    break;
            }
        }
    }