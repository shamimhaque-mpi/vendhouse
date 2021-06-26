<?php

class Cost extends Admin_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->model('action');
        $this->data['meta_title'] = 'Cost';
        $this->data['active']  = 'data-target="report_menu"';
    }

    public function index() {
        $this->data['subMenu'] = 'data-target="cost"';

        $this->data['cost_fields'] =$this->action->readDistinct('cost_field',"cost_field");

        $where=array('trash'=>0);

        if(isset($_POST['show'])){
            foreach ($_POST['search'] as $key => $value) {
                if($value != NULL){
                    $where[$key] = $value;
                }
            }

            foreach ($_POST['date'] as $key => $value) {
                if($value != NULL && $key == "from"){
                    $where['date >='] = $value;
                }
				
                if($value != NULL && $key == "to"){
                    $where['date <='] = $value;
                }
            }
            //print_r($where);
        }

        $this->data['costs']=$this->action->read('cost', $where);

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/report/cost', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }



}