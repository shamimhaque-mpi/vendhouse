<?php

class Balance_sheet extends Admin_Controller {

   function __construct() {
        parent::__construct();

        $this->load->model('action');
    }
    
    public function index($emit = NULL) {
        $this->data['meta_title'] = 'Balance Sheet';
        $this->data['active'] = 'data-target="report_menu"';
        $this->data['subMenu'] = 'data-target="balance"';
        $this->data['confirmation'] = $this->data['cost'] = $this->data['income'] = NULL;
        $this->data['purchase'] = $this->data['installment'] = NULL;

         if(isset($_POST['show'])){
            $where=$whereS=array();           
             foreach ($_POST['date'] as $key => $value) {
                if($value != NULL && $key=="from"){
                    $where["date >="]=$value;
                    $whereS["date >="]=$value;
                }
               if($value != NULL && $key=="to"){
                    $where["date <="]=$value;
                    $whereS["date <="]=$value;
                }                
            }  

            $whereS['quantity >'] = 0;


          $this->data['cost'] = $this->action->read('cost',$where);  
          $this->data['income'] = $this->action->readGroupBy('sale','voucher_number',$whereS);     
          $this->data['purchase'] = $this->action->readGroupBy('purchase','voucher_no',$where);     
               
        }


      
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);        
        $this->load->view('components/report/balance_sheet', $this->data);
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

