<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('is_logged_in')){

    /**
     * Checks whether there is an active session
     */
    function is_logged_in(){
        $CI =& get_instance();
        if(!$CI->session->has_userdata('logged_in')){
            redirect(base_url());
        }
    }
}