<?php

class Stock extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title'] = 'Stock';
        $this->data['active'] = 'data-target="stock"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = $this->data['godowns'] = null;

        $this->data['godowns']=$this->action->readDistinct('godowns','place');
        
        if ($this->input->post('qtyUpdate')) {
            $signQuantity = 0;
            $where = array("code" => $this->input->post("code"));
            
            $info = $this->action->read("stock",$where);
            $plus_quantity = ($info) ? $info[0]->plus_quantity : 0; 
            $minus_quantity = ($info) ? $info[0]->minus_quantity : 0; 
            
            $signQuantity = ($_POST['type'] == 'plus') ? 0 + $_POST['new_quantity'] : 0 - $_POST['new_quantity']; 
            $data = array(
                  'quantity'       => $this->input->post('quantity') + $signQuantity,
                  'plus_quantity'  => $plus_quantity + (($signQuantity >= 0) ? $signQuantity : 0),
                  'minus_quantity'  => $minus_quantity + (($signQuantity < 0) ? abs($signQuantity) : 0)
                );

            $status = $this->action->update('stock',$data,$where);

            if($status){
                $this->data['confirmation'] = "Stock Successfully Updated!";                
            }
        }


        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/stock', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

}
