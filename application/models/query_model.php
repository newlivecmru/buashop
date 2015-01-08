<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class query_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function getemployee() {

        $sql = "select * from employee
        WHERE user_type = '2'
        ";
        $datashow = $this->db->query($sql);
        return $datashow->result_array();
    }

    public function get_ddmin() {

        $sql = "select * from employee
        WHERE user_type = '1'
        ";
        $datashow = $this->db->query($sql);
        return $datashow->result_array();
    }

    public function getemployeebyid($id) {

        $sql = "select * from employee
        WHERE user_type = '2' and employee_id='" + $id + "'
        ";
        $datashow = $this->db->query($sql);
        return $datashow->result_array();
    }

    public function genemployeeid() {

        $sql = "SELECT id+1  AS idemp
        FROM (
        SELECT SUBSTRING( MAX(employee_id) , 2 ) AS id
        FROM  employee
       WHERE  employee_id LIKE  'E%'
        ) AS data1 ";
        $datashow = $this->db->query($sql)->row();

        $input = $datashow;

        $genid = str_pad($input, 3, "0", STR_PAD_LEFT);
        $idEmp = "E" + $genid;
        return $idEmp;
    }

    public function getproductype() {

        $sql = "select * from product_type ";
        $datashow = $this->db->query($sql);
        return $datashow->result_array();
    }

    public function getproduct() {

        $sql = "SELECT product_type.product_type_des,product.product_id,product.product_des,
product.onhand_now,product.price,product.unit,product.discount,supplier.supplier_name
from product
left JOIN product_type on product.ref_product_type_id=product_type.product_type_id
left join supplier on product.ref_supplier_id=supplier.supplier_id";
        $datashow = $this->db->query($sql);
        return $datashow->result_array();
    }

    public function getproduct_byid($post) {

        $sql = "
            SELECT product_type.product_type_des,product.product_id,product.product_des,
product.onhand_now,product.price,product.unit,product.discount,supplier.supplier_name
from product
left JOIN product_type on product.ref_product_type_id=product_type.product_type_id
left join supplier on product.ref_supplier_id=supplier.supplier_id
where product_id='$post[product_id]'
    ";
        // print_r($sql);
        $datashow = $this->db->query($sql);
        return $datashow->result_array();
    }

    public function getsupplier() {

        $sql = "select * from supplier";
        $datashow = $this->db->query($sql);
        return $datashow->result_array();
    }

    public function getproductchange_byid($post) {

        $sql = "
            SELECT product_type.product_type_des,product.product_id,product.product_des,
product.onhand_now,product.price,product.unit,product.discount,supplier.supplier_name
from product
left JOIN product_type on product.ref_product_type_id=product_type.product_type_id
left join supplier on product.ref_supplier_id=supplier.supplier_id
where product_id='$post[product_id]'
    ";
        // print_r($sql);
        $datashow = $this->db->query($sql);
        return $datashow->result_array();
    }


}
