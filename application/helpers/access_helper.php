<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('is_logged_in')){

    /**
     * Checks whether there is an active session
     */
    function is_logged_in($valid_user){
        $CI =& get_instance();
        if(!$CI->session->has_userdata('logged_in') || $CI->session->userdata('role') != $valid_user){
            redirect(base_url());
        }
    }
}