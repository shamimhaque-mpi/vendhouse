<?php
class Delivery_charge extends Admin_Controller {

     function __construct() {
        parent::__construct();
        $this->holder();
        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title'] = 'delivery_charge';
        $this->data['active'] = 'data-target="delivery_charge"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = $this->data['result'] = null;

        if(isset($_POST['save'])){
            $data = [
                "date"   => date("Y-m-d"),
                "amount" => $this->input->post("amount")
            ];

            $records = $this->action->read("delivery_charge");
            if($records != NULL){
                $options = [
                    'title'  => "update",
                    'emit'   => "Delivery Charge successfully Updated!",
                    'btn'    => true
                ];

                $this->data['confirmation'] = message($this->action->update("delivery_charge",$data,array("id"  => $records[0]->id)),$options);
            }else{
                $options = [
                    'title'  => "success",
                    'emit'   => "Delivery Charge successfully Saved!",
                    'btn'    => true
                ];

                $this->data['confirmation'] = message($this->action->add("delivery_charge",$data),$options);
            }

            $this->session->set_flashdata("confirmation",$this->data['confirmation']);
            redirect("charge/delivery_charge","refresh");
        }


        $this->data['result'] = $this->action->read("delivery_charge");

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/charge/delivery_charge', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

  private function holder(){
        if($this->session->userdata('holder') == null){
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }

}
