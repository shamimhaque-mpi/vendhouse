 <?php

class SearchSale extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title'] = 'Sale';
        $this->data['active'] = 'data-target="report_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['result'] = null;

        if(isset($_POST['show'])){
            $this->data['result'] = $this->searchSale();
        }

        $this->data['product_cats'] = $this->action->read('category');

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/sale/sale-report-nav', $this->data);
        $this->load->view('components/sale/show-sale', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function monthly_report() {
        $this->data['meta_title'] = 'Sale';
        $this->data['active'] = 'data-target="report_menu"';
        $this->data['subMenu'] = 'data-target="monthly_report"';
        $this->data['result'] = null;


        $where = array("total <" => "500");

        if(isset($_POST['show'])){
            /*foreach($_POST['search'] as $key => $val){
                if($val != null){
                    $where[$key] = $val;
                }
            }*/

            foreach($_POST['date'] as $key => $val){
                if($val != null && $key == 'from'){
                    $where['date >='] = $val;
                }

                if($val != null && $key == 'to'){
                    $where['date <='] = $val;
                }
            }

            $where['quantity >'] =  0;

            $this->data['result'] = $this->action->readGroupBy('sale', 'voucher_number', $where);
        }



        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/sale/sale-report-nav', $this->data);
        $this->load->view('components/sale/monthly_report', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    private function searchSale(){
        $where = array();

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

        $where['quantity >'] =  0;

        return $this->action->readGroupBy('sale', 'voucher_number', $where);
    }

}
