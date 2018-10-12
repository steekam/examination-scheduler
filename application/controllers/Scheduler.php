<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
    class Scheduler extends CI_Controller{

        public function test_graph(){
            $file_path = base_url('assets/config/test_sess.json');
            $config_data = json_decode(file_get_contents($file_path));
            $unit_graph = $this->create_graph($config_data);
        }
        /**
         * Load the index view
         * 
         */        
        public function index(){
            if(!$this->session->userdata('logged_in')){
                redirect(base_url());
            }

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
            if(!$this->session->userdata('logged_in')){
                redirect(base_url());
            }

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
            if(!$this->session->userdata('logged_in')){
                redirect(base_url());
            }

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
            if(!$this->session->userdata('logged_in')){
                redirect(base_url());
            }

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
            if(!$this->session->userdata('logged_in')){
                redirect(base_url());
            }

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
            if(!$this->session->userdata('logged_in')){
                redirect(base_url());
            }

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
            if(!$this->session->userdata('logged_in')){
                redirect(base_url());
            }

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
            if(!$this->session->userdata('logged_in')){
                redirect(base_url());
            }

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


        /**
         * 
         * 
         * TODO: Remember to remove
         * !Don't forget
         * Test area
         * 
         * 
         * 
         * 
         * 
         * 
         * 
         */


        function create_graph($config_data=array()){
            /**
            * Graph representing the units to be scheduled
            */
            $G = new Structures_Graph(false);

            /**
             * Adjancey matrix of the nodes
             */
            $adj = array();
    
            /**
            *  List of all courses to be scheduled.  
            */
            $nodeList = array();
            //Get all the units and add nodes to G
            if(isset($config_data)){
                foreach ($config_data->faculties as $faculty) {
                    foreach ($faculty as $year) {
                        foreach ($year as $course) {
                            $first = true;
                            $prevNode = null;
                            $first_node = null;
                            foreach ($course as $unit_key => $unit_val) {
                                //Create unit node
                                $nodeList[$unit_key] = new Structures_Graph_Node();
                                
                                //Set metadata
                                $nodeList[$unit_key]->setMetaData('meta',$unit_val);

                                //Add the node to graph structure
                                $G->addNode($nodeList[$unit_key]);
                            
                                //Units in the same course are adajacent
                                if ($first) {
                                    $first_node = $nodeList[$unit_key];
                                    $first = false;
                                }else{
                                }
                                $prevNode = $nodeList[$unit_key];
                            }
                        }
                    }
                }
            }

            echo $nodeList['ICS1101']->inDegree();
            return $G;
        }

        function connect_adjacents($set=array()){
            
        }
    }