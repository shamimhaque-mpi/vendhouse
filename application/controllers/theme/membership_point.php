<?php
class Membership_point extends Admin_Controller {
    function __construct() {
        parent::__construct();
        
        $this->load->model('action');
        $this->data['meta_title'] = 'Setting';
        $this->data['active'] = 'data-target="theme_menu"';
        $this->data['subMenu'] = 'data-target="amount"';
    }
    
    public function index() {

    	$this->data['point_value']=$this->action->read('point_value'); 

        //-------------------------Vat Information Start Here------------------------------
        if ($this->input->post('submit_point')) {

            $data=array(
				'date'     => date('Y-m-d'),
				'point_id' => $this->input->post('point_id'),
				'point'    => $this->input->post('point')
            );

            $msg_array = array(
                "title" => "Success",
                "emit"  => "Membership Point successfully Saved",
                "btn"   => true
            );
            $this->data['confirmation'] = message($this->action->add('point_value', $data), $msg_array);
            $this->session->set_flashdata("confirmation", $this->data['confirmation']);
            redirect('theme/delivery_charge/delivery_charge/','refresh');
        }

        if ($this->input->post('update_point')) {

            $where=array(
                'id'=>$this->input->post('point_id')
            );

            $data=array(
                'date'     => date('Y-m-d'),
				'point_id' => $this->input->post('point_id'),
				'point'    => $this->input->post('point')
            );

            $msg_array = array(
                "title" => "Success",
                "emit"  => "Membership Point successfully Updated",
                "btn"   => true
            );

            $this->data['confirmation'] = message($this->action->update('point_value', $data,$where), $msg_array);
            $this->session->set_flashdata("confirmation", $this->data['confirmation']);
            redirect('theme/delivery_charge/delivery_charge/','refresh');

        }

    }  
}
     