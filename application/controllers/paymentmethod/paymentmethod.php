<?php

class Paymentmethod extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
        $this->load->library('upload');
    }
    
    public function index(){
        $this->data['active'] = 'data-target="paymentmethod_menu"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = null;
        
        // read payment method table
        $this->data['methods'] = $this->action->read('payment_method');
    
        // insert payment method in payment_method table 
        
        if($this->input->post('save')){
            
            // data array
            $data = array(
                "date"   => date("Y-m-d"),
                "name"   => $this->input->post('name'),
                "number" => $this->input->post('number'),
                "type"   => $this->input->post('type')
            );
            
            // conditional array
            // $where = array("name" => $this->input->post('name'));
            $where = array("name" => $this->input->post('name'), "type" => $this->input->post('type'));
        
            // dd($where);
            
            if($this->action->exists("payment_method", $where)){
                
                $this->action->update('payment_method',$data,$where);
                $this->session->set_flashdata('success', 'Payment method successfully update !');
                redirect('paymentmethod/paymentmethod',"refresh");
            }else{
                
                $this->action->add('payment_method', $data);
                $this->session->set_flashdata('success', 'Payment method successfully added!');
            }
            
            redirect('paymentmethod/paymentmethod',"refresh");
            
        }
        
        // end insert payment method in payment_method table 
        
        
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/paymentmethod/paymentmethod', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }
    
    public function delete($id){
        $this->action->deleteData('payment_method', ['id'=>$id]);
        
        $this->session->set_flashdata('success', 'Payment Method Successfully Deleted !');
        redirect('paymentmethod/paymentmethod',"refresh");
    }
}