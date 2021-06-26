<?php

class EditPurchase extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title'] = 'Purchase';
        $this->data['active'] = 'data-target="purchase_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

        if(isset($_POST['save'])){
            $this->data['confirmation'] = $this->edit();
        }

        $where = array('voucher_no' => $this->input->get('vno'));
        $this->data['info'] = $this->action->read('purchase', $where);

        // get all vendors
        $this->data['allVendors'] = $this->getAllVendors();

        // get all category
        $this->data['allCategory'] = $this->getAllCategory();

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/purchase/purchase-nav', $this->data);
        $this->load->view('components/purchase/edit-purchase', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    private function getAllVendors(){
        $vendors = $this->action->read('parties', array('type'=>'supplier'));
        return $vendors;
    }
    private function getAllCategory(){
        $category = $this->action->read('category');
        return $category;
    }

    private function edit(){
        foreach ($_POST['id'] as $key => $value) {
            $where = array('id' => $_POST['id'][$key]);

            $data = array(
                'purchase_price'  => $_POST['price'][$key],
                'quantity'        => $_POST['quantity'][$key],                
                'discount'        => $_POST['discount'][$key],
                'subtotal'        => $_POST['subtotal'][$key],
                'total'           => $this->input->post('total'),
                'total_discount'  => $this->input->post('total_discount'),
                'grand_total'     => $this->input->post('grand_total'),
                'paid'            => $this->input->post('paid'),
                'due'             => $this->input->post('due')
            );

            if($this->action->update('purchase', $data, $where)){
                $this->handelStock($key);
            }

             // 2017-07-19 update products table's purchase price
            $cond = array("product_code" => $_POST['product_code'][$key]);
            $this->action->update("products",array("purchase_price" => $_POST['price'][$key]),$cond);
        }

        $options = array(
            'title' => 'SUCCESS',
            'emit'  => 'Purchased item changed successfully!',
            'btn'   => true
        );

        return message('success', $options);
    }

    private function handelStock($index) {
        $where = array(
            'category' => $_POST['category'][$index],
            'subcategory' => $_POST['subcategory'][$index],
            'product_name' => $_POST['product'][$index],
            'godown' => $_POST['godowns'][$index]
        );

        $record = $this->action->read('stock', $where);

        // set the quantity
        if($this->input->post('oldQuantity') > $_POST['quantity'][$index]){
            $quantity = $record[0]->quantity + ($_POST['oldQuantity'][$index] - $_POST['quantity'][$index]);
        } else {
            $quantity = $record[0]->quantity - ($_POST['oldQuantity'][$index] - $_POST['quantity'][$index]);
        }

        $data = array('quantity' => $quantity);
        $this->action->update('stock', $data, $where);
    }


}
