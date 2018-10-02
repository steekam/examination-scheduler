<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
    class Scheduler extends CI_Controller{
        /**
         * Load the index view
         * TODO: Remember to add the session check
         * 
         */        
        public function index(){
            $this->load->view('templates/header');
            $this->load->view('templates/top_header.php');
            $this->load->view('scheduler/sidenav');
            $this->load->view('scheduler/index');
            $this->load->view('templates/footer');
        }

        /**
         * Examination rooms load
         */
        public function rooms(){
            $this->load->view('templates/header');
            $this->load->view('templates/top_header.php');
            $this->load->view('scheduler/sidenav');
            $this->load->view('scheduler/rooms');
            $this->load->view('templates/footer');
        }
    }