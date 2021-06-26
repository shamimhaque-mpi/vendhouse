<?php

class Salary_statement extends Admin_Controller {

   function __construct() {
        parent::__construct();

        $this->load->model('action');
    }
    
    public function index($emit = NULL) {
        $this->data['meta_title'] = 'Salary Statement';
        $this->data['active'] = 'data-target="report_menu"';
        $this->data['subMenu'] = 'data-target="salary"';
      
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);        
        $this->load->view('components/report/salary_statement', $this->data);
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

