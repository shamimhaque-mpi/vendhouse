<?php

class User_supplier extends Admin_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('action');
    }
    
    public function index() {
        $this->data['meta_title'] = 'user_supplier';
        $this->data['active'] = 'data-target="user_supplier_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;
        
        $this->data['allSupplier'] = $this->action->read('users', array('privilege' => 'user'));
	
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/user_supplier/user_supplier', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }


}
