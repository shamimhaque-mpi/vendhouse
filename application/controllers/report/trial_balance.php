<?php

class Trial_balance extends Admin_Controller {

   function __construct() {
        parent::__construct();

        $this->load->model('action');
    }
    
    public function index($emit = NULL) {
        $this->data['meta_title'] = 'trial balance';
        $this->data['active'] = 'data-target="report_menu"';
        $this->data['subMenu'] = 'data-target="trial"';

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);        
        $this->load->view('components/report/trial_balance', $this->data);
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

