<?php

class WishList extends Subscriber_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->holder();

		$this->load->model('action');
        $this->load->helper('form');
        $this->load->helper('custom');
        $this->load->helper('msg');

        //Converting array to object
        $meta = $this->retrieve->read("site_meta");
        $meta_info=array();
        foreach ($meta as $meta_value) {
            $meta_info[$meta_value->meta_key] = $meta_value->meta_value;
        }
        $meta_data = (object) $meta_info;
        $this->data["meta"] = $meta_data;
	}

	public function index(){
		$this->data['meta_title'] = 'Wishlist';
        $this->isLogin();

        $this->load->view('frontend/include/header', $this->data);
        $this->load->view('frontend/include/navbar', $this->data);
        $this->load->view('frontend/include/order_modal', $this->data);
        $this->load->view('subscriber/wishList', $this->data);
        $this->load->view('frontend/include/footer', $this->data);
	}

    protected function isLogin(){
        if($this->session->userdata('subscriberLoggedin') != 1){
            redirect('/login');
        }
    }
    
    private function holder() {
        if($this->uri->segment(1) != "subscriber"){
            $this->subscriber_m->logout();
            redirect('frontend/home');
        }
    }
}
