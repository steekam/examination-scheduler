<?php 
    class User_model extends CI_Model {

        //Load database
        public function __construct(){
            $this->load->database();
        }

        //Register user
        public function register($enc_password){
            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'role' => $this->input->post('role'),
                'password' => $enc_password
            );
            return $this->db->insert('users',$data);
        }

        //Login user
        public function login(){
            //Validate
            $this->db->where('username', $this->input->post('username'));

            $result = $this->db->get('users');

            if ($result->num_rows() == 1) {
                return password_verify($this->input->post('password'),$result->row(0)->password) ? $result->row(0) : false;
            }
        }

        //Updates the password
        public function update_password($enc_password, $activated = FALSE){
            $data = array(
                'password' => $enc_password,
            );
            if(!$activated){
                $data['activated'] = 'true';
            }            
            
            $this->db->where('id',$this->session->userdata('user_id'));
            return $this->db->update('users',$data);
        }

        //Gets user details 
        public function get_user($user_id = FALSE,$user_email = FALSE){
            if($user_id){
                $this->db->where('id',$user_id);
            }else if($user_email){
                $this->db->where('email',$user_email);
            }
            $query = $this->db->get('users');            
            return $query->row_array();
        }

        //Check if email is registered to an account
        public function check_email($email){
            $this->db->where('email',$email);
            $query = $this->db->get('users');
            
            return ($query->num_rows() == 1);
        }

        //Updates the reset code on password change request
        public function set_reset_code($reset_code,$user_id){
            //Check if there is a valid reset code
            $this->db->where('user_id',$user_id);
            $result = $this->db->get('password_reset');
            if($result->num_rows() > 0){
                $message = "";
            }

            $data = array(
                'user_id' => $user_id,
                'reset_code' => $reset_code
            );

            return $this->db->insert('password_reset',$data);
        }
    }