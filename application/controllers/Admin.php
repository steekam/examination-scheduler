<?php
    class Admin extends CI_Controller{
        
        //Deals witht the view after admin login
        public function index(){
            $this->load->view('templates/header');
            $this->load->view('templates/admin_header');
            $this->load->view('admin/index');
            $this->load->view('templates/footer');
        }

        public function register_user(){
            $this->load->view('templates/header');
            $this->load->view('templates/admin_header');
            $this->load->view('admin/register_user');
            $this->load->view('templates/footer');
        }
    }