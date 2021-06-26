<?php

class Lone extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }
    
    public function index() {
        $this->data['meta_title'] = 'Lone';
        $this->data['active'] = 'data-target="lone_menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['result'] = null;

        if(isset($_POST['show'])){
            $this->data['result'] = $this->getLoanAccount();
        }

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/lone/lone-nav', $this->data);
        $this->load->view('components/lone/add-lone', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    private function getLoanAccount(){
        $where = array();

        foreach($_POST['search'] as $key => $val){
            if($val != null){
                $where[$key] = $val;
            }
        }

        $where['status']  = 'opened';

        return $this->action->read('loan', $where);
    }
    

    public function show_lone() {
        $this->data['meta_title'] = 'Lone';
        $this->data['active'] = 'data-target="lone_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = $this->data['loan'] = null;

        if(isset($_POST['show'])){
            $where = array();
            foreach ($_POST['search'] as $key => $value) {
                if($value != NULL){
                    $where[$key] = $value;
                }
            }

            foreach ($_POST['date'] as $key => $value) {
                if($value != NULL && $key == 'from'){                   
                    $where['installment.date >='] = $value;
                }
                if($value != NULL && $key == 'to'){                  
                    $where['installment.date >='] = $value;
                }
            }

            $joinCond = "loan.id=installment.loan_id";
            $this->data['loan'] = $this->action->joinAndRead('loan', 'installment', $joinCond, $where);
        }
        

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/lone/lone-nav', $this->data);
        $this->load->view('components/lone/show-lone', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    


}