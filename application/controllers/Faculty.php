<?php
    class Faculty extends CI_Controller{
        /**
         * Index function for the faculty representative
         */
        public function index(){
            $this->load->view('templates/header');
            $this->load->view('templates/top_header');
            $this->load->view('faculty/sidenav');
            $this->load->view('faculty/index');
            $this->load->view('templates/footer');
        }
    }