<?php

class Sale extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title'] = 'Sale';
        $this->data['active'] = 'data-target="sale_menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;

        $this->data["vheaderInfo"] = $this->action->read("voucher_header");
        $this->data["vfooterInfo"] = $this->action->read("voucher_footer");

        if(isset($_POST['save'])){
             $value = $this->create();
             $this->data['confirmation'] = $value['message'];
             redirect('sale/viewSale?vno=' . $value['voucher_number'], 'refresh');
        }

        // get all Product
        $this->data['allCategory'] = $this->getAllCategory();


        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/sale/sale-nav', $this->data);
        $this->load->view('components/sale/add-sale', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }



    private function getAllCategory(){
        $data = $this->action->readGroupBy('stock',"category",array(),"id","asc");
        return $data;
    }



    private function create(){
        $id_array = array();
        foreach ($_POST['product'] as $key => $value) {
            if($_POST['product'][$key] != null){
                $data = array(
                    'date'              => $this->input->post('date'),
                    'time'              => date("h:i:s A"),
                    'category'          => $_POST['category'][$key],
                    'subcategory'       => $_POST['subcategory'][$key],
                    'godown'            => $_POST['godown'][$key],
                    'product'           => $_POST['product'][$key],
                    'code'           	=> $_POST['code'][$key],
                    'purchase_price'    => $_POST['purchase_price'][$key],
                    'price'             => $_POST['price'][$key],
                    'quantity'          => $_POST['quantity'][$key],
                    'subtotal'          => $_POST['subtotal'][$key],
                    'total'             => $this->input->post('total'),
                    'vat'               => $_POST['vat_subtotal'][$key],
                    'vat_amount'        => $this->input->post('vat_amount'),
                    'discount'          => $this->input->post('discount'),
                    'grand_total'       => $this->input->post('grand_total'),
                    'received_amount'   => $this->input->post('received_amount'),
                    'return_amount'     => $this->input->post('return_amount'),
                    'paid'              => $this->input->post('paid'),
                    'due'               => $this->input->post('due'),
                    'remark'            => $_POST['free'][$key],
                    'name'              => $this->input->post('name'),
                    'mobile'            => $this->input->post('mobile'),
                    'sale_type'         => $this->input->post('sale_type'),
                    'virtual_sale'      => (isset($_POST['virtual'][$key])) ? $_POST['virtual'][$key] : 0,
                    'status'            => 'sale'
                );
                
                
                
                
               $virtual_code = (isset($_POST['virtual'][$key])) ? $_POST['virtual'][$key] : 0;

                $id = $this->action->addAndGetID("sale",$data);
                if(!in_array($id,$id_array)){
                    array_push($id_array,$id);
                }
                $this->handelStock($key,$virtual_code);
            }
        }
        
        
        
        // update the records with voucher number
        $code = date('y') . date('m') . date('d') . $this->data['branch'].str_pad($id_array[0], 4,0,STR_PAD_LEFT);
        if($id_array != NULL){
            foreach($id_array as $sl=>$val){
                $this->action->update('sale',array("voucher_number" => $code),array("id" => $val));
            }
        }
       

        $return_array = array();
        $options = array(
            'title'=>'success',
            'emit'=>'Product Sale successfully Completed!',
            'btn'=>true
        );

        $return_array['message'] = message('success', $options);
        $return_array['voucher_number'] = $code;

        return $return_array;
    }

    private function handelStock($index,$virtual_code){
        $where = array();

        $where['category']      = $_POST['category'][$index];
        $where['subcategory']   = $_POST['subcategory'][$index];
        $where['code']      	= $_POST['code'][$index];


        // get the product stock
        $record = $this->action->read('stock', $where);

        // set the quantity
        if($record != NULL && $virtual_code != 0){
          $quantity = $record[0]->quantity - $_POST['quantity'][$index];

          $data = array('quantity' => $quantity);
          $this->action->update('stock', $data, $where);
        } 
    }

}
