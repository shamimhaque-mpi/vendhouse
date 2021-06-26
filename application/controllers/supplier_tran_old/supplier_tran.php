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
            $this->session->set_flashdata('confirmation',$this->data['confirmation']);
            redirect('supplier_tran/supplier_tran/view_trans?vno='.$this->input->post('voucher_number'),"refresh");
        }

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/supplier_tran/nav', $this->data);
        $this->load->view('components/supplier_tran/add', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    private function supplierTransaction(){
        $where=array("voucher_no"=>$_POST['voucher_number']);
        $purchaseInfo=$this->action->read("purchase",$where);
       
        $data_update=array(
            "paid"=>$purchaseInfo[0]->paid + $_POST['payment'],
            "due"=>$_POST['net_balance']
        );        

        $data=array(
            'date'              =>date('Y-m-d'),
            'voucher_number'    =>$_POST['voucher_number'],
            'supplier_name'     =>$_POST['supplier_name'],
            'company_name'      =>$_POST['company_name'],
            'mobile'            =>$_POST['mobile'],
            'balance'           =>$_POST['balance'],
            'payment_type'      =>$_POST['payment_type'],
            'payment'           =>$_POST['payment'],
            'net_balance'       =>$_POST['net_balance']
        );

        $options=array(
            'title'=>'success',
            'emit'=>'Supplier transaction successfully Completed!',
            'btn'=>true
        );

        $this->action->update('purchase',$data_update,$where);
        $this->action->add('supplier_transaction',$data);
        return message("success",$options);
        
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


    public function view_trans() {
        $this->data['meta_title'] = 'Supplier Transaction';
        $this->data['active'] = 'data-target="supplierTran_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;
       
       	$where = array("voucher_number" => $this->input->get("vno"));
       	$this->data['info'] = $this->action->read("supplier_transaction");
       	$whereS = array("id" => $this->data['info'][0]->supplier_name);
       	$this->data['supplierInfo'] = $this->action->read("vendor",$whereS);
       	
        
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/supplier_tran/nav', $this->data);
        $this->load->view('components/supplier_tran/print_view', $this->data);
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
        }

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/supplier_tran/nav', $this->data);
        $this->load->view('components/supplier_tran/edit', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }


    private function editSupplierTransaction(){
        $where=array("voucher_no"=>$_POST['voucher_number']);
        $whereT=array("id"=>$_POST['id']);
        $purchaseInfo=$this->action->read("purchase",$where);
        $Info=$this->action->read("supplier_transaction",$whereT);
       
        $data_update=array(
            "paid"=>$purchaseInfo[0]->paid + $_POST['payment'],
            "due"=>$_POST['net_balance']
        );        

        $data=array(
            'date'              =>date('Y-m-d'),
            'voucher_number'    =>$_POST['voucher_number'],
            'supplier_name'     =>$_POST['supplier_name'],
            'company_name'      =>$_POST['company_name'],
            'balance'           =>$_POST['balance'],
            'payment_type'      =>$_POST['payment_type'],
            'payment'           =>$Info[0]->payment + $_POST['payment'],
            'net_balance'       =>$_POST['net_balance']
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