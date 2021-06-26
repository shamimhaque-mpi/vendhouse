<?php

class Supplier_report extends Admin_Controller {

     function __construct() {
        parent::__construct();
        $this->load->model('action');
    }
    
    public function index() {
        $this->data['meta_title'] = 'Report';
        $this->data['active'] = 'data-target="report_menu"';
        $this->data['subMenu'] = 'data-target="supplier_report"';
        $this->data['confirmation'] = null;
        
        $where = array();
        if(isset($_POST['show'])){
            foreach ($_POST['date'] as $key => $value) {
                if($value != NULL && $key == "from"){
                    $where["order_date >="] = $value;
                }

                if($value != NULL && $key == "to"){
                    $where["order_date <="] = $value;
                }
            }
        }
        
        $this->data['allOrder'] = $this->action->read('orders',$where);

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/report/nav', $this->data);
        $this->load->view('components/report/supplier_report', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }
}
