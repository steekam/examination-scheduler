<?php 
    class User extends CI_Controller {
        
        /**
         * Deals with user login
         */
        public function login(){
            //Check for cookies
            if(isset($_COOKIE['user_id'])){
                //Create session
                $user_data = array(
                    'user_id' => $_COOKIE['user_id'],
                    'username' => 'user',
                    'logged_in' => true
                );

                $this->session->set_userdata($user_data);
                redirect('admin');
            }

            switch($this->session->userdata('role')){
                case 'administrator':
                    redirect('admin');
                    break;
                case 'faculty representative':
                    redirect(base_url('faculty'));
                    break;
                case 'scheduler manager':
                    redirect(base_url('scheduler'));
                    break;
                default:
                    break;
            }


            //Form validation
            $this->form_validation->set_rules('username','Username','trim|required');
            $this->form_validation->set_rules('password','Password','trim|required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable">', '</div>');

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
                        setcookie('user_id', $user_id, time() + (86400 * 30), "/");
                    }

                    //Set session message
                    $this->session->set_flashdata('user_logged_in','Welcome ');

                    //Check if the user is activated
                    if($user->activated == "true"){
                        switch($user->role){
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
                setcookie("user_id", "", time() - 36000, "/");
            }

            $this->session->set_flashdata('user_logged_out','You are now logged out');
            redirect(base_url());
        }

        /**
         * Prompts deals with the password reset function
         */
        public function password_reset(){
            if(!$this->session->userdata('user_id')){
                redirect(base_url());
            }

            $this->load->view('templates/header');
            $this->load->view('user/password_reset');
            $this->load->view('templates/footer');


        }
    }