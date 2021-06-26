 <?php

class SaleChalan extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title'] = 'Sale';
        $this->data['active'] = 'data-target="report_menu"';
        $this->data['subMenu'] = 'data-target="chalan"';
        $this->data['result'] = $this->data['total_voucher'] = null;

        $where = array(
            "date"        => date("Y-m-d"),
            "quantity >"  => 0
        );
        $this->data['result'] = $this->action->readGroupBy("sale","code",$where,"id","desc");


        if(isset($_POST['show'])){
            $this->data['result'] = $this->searchSale();
        }

        $totalVno = 0;
        foreach($this->data['result'] as $key => $row){
            $info = $this->action->read("sale",array("code" => $row->code));
            $totalVno += count($info);
        }
        $this->data['total_voucher'] = $totalVno;

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/sale/sale-report-nav', $this->data);
        $this->load->view('components/sale/sale-chalan', $this->data);
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

        return $this->action->readGroupBy('sale', 'code', $where,"id","desc");
    }

}
