<?php

/**
* working with product purchase  section.
* Methods():
*   index: Handle purchase entry to database.
*   create: insert record to database.
*   handelPartyTransaction: insert transactional record.
*   sapmeta: add additional info to database.
*   handelStock: update product stock in database table.
*   getAllparty: fetch all party.
*   getAllProducts: fetch all products.
*   getAllGodowns: fetch all Godowns.
*   show_purchase: fetch all purchase records from database.
*   view: preview particular purchase record.
*   delete_purchase: delete particular purchase record.
*   itemWise: fetch product wise purchase record.
*
**/

class Purchase extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }
    public function index() {
        $this->data['meta_title']   = 'Purchase';
        $this->data['active']       = 'data-target="purchase_menu"';
        $this->data['subMenu']      = 'data-target="add-new"';
        $this->data['confirmation'] = null;
        
        $this->data['invoice'] = generate_invoice("saprecords",array("status" => "purchase"));

        // save purchase data
        if(isset($_POST['save'])){
           $this->data['confirmation'] = $this->create();
           $this->session->set_flashdata("confirmation",$this->data['confirmation']);
           redirect("purchase/purchase","refresh");
        }

        // get all vendors
        $this->data['allParty'] = $this->getAllparty();

        // get all products
        $this->data['allProducts'] = $this->getAllProducts();

        // get all godowns
        $this->data['allGodowns'] = $this->getAllGodowns();

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/purchase/nav', $this->data);
        $this->load->view('components/purchase/add', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    private function create(){
        // insert purchase record
        $total_quantity = 0;
        foreach ($_POST['product'] as $key => $value) {
            $total_quantity += $_POST['quantity'][$key];

            $data = array();
            $data['sap_at']         = $this->input->post('date');
            $data['voucher_no']     = $this->input->post('voucher_no');
            $data['product_code']   = $_POST['product_code'][$key];
            $data['purchase_price'] = $_POST['purchase_price'][$key];
            $data['quantity']       = $_POST['quantity'][$key];
            $data['unit']           = $_POST['unit'][$key];
            $data['status']         = 'purchase';

            if($this->action->add('sapitems', $data)){
                $this->handelStock($key);
            }
        }

        // insert bill record
        if($this->input->post("current_sign") == "Receivable"){
            $balance = 0 + $this->input->post('current_balance');
        } else {
            $balance = 0 - $this->input->post('current_balance');
        }

        $data = array(
            'sap_at'            => $this->input->post('date'),
            'voucher_no'        => $this->input->post('voucher_no'),
            'party_code'        => $this->input->post('party_code'),
            'total_bill'        => $this->input->post('grand_total'),
            'total_quantity'    => $total_quantity,
            'total_discount'    => $this->input->post('total_discount'),
            'transport_cost'    => $this->input->post('transport_cost'),
            'party_balance'     => $balance,
            'paid'              => $this->input->post('paid'),
            'method'            => $this->input->post('method'),   
            'status'            => 'purchase',
        );

        $status = $this->action->add('saprecords', $data);
        $this->handelPartyTransaction();
        $this->sapmeta();

        $options = array(
            'title' => 'success',
            'emit'  => 'Purchase successfully Completed!',
            'btn'   => true
        );

        return message($status, $options);
    }
    /**
    * Table : partytransaction
    * Strategy : 
    *    set purchase grandtotal amount to credit column
    *    set paid amount to debit column
    *       
    **/
    private function handelPartyTransaction(){
        
        // fetch last insert record and increase by 1.
        $where = array('party_code' => $this->input->post('party_code'));
        $last_sl = $this->action->read_limit('partytransaction',$where,'desc',1);
        $voucher_sl = ($last_sl)? ($last_sl[0]->serial+1) : 1;
        
        $data = array(
            'transaction_at'    => $this->input->post('date'),
            'party_code'        => $this->input->post('party_code'),
            'credit'            => $this->input->post('grand_total'),
            'debit'             => $this->input->post('paid'),
            'transaction_via'   => $this->input->post('method'),
            'relation'          => 'purchase:' . $this->input->post('voucher_no'),
            'remark'            => 'purchase',
            'serial'            => $voucher_sl
        );

        $this->action->add('partytransaction', $data);

        return true;
    }

    private function sapmeta() {
        if (isset($_POST['meta'])) {
            foreach ($_POST['meta'] as $key => $value) {
                $data = array(
                    'voucher_no'    => $this->input->post('voucher_no'),
                    'meta_key'      => $key,
                    'meta_value'    => $value
                );
                $this->action->add('sapmeta', $data);
            }
        }
        $data['meta_key']   = 'purchase_by';
        $data['meta_value'] = $this->data['name'];
        $this->action->add('sapmeta', $data);
    }

    private function handelStock($index) {
        // get stock info
        $where                = array();
        $where['code']        = $_POST['product_code'][$index];
        $record = $this->action->read('stock', $where);

        // set the quantity
        $quantity = ($record != null) ? ($record[0]->quantity + $_POST['quantity'][$index]): $_POST['quantity'][$index];

        // check the product update or insert
        // set product an averge purchase price if the product have already purchased before.
        
        if($record != null) {
            $data = array('quantity' => $quantity);
            
            //read from `sapitems` table for previous purchase price 
            $cond = array(
                'product_code' => $_POST['product_code'][$index],
                'trash' => 0
            );
            $purchaseRecords = $this->action->read('sapitems',$cond); 
            
            $count = 0.00;
            $totalPurchasePrice =  0.00;
            if($purchaseRecords != null ){
                foreach($purchaseRecords as $key => $value){
                    $totalPurchasePrice += ($value->purchase_price * $value->quantity);
                    $count +=  $value->quantity;
                }
            }else{
                $count = 1; // for escaping ZeroDivisonError
            }
            
            $average_price = ($totalPurchasePrice) / $count;
            
            
            if($_POST['purchase_price'][$index] > 0) {
                $data['purchase_price'] = $average_price;
            }
            $this->action->update('stock', $data, $where);
        } else {
            $data = array(
                'code'          => $_POST['product_code'][$index],
                'name'          => $_POST['product'][$index],
                'category'      => $_POST['product_cat'][$index],
                'subcategory'   => $_POST['product_subcat'][$index],
                'quantity'      => $quantity,
                'purchase_price'=> $_POST['purchase_price'][$index],
                'sell_price'    => $_POST['sale_price'][$index],
                'unit'          => $_POST['unit'][$index],
            );

            $this->action->add('stock', $data);
        }
    }

    private function getAllparty(){
        $where = array(
            "type"   => "supplier",
            "status" => "active",
            "trash"   => 0
        );
        $party = $this->action->read("parties", $where);
        return $party;
    }

    private function getAllProducts(){
        $where = array("status" => 1);
        $products = $this->action->read("products", $where);
        return $products;
    }

    private function getAllGodowns(){
        $godowns = $this->action->read("godowns");
        return $godowns;
    }

    public function show_purchase() {
        $this->data['meta_title'] = 'Purchase';
        $this->data['active']     = 'data-target="purchase_menu"';
        $this->data['subMenu']    = 'data-target="all"';
        $this->data['result']     = null;

        $where = array('sap_at' => date("Y-m-d"));
        $where["saprecords.status"] = 'purchase';
        $where["saprecords.trash"] = 0;
        $joinCond = "saprecords.party_code = parties.code";
        $this->data['result'] = $this->action->joinAndReadPurchase("saprecords", "parties", $joinCond, $where,"saprecords.id","desc");

        if(isset($_POST['show'])){
            $where = array();
            foreach($_POST['search'] as $key => $val){
                if($val != null){
                    $where["saprecords.".$key] = $val;
                }
            }

            foreach($_POST['date'] as $key => $val){
                if($val != null && $key == 'from'){
                    $where['saprecords.sap_at >'] = $val;
                }

                if($val != null && $key == 'to'){
                    $where['saprecords.sap_at <'] = $val;
                }
            }
            
            
            $where["saprecords.status"] = 'purchase';
            $where["saprecords.trash"] = 0;
            $joinCond = "saprecords.party_code = parties.code";
            $this->data['result'] = $this->action->joinAndReadPurchase("saprecords", "parties", $joinCond, $where,"saprecords.id","desc");
        }

        

        // get all party
        $this->data['allParty'] = $this->getAllparty();

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/purchase/nav', $this->data);
        $this->load->view('components/purchase/view-all', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function view() {
        $this->data['meta_title'] = 'Purchase';
        $this->data['active'] = 'data-target="purchase_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

        $where = array(
            'saprecords.voucher_no' => $this->input->get('vno'),
            'saprecords.status' => 'purchase'
            );
        $joinCond = "saprecords.party_code = parties.code";
        $this->data['purchase_record'] = $this->action->joinAndRead("saprecords", "parties", $joinCond, $where);

        $where = array(
            "sapitems.voucher_no" => $this->input->get('vno'),
            'sapitems.status' => 'purchase',
            'sapitems.trash' => 0
        );

        $joinCond = "sapitems.product_code = products.product_code";
        $this->data['purchase_info'] = $this->action->joinAndRead("products","sapitems",$joinCond,$where);

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/purchase/nav', $this->data);
        $this->load->view('components/purchase/view', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    /**
    * Delete purchase and update stock
    * table : saprecords,sapitems,stock,partytransaction
    * Strategy:
    *   Update column trash 0 to 1
    *   Update Stock quantity by code,category,subcategory,godown
    *
    **/
    public function delete_purchase() {
        $where = array('voucher_no' => $this->input->get('vno'));

        $where = array('voucher_no' => $this->input->get('vno'));
        $purchaseInfo = $this->action->read('sapitems', $where);

        foreach ($purchaseInfo as $key => $value) {
            // set condition for every item
            $stockWhere = array("code" => $value->product_code);

            // get stock information
            $stockInfo = $this->action->read('stock', $stockWhere);

            // caltulate new quantity
            if($stockInfo != null){
                $quantity = $stockInfo[0]->quantity - $purchaseInfo[$key]->quantity;
                $data = array('quantity' => $quantity);

                // update the stock
                $this->action->update('stock', $data, $stockWhere);
            }
        }

        // Update row
        $data = array("trash" => 1);
        $response = $this->action->update('sapitems', $data, $where);
        $response = $this->action->update('saprecords', $data, $where);
        $response = $this->action->update('sapmeta', $data, $where);
        $this->action->update('partytransaction', $data, array("relation" => "purchase:".$this->input->get('vno')));

        $options = array(
            'title' => 'delete',
            'emit'  => 'Purchase  delete successfully!',
            'btn'   => true
        );
        
        $this->session->set_flashdata('deleted', message($response, $options));
        redirect('purchase/purchase/show_purchase', 'refresh');
    }
    
    public function itemWise() {
        $this->data['meta_title'] = 'Purchase';
        $this->data['active'] = 'data-target="purchase_menu"';
        $this->data['subMenu'] = 'data-target="wise"';
        $this->data['result'] = null;
        
        $this->data['allProducts'] = $this->action->read('products');
    
        if(isset($_POST['show'])){ 
            $where = array();
            $where["product_code"] = $_POST['product_code'];
            $where["status"] ="purchase";
            $where["trash"] = 0;

            $this->data['result'] = $this->action->read("sapitems", $where);

            $cond = array('product_code'=>$_POST['product_code']); 
            $this->data['rawname'] = $this->action->read('products', $cond);           
        }

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/purchase/nav', $this->data);
        $this->load->view('components/purchase/itemWise', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }
}
