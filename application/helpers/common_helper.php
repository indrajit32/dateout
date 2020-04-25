<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}


   function get_all_user(){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database
       $query = $ci->db->get('users');

	   $result = $query->result_array();

	   return $result; 
   }


  function get_all_deals(){

     $ci =& get_instance();
     $ci->load->database();

        $ci->db->select("*");
        $ci->db->from("products_translations");
        $ci->db->where('abbr', 'en');
        $query = $ci->db->get();

      return $query->result_array();
  }

    function get_deal_by_id($id){

      $ci =& get_instance();
      $ci->load->database();

      $ci->db->select("title");
      $ci->db->from("products_translations");
      $ci->db->where(array('abbr'=>'en','for_id'=>$id));
      $query = $ci->db->get();

      return $query->result_array();
  }

  function get_user_by_id($id){

      $ci =& get_instance();
      $ci->load->database();

      $ci->db->select("username");
      $ci->db->from("users");
      $ci->db->where(array('id'=>$id));
      $query = $ci->db->get();

      return $query->result_array();
  }

    function get_review_images_by_id($id){

      $ci =& get_instance();
      $ci->load->database();

      $ci->db->select("*");
      $ci->db->from("product_review_images");
      $ci->db->where(array('product_review_id'=>$id));
      $query = $ci->db->get();

      return $query->result_array();
  }

    function get_explore_images_by_id($id){

      $ci =& get_instance();
      $ci->load->database();

      $ci->db->select("*");
      $ci->db->from("explore_image");
      $ci->db->where(array('explore_id'=>$id));
      $query = $ci->db->get();

      return $query->result_array();
  }

    function count_explore_list($abbr){

      $ci =& get_instance();
      $ci->load->database();

      $ci->db->where('abbr', $abbr);
      $query = $ci->db->get('explore');
      return $query->num_rows();
    }
