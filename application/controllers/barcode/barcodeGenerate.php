<?php

class BarcodeGenerate extends Admin_controller {

    function __construct() {
        parent::__construct();

        $this->holder();
        $this->load->model('action');

        $this->data['meta_title'] = 'Barcode';
        $this->data['active'] = 'data-target="barcode_menu"';
    }

    public function index() {
         $this->data['subMenu'] = 'data-target="barcodegen"';
         $this->data['row'] = $this->data['column'] = null;
         $this->data['products'] = array();

        // after form submit
        if(isset($_POST['generateForm'])){
        	$column = 6;

        	foreach($_POST['code'] as $key => $value){
        		$where = array("bar_code" => $value);
            		$info = $this->action->read('products', $where);

        		if($info){
	        		$product = array(
	        			'quantity' 	=> $_POST['quantity'][$key],
                        'sale_price' => $_POST['sale_price'][$key],
	        			'column' 	=> $column,
	        			'row'		=> ceil($_POST['quantity'][$key] / $column),
	        			'code' 		=> $value,
	        			'img' 		=> base_url('public/uploaded_barcode') . '/' . $value . ".png",
	        			'productInfo'	=> (array)$info[0]
	        		);

	        		$this->data['products'][] = $product;
        		}
        	}
        }

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/barcode/menu', $this->data);
        $this->load->view('components/barcode/barcodeGenerate', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }


    public function purchase_barocde() {
         $this->data['subMenu'] = 'data-target="barcodegen"';
         $this->data['row'] = $this->data['column'] = $this->data['results'] = null;
         $this->data['products'] = array();

        // after form submit
        if(isset($_POST['generateForm'])){
        	$column = 6;

        	foreach($_POST['code'] as $key => $value){
        		$where = array("bar_code" => $value);
            		$info = $this->action->read('products', $where);

        		if($info){
	        		$product = array(
	        			'quantity' 	=> $_POST['quantity'][$key],
	        			'column' 	=> $column,
	        			'row'		=> ceil($_POST['quantity'][$key] / $column),
	        			'code' 		=> $value,
	        			'img' 		=> base_url('public/uploaded_barcode') . '/' . $value . ".png",
	        			'productInfo'	=> (array)$info[0]
	        		);

	        		$this->data['products'][] = $product;
        		}
        	}
        }

        $this->data['results'] = $this->action->read("purchase",array("voucher_no" => $_GET['vno']));

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/barcode/menu', $this->data);
        $this->load->view('components/barcode/purchase_barocde', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }



    public function rangeBarcode() {
         $this->data['subMenu'] = 'data-target="range"';
         $this->data['row'] = $this->data['column'] = null;

        // after form submit
        if(isset($_POST['generateForm'])){
            $this->data['from'] = $this->input->post('from');
            $this->data['to'] = $this->input->post('to');
            $this->data['quantity'] = ($this->data['to'] - $this->data['from']) + 1;
            $this->data['column'] = 4;
            $this->data['row'] = ceil($this->data['quantity'] / $this->data['column']);

            $forF = $this->input->post('from');
            $forT = $this->input->post('to');

            $this->data["proInfo"] = $this->action->readProductRange('products', 'bar_code', $forF, $forT);
        }

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/barcode/menu', $this->data);
        $this->load->view('components/barcode/rangebarcodeGenerate', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    private function holder(){
       if($this->session->userdata('holder') == null){
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }

}
