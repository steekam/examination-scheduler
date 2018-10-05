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
            "building_id" => $this->input->post('building_id')
        );
        return $this->db->insert('room',$data);
    }

    /**
     * Edit room record
     */
    public function edit_room(){
        $data = array(
            "name" => $this->input->post('room_name')
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
 }