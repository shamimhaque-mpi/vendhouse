<?php
class Transaction extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title']   = 'transaction';
        $this->data['active']       = 'data-target="supplier-menu"';
        $this->data['subMenu']      = 'data-target="transaction"';
        $this->data['confirmation'] = null;

        if(isset($_POST['save'])) {
            $previous_balance = ($this->input->post('sign') == "Receivable") ? (0 + $this->input->post('balance')) : (0 - $this->input->post('balance'));

            $current_balance = ($this->input->post('csign') == "Receivable") ? (0 + $this->input->post('totalBalance')) : (0 - $this->input->post('totalBalance'));

            $data = array(
                'transaction_at'     => $this->input->post('created_at'),
                'party_code'         => $this->input->post('code'),
                'previous_balance'   => $previous_balance,
                'paid'               => $this->input->post('payment'),
                'current_balance'    => $current_balance,
                'transaction_via'    => $this->input->post('payment_type'),
                'relation'           => 'transaction',
                'comment'            => $this->input->post('comment'),
                'status'             => "payable"
            );

            $options = array(
                'title' => 'success',
                'emit'  => 'Supplier Transaction Successfully Saved!',
                'btn'   => true
            );

            $message = message($this->action->add('partytransaction', $data), $options);

            $this->calculateBalance($current_balance, $this->input->post('code'));
            $this->session->set_flashdata('confirmation', $message);

            $lastId = $this->action->read('partytransaction',array(),'DESC');
            
            redirect('supplier/all_transaction/view/' . $lastId[0]->id, 'refresh');
        }

        // Get all client parties name
        $where = array(
            "type"   => "supplier", 
            "status" => "active", 
            "trash"  => 0
        );

        $this->data['info'] = $this->action->readGroupBy('parties', 'name', $where, "id", "asc");

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/supplier/nav', $this->data);
        $this->load->view('components/supplier/transaction', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    /**
     * update table
     * 
     * update partybalance table using code from partytransaction:party_code
     * 
     * update partytransactionmeta table using transaction_id from partytransaction:id
     * update partytransaction table using id
     *
     */
    public function edit_transaction($id = null) {
        $this->data['meta_title']   = 'transaction';
        $this->data['active']       = 'data-target="supplier-menu"';
        $this->data['subMenu']      = 'data-target="all-transaction"';
        $this->data['confirmation'] = null;

        if(isset($_POST['update'])) {
            // update partybalance table using code from partytransaction:party_code
            $where = array('id' => $this->uri->segment(4));
            $partytransactionRec = $this->action->read('partytransaction', $where);

            $balance = ($this->input->post('csign') == 'Receivable') ? (0 + $this->input->post('totalBalance')) : (0 - $this->input->post('totalBalance'));

            $where = array('code' => $partytransactionRec[0]->party_code);
            $data = array('balance' => $balance);

            $this->action->update('partybalance', $data, $where);

            // update partytransactionmeta table using transaction_id from partytransaction:id
            if($this->input->post('payment_type') == 'cheque') {
                foreach ($_POST['meta'] as $key => $value) {
                    $where = array(
                        'transaction_id' => $id,
                        'meta_key' => $key
                    );

                    $data = array('meta_value' => $value);

                    $this->action->update('partytransactionmeta', $data, $where);
                }
            }

            // update partytransaction table using id
            $where = array('id' => $id);

            $data = array(
                'change_at'          => date('Y-m-d'),
                // 'previous_balance'   => $this->input->post('balance'),
                'paid'               => $this->input->post('payment'),
                // 'current_balance'    => $this->input->post('totalBalance'),
                'transaction_via'    => $this->input->post('payment_type'),
                'remark'             => $this->input->post('remark'),
                'status'             => $this->input->post('csign')
            );

            $msg = $this->action->update('partytransaction', $data, $where);

            $options = array(
                'title' => 'success',
                'emit'  => 'Supplier Transaction Successfully Saved!',
                'btn'   => true
            );

            $this->session->set_flashdata('confirmation', message($msg, $options));

            redirect('supplier/transaction/edit_transaction/' . $id, 'refresh');
        }

        // Get transactionj Info
        $where = array("id" => $id);
        $this->data['transactionRec'] = $this->action->read('partytransaction', $where);

        // get party info 
        $joincond = "parties.code = partybalance.code";
        $where = array('parties.code' => $this->data['transactionRec'][0]->party_code);

        $this->data['partyinfo'] = $this->action->joinAndRead("parties", "partybalance", $joincond, $where);

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/supplier/nav', $this->data);
        $this->load->view('components/supplier/edit_transaction', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }

    private function calculateBalance($balance, $who) {
        $data = array('balance' => $balance);
        $where = array('code' => $who);

        $this->action->update('partybalance', $data, $where);
    }


}
