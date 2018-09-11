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
    }