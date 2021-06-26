<?php

class Order extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('action');
        $this->load->helper('admin');
        $this->load->library('uri');
        
        $where = array('order_no' => $this->input->get('ono'));
        $this->data['records'] = $this->action->read('orders', $where);
        
        //Converting array to object
        $meta = $this->action->read("site_meta");
        $meta_info=array();
        foreach ($meta as $meta_value) {
            $meta_info[$meta_value->meta_key] = $meta_value->meta_value;
        }
        $meta_data = (object) $meta_info;
        $this->data["meta"] = $meta_data;
        //Converting array to object
    }
    
    public function index() {
        $this->data['meta_title'] = 'Order';
        $this->data['active'] = 'data-target="order_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;
        
        // read all supplier from user profile 
        $this->data['allProfile'] = $this->action->read('users',array('privilege !=' => 'super'));
        

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/order/order-nav', $this->data);
        $this->load->view('components/order/allOrder', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function searchOrder() {
        $this->data['meta_title'] = 'Order';
        $this->data['active'] = 'data-target="order_menu"';
        $this->data['subMenu'] = 'data-target="search"';
        $this->data['confirmation'] = $this->data['result'] = null;
        
        $this->data['userInfo'] = $this->action->read('users');
        $this->data['orders'] = get_result('orders', '', ['name'], 'name');

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/order/order-nav', $this->data);
        $this->load->view('components/order/searchOrder', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function orderView() {
        $this->data['meta_title'] = 'Order';
        $this->data['active'] = 'data-target="order_menu"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = null;
        
        
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/order/order-nav', $this->data);
        $this->load->view('components/order/orderView', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function srOrder() {
        $this->data['meta_title'] = 'SR Order';
        $this->data['active'] = 'data-target="order_menu"';
        $this->data['subMenu'] = 'data-target="sr"';
        $this->data['confirmation'] = $this->data['result'] = null;

        // Read all SR
        $this->data['allsr'] = $this->action->read('sr');

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/order/order-nav', $this->data);
        $this->load->view('components/order/srOrder', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }    



   public function delete($id=NULL) {  
      
       $this->data['confirmation'] = null;     
       $msg_array=array(
            'title'=>'delete',
            'emit'=>'Data Successfully Deleted!',
            'btn'=>true
         );


        $order_no  = $this->uri->segment(4); 
        if($order_no){
            $this->action->update('orders',array('status' => 'inactive'),array('order_no ' => $order_no));
            $this->session->set_flashdata('success', 'Order deleted successfully');
            redirect('order/order','refresh');
        }
        
        

    }

    
}
