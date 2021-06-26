 <?php

class SalesItem extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title'] = 'Sale';
        $this->data['active'] = 'data-target="sale_menu"';
        $this->data['subMenu'] = 'data-target="saleslist"';
        $this->data['result'] = null;
		
		$this->data['info'] = $this->action->read("sale",array('status' => 'sale'));

		

		if($this->input->post('submit')){
			$where = array(
				'product' => $this->input->post('productName'),
				'status' => 'sale'
			);
			$this->data['result'] = $this->action->read("sale",$where);
			//print_r($where);
		}
		
		//print_r($this->data['result']);
	
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/sale/sale-report-nav', $this->data);
        $this->load->view('components/sale/sales_item', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

}