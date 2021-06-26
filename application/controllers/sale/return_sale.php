<?php

class Return_sale extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }
    
    public function index() {
        $this->data['meta_title'] = 'Return Sale';
        $this->data['active'] = 'data-target="sale_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

        if(isset($_POST['save'])) {
            $this->data['confirmation'] = $this->change();
            $this->session->set_flashdata("confirmation", $this->data['confirmation']);
            
            redirect("sale/return_sale?vno=" . $_GET['vno']);
        }
       
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/sale/sale-report-nav', $this->data);
        $this->load->view('components/sale/return-sale', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }


    private function change(){
        foreach ($_POST['id'] as $key => $value) {
            $where = array('id' => $value);            
            
            $data = array(
                'price'     	=> $_POST['price'][$key],
                'quantity'  	=> ($_POST['oldQuantity'][$key] - $_POST['returnQuantity'][$key]),
                'subtotal'  	=> $_POST['subtotal'][$key],
                'total'     	=> $this->input->post('total'),
                'grand_total'   => $this->input->post('grand_total'),
                'paid'      	=> ($this->input->post('paid') - $this->input->post('returnAmount')),
                'due'       	=> $this->input->post('due')
            );

            if($this->action->update('sale', $data, $where)) {
                $this->handelStock($key);
            }
            
            $cond = array(
              "date" 		=> date("Y-m-d"),
              "voucher_no" 	=> $_POST['voucher_no'],
              "code"            => $_POST['code'][$key]
            );
            
             $data = array(
	          "date"          => date("Y-m-d"),
	          "voucher_no"    => $_POST['voucher_no'],
	          "code"          => $_POST['code'][$key], 
	          "quantity"      => $_POST['returnQuantity'][$key],
	          "return_amount" => $_POST['returnAmount'],
	    );
            
            $info = $this->action->read("return_sale",$cond);            
            if($info != NULL){
              $this->action->update("return_sale",$data,$cond);
            }else{
             $this->action->add("return_sale", $data);
            }         
           
	}
        
        $options = array(
            'title' => 'success',
            'emit'  => 'Sale successfully Returned!',
            'btn'   => true
        );

        return message('success', $options);
    }

    private function handelStock($index){
        $where = array(
            'category'      => $_POST['category'][$index],
            'subcategory'   => $_POST['subcategory'][$index],
            // 'product_name'  => $_POST['product'][$index],
            'godown'        => $_POST['godown'][$index],
            'code'          => $_POST['code'][$index]
        );

        // get the product stock
        $record = $this->action->read('stock', $where);

        // set the quantity
       $quantity = $record[0]->quantity +  $_POST['returnQuantity'][$index];

        $data = array('quantity' => $quantity);
        $this->action->update('stock', $data, $where);
    }

}