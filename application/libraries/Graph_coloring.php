<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Library helper to help in creating graphs data structures and graph vertex coloring
 */
class Graph_coloring {
    /** 
     * Building Graph for the problem set 
     * 
     * @param Array $config_data  Array with config for scheduling for every faculty
     * @return Structures_Graph Graph object of the units
     */
    function create_graph($config_data=array()){
        /**
        * Graph representing the units to be scheduled
        */
        $G = new Structures_Graph(false);

        /**
        *  List of all courses to be scheduled.  
        */
        $unitList = array();

        //Get all the units and add nodes to G
        if(isset($config_data)){
            foreach ($config_data->faculties as $faculty) {
                foreach ($faculty as $year) {
                    foreach ($year as $course) {
                        $first = true;
                        $prevNode = null;
                        foreach ($course as $unit_key => $unit_val) {
                            //Create unit node
                            $unitList[$unit_key] = new Structures_Graph_Node();
                        
                            //Set metadata
                            foreach ($unit_val as $meta_key => $value) {
                                $unitList[$unit_key]->setMetadata($meta_key,$value);
                            }
                        
    
                            //Add the node to graph structure
                            $G->addNode($unitList[$unit_key]);
                        
                            //Units in the same course ara adajacent
                            if (!$first) {

                                $unitList[$unit_key]->connectTo($prevNode);
                                print_r(prevNode);
                            }else{
                                $first = false;
                            }
                            $prevNode = $unitList[$unit_key];
                        }
                    }
                }
            }
        }

        return $G;
    }
}