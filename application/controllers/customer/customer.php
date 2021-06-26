<?php

class Customer extends Admin_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('action');
        $this->load->library('uri');
    }
    
    public function index() {
        $this->data['meta_title'] = 'Customer';
        $this->data['active'] = 'data-target="customer_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;
        
        if($_POST){
            save_data('registration', ['status'=>$_POST['status']], ['id'=>$_POST['id']]);
            
            
            $this->session->set_flashdata('success', 'Status Successfully Changed!');
            redirect('customer/customer', 'refresh');
        }
        
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/customer/customer-nav', $this->data);
        $this->load->view('components/customer/allCustomer', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }


    public function delete($id=NULL) {  
      
        $this->data['confirmation'] = null;     
        
         
        $id = $this->uri->segment(4); 
        if($id){
            $this->action->update('registration', array('status' => 'inactive'), array('id' => $id));
            $this->session->set_flashdata('success', 'Data Successfully Deleted!');
            redirect('customer/customer','refresh');
        }
    }

}
