<?php

class Supplier_tran extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
        $this->load->library('upload');
    }

    public function index() {
        $this->data['meta_title'] = 'Supplier Transaction';
        $this->data['active'] = 'data-target="supplierTran_menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;

        $this->data['vendors']= $this->action->readGroupBy('vendor','vendor_name');

        if(isset($_POST['submit'])){
            $this->data['confirmation']=$this->supplierTransaction();
        }

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/supplier_tran/nav', $this->data);
        $this->load->view('components/supplier_tran/add', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    private function supplierTransaction(){
        $where = array("voucher_no" => $_POST['voucher_number']);
        $purchaseInfo = $this->action->read("purchase",$where);

        $data_update=array(
            "paid" => $purchaseInfo[0]->paid + $_POST['payment'],
            "due"  => $purchaseInfo[0]->grand_total - ($purchaseInfo[0]->paid + $_POST['payment'])
        );

        $data = array(
            'date'              => date('Y-m-d'),
            'voucher_number'    => $_POST['voucher_number'],
            'supplier_name'     => $_POST['supplier_name'],
            'company_name'      => $_POST['company_name'],
            'balance'           => $_POST['balance'],
            'payment_type'      => $_POST['payment_type'],
            'payment'           => $_POST['payment'],
            'net_balance'       => $_POST['net_balance']
        );

        $options=array(
            'title'=>'success',
            'emit'=>'Supplier transaction successfully Completed!',
            'btn'=>true
        );

        $this->action->update('purchase',$data_update,$where);
        $id = $this->action->addAndGetID('supplier_transaction',$data);
        redirect('supplier_tran/supplier_tran/view_supplier_tran/'.$id,'refresh');

    }


    public function view_supplier_tran($id = NULL) {
        $this->data['meta_title'] = 'Supplier Transaction';
        $this->data['active'] = 'data-target="supplierTran_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

        $this->data['info'] = $this->action->read("supplier_transaction",array("id" => $id));


        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/supplier_tran/nav', $this->data);
        $this->load->view('components/supplier_tran/view', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    public function all_supplier_tran() {
        $this->data['meta_title'] = 'Supplier Transaction';
        $this->data['active'] = 'data-target="supplierTran_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;


        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/supplier_tran/nav', $this->data);
        $this->load->view('components/supplier_tran/view-all', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }



    public function edit_supplier_tran($id=NULL) {
        $this->data['meta_title'] = 'Supplier Transaction';
        $this->data['active'] = 'data-target="supplierTran_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

        $where = array('id' => $id);
        $this->data['transaction']= $this->action->read('supplier_transaction', $where);

        if(isset($_POST['edit'])){
          $this->data['confirmation']=$this->editSupplierTransaction();
          $this->session->set_flashdata("confirmation",$this->data['confirmation']);
          redirect("supplier_tran/supplier_tran/edit_supplier_tran/".$id,"refresh");
        }

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/supplier_tran/nav', $this->data);
        $this->load->view('components/supplier_tran/edit', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }


    private function editSupplierTransaction(){
        $where = array("voucher_no" => $_POST['voucher_number']);
        $whereT = array("id" => $_POST['id']);

        $purchaseInfo=$this->action->read("purchase",$where);
        $info = $this->action->read("supplier_transaction",$whereT);

       //calculation payment
        if($_POST['pre_payment'] > $_POST['payment']){
            $ppayment = $purchaseInfo[0]->paid - ($_POST['pre_payment'] - $_POST['payment']);
            $spayment = $info[0]->payment - ($_POST['pre_payment'] - $_POST['payment']);
        }else{
            $ppayment = $purchaseInfo[0]->paid + ($_POST['payment'] - $_POST['pre_payment']);
            $spayment = $info[0]->payment + ($_POST['payment'] - $_POST['pre_payment']);
        }

        $data_update=array(
            "paid" => $ppayment,
            "due"  => $_POST['net_balance']
        );




        $data = array(
            'voucher_number'    => $_POST['voucher_number'],
            'supplier_name'     => $_POST['supplier_name'],
            'company_name'      => $_POST['company_name'],
            'balance'           => $_POST['balance'],
            'payment_type'      => $_POST['payment_type'],
            'payment'           => $spayment,
            'net_balance'       => $_POST['net_balance']
        );

        $options=array(
            'title'=>'success',
            'emit'=>'Supplier transaction successfully Updated!',
            'btn'=>true
        );

        $this->action->update('purchase',$data_update,$where);
        $this->action->update('supplier_transaction',$data,$whereT);
        return message("success",$options);

    }


    public function delete($id=NULL) {
      $this->data['confirmation'] = null;

      $where = array('id' => $id);

      $paymentInfo = $this->action->read("supplier_transaction",$where);
      if($paymentInfo != NULL){
          $purchaseInfo = $this->action->readGroupBy("purchase","voucher_no",array("voucher_no" => $paymentInfo[0]->voucher_number));
          $paid = ($purchaseInfo) ? $purchaseInfo[0]->paid : 0.00;
          $due = ($purchaseInfo) ? $purchaseInfo[0]->due : 0.00;
          $data_update=array(
              "paid" => $paid - $paymentInfo[0]->payment,
              "due"  =>  $due + $paymentInfo[0]->payment
          );

          $this->action->update("purchase",$data_update,array("voucher_no" => $paymentInfo[0]->voucher_number));
      }

       $msg_array=array(
            'title'=>'delete',
            'emit'=>'Supplier Transaction Successfully Deleted!',
            'btn'=>true
         );

        $this->data['confirmation']=message($this->action->deleteData('supplier_transaction', $where),$msg_array);
        $this->session->set_flashdata('confirmation',$this->data['confirmation']);
        redirect('supplier_tran/supplier_tran/all_supplier_tran','refresh');
    }



}
