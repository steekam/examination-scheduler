<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    if (!function_exists('simplify_schedule')){
        /**
         * Create a better json format
         */
        function simplify_schedule($schedule){
            $CI =& get_instance();
            $simple_timetable = array();

            foreach ($schedule->timetable as $d => $day) {
                $this_day = array();
                foreach ($day as $p => $period) {
                    foreach ($period as $u => $unit) {
                        $unit->name = $CI->faculty_model->get_unit_name($u);
                        $unit->code = $u;
                        $unit->period = $p;
                        $this_day[] = $unit;
                    }
                }
                $simple_timetable[] = $this_day;
            }

            return $simple_timetable;
        }
    }