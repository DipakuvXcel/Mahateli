<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_cat_name')){
   function get_cat_name($id){
       $ci =& get_instance();
       $ci->load->database();
       $query = $ci->db->get_where('product_category',array('id'=>$id));
       
       if($query->num_rows() > 0){
           $result = $query->row_array();
           return $result['name'];
       }else{
           return false;
       }
   }
}

if ( ! function_exists('get_offer_name')){
   function get_offer_name($id){
       $ci =& get_instance();
       $ci->load->database();
       $query = $ci->db->get_where('product_both_together',array('id'=>$id));
       
       if($query->num_rows() > 0){
           $result = $query->row_array();
           return $result['name'];
       }else{
           return false;
       }
   }
}

if ( ! function_exists('get_subcat_name')){
   function get_subcat_name($id){
       $ci =& get_instance();
       $ci->load->database();
       $query = $ci->db->get_where('product_subcategory',array('id'=>$id));
       
       if($query->num_rows() > 0){
           $result = $query->row_array();
           return $result['name'];
       }else{
           return false;
       }
   }
}

if ( ! function_exists('get_combo_name')){
   function get_combo_name($id){
       $ci =& get_instance();
       $ci->load->database();
       $query = $ci->db->get_where('combo_product',array('id'=>$id));
       
       if($query->num_rows() > 0){
           $result = $query->row_array();
           return $result['product_name'];
       }else{
           return false;
       }
   }
}

if ( ! function_exists('get_goals_name')){
   function get_goals_name($id){
       $ci =& get_instance();
       $ci->load->database();
       $query = $ci->db->get_where('goals',array('id'=>$id));
       
       if($query->num_rows() > 0){
           $result = $query->row_array();
           return $result['name'];
       }else{
           return false;
       }
   }
}

if ( ! function_exists('get_childcat_name')){
   function get_childcat_name($id){
       $ci =& get_instance();
       $ci->load->database();
       $query = $ci->db->get_where('product_childcategory',array('id'=>$id));
       
       if($query->num_rows() > 0){
           $result = $query->row_array();
           return $result['name'];
       }else{
           return false;
       }
   }
}

if ( ! function_exists('get_user_name')){
   function get_user_name($id){
       $ci =& get_instance();
       $ci->load->database();
       $query = $ci->db->get_where('user',array('id'=>$id));
       
       if($query->num_rows() > 0){
           $result = $query->row_array();
		   return $result['name'];
       }else{
           return false;
       }
   }
}

if ( ! function_exists('get_product_name')){
   function get_product_name($id){
       $ci =& get_instance();
       $ci->load->database();
       $query = $ci->db->get_where('products',array('product_id'=>$id));
       
       if($query->num_rows() > 0){
           $result = $query->row_array();
           return $result['product_name'];
       }else{
           return false;
       }
   }
}

if ( ! function_exists('get_product_profile_image')){
   function get_product_profile_image($id){
       $ci =& get_instance();
       $ci->load->database();
       $query = $ci->db->get_where('products',array('product_id'=>$id));
       
       if($query->num_rows() > 0){
           $result = $query->row_array();
           return $result['image'];
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

if ( ! function_exists('get_blog_cat_name')){
    function get_blog_cat_name($id){
        $ci =& get_instance();
        $ci->load->database();
        $query = $ci->db->get_where('blog_category',array('id'=>$id));
        
        if($query->num_rows() > 0){
            $result = $query->row_array();
            return $result['name'];
        }else{
            return false;
        }
    }
 }
 
 if ( ! function_exists('get_flavour_name')){
    function get_flavour_name($id){
        $ci =& get_instance();
        $ci->load->database();
        $query = $ci->db->get_where('flavour',array('id'=>$id));
        
        if($query->num_rows() > 0){
            $result = $query->row_array();
            return $result['name'];
        }else{
            return false;
        }
    }
 }
 
 if ( ! function_exists('get_brand_name')){
    function get_brand_name($id){
        $ci =& get_instance();
        $ci->load->database();
        $query = $ci->db->get_where('brands',array('id'=>$id));
        
        if($query->num_rows() > 0){
            $result = $query->row_array();
            return $result['name'];
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

if ( ! function_exists('get_state_name')){
   function get_state_name($id){
       $ci =& get_instance();
       $ci->load->database();
       $query = $ci->db->get_where('state',array('id'=>$id));
       
       if($query->num_rows() > 0){
           $result = $query->row_array();
           return $result['state_name'];
       }else{
           return false;
       }
   }
}
 
if ( ! function_exists('get_city_name')){
   function get_city_name($id){
       $ci =& get_instance();
       $ci->load->database();
       $query = $ci->db->get_where('city',array('id'=>$id));
       
       if($query->num_rows() > 0){
           $result = $query->row_array();
           return $result['city_name'];
       }else{
           return false;
       }
   }
}

if ( ! function_exists('get_area_name')){
   function get_area_name($id){
       $ci =& get_instance();
       $ci->load->database();
       $query = $ci->db->get_where('pincode',array('id'=>$id));
       
       if($query->num_rows() > 0){
           $result = $query->row_array();
           return $result['area_name'];
       }else{
           return false;
       }
   }
}

if ( ! function_exists('get_experts_name')){
   function get_experts_name($id){
       $ci =& get_instance();
       $ci->load->database();
       $query = $ci->db->get_where('users',array('id'=>$id));
       
       if($query->num_rows() > 0){
           $result = $query->row_array();
		   return $result['name'];
       }else{
           return false;
       }
   }
}

 
?>