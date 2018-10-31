<?php defined('BASEPATH') OR exit('No direct script allowed');

/**
 *  Representation of a unit
 */
class Unit {

    protected $_name = null;
    protected $_specs = null;
    protected $_adj_list = array();

    public function __construct(){
    }

    /**
     * 
     */
    public function get_name(){
        return $this->_name;
    }

    /**
     * 
     */
    public function set_name($name){
        $this->_name = $name;
    }

    /**
     * 
     */
    public function get_specs(){
        return $this->_specs;
    }

    /**
     * 
     */
    public function set_specs($specs){
        $this->_specs = $specs;
    }

    /**
     * Add to the node adjacency list
     */
    public function add_connection($nodes){
        foreach($nodes as $node){
            if($node != $this){
                $this->_adj_list[] = $node;
            }
        }
    }

    /**
     * Get the adjacency list
     */
    public function get_adj_list(){
        return $this->_adj_list;
    }

    /**
     * Returns the degree of the node
     * Number of nodes connected to it
     */
    public function get_degree(){
        return count($this->_adj_list);
    }
}