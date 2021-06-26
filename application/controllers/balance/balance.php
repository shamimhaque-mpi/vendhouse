<?php 
/**
* 
*/
class Balance extends Admin_Controller{
	
	function __construct(){
        parent::__construct();
        $this->holder();
        $this->load->model('action');
	}

	public function index(){
		$this->data['meta_title'] = 'Balance';
        $this->data['active'] = 'data-target="report_menu"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = null;

        //search balance sheet
        $where = array( ); 
        if(isset($_POST['search'])) {

            foreach($_POST['date'] as $key => $val){
                if($val != null && $key == 'from'){
                    $where['date >='] = $val;
                }

                if($val != null && $key == 'to'){
                    $where['date <='] = $val;
                }
            }

        }
        //Sale Information Start here
        $sales = $this->action->readGroupBy("sale","voucher_number", $where);
        $due_collection = $this->action->read_sum("due_payment","paid",$where);
        $discount = $vat = $due = $paid = $return = 0;

        foreach ($sales as $key => $sale) {
            $discount   += $sale->discount;
            $vat        += $sale->vat_amount;
            $due        += $sale->due;
            $paid       += $sale->paid;
            $return     += $sale->return_amount;
        }

        $this->data["discount"] = $discount;
        $this->data["vat"] = $vat;
        $this->data["due"] = $due;
        $this->data["paid"] = $paid;
        $this->data["return"] = $return;
        $this->data["due_collection"] = $due_collection[0]->paid;
        //Sale Information End here
        
        //Purchase Section Start here
        $purchases = $this->action->readGroupBy("purchase","voucher_no", $where);
        $purchase_total = $purchase_paid = $purchase_return = 0;
        foreach ($purchases as $key => $purchase) {
            $purchase_total   += $purchase->grand_total;
            $purchase_paid    += $purchase->paid;
        }

        $this->data["purchase_total"] = $purchase_total;
        $this->data["purchase_paid"]  = $purchase_paid;
        //Purchase Section End here
        
        //Expendeture Section Start here
        $cost = $this->action->read_sum("cost","amount",$where);
        $this->data["expenditure"] = $cost[0]->amount;
        //Expendeture Section End here
        
        //Business Status Start here
        $stock_value = $this->action->stock_amount($where);
        $this->data["stock_value"] = $stock_value[0]->stock_amount;
        //Business Status End here
        
        //Other Income Start here
        $other_income = $this->action->read_sum("income","amount",$where);
        $this->data["other_income"] = $other_income[0]->amount;
        //Other Income End here

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/balance/balance', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }




  private function holder(){  
        if($this->session->userdata('holder') == null){
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }
}