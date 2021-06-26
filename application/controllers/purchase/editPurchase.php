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
            $this->session->set_flashdata('confirmation', $this->edit());
            redirect("purchase/editPurchase?vno=" . $this->input->get('vno'), "refresh");
        }

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/purchase/nav', $this->data);
        $this->load->view('components/purchase/edit', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    private function edit(){
        // update purchase record
        $total_quantity = 0;
        foreach ($_POST['id'] as $key => $value) {
            $total_quantity += $_POST['new_quantity'][$key];
            $data = array();
            $where = array('id' => $_POST['id'][$key]);

            $data['sap_at']         = $this->input->post('date');
            $data['purchase_price'] = $_POST['purchase_price'][$key];
            $data['quantity']       = $_POST['new_quantity'][$key];

            if($this->action->update('sapitems', $data, $where)){
                $this->handelStock($key);
            }
        }

        // update bill record
        if($this->input->post("previous_sign") == "Receivable"){
            $balance = 0 + $this->input->post('previous_balance');
        } else {
            $balance = 0 - $this->input->post('previous_balance');
        }

        $data = array(
            'sap_at'            => $this->input->post('date'),
            'change_at'         => date('Y-m-d'),
            'total_quantity'    => $total_quantity,
            'total_bill'        => $this->input->post('new_grand_total'),
            'total_discount'    => $this->input->post('new_total_discount'),
            'party_balance'     => $balance,
            'paid'              => $this->input->post('total_paid')
        );

        $where = array('voucher_no' => $this->input->get('vno'));
        $status = $this->action->update('saprecords', $data, $where);

        $this->handelPartyTransaction();

        $options = array(
            'title' => 'Updated',
            'emit'  => 'Purchase successfully changed!',
            'btn'   => true
        );

        return message($status, $options);
    }

    private function handelStock($index) {
        // get stock info
        $where                = array();
        $where['code']        = $_POST['product_code'][$index];
        $record = $this->action->read('stock', $where);

        // set the quantity
        $newQuantity = $_POST['new_quantity'][$index] - $_POST['old_quantity'][$index];
        $quantity = $record[0]->quantity + $newQuantity;

        // update the stock
        $data = array();
        $data = array('quantity' => $quantity);

        if($_POST['purchase_price'][$index] > 0) {
            $data['purchase_price'] = $_POST['purchase_price'][$index];
        }

        $this->action->update('stock', $data, $where);
    }

    private function handelPartyTransaction(){
        $data = array(
            'change_at' => $this->input->post('date'),
            'credit'    => $this->input->post('new_grand_total'),
            'debit'     => $this->input->post('total_paid'),
        );

        $where = array('relation' => 'purchase:' . $this->input->get('vno'));
        $this->action->update('partytransaction', $data, $where);

        return true;
    }
}
