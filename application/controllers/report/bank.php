<?php

class Bank extends Admin_Controller {

     function __construct() {
        parent::__construct();

        $this->load->model('action');
    }
    
    public function index() {
        $this->data['meta_title'] = 'Bank';
        $this->data['active'] = 'data-target="report_menu"';
        $this->data['subMenu'] = 'data-target="bank"';
        $this->data['confirmation']=$this->data['bank_record'] = null;
        
        if(isset($_POST['custom_show'])){
            $where = array();
            foreach($_POST['search'] as $key => $val){
                if($val != null){
                    $where[$key] = $val;
                }
            }

            foreach($_POST['date'] as $key => $val){
                if($val != null && $key == 'from'){
                    $where['transaction_date >'] = $val;
                }

                if($val != null && $key == 'to'){
                    $where['transaction_date <'] = $val;
                }
            }

            // $this->data['bank_record'] = $this->action->searchTransaction('transaction');
        	$this->data['bank_record'] = $this->action->read('transaction', $where);
        }

        $this->data["bank_list"] = $this->action->read_distinct("bank_account", array(), "bank_name");

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/bank/bank-nav', $this->data);
        $this->load->view('components/report/bank', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }
    
    
    public function ajax_account_list() {
    	$where=array("bank_name"=>$this->input->post('bankName'));
    	$alldata=$this->action->read('bank_account',$where);
    	$alldatas=json_encode($alldata);
    	echo $alldatas;
    }
    
    

}
