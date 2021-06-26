<?php
class Dashboard extends Admin_controller{
    function __construct() {
        parent::__construct();
        $this->holder();
        $this->load->model('action');
    }
    
    public function index() {
        $this->data['meta_title'] = 'dashboard';
        $this->data['active'] = 'data-target="dashboard"';
        $this->data['subMenu'] = 'data-target=""';


        /*$this->data['sale'] = $this->action->read('sale',array('date' => date('Y-m-d')));
        $this->data['purchase'] = $this->action->sum('purchase', 'grand_total', array('date' => date('Y-m-d')));
        $this->data['cost'] = $this->action->sum('cost', 'amount', array('date' => date('Y-m-d')));
        $this->data['bank'] = $this->action->sum('transaction', 'amount', array('transaction_date' => date('Y-m-d'), 'transaction_type' => 'Debit'));
        $this->data['stock'] = $this->action->readStock('stock',10);*/
        
        $this->data['today_order_amount'] = $this->action->sum('orders', 'grand_total', array('order_date' => date('Y-m-d')));
        //print_r($this->data['today_order_amount']);
        $this->data['today_order'] = count($this->action->read('orders', array('order_date' => date('Y-m-d'))));
        $this->data['today_cost_amount'] = $this->action->sum('cost', 'amount', array('date' => date('Y-m-d')));
        //print_r($this->data['today_cost_amount']);
        
        $this->data['total_order']          = count($this->action->read('orders'));
        $this->data['total_pending_order']  = count($this->action->read('orders', array('status'=>'pending')));
        $this->data['total_approved_order'] = count($this->action->read('orders', array('status'=>'delivered')));
        
        

        $this->load->view('super/includes/header', $this->data);
        $this->load->view('super/includes/aside', $this->data);
        $this->load->view('super/includes/headermenu', $this->data);
        $this->load->view('super/dashboard', $this->data);
        $this->load->view('super/includes/footer');
    }

    private function holder(){
        if($this->uri->segment(1) != $this->session->userdata('holder')){
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }

}
