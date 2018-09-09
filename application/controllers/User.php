<?php 
    class User extends CI_Controller {
        
        //Deals with login content of user
        public function login(){
            $this->load->view('templates/header');
            $this->load->view('user/login');
            $this->load->view('templates/footer');
        }
    }