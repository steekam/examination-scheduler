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
            $subdata = array();
            $buildings = $this->scheduler_model->get_buildings();

            foreach ($buildings as $building) {
                $subdata[] = array(
                    "building" => $building,
                    "rooms" => $this->scheduler_model->get_building_rooms($building["id"])
                );
                
            }
            $data = array(
                "entries" => $subdata
            );

            $this->load->view('templates/header');
            $this->load->view('templates/top_header.php');
            $this->load->view('scheduler/sidenav');
            $this->load->view('scheduler/rooms',$data);
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

        /**
         * Edit building call handler
         */
        public function edit_building(){
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
                if($this->scheduler_model->edit_building()){
                    $success = array(
                        "icon" => "zmdi zmdi-badge-check",
                        "type" => "success",
                        "message" => "Building details edited successfully"
                    );
                    echo json_encode($success);
                }else{
                    $error = array(
                        "icon" => "zmdi zmdi-alert-circle-o",
                        "type" => "danger",
                        "message" => "Error in editing records. Try again later"
                    );
                    echo json_encode($error);
                }
            }
        }

        /**
         * Delete building call handler
         */
        public function delete_building(){
            if($this->scheduler_model->delete_building()){
                $success = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Building details deleted successfully"
                );
                echo json_encode($success);
            }else{
                $error = array(
                    "icon" => "zmdi zmdi-alert-circle-o",
                    "type" => "danger",
                    "message" => "Error in deleting records. Try again later"
                );
                echo json_encode($error);
            }
        }

        /**
         * Add new room entry into database
         */
        public function add_room(){
            //Validation for the form
            $this->form_validation->set_rules('room_name','Room name','trim|required|is_unique[room.name]',array(
                'is_unique' => 'This %s already exists'
            ));

            if ($this->form_validation->run() === FALSE) {
                $validation = array(
                    "icon" => "zmdi zmdi-alert-circle-o",
                    "type" => "danger",
                    "message" => set_value('room_name')." already exists."
                );
                echo json_encode($validation);
            }else{
                if($this->scheduler_model->add_room()){
                    $success = array(
                        "icon" => "zmdi zmdi-badge-check",
                        "type" => "success",
                        "message" => "New room added successfully"
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

        /**
         * Edit room call handler
         */
        public function edit_room(){
            //Validation for the form
            $this->form_validation->set_rules('room_name','Room name','trim|required|is_unique[room.name]',array(
                'is_unique' => 'This %s already exists'
            ));

            if ($this->form_validation->run() === FALSE) {
                $validation = array(
                    "icon" => "zmdi zmdi-alert-circle-o",
                    "type" => "danger",
                    "message" => set_value('room_name')." already exists."
                );
                echo json_encode($validation);
            }else{
                if($this->scheduler_model->edit_room()){
                    $success = array(
                        "icon" => "zmdi zmdi-badge-check",
                        "type" => "success",
                        "message" => "Room details edited successfully"
                    );
                    echo json_encode($success);
                }else{
                    $error = array(
                        "icon" => "zmdi zmdi-alert-circle-o",
                        "type" => "danger",
                        "message" => "Error in editing records. Try again later"
                    );
                    echo json_encode($error);
                }
            }
        }

        /**
         * Delete room call handler
         */
        public function delete_room(){
            if($this->scheduler_model->delete_room()){
                $success = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Room details deleted successfully"
                );
                echo json_encode($success);
            }else{
                $error = array(
                    "icon" => "zmdi zmdi-alert-circle-o",
                    "type" => "danger",
                    "message" => "Error in deleting record. Try again later"
                );
                echo json_encode($error);
            }
        }
    }