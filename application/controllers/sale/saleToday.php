 <?php

class SaleToday extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title'] = 'Sale';
        $this->data['active'] = 'data-target="report_menu"';
        $this->data['subMenu'] = 'data-target="today"';
        
        $where = array("date" => date("Y-m-d"));
	    $this->data['sales'] = $this->action->readGroupBy("sale", 'voucher_number', $where, 'id', 'asc');

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/sale/sale-report-nav', $this->data);
        $this->load->view('components/sale/sale_today', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

}