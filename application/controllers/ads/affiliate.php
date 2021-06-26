<?php

class Affiliate extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
        
    }
    
    public function index() {
        $this->data['active'] = 'data-target="affiliate"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = null;

        
        if ($this->input->post('save')) {
                $data=array(
                    "date"         => date("Y:m:d"),
                    'embed_code'   => $this->input->post('embed_code')
                );
                    
                $msg = array(
                    "title"  => "success",
                    "emit"   => "Affiliate Product successfully Saved!",
                    "btn"    => true
                );    
                    
                $this->data['confirmation']=message($this->action->add("affiliate_product",$data),$msg);
                $this->session->set_flashdata('confirmation', $this->data["confirmation"]);
                redirect('ads/affiliate','refresh');
            }
            
           
        if($this->input->get("delete_token")){
            $this->action->deletedata('affiliate_product',array('id'=>$this->input->get("delete_token")));
            $msg_array=array(
                "title"=>"success",
                "emit"=>"Data Successfully Deleted!",
                "btn"=>true
            );
            $this->data['confirmation']=message("success",$msg_array);
            $this->session->set_flashdata('confirmation', $this->data["confirmation"]);
            redirect('ads/affiliate','refresh');
        }
        

        $this->data["products"]=$this->action->read("affiliate_product");

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/ads/affiliate', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }
}