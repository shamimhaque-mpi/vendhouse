<?php

class EditSale extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }
    
    public function index() {
        $this->data['meta_title'] = 'Sale';
        $this->data['active'] = 'data-target="sale_menu"';
        $this->data['subMenu'] = 'data-target="edit"';
        $this->data['confirmation'] = null;

        if(isset($_POST['save'])){
            $this->data['confirmation'] = $this->change();
        }

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/sale/sale-report-nav', $this->data);
        $this->load->view('components/sale/edit-sale', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    private function change(){
        foreach ($_POST['id'] as $key => $value) {
            $where = array('id' => $value);

            $data = array(
                'price'     => $_POST['price'][$key],
                'quantity'  => $_POST['newQuantity'][$key],
                'subtotal'  => $_POST['subtotal'][$key],
                'total'     => $this->input->post('total'),
                'grand_total'     => $this->input->post('grand_total'),
                'paid'      => $this->input->post('paid'),
                'due'       => $this->input->post('due')
            );

            if($this->action->update('sale', $data, $where)){
                $this->handelStock($key);
            }
        }

        $options = array(
            'title' => 'success',
            'emit'  => 'Sale change successfully completed!',
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
        if($_POST['newQuantity'][$index] > $_POST['oldQuantity'][$index]){
            $quantity = $record[0]->quantity - ($_POST['newQuantity'][$index] - $_POST['oldQuantity'][$index]);
        } else {
            $quantity = $record[0]->quantity + ($_POST['oldQuantity'][$index] - $_POST['newQuantity'][$index]);
        }

        $data = array('quantity' => $quantity);
        $this->action->update('stock', $data, $where);
    }

}