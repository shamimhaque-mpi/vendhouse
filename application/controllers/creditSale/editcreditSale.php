<?php

class EditcreditSale extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
        $this->holder();
    }
    
    public function index() {
        $this->data['meta_title'] = 'Edit Credit Sale';
        $this->data['active'] = 'data-target="credit_sale_menu"';
        $this->data['subMenu'] = 'data-target="all-credit"';
        $this->data['confirmation'] = null;   

        if(isset($_POST['edit_creditSales'])){
          $this->data['confirmation']=$this->change();
        }   
        

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data); 
        $this->load->view('components/creditSale/credit-nav', $this->data);
        $this->load->view('components/creditSale/editcredit_sales', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    private function change(){
        foreach ($_POST['id'] as $key => $value) {
            $where = array('id' => $value);

            $data = array(
                'price' => $_POST['price'][$key],
                'quantity' => $_POST['newQuantity'][$key],
                'subtotal' => $_POST['subtotal'][$key],
                'total' => $this->input->post('total'),
                'paid' => $this->input->post('paid'),
                'due' => $this->input->post('due')
            );

            if($this->action->update('sale', $data, $where)){
                $this->handelStock($key);
            }
        }

        $this->handelLoan();

        $options = array(
            'title' => 'success',
            'emit'  => 'Credit Sale  successfully Updated!',
            'btn'   => true
        );

        return message('success', $options);
    }

    private function handelStock($index){
        $where = array(
            'category'      => $_POST['category'][$index],
            'subcategory'   => $_POST['subcategory'][$index],
            'product_name'  => $_POST['product'][$index],
            'godown'        => $_POST['godown'][$index]
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

    private function handelLoan(){ 
         $where=array('voucher_number' => $this->input->post('voucher_number'));
        //set data
        $data=array(         
                'installment_no'          => $this->input->post('installment_quantity'),
                'amount_per_installment'  => $this->input->post('amount_quantity'),
                'installment_type'        => $this->input->post('installment_type'),
                'installment_day'         => $this->input->post('installment_day'),
                'installment_date'        => $this->input->post('installment_date'),
                'amount'                  => $this->input->post('due'),
                'due'                     => $this->input->post('due')
            );

        $this->action->update('loan', $data,$where);        
    }


    private function holder(){  
        if($this->session->userdata('holder') == null){
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }

}