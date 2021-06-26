<?php

class Limit extends Admin_Controller {

     function __construct() {
        parent::__construct();

        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title'] = 'Limit';
        $this->data['active'] = 'data-target="theme_menu"';
        $this->data['subMenu'] = 'data-target="limit"';
        $this->data['confirmation'] = $this->data['limit'] = null;
        
    	if($this->input->post('limit')){
    		$data = array(
        		'date'      =>date('Y-m-d'),
        		'amount' =>$this->input->post('amount')
    		);
    		
    		$msg_array = array(
                "title" =>"Success",
                "emit"  =>"Purchase Limit Added Successfully",
                "btn"   =>true
        	);
        	$limit = $this->action->read("purchase_limit");
        	if($limit){
        	    $this->action->update("purchase_limit", $data,array('id'=>$limit[0]->id));
        	    $this->session->set_flashdata('success', 'Purchase Limit Updated Successfully');
        	}else{
        	    $this->action->add("purchase_limit", $data);
        	    $this->session->set_flashdata('success', 'Purchase Limit Added Successfully');
        	}
    		
    	}
    	$this->data['limit'] = $this->action->read("purchase_limit");

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/theme/nav', $this->data);
        $this->load->view('components/theme/limit', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }
    
}