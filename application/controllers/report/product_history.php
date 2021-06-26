
<?php

class Product_history extends Admin_Controller {

   function __construct() {
        parent::__construct();

        $this->load->model('action');
        $this->load->library("pagination");
        $this->load->helper("url");
    }
    
    public function index($emit = NULL) {
        $this->data['meta_title'] = 'Product History';
        $this->data['active'] = 'data-target="report_menu"';
        $this->data['subMenu'] = 'data-target="product"';

        $this->data["products"] = $this->action->read("products");
        $this->data["product_history"] = $this->action->read("products");
      

        
          if(isset($_POST['show'])){
	          $where = array("bar_code" => $this->input->post("product_code"));
	          $this->data["product_history"] = $this->action->read("products",$where);
         }   



        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);        
        $this->load->view('components/report/product_history', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    } 
  
   private function holder() {
		$holder = config_item('privilege');		
        if(!(in_array($this->session->userdata('holder'), $holder))){
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }

}

