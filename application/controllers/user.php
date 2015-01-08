<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class user extends CI_Controller {

   function __construct() {
        parent::__construct();
        $this->load->model("query_model");
        $this->load->model("dropdown_menu");
    }

    public function index() {
        // echo "gggg";
        $this->load->view("template/header_user");

        $this->load->view("template/footer");
    }
    
      public function selling() {
       $this->load->view("template/header_user");
       $data['product'] = $this->dropdown_menu->getproduct();
        $this->load->view("user/selling",$data);
        $this->load->view("template/footer");
    }
    
        
      public function cancle_selling() {
       $this->load->view("template/header_user");
        $this->load->view("user/cancle_selling");
        $this->load->view("template/footer");
    }
    
         
      public function print_selling() {
       $this->load->view("template/header_user");
        $this->load->view("user/print_selling");
        $this->load->view("template/footer");
    }
     function gensellingid(){
        $sql="Select Max(substr(selling_id,-3))+1 as MaxID from  selling ";
        $rs['data']=$this->db->query($sql)->result_array();
         foreach ($rs['data'] as $row) {
            $dataid = $row['MaxID'];
            if($dataid==''){ 
                $std_id="SE000001";
            }else{
                $std_id="SE".sprintf("%06d",$dataid);
            }
        }
        $res=array(
            "maxid"=>$std_id
        );
        echo json_encode($res);
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
    
        public function create_selling() {
        $id_pro=$this->input->post("product_id");
        $ar_ins_sell = array(
            "onhand_now" => $this->input->post("onhand_now"),
        );
         $this->db->where("product_id", $id_pro)->update("product", $ar_ins_sell);
         
           $ar = array(
            "selling_id" => $this->input->post("selling_id"),
            "line_selling" => $this->input->post("line_selling"),
            "product_id" => $this->input->post("product_id"),
            "qty" => $this->input->post("qty"),
            "price" => $this->input->post("price"),
            "unit" => $this->input->post("unit"),
            "total" => $this->input->post("total"),
            "status" => $this->input->post("status"),
            "sell_date" => $this->input->post("sell_date"),
            "employee_id" => $this->input->post("employee_id"),
              
        );

        $this->db->insert("selling", $ar);
        
        }
        
        function search_cancle_selling(){
       $datest=$this->input->post("datestart");
       $dateend=$this->input->post("dateend");
       $pur_id=$this->input->post("selling_id");
       
       $selling_id="";
       if($pur_id==""  ){
       $selling_id="";
       }else{
         $selling_id=" and selling.selling_id like '%$pur_id%' ";
       }
        
      $sql = "
        select selling.* ,product.product_des,product.onhand_now
from selling
left join product on selling.product_id = product.product_id
         where selling.sell_date >='$datest' and selling.sell_date <='$dateend'
         $selling_id  and selling.status='1'
    ";
      //print_r($sql);
        $rs = $this->db->query($sql)->result_array();
        
       
       echo json_encode($rs);
       
       
   }
   
   
    function cancle_selling_del(){
       $id=$this->input->post("selling_id");
       $line= $this->input->post("line_selling");
       $id_pro=$this->input->post("product_id");
       
         $ar = array(
            "status" => $this->input->post("status"),
        );

        $this->db->where("selling_id", $id)->where("line_selling", $line)->update("selling", $ar);
        
        $ar_ins_pro = array(
            "onhand_now" => $this->input->post("qty"),
        );
        $this->db->where("product_id", $id_pro)->update("product", $ar_ins_pro);

   }
   
    function search_print_sell(){
       $datest=$this->input->post("datestart");
       $dateend=$this->input->post("dateend");
       $pur_id=$this->input->post("selling_id");
       
       $selling_id="";
       if($pur_id==""  ){
       $selling_id="";
       }else{
         $selling_id=" and selling.selling_id like '%$pur_id%' ";
       }
        
      $sql = "
       select selling.sell_date,selling.selling_id,
count(selling.selling_id) as selling_id_qty,
sum(selling.total) as total from selling

         where sell_date >='$datest' and sell_date <='$dateend'
         $selling_id
group by selling.sell_date,selling.selling_id
    ";
      //print_r($sql);
        $rs = $this->db->query($sql)->result_array();
        
       
       echo json_encode($rs);
   }
   
   function getselling_sum($id){
       
        $sql = "
       select sum(selling.total) as total from selling

        where selling.selling_id='$id'
        group by selling.selling_id
    ";
   // print_r($sql);
        $rs = $this->db->query($sql)->row_array();
       echo json_encode($rs);
   }
   
   function getselling_print($idprint){
       
   }
    
}