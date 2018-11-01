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
                return ($node1->get_name() < $node2->get_name()) ? -1 : 1;
            }
            return ($node1->get_degree() > $node2->get_degree()) ? -1 : 1;
        });
    }

    /**
     * Colors the vertices with minimum number of colors
     * such that no adjacent node have the same color
     * 
     * @return Array color matrix of the vertex coloring
     */
    public function vertex_coloring(){
        //Color store
        $c = array();
        $highest_deg = array_values($this->get_nodes())[0]->get_degree();
        for($i = 0; $i < $highest_deg; $i++){
            $c[$i] = $i;
        }

        //Store showing available colors. At first all are available
        $c_available = array_fill(0,count($c),true);
        

        //Color matrix [i] = color assigned to the node
        $c_matrix = array();
        
        $node_names = array_keys($this->get_nodes());
        
        //Init the matrix with -1 for unassigned
        foreach ($node_names as $name) {
            $c_matrix[$name] = -1;
        }

        //Color the first node
        $c_matrix[$node_names[0]] = $c[0];

        //Color the remaining non-adjacent colors with the same color
        foreach ($node_names as $current_node) {
            //Set adjacent nodes available to false
            $adj_list = $this->get_nodes()[$current_node]->get_adj_list();
            foreach($adj_list as $adj_node){
                if($c_matrix[$adj_node->get_name()] != -1){
                    $c_available[$c_matrix[$adj_node->get_name()]] = false;
                }
            }

            //Find lowest available color
            $c_av;
            for($c_av = 0; $c_av<count($c); ++$c_av){
                if($c_available[$c_av]){
                    break;
                }
            }
            //Set the color
            $c_matrix[$current_node] = $c_av;

            //Reset for the next iteration
            $c_available = array_fill(0,count($c),true); 
        }
        return $c_matrix;        
    }
}
