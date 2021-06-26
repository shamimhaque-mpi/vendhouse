<?php

class Production extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }
    
    public function index() {
        $this->data['meta_title'] = 'Production';
        $this->data['active'] = 'data-target="production"';
        $this->data['subMenu'] = 'data-target="add"';
        $this->data['confirmation'] = $this->data['godowns'] = null;

        $this->data['godowns']=$this->action->readDistinct('godowns','place');

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/production/production-nav', $this->data);
        $this->load->view('components/production/add', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }
    
    public function all() {
        $this->data['meta_title'] = 'Production';
        $this->data['active'] = 'data-target="production"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = $this->data['godowns'] = null;

        $this->data['godowns']=$this->action->readDistinct('godowns','place');

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/production/production-nav', $this->data);
        $this->load->view('components/production/all', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }
    
    public function view() {
        $this->data['meta_title'] = 'Production';
        $this->data['active'] = 'data-target="production"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = $this->data['godowns'] = null;

        $this->data['godowns']=$this->action->readDistinct('godowns','place');

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/production/production-nav', $this->data);
        $this->load->view('components/production/view', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }
    
    public function edit() {
        $this->data['meta_title'] = 'Production';
        $this->data['active'] = 'data-target="production"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = $this->data['godowns'] = null;

        $this->data['godowns']=$this->action->readDistinct('godowns','place');

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/production/production-nav', $this->data);
        $this->load->view('components/production/edit', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

}