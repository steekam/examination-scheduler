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

        /**
         * Interface for dealing with details provided by the facult representative
         * i.e courses and units in each course
         */
        public function details(){
            $this->load->view('templates/header');
            $this->load->view('templates/top_header');
            $this->load->view('faculty/sidenav');
            $this->load->view('faculty/details');
            $this->load->view('templates/footer');
        }

        /**
         * Viewing/Editing of the course and it details  
         */
        public function view_course($course_id){
            //Stores course details to be passed to the view
            $data = array();

            $this->load->view('templates/header');
            $this->load->view('templates/top_header');
            $this->load->view('faculty/sidenav');
            $this->load->view('faculty/view_course',$data);
            $this->load->view('templates/footer');
        }
    }