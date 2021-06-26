<?php

class Stock extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title']   = 'Stock';
        $this->data['active']       = 'data-target="raw_stock_menu"';
        $this->data['subMenu']      = 'data-target="add-new"';
        $this->data['confirmation'] = null;

        $where = array();

        $this->data['productInfo'] = $this->action->readGroupBy("stock", "code", $where);

        $this->data['category'] = $this->action->read_distinct("category", $where, "category");

        $this->data['subcategory'] = $this->action->read_distinct("subcategory", $where, "subcategory");

        $this->data['godown'] = $this->action->readGroupBy("godowns", "name", $where);
        
        $where = array('quantity >' => 0);

        if(isset($_POST['show'])){
            $where = array('quantity >' => 0);

            if(isset($_POST['search'])){
                foreach($_POST['search'] as $key => $val){
                    if($val != null){
                        $where["stock.".$key] = $val;
                    }
                }
            }
        }

        $this->data['result'] = $this->action->readOrderBy("stock", 'name', $where);

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/stock/stock', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer', $this->data);
    }
    
    public function product_stock($id=null){
        $this->data['meta_title']   = 'Stock';
        $this->data['active']       = 'data-target="stock_menu"';
        $this->data['subMenu']      = 'data-target="add-new"';
        $this->data['confirmation'] = null;
        
        $where = [];
        if($_POST && isset($_POST['id'])){
            update('products', $_POST, ['id'=>$_POST['id']]);
            redirect('stock/stock/product_stock');
        }
        
        if($id){
            $this->data['edit'] = read('products', ['id'=>$id]);
        }
        
        $this->data['items'] = read('products', ['status'=>1]);
        
        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/stock/product_stock', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer', $this->data);
    }
    
}