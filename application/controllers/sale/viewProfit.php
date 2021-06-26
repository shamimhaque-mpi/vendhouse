 <?php

class ViewProfit extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title'] = 'Sale';
        $this->data['active'] = 'data-target="sale_menu"';
        $this->data['subMenu'] = 'data-target="all"';

        $this->data["vheaderInfo"] = $this->action->read("voucher_header");
        $this->data["vfooterInfo"] = $this->action->read("voucher_footer");

        $where = array('voucher_number' => $this->input->get('vno'));
        $this->data['result'] = $this->action->read('sale', $where);

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/sale/sale-report-nav', $this->data);
        $this->load->view('components/sale/view_profit', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

}