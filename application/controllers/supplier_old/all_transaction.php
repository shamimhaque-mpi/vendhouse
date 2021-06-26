<?php
class All_transaction extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title']   = 'All Transaction';
        $this->data['active']       = 'data-target="supplier-menu"';
        $this->data['subMenu']      = 'data-target="all-transaction"';
        $this->data['confirmation'] = $this->data['transactionInfo'] = null;

        // Get all parties name
        $where = array("type" => "supplier","trash" =>0,"status" =>"active");
        $this->data['info'] = $this->action->readGroupBy('parties', 'name', $where, 'id', 'asc');

        $where = array("trash" =>0,"status" => "payable" );

        if(isset($_POST['show'])) {

            if($this->input->post('search') != NULL){
                foreach ($this->input->post('search') as $key => $value) {
                    $where[$key] = $value;
                }
            }

            if($this->input->post('date') != NULL){
                foreach($_POST['date'] as $key => $value) {
                    if($value != NULL){
                        if($key == "from"){$where["transaction_at >="] = $value;}
                        if($key == "to"){$where["transaction_at <="] = $value;}
                    }
                }
            }
        }

        $this->data['transactionInfo'] = $this->action->read('partytransaction', $where);

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/supplier/nav', $this->data);
        $this->load->view('components/supplier/allTransaction', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }
	
    public function view($id=null) {
        $this->data['meta_title']   = 'Voucher';
        $this->data['active']       = 'data-target="supplier-menu"';
        $this->data['subMenu']      = 'data-target="all-transaction"';
        $this->data['confirmation'] = $this->data['transactionInfo'] = null;

        //unic Id
        $this->data['party_code'] = supplierUniqueId('parties');
        // Get transactionj Info
        $where = array("id" => $id);
        $this->data['partyinfo'] = $this->action->read("partytransaction",$where);


        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/supplier/nav', $this->data);
        $this->load->view('components/supplier/view', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }


    /**
     * update table
     *
     * update party-balance using prty-code from partytransaction
     * eq: (party balance - paid)
     *
     * update sapitems table using voucher-number from partytransaction:relation
     * update sapmeta table using voucher-number from partytransaction:relation
     * update saprecords table using voucher-number from partytransaction:relation
     * 
     * update partytransactionmeta table using transaction_id from partytransaction:id
     * update partytransaction table using id
     * 
     */
	public function delete_transaction($id) {
        // update party-balance using prty-code from partytransaction
        $where = array("id" => $id);
        $transactionRec = $this->action->read('partytransaction', $where);
        
        $where = array('code' => $transactionRec[0]->party_code);
        $balanceRec = $this->action->read('partybalance', $where);

        $balance = $balanceRec[0]->balance - $transactionRec[0]->paid;
        $data = array('balance' => $balance);

        $this->action->update('partybalance', $data, $where);

        // update sapitems, sapmeta and saprecords table using voucher-number from partytransaction:relation
        $data = array('trash' => 1);

        if($transactionRec[0]->relation != 'transaction') {
            $relation = explode(":", $transactionRec[0]->relation);
            $where = array("voucher_no" => $relation[1]);
            
            // update sapitems
            $this->action->update("sapitems", $data, $where);

            // update sapitems
            $this->action->update("sapmeta", $data, $where);

            // update sapitems
            $this->action->update("saprecords", $data, $where);
        }
        
        // update partytransactionmeta table using transaction_id from partytransaction:id
        $where = array('transaction_id' => $transactionRec[0]->id);
        $this->action->update("partytransactionmeta", $data, $where);
        
        // update partytransaction table using id
        $where = array('id' => $transactionRec[0]->id);
        $this->action->update("partytransaction", $data, $where);

        $msg = array(
            "title" => "Deleted",
            "emit"  => "Transaction Successfully Deleted",
            "btn"   => true
        );

        $this->session->set_flashdata('confirmation', message("danger", $msg));

        redirect('supplier/all_transaction', 'refresh');
    }


}
