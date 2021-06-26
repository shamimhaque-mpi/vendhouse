<?php

class DeleteSale extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }
    
	    public function index() {
	        $this->data['meta_title'] = 'Delete Sale';
	        $this->data['active'] = 'data-target="sale_menu"';
	        $this->data['subMenu'] = 'data-target="add-new"';
	        $this->data['confirmation'] = null;

	        $where=array('voucher_number'=>$this->input->get('vno'));

	        $saleInfo=$this->action->read('sale',$where);
	        //echo "<pre>"; print_r($saleInfo); echo "</pre>";

	         foreach ($saleInfo as $key => $value) {
	        // set condition for every item
	        $stockWhere = array(
	            "category"       => $value->category,
	            "subcategory"    => $value->subcategory,
	            "product_name"   => $value->product,
	            "godown"         => $value->godown
	        );        
	        
	        // get stock information
	        $stockInfo = $this->action->read('stock', $stockWhere);

	        // caltulate new quantity
	        if($stockInfo != null){
	            $quantity = $stockInfo[0]->quantity + $saleInfo[$key]->quantity;
	            $data = array('quantity' => $quantity);

	            // update the stock
	            $this->action->update('stock', $data, $stockWhere);
	        }
	    }

	    $response = $this->action->deleteData('sale', $where);

	    $options = array(
	        'title' => 'delete',
	        'emit'  => 'Sale Successfully  Deleted!',
	        'btn'   => true
	    );

	    $this->session->set_flashdata('confirmation', message($response, $options));
	    redirect('sale/searchSale', 'refresh');
	}
}