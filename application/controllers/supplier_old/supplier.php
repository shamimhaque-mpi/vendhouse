<?php
class Supplier extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title']   = 'add';
        $this->data['active']       = 'data-target="supplier-menu"';
        $this->data['subMenu']      = 'data-target="add"';
        $this->data['confirmation'] = null;

        //Generate Unqiue ID
        $this->data['party_code'] = supplierUniqueId('parties');
        //$this->data['party_code'] = generateUniqueId('parties');

        if($this->input->post('add')){
            $data = array(
                'opening'        => date('Y-m-d'),
                'code'           => $this->input->post('code'),
                'name'           => $this->input->post('name'),
                'contact_person' => $this->input->post('contact_person'),
                'mobile'         => $this->input->post('mobile'),
                'address'        => $this->input->post('address'),
                'type'           => "supplier"
            );

            $options = array(
                'title' => 'success',
                'emit'  => 'Supplier Successfully Saved!',
                'btn'   => true
            );

            $this->data['confirmation']= message($this->action->add('parties', $data), $options);
            $this->session->set_flashdata('confirmation',$this->data['confirmation']);


            // insert data into balance table
            $data = array();
            $data['code'] = $this->input->post('code');
            $data['initial_balance'] =  $data['balance'] = $opening_balance = ($_POST['status'] == 'payable') ? (0 - $this->input->post('balance')) : $this->input->post('balance');

            $this->action->add('partybalance', $data);

            //insert opening balance into partymeta table
            $data = array();
            $data['party_code'] = $this->input->post('code');
            $data['meta_key']   = "opening_balance";
            $data['meta_value'] = $opening_balance;

            $this->action->add('partymeta', $data);
            redirect('supplier/supplier','refresh');

        }

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/supplier/nav', $this->data);
        $this->load->view('components/supplier/add', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function view_all() {
        $this->data['meta_title'] = 'all';
        $this->data['active']     = 'data-target="supplier-menu"';
        $this->data['subMenu']    = 'data-target="all"';

        $where = array("type" => "supplier","trash" =>0);
        $this->data['results'] = $this->action->read("parties",$where);
        

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/supplier/nav', $this->data);
        $this->load->view('components/supplier/view-all', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function preview($id=null) {
        $this->data['meta_title'] = 'view';
        $this->data['active']     = 'data-target="supplier-menu"';
        $this->data['subMenu']    = 'data-target="all"';

        $where= array('parties.id'=>$id);
        $joincond = "parties.code = partybalance.code";
        $this->data['partyInfo'] = $this->action->joinAndRead("parties", "partybalance", $joincond, $where);

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/supplier/nav', $this->data);
        $this->load->view('components/supplier/preview', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function edit($id=null) {
        $this->data['meta_title']   = 'edit';
        $this->data['active']       = 'data-target="supplier-menu"';
        $this->data['subMenu']      = 'data-target="all"';
        $this->data['confirmation'] = null;

        $where = array('id' => $id);

        if($this->input->post('update')){

            $data = array(
                'opening'        => date('Y-m-d'),
                'name'           => $this->input->post('name'),
                'contact_person' => $this->input->post('contact_person'),
                'mobile'         => $this->input->post('mobile'),
                'address'        => $this->input->post('address'),
                'status'         => $this->input->post('status')
                );
            $options = array(
                "title" => "Success",
                "emit"  => "Information Updated Successfully",
                "btn"   => true
            );

            $this->data['confirmation'] = message($this->action->update('parties', $data, $where), $options);


            //------update party balance table start  here-----//
            $where = $data = array();
            $where['code'] = $this->input->post('code');

            if($_POST['balance_type'] == 'receivable') {
                $data['balance']  = $opening_balance = 0 + $this->input->post('current_balance');
            } elseif($_POST['balance_type'] == 'payable') {
                $data['balance']  = $opening_balance = 0 -  $this->input->post('current_balance');
            } else {
               $data['balance']  = $opening_balance = 0 - 0.00;
            }

            $this->action->update('partybalance', $data, $where);
            //------update party balance table end  here------//



            //update opening balance into partymeta table
            $where               = $data = array();
            $where['party_code'] = $this->input->post('code');
            $where['meta_key']   = "opening_balance";
            $data['meta_value']  = $opening_balance;

            $this->action->update('partymeta', $data,$where);

            $this->session->set_flashdata('confirmation',$this->data['confirmation']);
            redirect('supplier/supplier/view_all','refresh');



        }


        $joinWhere = array('parties.id'=>$id);
        $joincond = "parties.code = partybalance.code";
        $this->data['info'] = $this->action->joinAndRead("parties", "partybalance", $joincond, $joinWhere);

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/supplier/nav', $this->data);
        $this->load->view('components/supplier/edit', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }





    
    
    /**
     * update table:
     * 
     * parties using party-code
     * partyBalance using party-code
     * partymeta using party-code
     * partytransaction using party-code
     * partytransactionmeta using partytransaction:id
     *
     * saprecords using party-code
     * update sapmeta table using saprecords:voucher-number
     * update sapitems table using saprecords:voucher-number
     * 
     */
    public function delete($code) {
        $data  = array("trash" => 1);

        // update party-transaction-meta table using id from party-transaction table
        $where = array("party_code" => $code);
        $transactionRec = $this->action->read('partytransaction', $where);

        if($transactionRec != null) {
            foreach ($transactionRec as $key => $value) {
                $where = array('transaction_id' => $value->id);
                $this->action->update('partytransactionmeta', $data, $where);
            }
        }

        // update party-transaction table using party-code
        $where = array("party_code" => $code);
        $this->action->update('partytransaction', $data, $where);

        // update party-meta table using party-code
        $this->action->update('partymeta', $data, $where);

        // update sapitems and sapmeta table using voucher-number from saprecords
        $sapRec = $this->action->read("saprecords", $where);

        if($sapRec != null) {
            foreach ($sapRec as $key => $row) {
                $where = array("voucher_no" => $row->voucher_no);

                // update sapmeta
                $this->action->update('sapmeta', $data, $where);

                // update sapitems
                $this->action->update('sapitems', $data, $where);
            }
        }

        // update sapitems table using party-code from patries
        $where = array("party_code" => $code);
        $this->action->update('saprecords', $data, $where);

        // update party-balance table using party-code
        $where = array("code" => $code);
        $this->action->update('partybalance', $data, $where);

        // update parties table using party-code
        $status = $this->action->update('parties', $data, $where);

        $msg_array = array(
            "title" =>"delete",
            "emit"  =>"Supplier Successfully Deleted",
            "btn"   => true
        );

        $this->session->set_flashdata("confirmation", message($status, $msg_array));

        redirect('supplier/supplier/view_all', 'refresh');
    }
    


}
