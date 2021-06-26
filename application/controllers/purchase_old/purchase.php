<?php

class Purchase extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title'] = 'Purchase';
        $this->data['active'] = 'data-target="purchase_menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;

        // save record
        if(isset($_POST['save'])){
            $this->savePurchaseRecord();
        }

        // get all vendors
        $this->data['allVendors'] = $this->getAllVendors();

        // get all category
        $this->data['allCategory'] = $this->getAllCategory();

        // get all godown
        $this->data['allGodowns'] = $this->getAllGodowns();

        // save purchase data
        if(isset($_POST['save'])){
           $this->data['confirmation']=$this->savePurchaseRecord($_POST['product']);
           redirect('purchase/purchase/view?vno='.$this->input->post('voucher_number'), 'refresh');
        }

        $this->data['products'] = $this->action->read('products',array("status" => 1),"desc");

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/purchase/add-purchase', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    private function savePurchaseRecord($products = array()) {
        foreach ($products as $key => $value) {
            $data = array(
                'date'            => $this->input->post('date'),
                'voucher_no'      => $this->input->post('voucher_number'),
                'vendor_id'       => $this->input->post('supplier'),
                'category'        => $_POST['category'][$key],
                'subcategory'     => $_POST['subcategory'][$key],
                'product_name'    => $value,
                'product_code'    => $_POST['product_code'][$key],
                'purchase_price'  => $_POST['price'][$key],
                'sale_price'      => $_POST['sale_price'][$key],
                'quantity'        => $_POST['quantity'][$key],
                'discount'        => $_POST['discount'][$key],
                'subtotal'        => $_POST['subtotal'][$key],
                'godown'          => $_POST['godowns'][$key],
                'total'           => $this->input->post('total'),
                'total_discount'  => $this->input->post('total_discount'),
                'grand_total'     => $this->input->post('grand_total'),
                'paid'            => $this->input->post('paid'),
                'due'             => $this->input->post('due'),
                'status'          => "available"
            );

            if($this->action->add('purchase', $data)){
                $this->handelStock($key);
            }


            // 2017-07-19 update products table's purchase price
            $cond = array("bar_code" => $_POST['product_code'][$key]);
            $this->action->update("products",array("purchase_price" => $_POST['price'][$key],"sale_price" => $_POST['sale_price'][$key]),$cond);


        }

        $options = array(
            'title'=>'success',
            'emit'=>'Product Purchase successfully Completed!',
            'btn'=>true
        );

        return message('success', $options);
    }

    private function handelStock($index) {
        $where = array();

	    $where = array('code' => $_POST['product_code'][$index]);
        $record = $this->action->read('stock', $where);

        // set the quantity
        $quantity = ($record != null) ? ($record[0]->quantity + $_POST['quantity'][$index]): $_POST['quantity'][$index];

        // check the product update or insert
        if($record != null){
            $data = array('quantity' => $quantity,'sell_price' => $_POST['sale_price'][$index]);
            $this->action->update('stock', $data, $where);
        } else {
            $data = array(
                'category'       => $_POST['category'][$index],
                'subcategory'    => $_POST['subcategory'][$index],
                'product_name'   => $_POST['product'][$index],
                'code'           => $_POST['product_code'][$index],
                'quantity'       => $quantity,
                'purchase_price' => $_POST['price'][$index],
                'sell_price'     => $_POST['sale_price'][$index],
                'godown'         => $_POST['godowns'][$index]
            );

            $this->action->add('stock', $data);
        }
    }

    private function getAllVendors(){
        $vendors = $this->action->read('parties', array('type'=>'supplier',"trash" => "0"));
        return $vendors;
    }

    private function getAllCategory(){
        $category = $this->action->read('category');
        return $category;
    }
    
      private function getAllSubCategory(){
        $subcategory = $this->action->read('subcategory');
        return $subcategory;
    }

    private function getAllGodowns(){
        $godowns = $this->action->read('godowns');
        return $godowns;
    }

    public function show_purchase() {
       $this->data['meta_title'] = 'Purchase';
        $this->data['active'] = 'data-target="report_menu"';
        $this->data['subMenu'] = 'data-target="purchase"';
        $this->data['result'] = null;

        if(isset($_POST['show'])){
            $where = array();
            foreach($_POST['search'] as $key => $val){
                if($val != null){
                    $where[$key] = $val;
                }
            }

            foreach($_POST['date'] as $key => $val){
                if($val != null && $key == 'from'){
                    $where['date >'] = $val;
                }

                if($val != null && $key == 'to'){
                    $where['date <'] = $val;
                }
            }

            $this->data['result'] = $this->action->readGroupBy('purchase', 'voucher_no', $where);
        }

        // get all vendors
        $this->data['allVendors'] = $this->getAllVendors();
        
        // get all category
        $this->data['allCategory'] = $this->getAllCategory();
        
        // get all subcategory
        $this->data['allSubCategory'] = $this->getAllSubCategory();

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/purchase/purchase-nav', $this->data);
        $this->load->view('components/purchase/show-purchase', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function purchaseList() {

        $this->data['meta_title'] = 'Purchase';
        $this->data['active'] = 'data-target="report_menu"';
        $this->data['subMenu'] = 'data-target="list"';
        $this->data['result'] = null;
	$where = array();
        if(isset($_POST['show'])){

           $where = array(
		 "product_code"=>$this->input->post('product_code')
		);

        }

	$this->data['result'] = $this->action->readGroupBy('purchase', 'voucher_no', $where);
	   // get all vendors
        $this->data['allVendors'] = $this->getAllVendors();
        $this->data['allProduct'] = $this->action->readGroupBy('purchase','product_name');

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/purchase/purchase-nav', $this->data);
        $this->load->view('components/purchase/purchaseList', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function view() {
        $this->data['meta_title'] = 'Purchase';
        $this->data['active'] = 'data-target="report_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

        $where = array('voucher_no' => $this->input->get('vno'));
        $this->data['info'] = $this->action->read('purchase', $where);

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/purchase/purchase-nav', $this->data);
        $this->load->view('components/purchase/view', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

public function delete_purchase(){
    $where = array('voucher_no' => $this->input->get('vno'));
    $purchaseInfo = $this->action->read('purchase', $where);

    foreach ($purchaseInfo as $key => $value) {
        // set condition for every item
        $stockWhere = array(
            "category"       => $value->category,
            "subcategory"    => $value->subcategory,
            "product_name"   => $value->product_name,
            "godown"         => $value->godown
        );

        // get stock information
        $stockInfo = $this->action->read('stock', $stockWhere);

        // caltulate new quantity
        if($stockInfo != null){
            $quantity = $stockInfo[0]->quantity - $purchaseInfo[$key]->quantity;
            $data = array('quantity' => $quantity);

            // update the stock
            $this->action->update('stock', $data, $stockWhere);
        }

        // echo "<pre>"; print_r($stockInfo); echo "</pre>";
    }

    // delete row
    $response = $this->action->deleteData('purchase', $where);

    $options = array(
        'title' => 'warning',
        'emit'  => 'Purchase and Stock delete successfully!',
        'btn'   => true
    );

    $this->session->set_flashdata('deleted', message($response, $options));
    redirect('purchase/purchase/show_purchase', 'refresh');
    // echo "<pre>"; print_r($purchaseInfo); echo "</pre>";
}


}
