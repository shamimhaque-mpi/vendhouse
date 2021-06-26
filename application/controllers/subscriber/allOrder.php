<?php

class AllOrder extends Subscriber_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->holder();

		$this->load->model('action');
        $this->load->helper('form');
        $this->load->helper('custom');
        $this->load->helper('msg');
        $this->data['info']     = $this->retrieve->read('registration', array('id' => $this->data['id']));
        
        $this->data['slider'] = $this->action->readOrderby("slider","position");
		$this->data['zilla'] = $this->action->read("districts");


        //Converting array to object
        $meta = $this->retrieve->read("site_meta");
        $meta_info=array();
        foreach ($meta as $meta_value) {
            $meta_info[$meta_value->meta_key] = $meta_value->meta_value;
        }
        $meta_data = (object) $meta_info;
        $this->data["meta"] = $meta_data;
        //Converting array to object
        $todays_where = array("date" => date("Y-m-d") );
        $this->data['todays_visitor']=$this->retrieve->read('visitors',$todays_where);
        $this->data['total_visitor']=$this->retrieve->readDistinct('visitors','ip');

		$this->data["categories"] = $this->action->active_category();
		$this->data["top_most_categories"] = $this->action->read_limit_rang("category",array("position >" => 0),"position","asc",3,0);
		if( $this->data["categories"] != NULL){
			foreach ($this->data["categories"] as $key => $cat) {
				$where=array(
					'product_cat'	=>	$cat->category,
					'status'		=>	1
				);
				$this->data['products'][] = $this->action->read('products',$where);
			}
		}
		
	    $this->data['coupon'] = $this->action->read("coupon");
		$limit_amount = $this->action->read("purchase_limit");
		$this->data['limit_amount'] = ($limit_amount) ? $limit_amount[0]->amount : 0.00;

	}

	public function index(){
		$this->data['meta_title'] = 'dashboard';

        $this->data['allOrder'] = $this->action->readGroupBy('orders','order_no',array('mobile' => $this->data['mobile']));

        $this->load->view('frontend/include/header', $this->data);
        $this->load->view('frontend/include/navbar', $this->data);
        $this->load->view('frontend/include/order_modal', $this->data);
        $this->load->view('subscriber/allOrder', $this->data);
        $this->load->view('frontend/include/footer', $this->data);
	}

    public function productView() {
        $this->data['meta_title'] = 'dashboard';

        $this->data['orderInfo'] = $this->action->read('orders', array('order_no'=>$this->input->get('order_no')));

        $this->load->view('frontend/include/header', $this->data);
        $this->load->view('frontend/include/navbar', $this->data);
        $this->load->view('frontend/include/order_modal', $this->data);
        $this->load->view('subscriber/productView', $this->data);
        $this->load->view('frontend/include/footer', $this->data);
    }
    
    
    public function orderCancel() {
        $where = array('order_no'=>$this->input->get('order_no'));
        
        //$data = array('status' => 'canceled');
        
        $options=array(
            'title'=>'delete',
            'emit'=>'This Order canceled !!!',
            'btn'=>true
        );
        
        /*$this->data['confirmation']=message($this->action->update('orders', $data, $where), $options);
        $this->session->set_flashdata('confirmation',$this->data['confirmation']);
        redirect('subscriber/allOrder');*/
        
        $this->data['confirmation']=message($this->action->deleteData('orders', $where), $options);
        $this->session->set_flashdata('confirmation',$this->data['confirmation']);
        redirect('subscriber/allOrder');
    }



    private function holder() {
            if($this->uri->segment(1) != "subscriber"){
                $this->subscriber_m->logout();
                redirect('frontend/home');
            }
        }
}
