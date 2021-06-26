<?php

class Profit_loss extends Admin_Controller {

   function __construct() {
        parent::__construct();

        $this->load->model('action');
    }
    
    public function index($emit = NULL) {
        $this->data['meta_title'] = 'Profit Loss';
        $this->data['active'] = 'data-target="report_menu"';
        $this->data['subMenu'] = 'data-target="Profit"';
        $this->data['confirmation'] =  $this->data["sales"] = NULL;       
        

        $where = array('date' => date('Y-m-d'));       
        $this->data["sales"] = $this->action->readGroupBy("sale", "voucher_number" , $where);   
          
       
        if(isset($_POST['show'])){
          $where = array();
          
          foreach($_POST['search'] as $key=>$value){
            if($value != NULL){
              $where[$key] = $value;
            }
          }
          if(isset($_POST['date'])){
            foreach($_POST['date'] as $key=>$value){
              if($value != NULL && $key=="from"){
                 $where['date >='] = $value;
              }
              
              if($value != NULL && $key=="to"){
                $where['date <='] = $value;
              }
            }
          }
          
          $this->data["sales"] = $this->action->readGroupBy("sale", "voucher_number" , $where);  
            
          
       }
        
      
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);        
        $this->load->view('components/report/profit_loss', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    } 
    
    
  
   private function holder() {
		$holder = config_item('privilege');		
        if(!(in_array($this->session->userdata('holder'), $holder))){
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }

}

