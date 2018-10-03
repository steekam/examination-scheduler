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
         * Examination rooms page load
         */
        public function rooms(){
            $this->load->view('templates/header');
            $this->load->view('templates/top_header.php');
            $this->load->view('scheduler/sidenav');
            $this->load->view('scheduler/rooms');
            $this->load->view('templates/footer');
        }

        /**
         * Add building to the database
         */
        public function add_building(){
            //Validation for the form
            $this->form_validation->set_rules('building_name','Building name','trim|required|is_unique[building.name]',array(
                'is_unique' => 'This %s already exists'
            ));

            if ($this->form_validation->run() === FALSE) {
                $validation = array(
                    "icon" => "zmdi zmdi-alert-circle-o",
                    "type" => "danger",
                    "message" => form_error('building_name')
                );
                echo json_encode($validation);
            }else{
                if($this->scheduler_model->add_building()){
                    $success = array(
                        "icon" => "zmdi zmdi-badge-check",
                        "type" => "success",
                        "message" => "New buidling added successfully"
                    );
                    echo json_encode($success);
                }else{
                    $error = array(
                        "icon" => "zmdi zmdi-alert-circle-o",
                        "type" => "danger",
                        "message" => "Error in adding records. Try again later"
                    );
                    echo json_encode($error);
                }
            }
        }
    }