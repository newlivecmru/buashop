<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("query_model");
        $this->load->model("dropdown_menu");
    }

    public function index() {
        // echo "gggg";
        $this->load->view("template/header");

        $this->load->view("template/footer");
    }

    public function employee() {
        $this->load->view("template/header");
        $data['datashow'] = $this->query_model->getemployee();
        $this->load->view("admin/employee", $data);
        //echo json_encode($data);
        $this->load->view("template/footer");
    }

    public function product_type() {
        $this->load->view("template/header");
        $data['datashow'] = $this->query_model->getproductype();
        $this->load->view("admin/product_type", $data);
        $this->load->view("template/footer");
    }

    public function product() {
        $this->load->view("template/header");
        $data['datashow'] = $this->query_model->getproduct();
        $data['product_type'] = $this->dropdown_menu->getproduct_type();
        $data['supplier'] = $this->dropdown_menu->getsupplier();
        $this->load->view("admin/product", $data);
        $this->load->view("template/footer");
    }

    public function admins() {
        $this->load->view("template/header");
        $data['datashow'] = $this->query_model->get_ddmin();
        $this->load->view("admin/admin", $data);
        $this->load->view("template/footer");
    }

    public function supplier() {
        $this->load->view("template/header");
        $data['datashow'] = $this->query_model->getsupplier();
        $this->load->view("admin/supplier", $data);
        $this->load->view("template/footer");
    }

    public function purchase() {
        $this->load->view("template/header");
        $data['product'] = $this->dropdown_menu->getproduct();
        $this->load->view("admin/purchase", $data);
        $this->load->view("template/footer");
    }

    public function receive() {
        $this->load->view("template/header");
        $this->load->view("admin/receive");
        $this->load->view("template/footer");
    }

    public function cancel_purch() {
        $this->load->view("template/header");
        $this->load->view("admin/cancel_purch");
        $this->load->view("template/footer");
    }
    
    public function cancel_rec() {
        $this->load->view("template/header");
        $this->load->view("admin/cancel_rec");
        $this->load->view("template/footer");
    }


    public function print_purch() {
        $this->load->view("template/header");
        $this->load->view("admin/print_purch");
        $this->load->view("template/footer");
    }

    public function report_purchase() {
        $this->load->view("template/header");
       $data['product'] = $this->dropdown_menu->getproduct();
        $data['product_type'] = $this->dropdown_menu->getproduct_type();
        $this->load->view("admin/report_purchase",$data);
        $this->load->view("template/footer");
    }

    public function report_sellling() {
        $this->load->view("template/header");
          $data['product'] = $this->dropdown_menu->getproduct();
        $data['product_type'] = $this->dropdown_menu->getproduct_type();
        $this->load->view("admin/report_sellling",$data);
        $this->load->view("template/footer");
    }

    public function reorder_point() {
        $this->load->view("template/header");
             $data['product'] = $this->dropdown_menu->getproduct();
        $data['product_type'] = $this->dropdown_menu->getproduct_type();
        $this->load->view("admin/reorder_point",$data);
        $this->load->view("template/footer");
    }

    public function getemployee() {
        $data['datashow'] = $this->query_model->getemployee();
        echo json_encode($data);
    }

    public function createemployee() {
        $ar = array(
            "employee_id" => $this->input->post("employee_id"),
            "name" => $this->input->post("name"),
            "surename" => $this->input->post("surename"),
            "age" => $this->input->post("age"),
            "id_card" => $this->input->post("id_card"),
            "address" => $this->input->post("address"),
            "tel" => $this->input->post("tel"),
            "username" => $this->input->post("username"),
            "password" => $this->input->post("password"),
            "user_type" => $this->input->post("user_type"),
        );

        $this->db->insert("employee", $ar);
        // echo "ok";
        $ar = array(
            "employee_id" => $this->input->post("employee_id"),
            "name" => $this->input->post("name"),
            "surename" => $this->input->post("surename"),
            "age" => $this->input->post("age"),
            "id_card" => $this->input->post("id_card"),
            "address" => $this->input->post("address"),
            "tel" => $this->input->post("tel"),
            "username" => $this->input->post("username"),
            "password" => $this->input->post("password"),
            "user_type" => $this->input->post("user_type"),
        );
        echo json_encode($ar);
    }

    public function delemployee($id) {
        $this->db->where("employee_id", $id)->delete("employee");
        echo "ok";
    }

    public function geteditemployee($id) {

        $rs = $this->db->where("employee_id", $id)->get("employee")->row_array();
        echo json_encode($rs);
    }

    public function editemployee($id) {
        $ar = array(
            "name" => $this->input->post("name"),
            "surename" => $this->input->post("surename"),
            "age" => $this->input->post("age"),
            "id_card" => $this->input->post("id_card"),
            "address" => $this->input->post("address"),
            "tel" => $this->input->post("tel"),
            "username" => $this->input->post("username"),
            "password" => $this->input->post("password"),
            "user_type" => $this->input->post("user_type"),
        );

        $this->db->where("employee_id", $id)->update("employee", $ar);
        $rs = $this->db->where("user_type", 2)->get("employee")->result_array();
        echo json_encode($rs);
    }

    public function genEmployeeId() {
        $data['datashow'] = $this->query_model->genEmployeeId();
        echo json_encode($data);
    }

    public function createproduct_type() {
        $ar = array(
            "product_type_id" => $this->input->post("product_type_id"),
            "product_type_des" => $this->input->post("product_type_des"),
        );

        $this->db->insert("product_type", $ar);
        // echo "ok";
        $ar = array(
            "product_type_id" => $this->input->post("product_type_id"),
            "product_type_des" => $this->input->post("product_type_des"),
        );
        echo json_encode($ar);
    }

    public function delproductype($id) {
        $this->db->where("product_type_id", $id)->delete("product_type");
        echo "ok";
    }

    public function geteditproductype($id) {

        $rs = $this->db->where("product_type_id", $id)->get("product_type")->row_array();
        echo json_encode($rs);
    }

    public function editproductype($id) {
        $ar = array(
            "product_type_des" => $this->input->post("product_type_des"),
        );

        $this->db->where("product_type_id", $id)->update("product_type", $ar);
        $rs = $this->db->get("product_type")->result_array();
        echo json_encode($rs);
    }

    public function createproduct() {
        $ar = array(
            "ref_product_type_id" => $this->input->post("ref_product_type_id"),
            "product_id" => $this->input->post("product_id"),
            "product_des" => $this->input->post("product_des"),
            "ref_supplier_id" => $this->input->post("ref_supplier_id"),
            "onhand_now" => $this->input->post("onhand_now"),
            "price" => $this->input->post("price"),
            "unit" => $this->input->post("unit"),
            "discount" => $this->input->post("discount"),
        );

        $this->db->insert("product", $ar);
        // echo "ok";

        $rs['data'] = $this->query_model->getproduct_byid($ar);
        foreach ($rs['data'] as $row) {
            $dataid = $row['product_type_des'];
            $datasup = $row['supplier_name'];
        }
        $res = array(
            "product_type_des" => $dataid,
            "product_id" => $this->input->post("product_id"),
            "product_des" => $this->input->post("product_des"),
            "supplier_name" => $datasup,
            "onhand_now" => $this->input->post("onhand_now"),
            "price" => $this->input->post("price"),
            "unit" => $this->input->post("unit"),
            "discount" => $this->input->post("discount"),
        );
        echo json_encode($res);
    }

    public function delproduct($id) {
        $this->db->where("product_id", $id)->delete("product");
        echo "ok";
    }

    public function geteditproduct($id) {

        $rs = $this->db->where("product_id", $id)->get("product")->row_array();
        echo json_encode($rs);
    }

    public function editproduct($id) {
        $ar = array(
            "ref_product_type_id" => $this->input->post("ref_product_type_id"),
            "product_des" => $this->input->post("product_des"),
            "ref_supplier_id" => $this->input->post("ref_supplier_id"),
            "onhand_now" => $this->input->post("onhand_now"),
            "price" => $this->input->post("price"),
            "unit" => $this->input->post("unit"),
            "discount" => $this->input->post("discount"),
        );

        $this->db->where("product_id", $id)->update("product", $ar);
        $rs = $this->query_model->getproduct();
        echo json_encode($rs);
    }

    public function createsupplier() {
        $ar = array(
            "supplier_id" => $this->input->post("supplier_id"),
            "supplier_name" => $this->input->post("supplier_name"),
            "address" => $this->input->post("address"),
            "tel" => $this->input->post("tel"),
            "fax" => $this->input->post("fax"),
            "email" => $this->input->post("email")
        );

        $this->db->insert("supplier", $ar);
        // echo "ok";
        $ar = array(
            "supplier_id" => $this->input->post("supplier_id"),
            "supplier_name" => $this->input->post("supplier_name"),
            "address" => $this->input->post("address"),
            "tel" => $this->input->post("tel"),
            "fax" => $this->input->post("fax"),
            "email" => $this->input->post("email")
        );
        echo json_encode($ar);
    }

    public function delsupplier($id) {
        $this->db->where("supplier_id", $id)->delete("supplier");
        echo "ok";
    }

    public function geteditsupplier($id) {

        $rs = $this->db->where("supplier_id", $id)->get("supplier")->row_array();
        echo json_encode($rs);
    }

    public function editsupplier($id) {
        $ar = array(
            "supplier_name" => $this->input->post("supplier_name"),
            "email" => $this->input->post("email"),
            "tel" => $this->input->post("tel"),
            "fax" => $this->input->post("fax"),
            "address" => $this->input->post("address"),
        );

        $this->db->where("supplier_id", $id)->update("supplier", $ar);
        $rs = $this->query_model->getsupplier();
        echo json_encode($rs);
    }

    public function createadmin() {
        $ar = array(
            "employee_id" => $this->input->post("employee_id"),
            "name" => $this->input->post("name"),
            "surename" => $this->input->post("surename"),
            "age" => $this->input->post("age"),
            "id_card" => $this->input->post("id_card"),
            "address" => $this->input->post("address"),
            "tel" => $this->input->post("tel"),
            "username" => $this->input->post("username"),
            "password" => $this->input->post("password"),
            "user_type" => $this->input->post("user_type"),
        );

        $this->db->insert("employee", $ar);
        // echo "ok";
        $ar = array(
            "employee_id" => $this->input->post("employee_id"),
            "name" => $this->input->post("name"),
            "surename" => $this->input->post("surename"),
            "age" => $this->input->post("age"),
            "id_card" => $this->input->post("id_card"),
            "address" => $this->input->post("address"),
            "tel" => $this->input->post("tel"),
            "username" => $this->input->post("username"),
            "password" => $this->input->post("password"),
            "user_type" => $this->input->post("user_type"),
        );
        echo json_encode($ar);
    }

    public function deladmin($id) {
        $this->db->where("employee_id", $id)->delete("employee");
        echo "ok";
    }

    public function geteditadmin($id) {

        $rs = $this->db->where("employee_id", $id)->get("employee")->row_array();
        echo json_encode($rs);
    }

    public function editadmin($id) {
        $ar = array(
            "name" => $this->input->post("name"),
            "surename" => $this->input->post("surename"),
            "age" => $this->input->post("age"),
            "id_card" => $this->input->post("id_card"),
            "address" => $this->input->post("address"),
            "tel" => $this->input->post("tel"),
            "username" => $this->input->post("username"),
            "password" => $this->input->post("password"),
            "user_type" => $this->input->post("user_type"),
        );

        $this->db->where("employee_id", $id)->update("employee", $ar);
        $rs = $this->db->where("user_type", 1)->get("employee")->result_array();
        echo json_encode($rs);
    }

    public function getchangeproduct($id) {
  
         $sql = "
   SELECT product_type.product_type_id,product_type.product_type_des,product.product_id,product.product_des,
product.onhand_now,product.price,product.unit,product.discount,supplier.supplier_id,supplier.supplier_name
from product
left JOIN product_type on product.ref_product_type_id=product_type.product_type_id
left join supplier on product.ref_supplier_id=supplier.supplier_id
where product_id='$id'
    ";
     $rs=  $this->db->query($sql)->row_array();

       echo json_encode($rs);
    }
    
    
    function genproductid(){
        
        $sql="Select Max(substr(product_id,-3))+1 as MaxID from  product";
        $rs['data']=$this->db->query($sql)->result_array();
         foreach ($rs['data'] as $row) {
            $dataid = $row['MaxID'];
            if($dataid==''){ 
                $std_id="P001";
            }else{
                $std_id="P".sprintf("%03d",$dataid);
            }
        }
        $res=array(
            "maxid"=>$std_id
        );
        echo json_encode($res);
    }
    
     function genempid(){
        $sql="Select Max(substr(employee_id,-3))+1 as MaxID from  employee";
        $rs['data']=$this->db->query($sql)->result_array();
         foreach ($rs['data'] as $row) {
            $dataid = $row['MaxID'];
            if($dataid==''){ 
                $std_id="E001";
            }else{
                $std_id="E".sprintf("%03d",$dataid);
            }
        }
        $res=array(
            "maxid"=>$std_id
        );
        echo json_encode($res);
    }
    
     function genproductype(){
        $sql="Select Max(substr(product_type_id,-3))+1 as MaxID from  product_type";
        $rs['data']=$this->db->query($sql)->result_array();
         foreach ($rs['data'] as $row) {
            $dataid = $row['MaxID'];
            if($dataid==''){ 
                $std_id="T001";
            }else{
                $std_id="T".sprintf("%03d",$dataid);
            }
        }
        $res=array(
            "maxid"=>$std_id
        );
        echo json_encode($res);
    }
    
     function gensupplier(){
        $sql="Select Max(substr(supplier_id,-3))+1 as MaxID from  supplier";
        $rs['data']=$this->db->query($sql)->result_array();
         foreach ($rs['data'] as $row) {
            $dataid = $row['MaxID'];
            if($dataid==''){ 
                $std_id="SU001";
            }else{
                $std_id="SU".sprintf("%03d",$dataid);
            }
        }
        $res=array(
            "maxid"=>$std_id
        );
        echo json_encode($res);
    }
    
     function genpurchaseid(){
        $sql="Select Max(substr(purchase_id,-3))+1 as MaxID from  purchase ";
        $rs['data']=$this->db->query($sql)->result_array();
         foreach ($rs['data'] as $row) {
            $dataid = $row['MaxID'];
            if($dataid==''){ 
                $std_id="PU001";
            }else{
                $std_id="PU".sprintf("%03d",$dataid);
            }
        }
        $res=array(
            "maxid"=>$std_id
        );
        echo json_encode($res);
    }
    
   function createpurchase(){
          $ar = array(
            "purchase_id" => $this->input->post("purchase_id"),
            "product_id" => $this->input->post("product_id"),
            "supplier_id" => $this->input->post("supplier_id"),
            "qty" => $this->input->post("qty"),
            "price" => $this->input->post("price"),
            "unit" => $this->input->post("unit"),
            "total" => $this->input->post("total"),
            "status" => $this->input->post("status"),
            "purchase_date" => $this->input->post("purchase_date"),
            "line_purchase" => $this->input->post("line_purchase"),
            "noreceive" => $this->input->post("noreceive"),
              
        );

        $this->db->insert("purchase", $ar);
        //echo "ok";
   }
   
   function searchreceive(){
       $datest=$this->input->post("datestart");
       $dateend=$this->input->post("dateend");
       $pur_id=$this->input->post("purchaseid");
       
       $puuchase_id="";
       if($pur_id==""  ){
       $puuchase_id="";
       }else{
         $puuchase_id=" and purchase.purchase_id like '%$pur_id%' ";
       }
        
      $sql = "
         SELECT 
         purchase.purchase_id,	
        purchase.line_purchase,	
        purchase.product_id,	
        purchase.supplier_id,	
        purchase.qty,	
        purchase.price,	
        purchase.unit,	
        purchase.total,	
        purchase.status,	
        purchase.purchase_date,
        product.product_des,	
        product.onhand_now,	
        supplier.supplier_name,
        purchase.noreceive
         FROM  purchase
         LEFT JOIN product ON purchase.product_id = product.product_id
         left join supplier on supplier.supplier_id = purchase.supplier_id
         where purchase_date >='$datest' and purchase_date <='$dateend'
         and  (purchase.status= '1' or  purchase.status= '2')
         $puuchase_id
    ";
      //print_r($sql);
        $rs = $this->db->query($sql)->result_array();
        
       
       echo json_encode($rs);
       
       
   }
   
   function createreceive(){
       $id=$this->input->post("purchase_id");
       $line= $this->input->post("line_purchase");
       $id_pro=$this->input->post("product_id");
       
         $ar = array(
            "status" => $this->input->post("status"),
            "noreceive" => $this->input->post("nonereceive"),
        );

        $this->db->where("purchase_id", $id)->where("line_purchase", $line)->update("purchase", $ar);
        
        $ar_ins_pro = array(
            "onhand_now" => $this->input->post("qty"),
        );
         $this->db->where("product_id", $id_pro)->update("product", $ar_ins_pro);
        
         $ar_ins = array(
            "purchase_id" => $this->input->post("purchase_id"),
            "line_purchase" => $this->input->post("line_purchase"),
            "qty_recieve" => $this->input->post("receive_qty"),
            "status" => $this->input->post("status"),
            "none_receive" => $this->input->post("nonereceive"),
            "product_id"=>$this->input->post("product_id"),
            "unit"=>$this->input->post("unit"),
            "employee_id"=>$this->input->post("employeeid"),
           "receive_date"=>$this->input->post("receivedate"),
        );
        $this->db->insert("receive", $ar_ins);

   }
   
   function search_print_pur(){
       $datest=$this->input->post("datestart");
       $dateend=$this->input->post("dateend");
       $pur_id=$this->input->post("purchaseid");
       
       $puuchase_id="";
       if($pur_id==""  ){
       $puuchase_id="";
       }else{
         $puuchase_id=" and purchase.purchase_id like '%$pur_id%' ";
       }
        
      $sql = "
       select purchase.purchase_date,purchase.purchase_id,
count(purchase.purchase_id) as purchase_id_qty,
sum(purchase.total) as total from purchase

         where purchase_date >='$datest' and purchase_date <='$dateend'
         $puuchase_id
group by purchase.purchase_date,purchase.purchase_id
    ";
      //print_r($sql);
        $rs = $this->db->query($sql)->result_array();
        
       
       echo json_encode($rs);
   }
   
   
    function search_cancle_purchase(){
       $datest=$this->input->post("datestart");
       $dateend=$this->input->post("dateend");
       $pur_id=$this->input->post("purchaseid");
       
       $puuchase_id="";
       if($pur_id==""  ){
       $puuchase_id="";
       }else{
         $puuchase_id=" and purchase.purchase_id like '%$pur_id%' ";
       }
        
      $sql = "
         SELECT 
         purchase.purchase_id,	
        purchase.line_purchase,	
        purchase.product_id,	
        purchase.supplier_id,	
        purchase.qty,	
        purchase.price,	
        purchase.unit,	
        purchase.total,	
        purchase.status,	
        purchase.purchase_date,
        product.product_des,	
        product.onhand_now,	
        supplier.supplier_name,
        purchase.noreceive
        FROM  purchase
         LEFT JOIN product ON purchase.product_id = product.product_id
         left join supplier on supplier.supplier_id = purchase.supplier_id
         where purchase_date >='$datest' and purchase_date <='$dateend'
         and  (purchase.status= '1')
         $puuchase_id
    ";
      //print_r($sql);
        $rs = $this->db->query($sql)->result_array();
        
       
       echo json_encode($rs);
       
       
   }
   
  public function del_purchase($id,$lineid) {
        $this->db->where("purchase_id", $id)->where("line_purchase", $lineid)->delete("purchase");
        echo "ok";
    }
    
    function search_cancle_receive(){
       $datest=$this->input->post("datestart");
       $dateend=$this->input->post("dateend");
       $pur_id=$this->input->post("purchaseid");
       
       $puuchase_id="";
       if($pur_id==""  ){
       $puuchase_id="";
       }else{
         $puuchase_id=" and purchase.purchase_id like '%$pur_id%' ";
       }
        
      $sql = "
        select receive.* ,product.product_des,product.onhand_now,purchase.qty as qty_pur
from receive
left join product on receive.product_id = product.product_id
left join purchase on receive.purchase_id=purchase.purchase_id and receive.line_purchase=purchase.line_purchase
         where receive.receive_date >='$datest' and receive.receive_date <='$dateend'
         $puuchase_id
    ";
      //print_r($sql);
        $rs = $this->db->query($sql)->result_array();
        
       
       echo json_encode($rs);
       
       
   }
   
     function canclereceive() {
        $id = $this->input->post("purchase_id");
        $line = $this->input->post("line_purchase");
        $id_pro = $this->input->post("product_id");

        $ar = array(
            "status" => $this->input->post("status"),
            "noreceive" => $this->input->post("nonereceive"),
        );

        $this->db->where("purchase_id", $id)->where("line_purchase", $line)->update("purchase", $ar);

        $ar_ins_pro = array(
            "onhand_now" => $this->input->post("qty"),
        );
        $this->db->where("product_id", $id_pro)->update("product", $ar_ins_pro);
        $this->db->where("purchase_id", $id)->where("line_purchase", $line)->delete("receive");
    }

   


}

