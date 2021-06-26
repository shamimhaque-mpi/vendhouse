<?php

class TakeInstallment extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }
    
    public function index() {
        $this->data['meta_title'] = 'Lone';
        $this->data['active'] = 'data-target="lone_menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = $this->data['memberInfo'] = null;

        if(isset($_POST['save'])){
            $this->data['confirmation'] = $this->takeLoan();
        }

        $where = array('id' => $this->input->get('lid'));
        $this->data['loanRecord'] = $this->action->read('loan', $where);

        if($this->data['loanRecord'] != null){
            $where = array('member_id' => $this->data['loanRecord'][0]->member_id);
            $this->data['memberInfo'] = $this->action->read('members', $where);

            $where = array('voucher_number' => $this->data['loanRecord'][0]->voucher_number);
            $this->data['saleRecord'] = $this->action->read('sale', $where);
        }

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/lone/lone-nav', $this->data);
        $this->load->view('components/lone/take_installment', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    private function takeLoan(){
        $status = 'warning';

        for($i=0;$i<$_POST['installment'];$i++){
            $data = array(
                'date' => $this->input->post('date'),
                'loan_id' => $this->input->get('lid'),
                'amount' => $this->input->post('amount')
            );
                
            $status = $this->action->add('installment', $data);
        }

        $this->updateSaleDue();

        $options = array(
            'title' => 'success',
            'emit'  => 'Installment has been successfully taken!',
            'btn'   => true
        );

        return message($status, $options);
    }

    private function updateSaleDue(){
        $where = array('voucher_number' => $this->input->post('voucherNumber'));

        // get data from loan table
        $info = $this->action->read('loan', $where);

        $due = $info[0]->due - ($this->input->post('amount') * $this->input->post('installment'));

        if($due <= 0.00){
            $data = array('due' => $due, 'status' => 'closed');
        } else {
            $data = array('due' => $due);
        }
        
        $this->action->update('loan', $data, $where);

        return 0;
    }

}