<?php
    class Faculty extends CI_Controller{
        /**
         * Index function for the faculty representative
         */
        public function index(){
            // Gets the faculty details of every rep
            $data['faculty'] = $this->faculty_model->get_faculty_rep();
            $data['course_count'] = $this->faculty_model->get_course_count($data['faculty']['id']);
            $data['unit_count'] = $this->faculty_model->get_unit_count($data['faculty']['id']);

            $this->load->view('templates/header');
            $this->load->view('templates/top_header');
            $this->load->view('faculty/sidenav');
            $this->load->view('faculty/index',$data);
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
            $data['faculty'] = $this->faculty_model->get_faculty_rep();
            // $data['course'] = $this->faculty_model->add_course($data['faculty']['id']);

            $this->load->view('templates/header');
            $this->load->view('templates/top_header');
            $this->load->view('faculty/sidenav');
            $this->load->view('faculty/details',$data);
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

        /** 
         * Gets the faculty details
         */
        public function view_faculty(){
            $data['faculty'] = $this->faculty_model->get_faculty_rep();
        }

        /**
         * Adds new course 
         */
        public function add_course(){
            $data['faculty'] = $this->faculty_model->get_faculty_rep();
            $faculty_id = $data['faculty']['id'];

            //Set form validations
            $this->form_validation->set_rules('abbrev','Abbreviation','trim|required|is_unique[course.abbrev]',array(
                'is_unique' => 'This %s already exists'
            ));
            $this->form_validation->set_rules('name','Name','trim|required|is_unique[course.name]',array(
                'is_unique' => 'This %s already exists'
            ));

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->load->view('templates/top_header');
                $this->load->view('faculty/sidenav');
                $this->load->view('faculty/register_course',$data);
                $this->load->view('templates/footer');
            } else {
                $data = array(
                    'abbrev' => $this->input->post('abbrev'),
                    'name' => $this->input->post('name'),
                    'faculty_id' => $faculty_id
                );
                echo $this->faculty_model->add_course($faculty_id);
            }
        }
        // Stores the course details to be passed to the database
        
        //Transfer the data to the model
        // $this->faculty_model->add_course($data);
        // $this->load->view('faculty/view_course',$data);
    
        /*
        * Function that registers courses
        */
        public function register_course(){
            $data['faculty'] = $this->faculty_model->get_faculty_rep();

            $this->load->view('templates/header');
            $this->load->view('templates/top_header');
            $this->load->view('faculty/sidenav');
            $this->load->view('faculty/register_course',$data);
            $this->load->view('templates/footer');
            
        }
         /*
        * Function that registers units
        */
        public function register_unit(){
            $data['faculty'] = $this->faculty_model->get_faculty_rep();
            $faculty_id = $data['faculty']['id'];
            $data['courses'] = $this->faculty_model->get_total_course($faculty_id); 

            $this->load->view('templates/header');
            $this->load->view('templates/top_header');
            $this->load->view('faculty/sidenav');
            $this->load->view('faculty/register_unit',$data);
            $this->load->view('templates/footer');
            
        }
    }