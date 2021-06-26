 <?php

class ViewcreditSale extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
        $this->holder();
    }

    public function index() {
        $this->data['meta_title'] = 'Sale';
        $this->data['active'] = 'data-target="credit_sale_menu"';
        $this->data['subMenu'] = 'data-target="all-credit"';
        $this->data['result'] = $this->data['confirmation'] = null;
        
        $where=array('voucher_number'=>$_GET['vno']);
        $this->data['result'] = $this->action->read('sale',$where);
    

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/creditSale/credit-nav', $this->data);
        $this->load->view('components/creditSale/view_credit', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }  

    private function holder(){  
        if($this->session->userdata('holder') == null){
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }

}