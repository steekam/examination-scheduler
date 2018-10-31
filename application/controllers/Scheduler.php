<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
    class Scheduler extends CI_Controller{
        //?Scheduler managers only only
        var $user = 3;
        public function test_graph(){
            $file_path = base_url('assets/config/test_sess.json');
            $config_data = json_decode(file_get_contents($file_path));
            $unit_graph =  new MyGraph();
            $unit_graph->create_graph($config_data);
            $unit_graph->sort_graph();
            $c_matrix = $unit_graph->vertex_coloring();
            print_r($c_matrix);
        }

        /**
         * Load the index view
         * 
         */        
        public function index(){
            is_logged_in($this->user);

            $data = array(
                'tags' => $this->faculty_model->get_tags(),
                'intakes' => $this->faculty_model->get_intakes(),
                'sessions' => $this->scheduler_model->get_sessions()
            );

            $this->load->view('templates/header');
            $this->load->view('templates/top_header.php');
            $this->load->view('scheduler/sidenav');
            $this->load->view('scheduler/index',$data);
            $this->load->view('templates/footer');
        }

        /**
         * Examination rooms page load
         */
        public function rooms(){
            is_logged_in($this->user);

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
            is_logged_in($this->user);

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
            is_logged_in($this->user);

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
            is_logged_in($this->user);

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
            is_logged_in($this->user);

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
            is_logged_in($this->user);

            //Validation for the form
            $this->form_validation->set_rules('room_name','Room name','trim|required|callback_name_check');

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
         * Checks where the new edited name is already present
         */
        public function name_check($name){
            return $this->scheduler_model->check_room($name,$this->input->post('room_id'));
        }

        /**
         * Delete room call handler
         */
        public function delete_room(){
            is_logged_in($this->user);

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

        //!Sessions
        /**
         * Create session
         */
        public function create_exam_session(){
            is_logged_in($this->user);
            $res = array();
            $data = array(
                'name' => $this->input->post('session_name'),
                'intake_id' => $this->input->post('intake_id'),
                'semester_tag' => $this->input->post('semester_tag'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'skip_dates' => !empty($this->input->post('skip_dates[]')) ? serialize($this->input->post('skip_dates[]')) : " ",
                'max_exams_astudent' => $this->input->post('max_exams'),
                'max_consec_exams' => $this->input->post('max_per_period')
            );

            if($this->scheduler_model->create_session($data)){
                $res = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Session added successfully"
                );
            }else{
                $res = array(
                    "icon" => "zmdi zmdi-alert-circle-o",
                    "type" => "danger",
                    "message" => "Could not complete request"
                );
            }
            echo json_encode($res);
        }

        /**
         * Validate session name
         */
        public function validate_session_name(){
            $name = $this->input->post('session_name');
            echo json_encode($this->scheduler_model->validate_session_name($name));
        }

        /**
         * Validate session run
         * Check no active sessions running
         */
        public function validate_session_run($id){
            $res = array();
            if( !$this->scheduler_model->validate_session_run($id) ){
                $res = array(
                    "icon" => "zmdi zmdi-alert-circle-o",
                    "type" => "danger",
                    "message" => "There is an active session",
                    "check" => false
                );               
            }else {
                $res = array(
                    "check" => true
                ); 
            }
            echo json_encode($res);
        }

        /**
         * Session run
         */
        public function run_session($id){
            is_logged_in($this->user);
            $res = array();

            //Check no other session is active
            if( $this->scheduler_model->validate_session_run($id) ){
                if($this->scheduler_model->activate_session($id)){
                    $res = array(
                        "icon" => "zmdi zmdi-badge-check",
                        "type" => "success",
                        "message" => "New session started",
                        "check" => true
                    );
                }else{
                    $res = array(
                        "icon" => "zmdi zmdi-alert-circle-o",
                        "type" => "danger",
                        "message" => "Could not complete request",
                        "check" => false
                    );
                }
            }
            echo json_encode($res);
        }

        /**
         * Session stop
         */
        public function stop_session($id){
            is_logged_in($this->user);
            $res =array();
            if($this->scheduler_model->stop_session($id)){
                $res = array(
                    "icon" => "zmdi zmdi-badge-check",
                    "type" => "success",
                    "message" => "Active sessioin stopped",
                    "check" => true
                );
            }else{
                $res = array(
                    "icon" => "zmdi zmdi-alert-circle-o",
                    "type" => "danger",
                    "message" => "Could not complete request",
                    "check" => false
                );
            }
            echo json_encode($res);
        }

        /**
         * Load session data
         */
        public function load_session($id){
            // is_logged_in($this->user);
            $res =array();
            
            $details = $this->scheduler_model->get_session($id)[0];
            $faculty_wrap = array();
            $student_groups = array();
            $units = array();

            if($details['active']){
                $faculties = $this->faculty_model->get_faculties();
                foreach($faculties as $faculty){
                    $courses = $this->faculty_model->get_courses($faculty['faculty_code']);
                    foreach ($courses as $course) {
                        //student groups
                        $_groups = $this->faculty_model->get_student_groups($course['course_code'],$details['intake_id']);
                        $student_groups[$course['course_code']] = $_groups;

                        //Units
                        $units[$course['course_code']] = $this->faculty_model->get_semester_units($course['course_code'],$details['semester_tag']);
                    }
                    $faculty_wrap[$faculty['faculty_code']] = $units;
                }                
            }else{
                $res = array(
                    "icon" => "zmdi zmdi-alert-circle-o",
                    "type" => "danger",
                    "message" => "Could not complete request",
                    "check" => false
                );
            }
            
            //?Create new json config file
            $base_contents = json_encode(array('faculties'=> $faculty_wrap));
            $file_name = FCPATH.'/assets/config/exam_sessions/sess_'.date('d-m-Y').'#'.$details['id'].'.json';
            if ( !file_put_contents($file_name, $base_contents)){
                $res = array(
                    "icon" => "zmdi zmdi-alert-circle-o",
                    "type" => "danger",
                    "message" => "Could not load session config file",
                    "check" => false
                );
            }
            else{
                    $config_data = json_decode(file_get_contents($file_name));
                    $unit_graph =  new MyGraph();
                    $unit_graph->create_graph($config_data);

                    //?Sorts the graph based on indegree size of the nodes
                    $unit_graph->sort_graph();

                    $c_matrix = $unit_graph->vertex_coloring();

                    //?Settings
                    $settings = array(
                        'periods_a_day' => $details['periods_a_day'],
                        'max_consec_exams' => $details['max_consec_exams'],
                        'max_exams_astudent' => $details['max_exams_astudent'],
                        'max_days' => date_diff(new DateTime($details['end_date']), new DateTime($details['start_date']))->d
                    );

                    $period_schedule = $this->create_period_schedule($settings,$unit_graph->get_nodes(),$c_matrix);
                    $active_rooms = $this->scheduler_model->get_active_rooms();
                    $p_room_schedule = $this->set_rooms($period_schedule,$active_rooms,$student_groups);
                    $active_invigilators = $this->faculty_model->get_active_invigilators();
                    $final_schedule = $this->set_invigilators($p_room_schedule,$unit_graph->get_nodes(),$active_invigilators);

                    $schedule_config = array(
                        'dates' => array(
                            'start_date' => $details['start_date'],
                            'end_date' => $details['end_date']
                        ),
                        'timetable' => $final_schedule
                    );

                    $final_contents = json_encode($schedule_config);
                    $final_file_name = FCPATH.'assets/config/schedules/sess_'.date('d-m-Y').'#'.$details['id'].'.json';
                    if ( !file_put_contents($final_file_name, $final_contents)){
                        $res = array(
                            "icon" => "zmdi zmdi-alert-circle-o",
                            "type" => "danger",
                            "message" => "Could not load session config file",
                            "check" => false
                        );
                    }else{
                        $res = array(
                            "icon" => "zmdi zmdi-badge-check",
                            "type" => "success",
                            "message" => "Active sessioin stopped",
                            "check" => true
                        );
                        echo "Woe";
                    }
                }
                return $res;
        }

        /**
         * Create period schedule
         * Set the units into time slots
         */
        public function create_period_schedule($settings,$nodes,$c_matrix){
            /**
             * define X as no. of days of the exam
             * */
            $X = 0;
            /**
             * number of colors
             * */
            $c_num = max($c_matrix);

            /**
             * Current color
             */
            $c_current = 0;

            /**
             *Exam id of scheduled exams 
             */
            $exam_id = 1;

            /**
             *Get all the unit names 
             */
            $unit_names = array_keys($nodes);
            
            /**
             * Keeps track of scheduled exams
             */
            $s_matrix = array();


            /**
             * Schedule: Stores the whole schedule of the exam session
             */
            $schedule = array();
            
            //Init the scheduled matrix with -1 for unset
            foreach ($unit_names as $name) {
                $s_matrix[$name] = -1;
            }

            while($X < $settings['max_days']){
                /**
                 *  define Y as no. of periods set in a day
                 */
                $Y = 0;

                //Concurrent exams
                $consec = $settings['max_consec_exams'];

                //Max exams a day per student
                $e_aday = $settings['max_exams_astudent'];

                //Periods in  a day
                $p_day = array();

                //Exams in a period
                $e_period = array();
                $last_period = array();

                while($Y < $settings['periods_a_day']){
                    $unit_domain = $this->pick_units_domain($c_current,$c_matrix,$s_matrix);
                    if(!empty($unit_domain)){

                        for($u = 0; $u < count($unit_domain); ++$u){
                            if(count($e_period) == $consec){
                                break;
                            }

                            $curr_unit = $unit_domain[$u];
                            $curr_adj_list = $this->get_adj_list_names($nodes[$curr_unit]->get_adj_list());
                            if(!empty($e_period)){
                                $curr_period_keys = array_keys($e_period);
                                $intersect = count(array_intersect($curr_period_keys,$curr_adj_list));
                                if($intersect > 0){
                                    break;
                                }
                            }

                            //Check 2nd periods
                            if($Y == 1 ){
                                $last_period_keys = array_keys($last_period);
                                $intersect = count(array_intersect($last_period_keys,$curr_adj_list));
                                if($intersect > 0){
                                    continue;
                                }
                            }else if($Y == 2){
                                $second_keys = array_keys($last_period);
                                $intersect = count(array_intersect($second_keys,$curr_adj_list));
                                if($intersect > 0){
                                    continue;
                                }
                            }

                            $e_period[$curr_unit] = array(
                                'exam_id' => $exam_id,
                                'year' => $nodes[$curr_unit]->get_specs()->year,
                                'course_code' => $nodes[$curr_unit]->get_specs()->course_code
                            );
                            $exam_id++;
                            $s_matrix[$curr_unit] = 1;                            
                        }
                    }
                    $c_current == $c_num ? $c_current = 0 : $c_current++;

                    if(count($e_period) == $consec){
                        $p_day[$Y] = $e_period;
                        $last_period = $e_period;
                        $e_period = array();
                        ++$Y;
                    }else if(!in_array(-1,$s_matrix)){
                        $p_day[$Y] = $e_period;
                        break;
                    }else if($this->remaining_exams($s_matrix) < $consec){
                        if(!empty($e_period)){
                            $p_day[$Y] = $e_period;
                            $last_period = $e_period;
                            $e_period = array();
                        }
                        ++$Y;
                    }
                    
                }
                if(!empty($p_day)){
                    $schedule[] = $p_day;
                }

                if(!in_array(-1,$s_matrix)){
                    break;
                }
                ++$X;
            }
            return $schedule;
        }

        /**
         * Picks units in a certain color domain
         * That are unscheduled
         */
        public function pick_units_domain($color,$c_matrix,$s_matrix){
            $domain = array();
            foreach ($c_matrix as $key => $value) {
                if($value === $color && $s_matrix[$key] === -1){
                    $domain[] = $key;
                }
            }
            return $domain;
        }

        /**
         * Returns the remaining exams
         */
        public function remaining_exams($s_matrix){
            $domain = array();
            foreach ($s_matrix as $key => $value) {
                if($value === -1 ){
                    $domain[] = $key;
                }
            }
            return count($domain);
        }

        /**
         * Gets the names of the objects in the adjacency list
         */
        public function get_adj_list_names($adj_list){
            $names = array();
            foreach ($adj_list as $unit) {
                $names[] = $unit->get_name();
            }
            return $names;
        }

        /**
         * Give the the time slots into rooms
         */
        public function set_rooms($period_schedule,$rooms,$groups){
            $rooms_sorted = $this->sort_rooms($rooms);
            $ugs_matrix = $this->create_unit_size_matrix($groups);

            /**
             * Room availability matrix
             * Init with -1 for unavailable
             */
            $r_available = array_fill(0,count($rooms_sorted),-1);
            foreach($period_schedule as $d => $day){
                foreach($day as $p => $period){
                    foreach($period as $u => $unit){
                        $size = $ugs_matrix[$unit['course_code']][$unit['year']]['total_size'];
                        $room_id = $this->find_whole_room($r_available,$rooms_sorted,$size);
                        if($room_id){
                            $r_available[$room_id] = 1;
                            $unit['room'] = $rooms_sorted[$room_id]->name;
                            $unit['groups'] = $ugs_matrix[$unit['course_code']][$unit['year']]['groups'];
                        }else{
                            $u_groups = $ugs_matrix[$unit['course_code']][$unit['year']]['groups'];
                            $rooms_split = $this->find_split_rooms($r_available,$rooms_sorted,$size,$u_groups);
                            foreach($rooms_split as $room_split){
                                $r_available[$room_split] = 1;
                                $unit['room'][] = $rooms_sorted[$room_split]->name;
                                $unit['groups'] = $u_groups;
                            }
                        }
                        $period_schedule[$d][$p][$u] = $unit;
                    }
                    //reset availability
                    $r_available = array_fill(0,count($rooms_sorted),-1);
                }
            }
            return $period_schedule;
        }

        /**
         * Sort the rooms in terms of size
         */
        public function sort_rooms($rooms){
            uasort($rooms,function($node1, $node2){
                if($node1->room_size == $node2->room_size){
                    return ($node1->name > $node2->name) ? -1 : 1;
                }
                return ($node1->room_size < $node2->room_size) ? -1 : 1;
            });
            return $rooms;
        }

        /**
         * Creates a matrix of units, their groups and sizes
         */
        public function create_unit_size_matrix($groups){
            /**
             * Stores the unit group size matrix
             */
            $us_matrix = array();

            foreach($groups as $key => $course){
                $us_matrix[$key] = array();
                foreach($course as $key_y => $year){
                    $us_matrix[$key][$key_y] = array();
                    if(count($year) > 1){
                        $us_matrix[$key][$key_y]['total_size'] = 0;
                        foreach($year as $grp){
                            $us_matrix[$key][$key_y]['total_size'] += $grp['size'];
                            $us_matrix[$key][$key_y]['groups'][$grp['name']] = array('size'=> $grp['size']);
                        }
                    }else{
                        $us_matrix[$key][$key_y]['total_size'] = $year[0]['size'];
                        $us_matrix[$key][$key_y]['groups'][$year[0]['name']] = array('size'=> $year[0]['size']);
                    }
                }
            }
            return $us_matrix;
        }

        /**
         * Find suitable room
         */
        public function find_whole_room($r_available,$rooms_sorted,$exam_size){
            $good_room;
            for($r = 0; $r < count($rooms_sorted); $r++){
                if($r_available[$r] == -1 && $rooms_sorted[$r]->room_size >= $exam_size){
                    $good_room = $r;
                    break;
                }
            }
            return isset($good_room) ? $good_room : false;
        }

        /**
         * Find suitable split rooms
         */
        public function find_split_rooms($r_available,$rooms_sorted,$exam_size,$groups){
            $good_rooms = array();
            foreach($groups as $grp){
                $g_size = $grp['size'];
                for($r = 0; $r < count($rooms_sorted); $r++){
                    if($r_available[$r] == -1 && $rooms_sorted[$r]->room_size >= $g_size){
                        $good_rooms[] = $r;
                        $r_available[$r] = 1;
                        break;
                    }
                }
            }
            return $good_rooms;
        }

        /**
         * Sets invigilators for the exam
         */
        public function set_invigilators($schedule,$nodes,$invigilators){
            /**
             * Invigilator availability matrix
             * Init with -1 for unavailable
             */
            $invi_available = array_fill(0,count($invigilators),-1);
            foreach($schedule as $d => $day){
                foreach($day as $p => $period){
                    foreach($period as $u => $unit){
                        $pref = $nodes[$u]->get_specs()->pref_invigilator;
                        if(isset($invi_available[$pref]) && $invi_available[$pref] == -1){
                            $unit['invigilator'] = $invigilators[$pref]['full_name'];
                            $invi_available[$pref] = 1;
                        }else{
                            for($i = 0; $i < count($invigilators); $i++){
                                if($invi_available[$i]== -1){
                                    $unit['invigilator'] = $invigilators[$i]['full_name'];
                                    $invi_available[$i] = 1;
                                    break;
                                }
                            }
                        }
                        $schedule[$d][$p][$u] = $unit;
                    }
                }
                //reset for each day
                $invi_available = array_fill(0,count($invigilators),-1);
            }
            return $schedule;
        }
    
        /*
         *  Display the exam timetable
         */
        public function timetable(){
            $this->load->view('templates/header');
            $this->load->view('templates/top_header.php');
            $this->load->view('scheduler/sidenav');
            $this->load->view('scheduler/timetable');
            $this->load->view('templates/footer');
        }
    }
