<?php

class GetTodaysInstallmentList extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }
    
    public function index() {
        $this->data['meta_title'] = 'Today\'s List';
        $this->data['active'] = 'data-target="lone_menu"';
        $this->data['subMenu'] = 'data-target="list"';
        $this->data['result'] = null;

        $date = date('d');
        $days = config_item('days');
        $day = $days[date('l')];

        $this->data['result'] = $this->action->getTodaysInstallment($day, $date);

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/lone/lone-nav', $this->data);
        $this->load->view('components/lone/todays-list', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    


}