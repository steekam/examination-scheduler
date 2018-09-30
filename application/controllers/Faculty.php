<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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

        /**
         * Gets all the faculties and encodes in JSON format
         */
        public function get_faculties(){
            echo json_encode($this->faculty_model->get_faculties());
        }
    }