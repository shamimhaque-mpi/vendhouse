<?php
class Delivery_charge extends Admin_Controller {
    function __construct() {
        parent::__construct();

        $this->load->model('action');
        $this->data['meta_title'] = 'Setting';
        $this->data['active']     = 'data-target="theme_menu"';
        $this->data['subMenu']    = 'data-target="amount"';
        $this->data['coupon']     = $this->action->read('coupon');
    }

    public function index() {
        $status = $emit = "";
        if (isset($_POST['submit'])) {

            $data=array(
				'date'      => date('Y-m-d'),
                'amount'    => $this->input->post('amount'),
                'area'      => $this->input->post('area')
            );

            $where = array( 'area'  => $this->input->post('area'));

            if($this->action->exists("delivery_charge",$where)){
                $status = $this->action->update('delivery_charge', $data,$where);
                $emit = "Delivery Charge successfully Updated!";
            }else{
                $status = $this->action->add('delivery_charge', $data);
                $emit = "Delivery Charge successfully Saved!";
            }
            
            $this->session->set_flashdata('success', $emit);
            redirect('theme/delivery_charge/delivery_charge/','refresh');
        }



        // coupun start here

        if ($this->input->post('submit_coupon')) {

            $data=array(
                'date'      => date('Y-m-d'),
                'coupon_no' => $this->input->post('coupon_no'),
                'coupon_discount'    => $this->input->post('coupon_discount')
            );
            
            $this->action->add('coupon', $data);
            $this->session->set_flashdata('success', 'Coupon successfully Saved');
            redirect('theme/delivery_charge/delivery_charge/','refresh');
        }

        if ($this->input->post('update_coupon')) {

            $where=array(
                'id'=>$this->input->post('id')
            );

            $data=array(
                'date'      => date('Y-m-d'),
                'coupon_no' => $this->input->post('coupon_no'),
                'coupon_discount'    => $this->input->post('coupon_discount')
            );
            
            $this->action->update('coupon', $data,$where);
            $this->session->set_flashdata('success', 'Coupon successfully Updated !');
            redirect('theme/delivery_charge/delivery_charge/','refresh');

        }
        // coupun end here


        //------------------------- View Information Start Here --------------------------
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/theme/nav', $this->data);
        $this->load->view('components/theme/amount_setting', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');

    }



}
