<?php

class BankInfo extends Admin_Controller {

     function __construct() {
        parent::__construct();

        $this->load->model('action');
    }
    
    public function index() {
        $this->data['meta_title'] = 'Bank';
        $this->data['active'] = 'data-target="bank_menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;
	
	   $this->form_validation->set_rules('account_number', 'Account Number', 'trim|required|is_unique[bank_account.account_number]');

    	if($this->input->post('add_account')){
    		if($this->form_validation->run()==false){
    			$msg_array=array(
                    "title"=>"Error",
                    "emit"=>validation_errors(),
                    "btn"=>true
                );

                $this->data['confirmation']=message("warning",$msg_array);
    		}else{
        		$data = array(
        			"datetime"=>$this->input->post('date'),
        			"bank_name"=>$this->input->post('bank_name'),
        			"holder_name"=>$this->input->post('account_holder_name'),
        			"account_number"=>$this->input->post('account_number'),
        			"pre_balance"=>$this->input->post('previous_balance')
        		);

        		$msg_array = array(
                    "title"=>"Success",
                    "emit"=>"New Account Added Successfully",
                    "btn"=>true
                );
                $this->data['confirmation'] = message($this->action->add('bank_account', $data), $msg_array);
    		}
    	}
    	
    	$this->data['all_bank']=$this->action->read('bank_name');

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/bank/bank-nav', $this->data);
        $this->load->view('components/bank/add_account', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }
    
    public function all_account() {
        $this->data['meta_title'] = 'Bank';
        $this->data['active'] = 'data-target="bank_menu"';
        $this->data['subMenu'] = 'data-target="all-acc"';
        $this->data['confirmation'] = null;
        
        //---------------------Delete Data Start------------------------------
        if($this->input->get("id")){//Deleting Message
            $this->action->deletedata('bank_account',array('id'=>$this->input->get("id")));
            redirect('bank/bankInfo/all_account?d_success=1','refresh');
        }

        if ($this->input->get("d_success")==1){
            $msg_array=array(
                "title"=>"Deleted",
                "emit"=>"Account Successfully Deleted",
                "btn"=>true
            );
            $this->data['confirmation']=message("danger",$msg_array);
        }
        //---------------------Delete Data End--------------------------------

	$this->data['all_account']=$this->action->read('bank_account');
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/bank/bank-nav', $this->data);
        $this->load->view('components/bank/all_account', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }
    
    public function editAccount() {
        $this->data['meta_title'] = 'Bank';
        $this->data['active'] = 'data-target="bank_menu"';
        $this->data['subMenu'] = 'data-target="all-acc"';
        $this->data['confirmation'] = null;
        
        $where=array('id'=>$this->input->get('id'));
        
        if($this->input->post('edit_account')){
        
		$data=array(
		"datetime"=>$this->input->post('date'),
		"bank_name"=>$this->input->post('bank_name'),
		"holder_name"=>$this->input->post('account_holder_name'),
		"account_number"=>$this->input->post('account_number'),
		"pre_balance"=>$this->input->post('previous_balance')
		);
		
		$msg_array=array(
                "title"=>"Success",
                "emit"=>"Account Updated Successfully",
                "btn"=>true
            	);
		
		$this->data['confirmation']=message($this->action->update('bank_account',$data,$where),$msg_array);
		}
        
        

	$this->data['all_account']=$this->action->read('bank_account',$where);

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/bank/bank-nav', $this->data);
        $this->load->view('components/bank/editAccount', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }



    public function transaction() {
        $this->data['meta_title'] = 'Bank';
        $this->data['active'] = 'data-target="bank_menu"';
        $this->data['subMenu'] = 'data-target="add"';
        $this->data['confirmation'] = null;

	    $this->data["bank_list"] = $this->action->read_distinct("bank_account", array(), "bank_name");
    	if($this->input->post('add_transaction')){
    		$data = array(
        		'transaction_date'  =>$this->input->post('date'),
        		'bank'              =>$this->input->post('bank_name'),
        		'account_number'    =>$this->input->post('account_number'),
        		'transaction_type'  =>$this->input->post('transaction_type'),
        		'source'            =>$this->input->post('fund_source'),
        		'amount'            =>$this->input->post('amount'),
        		'transaction_by'    =>$this->input->post('transaction_by')
    		);
    		
    		$msg_array = array(
                "title" =>"Success",
                "emit"  =>"Transaction Added Successfully",
                "btn"   =>true
        	);
    		$this->data['confirmation'] = message($this->action->add("transaction", $data), $msg_array);


            // change the current balance
            $where = array(
                'bank_name'         => $this->input->post('bank_name'),
                'account_number'    => $this->input->post('account_number')
            );

            $bank_info = $this->action->read('bank_account', $where);

            if($this->input->post('transaction_type') == 'Debit'){
                $balance = $bank_info[0]->pre_balance - $this->input->post('amount');
            } else {
                $balance = $bank_info[0]->pre_balance + $this->input->post('amount');
            }

            $data = array('pre_balance' => $balance);
            $this->action->update('bank_account', $data, $where);
    	}

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/bank/bank-nav', $this->data);
        $this->load->view('components/bank/add_transaction', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function searchViewTransaction() {
        $this->data['meta_title'] = 'Bank';
        $this->data['active'] = 'data-target="bank_menu"';
        $this->data['subMenu'] = 'data-target="search"';
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
        $this->load->view('components/bank/bank_report_nav', $this->data);
        $this->load->view('components/bank/searchViewTransaction', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function allTransaction() {
        $this->data['meta_title'] = 'Bank';
        $this->data['active'] = 'data-target="report_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;
        
        //---------------------Delete Data Start------------------------------
        if($this->input->get("id")){//Deleting Message
            $this->action->deletedata('transaction',array('id'=>$this->input->get("id")));
            redirect('bank/bankInfo/allTransaction?d_success=1','refresh');
        }

        if ($this->input->get("d_success")==1){
            $msg_array=array(
                "title"=>"Deleted",
                "emit"=>"Transaction Successfully Deleted",
                "btn"=>true
            );
            $this->data['confirmation']=message("danger",$msg_array);
        }
        //---------------------Delete Data End--------------------------------

	$this->data['all_tranc']=$this->action->read('transaction');

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/bank/bank_report_nav', $this->data);
        $this->load->view('components/bank/allTransaction', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function editTransaction() {
        $this->data['meta_title'] = 'Bank';
        $this->data['active'] = 'data-target="bank_menu"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = null;
        
        $this->data["bank_list"]=$this->action->read_distinct("bank_account",array(),"bank_name");
        
    	$where=array("id"=>$this->input->get("id"));
    	
    	if($this->input->post('add_transaction')){
    	$data=array(
    	'transaction_date'=>$this->input->post('date'),
    	'bank'=>$this->input->post('bank_name'),
    	'account_number'=>$this->input->post('account_number'),
    	'transaction_type'=>$this->input->post('transaction_type'),
    	'amount'=>$this->input->post('amount'),
    	'transaction_by'=>$this->input->post('transaction_by')
    	);
    	
    	$msg_array=array(
            "title"=>"Success",
            "emit"=>"Transaction Added Successfully",
            "btn"=>true
        	);
    	$this->data['confirmation']=message($this->action->update("transaction",$data,$where),$msg_array);
    	}
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/bank/bank_report_nav', $this->data);
        $this->load->view('components/bank/edit-transaction', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }
    
    public function addBankName() {
        $this->data['meta_title'] = 'Bank Name';
        $this->data['active'] = 'data-target="bank_menu"';
        $this->data['subMenu'] = 'data-target="bank_name"';
        $this->data['confirmation'] = null;
        

    	if($this->input->post('sub')){
    		$data = array(
        		'date'    =>date('Y-m-d'),
        		'bank_name'    =>$this->input->post('bank_name')
    		);
    		
    		$where = array(
    		    'bank_name'    =>$this->input->post('bank_name')
    		);
    		$warning = array(
                "title" =>"warning",
                "emit"  =>"Bank Name Already Exists",
                "btn"   =>true
        	);
    		
    		$msg_array = array(
                "title" =>"Success",
                "emit"  =>"Bank Name Added Successfully",
                "btn"   =>true
        	);
        	
        	if($this->action->exists('bank_name',$where)){
        	    $this->data['confirmation'] = message("warning", $warning);
        	}else{
    		    $this->data['confirmation'] = message($this->action->add("bank_name", $data), $msg_array);
        	}
    	}
    	
    	if(isset($_GET['id'])){
    	    $where = array(
    	        "id"    => $_GET['id']
    	    );
    	        
    	  	$msg_array = array(
                "title" =>"Success",
                "emit"  =>"Bank Name Delete Successfully",
                "btn"   =>true
        	);
    	        
    	    $this->data['confirmation'] = message($this->action->deleteData("bank_name", $where), $msg_array);
    	}
    	
    	$this->data['all_bank']=$this->action->read('bank_name');
    	

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/bank/bank-nav', $this->data);
        $this->load->view('components/bank/bank_name', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }
    
    public function ajax_account_list() {
    	$where=array("bank_name"=>$this->input->post('bankName'));
    	$alldata=$this->action->read('bank_account',$where);
    	$alldatas=json_encode($alldata);
    	echo $alldatas;
    }
    
    

}
