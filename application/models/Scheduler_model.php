<?php
 class Scheduler_model extends CI_Model{

    /**
     * Adds a new building to record
     */
    public function add_building(){
        $data = array(
            "name" => $this->input->post('building_name')
        );

        return $this->db->insert('building',$data);
    }

    /**
     * Gets a result array of all the buildings on record
     */
    public function get_buildings(){
        $this->db->order_by("name","asc");
        $result = $this->db->get('building');
        return $result->result_array();
    }

    /**
     * Get rooms in a certain building
     */
    public function get_building_rooms($building_id){
        $this->db->where('building_id',$building_id);
        $this->db->order_by("name","asc");
        $result = $this->db->get('room');
        return $result->result_array();
    }
    
    /**
     * Get all rooms
     */
    public function get_all_rooms(){
        return $this->db->get('room')->result_array();
    }

    /**
     * Edit a a building record
     */
    public function edit_building(){
        $data = array(
            'name' => $this->input->post('building_name')
        );
        $this->db->where('id',$this->input->post('building_id'));
        return $this->db->update('building',$data);
    }

    /**
     * Delete a a building record
     */
    public function delete_building(){
        $this->db->where('id',$this->input->post('building_id'));
        return $this->db->delete('building');
    }

    /**
     * Adds a new room record
     */
    public function add_room(){
        $data = array(
            "name" => $this->input->post('room_name'),
            "room_size" => $this->input->post('room_size'),
            "status" => $this->input->post('room_status'),
            "building_id" => $this->input->post('building_id')
        );
        return $this->db->insert('room',$data);
    }

    /**
     * Query for room name check
     */
    public function check_room($name,$room_id){
        $this->db->where('name',$name);
        $this->db->where('id !=',$room_id);
        $result = $this->db->get('room');
        return ($result->num_rows() == 0);
    }

    /**
     * Edit room record
     */
    public function edit_room(){
        $data = array(
            "name" => $this->input->post('room_name'),
            "status" => $this->input->post('room_status'),
            "room_size" => $this->input->post('room_size')
        );
        $this->db->where('id',$this->input->post('room_id'));
        return $this->db->update('room',$data);
    }

    /**
     * Delete a a room record
     */
    public function delete_room(){
        $this->db->where('id',$this->input->post('room_id'));
        return $this->db->delete('room');
    }

    /**
     * Get active rooms
     */
    public function get_active_rooms(){
        $this->db->where('status',"active");
        return $this->db->get('room')->result_object();
    }

    //!Sessions
    /**
     * Create session
     */
    public function create_session($data){
        return $this->db->insert('exam_session',$data);
    }

    /**
     * Delete session
     */
    public function delete_exam_session($sess_id){
        $this->db->where('id',$sess_id);
        return $this->db->delete('exam_session');
    }

    /**
     * Validate session name
     */
    public function validate_session_name($name){
        $this->db->where('name',$name);
        return $this->db->get('exam_session')->num_rows() === 0;
    }

    /**
     * Get sessions
     */
    public function get_sessions(){
        $this->db->select('exam_session.* , intake.name as intake_name, course_type.name as intake_type, tag.tag_name');
        $this->db->join('intake','intake.id = exam_session.intake_id');
        $this->db->join('course_type','intake.course_type = course_type.id');
        $this->db->join('tag','tag.tag_id = exam_session.semester_tag');
        return $this->db->get('exam_session')->result_array();
    }

    /**
     * Get session
     */
    public function get_session($id){
        $this->db->where('id',$id);
        return $this->db->get('exam_session')->result_array();
    }

    /**
     * Validate session run
     */
    public function validate_session_run($id){
        $this->db->where('active',1);
        return $this->db->get('exam_session')->num_rows() === 0; 
    }

    /**
     * Activate session
     * 
     */
    public function activate_session($id){
        $this->db->where('id',$id);
        return $this->db->update('exam_session',array('active'=>1));
    }

    /**
     * Stop session
     */
    public function stop_session($id){
        $this->db->where('id',$id);
        return $this->db->update('exam_session',array('active'=>0));
    }

    /**
     * Set schedule location on server
     */
    public function set_schedule_file($session_id,$final_file_name){
        $this->db->where('id',$session_id);
        return $this->db->update('exam_session',array('schedule_path' => $final_file_name));
    }

    /**
     * Get the schedule for a specified session in json format
     */
    public function get_schedule($id){
        $this->db->where('id',$id);
        return $this->db->get('exam_session')->row_array();
    }
}