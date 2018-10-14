<?php defined('BASEPATH') OR exit('No direct script allowed');

/**
 *  Representation of a graph as an adjancey matrix
 */
class MyGraph {
    
    protected $_nodes = array();
    protected $_adj_matrix = array();
    
    public function __construct(){
    }

    public function newGraph(){
        $this->__construct();
    }
    
    /**
     * Add new node to the graph
     */
    public function add_node($node,$key){
        //Only add Unit
        if(is_a($node,'Unit')){
            if(in_array($node,$this->_nodes) && array_key_exists($key,$this->_nodes)){
                throw new Exception("Unit node already exists");
            }else{
                $this->_nodes[$key] = $node;
            }
        }else{
            throw new Exception('The node in not of class Unit');
        }
    }

    /**
     * Removes a node
     */
    public function remove_node($node){
        if(in_array($node,$this->_nodes)){
            unset($this->_nodes[array_search($node)]);
        }else{
            throw new Exception('Node is not present');
        }
    }

    /**
     *  @param Array $config_data Array with data to be passed into the graph
     *  @return MyGraph $G an instance of the MyGraph class
     */
    public function create_graph($config_data=array()){
        //Get all the units and add nodes to G
        if(isset($config_data)){
            foreach ($config_data->faculties as $faculty) {
                foreach ($faculty as $year) {
                    foreach ($year as $course) {
                        $temp_adj = array();
                        $first = true;
                        $start = 1;
                        foreach ($course as $unit_key => $unit_val) {                             
                            //New node
                            $node = new Unit();
                            $node->set_name($unit_key);
                            $node->set_specs($unit_val);
                            $temp_adj[] = $node;
                            $this->add_node($node,$node->get_name());
                        }
                        $this->create_adj_list($temp_adj);
                    }
                }
            }
            $this->init_adj_matrix();
        }
    }

    /**
     * Get all the nodes
     */
    public function get_nodes(){
        return $this->_nodes;
    }

    /**
     * Get adjacency matrix
     */
    public function get_adj_matrix(){
        return $this->_adj_matrix;
    }

    /**
     * Utility for creating adjacency list
     */
    public function create_adj_list($list){
        foreach($list as $node){
            if(is_a($node,'Unit')){
                $node->add_connection($list);
            }
        }
    }

    /**
     * Initialize the adjacency matrix
     */
    public function init_adj_matrix(){
        $node_names = array_keys($this->_nodes);

        foreach ($node_names as $row) {
            foreach($node_names as $col){
                if(in_array($this->_nodes[$col],$this->_nodes[$row]->get_adj_list())){
                    $this->_adj_matrix[$row][$col]=1;
                }else{
                    $this->_adj_matrix[$row][$col]=0;
                }
            }
        }        
    }


    /**
     * Sorts the graph in descending order with nodes with larger degrees first
     */
    public function sort_graph(){
        return uasort($this->_nodes,function($node1, $node2){
            if($node1->get_degree() == $node2->get_degree()){
                return ($node1->get_name() > $node2->get_name()) ? -1 : 1;
            }
            return ($node1->get_degree() > $node2->get_degree()) ? -1 : 1;
        });
    }

    /**
     * Colors the vertices with minimum number of colors
     * such that no adjacent node have the same color
     */
    public function vertex_coloring(){
        $G = $this;
        //Color list
        $colors = array();
        //Color matrix
        $c_matrix = array();
    }

}
