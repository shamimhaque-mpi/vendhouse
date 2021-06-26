<?php
class Closing extends Admin_Controller {

     function __construct() {
        parent::__construct();
        $this->holder();
        $this->load->model('action');
        $this->data["opening"]=count($this->action->read("closing"));
    }
    
    public function index() {
        $this->data['meta_title'] = 'Category';
        $this->data['active'] = 'data-target="closing-menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;

        $today = date("Y-m-d");
        //Saving Data Start here
        if ($this->input->post("submit")) {
            $today_opening = $this->input->post("init_balance") + $this->input->post("income");
            $data=array(
                "date"      =>  $today,
                "opening"   =>  $today_opening,
                "income"    =>  $this->input->post("income"),
                "cost"      =>  $this->input->post('cost'),
                "bank"      =>  $this->input->post('bank'),
                "hand_cash" =>  $this->input->post('curr_Cash')
            );
            if ($this->action->exists("closing",array("date"=>$today))) {
                $msg_array=array(
                    'title'=>'update',
                    'emit'=>'Closing Successfully Updated!',
                    'btn'=>true
                 );
                $this->data['confirmation']=message($this->action->update("closing",$data,array("date"=>$today)),$msg_array);
            }else{
                $msg_array=array(
                    'title'=>'Saved',
                    'emit'=>'Closing Successfully Saved!',
                    'btn'=>true
                 );
                $this->data['confirmation']=message($this->action->add("closing",$data),$msg_array);
            }
        }
        //Saving Data End here

        //Previous Hand
        $prev_handCash = 0;
        $last_closing = $this->action->readOrderby("closing","date",array("date !="=>$today),"desc");
        if (count($last_closing)) {
            $prev_handCash = $last_closing[0]->hand_cash;
        }

        //Income
        $income=0;
        $sales = $this->action->readGroupby("sale","voucher_number",array("date"=>$today));
        foreach ($sales as $sale) {
            $income += $sale->paid;
        }

        $where=array(
            "transaction_date"  =>  $today,
            "transaction_type"  => "Debit"
        );
        $bankDR = $this->action->read("transaction",$where);
        foreach ($bankDR as $bdr) {
            $income += $bdr->amount;
        }

        //Cost
        $cost=array();

        $purchase = $this->action->readGroupby("purchase","voucher_no",array("date"=>$today));
        foreach ($purchase as $purch) {
            $cost[] = $purch->paid;
        }

        $costs = $this->action->read("cost",array("date"=>$today));
        foreach ($costs as $cost_val) {
            $cost[] = $cost_val->amount;
        }

        //Bank
        $bank=array();
        $where=array(
            "transaction_date"  =>  $today,
            "transaction_type"  => "Credit"
        );
        $bankCR = $this->action->read("transaction",$where);
        foreach ($bankCR as $bcr) {
            $bank[] = $bcr->amount;
        }

        $this->data['income']   = $income;// + $prev_handCash;
        $this->data['pre_Cash'] = $prev_handCash;
        $this->data['cost']     = array_sum($cost);
        $this->data['bank']     = array_sum($bank);
        $this->data['curr_Cash']= ($income+$prev_handCash)-($this->data['cost']+$this->data['bank']);

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/closing/nav', $this->data);
        $this->load->view('components/closing/daily', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    public function report() {
        $this->data['meta_title'] = 'Category';
        $this->data['active'] = 'data-target="closing-menu"';
        $this->data['subMenu'] = 'data-target="report"';
        $this->data['resultset'] = null;

        // search
        if(isset($_POST['search'])){
            $where = array(
                "date"          => $this->input->post('date'),
                "opening_type"  => "auto"
            );
            
            $this->data['resultset'] = $this->action->read("closing", $where);
        }

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/closing/nav', $this->data);
        $this->load->view('components/closing/report', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    public function opening() {
        $this->data['meta_title'] = 'Category';
        $this->data['active'] = 'data-target="closing-menu"';
        $this->data['subMenu'] = 'data-target="opening"';
        $this->data['confirmation'] = null;

        $where=array(
            "opening_type"=>"menual"
        );

        //Save start
        if ($this->input->post("submit")) {
            $data=array(
                "hand_cash"     => $this->input->post("opening_amount"),
                "opening_type"  => "menual"
            );

            $msg_array=array(
                'title'=>'update',
                'emit'=>'Data Successfully Saved!',
                'btn'=>true
             );
            $this->data['confirmation']=message($this->action->add("closing",$data),$msg_array);
        }
        //Save end
        //Update Start
        if ($this->input->post("update")) {
            $data=array(
                "hand_cash" => $this->input->post("opening_amount")
            );

            $msg_array=array(
                'title'=>'update',
                'emit'=>'Data Successfully Updated!',
                'btn'=>true
             );
            $this->data['confirmation']=message($this->action->update("closing",$data,$where),$msg_array);
        }
        //Update End

        $this->data["opening_val"] = $this->action->read("closing",$where);

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/closing/nav', $this->data);
        $this->load->view('components/closing/opening', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    
  private function holder(){  
        if($this->session->userdata('holder') == null){
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }

}
