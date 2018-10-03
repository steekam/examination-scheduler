<?php
 class Scheduler_model extends CI_Model{

    public function add_building(){
        $data = array(
            "name" => $this->input->post('building_name')
        );

        return $this->db->insert('building',$data);
    }
 }