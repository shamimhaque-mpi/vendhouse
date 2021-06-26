<?php

class Daily_report extends Admin_Controller {

   function __construct() {
        parent::__construct();

        $this->load->model('action');
    }
    
    public function index($emit = NULL) {
        $this->data['meta_title'] = 'Daily Report';
        $this->data['active'] = 'data-target="report_menu"';
        $this->data['subMenu'] = 'data-target="daily"';
        $this->data['confirmation'] = $this->data['cost'] = $this->data['income'] 
        = $this->data["todayDueCollction"] = $this->data["todaySales"] = $this->data["todaySalesReturn"] = $this->data["todayDueSaleInfo"] = NULL;
        $this->data['purchase'] = $this->data['installment'] =  $this->data["proCode"] = null;   
        
        
              
     // today's profit or loss start here
        $totalPurchase = $grandPurchase = $grandSale = $balance = 0.00;	
        $where = array('date' => date('Y-m-d'));
         $where1 =array(
          	'date' 	=> date('Y-m-d'),
          	'due >' => 0.00
          );       
          
        $this->data["todaySales"] = $this->action->readGroupBy("sale", "voucher_number" , $where); 
        $this->data['sale'] = $this->action->readGroupBy('sale','voucher_number',array('date' => date('Y-m-d')));
        
          if(isset($_POST['show'])){
          $where = array();
          if(isset($_POST['date'])){
          
           unset($where1['date']);
           
            foreach($_POST['date'] as $key=>$value){
              if($value != NULL && $key=="from"){
                 $where['date >='] = $value;
                 $where1['date >='] = $value;
              }
              
              if($value != NULL && $key=="to"){
                $where['date <='] = $value;
                $where1['date <='] = $value;
              }
            }
          }

          
         }     
         
          $this->data['todayPurchase'] = $this->action->readGroupBy('purchase', 'voucher_no', $where);
          
         
          $this->data["todaySales"] = $this->action->readGroupBy("sale", "voucher_number" , $where); 
          $this->data["todayDueCollction"] = $this->action->read("due_payment", $where); 
          $this->data["todaySalesReturn"] = $this->action->read("return_sale", $where);
         
          $this->data["todayDueSaleInfo"] = $this->action->readGroupBy("sale","voucher_number", $where1);  
          
     // today's profit or loss end here	
          
        

        $where = array('date' => date('Y-m-d'));
        $this->data['cost'] = $this->action->read('cost', $where); 
        $this->data["proCode"] = $this->action->readGroupBy("sale", "code", $where); 
        
        
        //todays sale return start
          $total_return = 0.0;
          $collect = $this->action->readGroupBy("return_sale","voucher_no", array('date' => date("Y-m-d")));
          
          
          foreach($collect as $key=>$value){          
            $total_return += $value->return_amount;         
          }  
                
         $this->data['sale_return'] =  $total_return;        
       //todays sale return end
       
        
      
        
        //Getting Total Sale
        $where = array('date' => date("Y-m-d"));
        $sales = $this->action->readGroupBy('sale', 'voucher_number', $where);
        $total_sale = array();
        foreach($sales as $key=> $value){
        	$total_sale[] = $value->paid;
        }
        $this->data['total_sale'] = array_sum($total_sale);
        //Getting Total Sale   
        
        
        $where = array(
        'transaction_type' => 'গ্রহন',
        'date' => date("Y-m-d")
        );
        $this->data['md_receive'] = $this->action->read("md_transaction",$where);      
        
         
         
        
        if(isset($_POST['show'])){
          $where = array();
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
          
          
         //todays sale return start
          $total_return = 0.0;
          $collect = $this->action->readGroupBy("return_sale","voucher_no", $where);
          
          
          foreach($collect as $key=>$value){          
            $total_return += $value->return_amount;         
          }  
                
         $this->data['sale_return'] =  $total_return;        
       //todays sale return end
       
       
           
          $this->data["proCode"] = $this->action->readGroupBy("sale", "code", $where);
          $this->data['cost'] = $this->action->read('cost', $where);
          
         //Getting Total Sale        
           $sales = $this->action->readGroupBy('sale', 'voucher_number', $where);
           $total_sale = array();
           foreach($sales as $key=> $value){
         	$total_sale[] = $value->paid;
           }
          $this->data['total_sale'] = array_sum($total_sale);
        //Getting Total Sale
        
        
          
         $where['transaction_type'] = 'গ্রহন';        
         $this->data['md_receive'] = $this->action->read("md_transaction",$where);
          
          
        }
        
      
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);        
        $this->load->view('components/report/daily_report', $this->data);
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

