<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('get_user_name')){
   function get_user_name($id){
       $ci =& get_instance();
       $ci->load->database();
       $query = $ci->db->get_where('user',array('id'=>$id));
       
       if($query->num_rows() > 0){
           $result = $query->row_array();
		   return $result['company_name'].' ('.$result['name'].')';
       }else{
           return false;
       }
   }
}


if ( ! function_exists('get_company_name')){
   function get_company_name($id){
       $ci =& get_instance();
       $ci->load->database();
       $query = $ci->db->get_where('about_shop_own',array('admin'=>$id));
       
       if($query->num_rows() > 0){
           $result = $query->row_array();
           return $result['shop_name'];
       }else{
           return false;
       }
   }
}
 
if ( ! function_exists('get_country_name')){
    function get_country_name($id){
        $ci =& get_instance();
        $ci->load->database();
        $query = $ci->db->get_where('country',array('id'=>$id));
        
        if($query->num_rows() > 0){
            $result = $query->row_array();
            return $result['country_name'];
        }else{
            return false;
        }
    }
 }
?>