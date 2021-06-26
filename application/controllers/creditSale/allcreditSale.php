 <?php
class AllcreditSale extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
        $this->holder();
    }

     public function index() {
        $this->data['meta_title'] = 'All Credit Sale';
        $this->data['active'] = 'data-target="credit_sale_menu"';
        $this->data['subMenu'] = 'data-target="all-credit"';
        $this->data['result'] = $this->data['confirmation']= null;
        
        if(isset($_POST['show'])){
            $this->data['result'] = $this->searchCreditSale();
        }

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);       
        $this->load->view('components/creditSale/credit-nav', $this->data);
        $this->load->view('components/creditSale/allcredit_sales', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    private function searchCreditSale(){
        $where = array();

        $where['status']='credit_sale';

        foreach($_POST['search'] as $key => $val){
            if($val != null){
                $where[$key] = $val;
            }
        }

        foreach($_POST['date'] as $key => $val){
            if($val != null && $key == 'from'){
                $where['date >='] = $val;
            }

            if($val != null && $key == 'to'){
                $where['date <='] = $val;
            }
        }

        return $this->action->readGroupBy('sale', 'voucher_number', $where);
    }

    private function holder(){  
        if($this->session->userdata('holder') == null){
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }

}