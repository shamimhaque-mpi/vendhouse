<?php

class CreditSale extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
        $this->holder();
    }
    
    public function index() {   
        $this->data['meta_title'] = 'Credit Sale';
        $this->data['active'] = 'data-target="credit_sale_menu"';
        $this->data['subMenu'] = 'data-target="add-credit"';
        $this->data['confirmation'] = null;

        // get all category
        $this->data['allCategory'] = $this->getAllCategory();

        // get all godown
        $this->data['allGodowns'] = $this->action->read("godowns");

          if(isset($_POST['add_creditSales'])){
            $this->data['confirmation'] = $this->save();
            redirect('creditSale/viewcreditSale?vno='.$this->input->post('voucher_number'),'refresh');
        }

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/creditSale/credit-nav', $this->data);
        $this->load->view('components/creditSale/credit_sales', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    private function getAllCategory(){
        $category = $this->action->read_distinct('stock', array(), 'category');
        return $category;
    }

    private function save(){
        foreach ($_POST['product'] as $key => $value) {
            $data = array(
                'date' => $this->input->post('date'),
                'voucher_number' => $this->input->post('voucher_number'),
                'category' => $_POST['category'][$key],
                'subcategory' => $_POST['subcategory'][$key],
                'product' => $_POST['product'][$key],
                'godown' => $_POST['godown'][$key],
                'price' => $_POST['price'][$key],
                'quantity' => $_POST['quantity'][$key],
                'subtotal' => $_POST['subtotal'][$key],
                'total' => $this->input->post('total'),
                'paid' => $this->input->post('paid'),
                'due' => $this->input->post('due'),
                'member_id' => $this->input->post('member_No'),
                'status' => 'credit_sale'
            );

            if($this->action->add('sale', $data)){
                $this->handelStock($key);                
            }
        }

        $this->handelLoan();

        $options = array(
            'title'=>'success',
            'emit'=>'Product Sale successfully Completed!',
            'btn'=>true
        );

        return message('success', $options);
    }

    private function handelStock($index){
        $where = array();

        $where['category']      = $_POST['category'][$index];
        $where['subcategory']   = $_POST['subcategory'][$index];
        $where['product_name']  = $_POST['product'][$index];
        $where['godown']        = $_POST['godown'][$index];

        // get the product stock
        $record = $this->action->read('stock', $where);

        // set the quantity
        $quantity = $record[0]->quantity - $_POST['quantity'][$index];

        $data = array('quantity' => $quantity);
        $this->action->update('stock', $data, $where);
    }


    private function handelLoan(){       
        //set data
        $data=array(
                'date'                    => $this->input->post('date'),
                'voucher_number'          => $this->input->post('voucher_number'),
                'member_id'               => $this->input->post('member_No'),
                'installment_no'          => $this->input->post('installment_quantity'),
                'amount_per_installment'  => $this->input->post('amount_quantity'),
                'installment_type'        => $this->input->post('installment_type'),
                'installment_day'         => $this->input->post('installment_day'),
                'installment_date'        => $this->input->post('installment_date'),
                'amount'                  => $this->input->post('due'),
                'due'                     => $this->input->post('due')
            );

        $this->action->add('loan', $data);        
    }

   private function holder(){  
        if($this->session->userdata('holder') == null){
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }


}