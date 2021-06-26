<?php
class Sale_return extends Admin_Controller {

     function __construct() {
        parent::__construct();
        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title'] = 'Sale Return';
        $this->data['active'] = 'data-target="sale_menu"';
        $this->data['subMenu'] = 'data-target="add-sale-return"';
        $this->data['confirmation'] = null;

		if($this->input->post("submit")){
			$data = array(
				"date" 			=> date("Y-m-d"),
				"code" 	        => $this->input->post("product_code"),
//				"product_name"	=> $this->input->post("product_name"),
//				"category" 		=> $this->input->post("category"),
	//			"subcategory" 	=> $this->input->post("subcategory"),
				"quantity"		=> $this->input->post("quantity"),
				"return_amount" => $this->input->post("return_amount")
			);

			$msg_array = array(
				"title" => "Success",
				"emit" 	=> "Return Successfully Saved",
				"btn" 	=> true
			);
			$this->session->set_flashdata("confirmation",message($this->action->add("return_sale",$data),$msg_array));
			$this->handelStock();

			redirect("sale_return/sale_return","refresh");
		}

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/sale/sale-nav', $this->data);
        $this->load->view('components/sale_return/add', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    private function handelStock(){
        $where = array(
		"code" => $this->input->post("code")
        );

        // get the product stock
        $record = $this->action->read('stock', $where);

        // set the quantity
        $quantity = $record[0]->quantity +  $_POST['quantity'];

        $data = array('quantity' => $quantity);
        $this->action->update('stock', $data, $where);
    }


    public function all() {
        $this->data['meta_title'] = 'Sale Return';
        $this->data['active'] = 'data-target="report_menu"';
        $this->data['subMenu'] = 'data-target="all-return"';
        $this->data['confirmation'] = null;

		$this->data["info"]=$this->action->read("return_sale");

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/sale/sale-report-nav', $this->data);
        $this->load->view('components/sale_return/all', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }
}
