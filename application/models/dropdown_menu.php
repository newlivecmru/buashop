<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class dropdown_menu extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
  public function getproduct_type() {

      $this->db->select("*")->from("product_type");
      return $this->db->get();
    }

    public function getsupplier() {

      $this->db->select("*")->from("supplier");
      return $this->db->get();
    }
    
     public function getproduct() {

      $this->db->select("*")->from("product");
      return $this->db->get();
    }
    
 }
