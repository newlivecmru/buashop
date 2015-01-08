<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class login extends CI_Controller {

    function __construct() {
  parent::__construct();
  $this->load->model('users_model','users');
  $this->load->library(array('session','form_validation'));
  $this->load->helper(array('url','html','form'));
    }
    

    public function index() {
  if(! $this->session->userdata('logged')){
      redirect('login/user_login');
  }else{  
     $this->load->view("template/header");
     $this->load->view("template/footer");
  }
  
    }
    function user_login()
    {
        $this->load->view("login/index"); 
    }
    
    
    function dologin(){
        
 $post=$this->input->post();
 $username=$this->input->post('username');
 $password=$this->input->post('password');
 
 $sql="select * from employee where username='$username' and password='$password' ";
 $data=$this->db->query($sql)->result_array();
 
 if(count($data)>0){
     $_SESSION["username"]=$data[0]["username"];
     $_SESSION["userid"]=$data[0]["employee_id"];
     
     if($data[0]["user_type"] == "1"){
        redirect('admin');
      
     }else{
        redirect('user');
     }
     
     
     
 }else{

    $this->load->view("login/no_login");  

 }
    }
    
//    function dologin(){
//       $this->form_validation->set_rules('username','username','required');
//       $this->form_validation->set_rules('password','password','required');
//       
//      $this->form_validation->set_error_delimiters('<font color=red>','</font>'); 
//      
//      if($this->input->post('submit')){
//          $username=$this->input->post('username');
//         $password=$this->input->post('password');
//          
//      if($this->form_validation->run()){
//          $check=$this->users->_checkuser($username,$password);
//          if($check){
//              
//              $data=array(
//                  'username'=>$username,
//                  'logged'=>TRUE
//              );
//              $this->session->set_userdata($data);
//              redirect('admin');
//              
//          }else{
//              $this->session->set_flashdata('msg_error','รหัสผ่านไม่ถูกต้อง กรุณาตรวจสอบ');
//             $this->load->view("login/index");   
//          }
//          
//      } else{
//              $this->session->set_flashdata('msg_error','กรุณากรอกข้อมูลให้ครบ');
//             $this->load->view("login/index");    
//             
//         }
//         
//      }else{
//             $this->load->view("login/index");  
//        }
// 
//    }
    
    function logout(){
        $this->session->sess_destroy();
       redirect('admin');
    }
    
}