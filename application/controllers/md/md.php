<?php

class Md extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
        $this->load->library('upload');
    }

    public function index() {
        $this->data['meta_title'] = '';
        $this->data['active'] = 'data-target="member_menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = $this->data['transaction'] = null;
	
	if($this->input->post("save")){
		$data = array(
			"date" => $this->input->post("date"),
			"amount" => $this->input->post("amount"),
			"transaction_type" => $this->input->post("transaction_type"),
			"transaction_by"	=>$this->input->post("transaction_by")
			
		);
		  $msg_array = array(
	              "title" => "Success",
	              "emit"  => "Data successfully save",
	              "btn"   => true
	          );
	          $this->data['confirmation'] = message($this->action->add('md_transaction', $data), $msg_array);
	}
	
	$this->data['transaction'] = $this->action->read("md_transaction");

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/md/md', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

}