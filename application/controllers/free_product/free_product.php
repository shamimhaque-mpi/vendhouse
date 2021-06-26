<?php
class Free_product extends Admin_Controller {

     function __construct() {
        parent::__construct();

        $this->load->model('action');
        $this->holder();

        $this->data['meta_title'] = 'free_product';
        $this->data['active'] = 'data-target="free_product_menu"';
    }

    public function index() {
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;

        $this->data['products'] = $this->action->read("products",array("status" => 1));


        if(isset($_POST['save'])){
            $msg = $this->saveData();
            $this->session->set_flashdata("confirmation",$msg);
            redirect("free_product/free_product","refresh");
        }


        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/free_product/nav', $this->data);
        $this->load->view('components/free_product/add', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }


    private function saveData(){
        foreach ($_POST['product'] as $key => $value) {
            $data = array(
                "from_date"            => $_POST['from_date'],
                "to_date"              => $_POST['to_date'],
                "product"              => $value,
                "product_code"         => $_POST['product_code'][$key],
                "free_product"         => $_POST['free_product'][$key],
                "free_product_code"    => $_POST['free_product_code'][$key],
                "quantity"             => $_POST['quantity'][$key],
                "free_quantity"        => $_POST['free_quantity'][$key],
                "relation"             => $_POST['relation'][$key]
            );

            $this->action->add("free_product",$data);
        }

        $msg = array(
            'title'  => "success",
            'emit'   => "Free Product Successfully Saved!",
            'btn'    => true
        );

        return message("success",$msg);
    }

    public function all() {
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = $this->data['result'] = null;

        $this->data['result'] = $this->action->read("free_product");

        if(isset($_POST['show'])){
            $where = array();
            foreach ($_POST['date'] as $key => $value) {
                if($value != NULL && $key == "from"){
                    $where["from_date >="] = $value;
                }

                if($value != NULL && $key == "to"){
                    $where["to_date <="] = $value;
                }
            }

         $this->data['result'] = $this->action->read("free_product",$where);
        }

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/free_product/nav', $this->data);
        $this->load->view('components/free_product/all', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer',$this->data);

    }
    
    public function supplier_wise() {
        $this->data['subMenu'] = 'data-target="supplier_wise"';
        $this->data['confirmation'] = $this->data['result'] = null;

        

        if(isset($_POST['show'])){
           $where = array();
           
           foreach ($_POST['date'] as $key => $value) {
            if($value != NULL && $key == "from"){
                    $where["date >="] = $value;
                }

                if($value != NULL && $key == "to"){
                    $where["date <="] = $value;
                }
            }
           
            $where['remark'] = "free";
            $this->data['result']= $this->action->read("sale",$where);
               
        }
        
        $this->data['suppliers'] = $this->action->read("parties",array("type" => "supplier","status" => "active","trash" => 0));

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/free_product/nav', $this->data);
        $this->load->view('components/free_product/supplier_wise', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer',$this->data);

    }

    public function edit($id = null) {
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = $this->data['result'] = null;

        $this->data['result'] = $this->action->read("free_product",array("id"  => $id));

        if(isset($_POST['edit'])){
            $data = array(
                "from_date"            => $_POST['from_date'],
                "to_date"              => $_POST['to_date'],
                "quantity"             => $_POST['quantity'],
                "free_quantity"        => $_POST['free_quantity'],
                "relation"             => $_POST['relation']
            );

            $msg = array(
                'title'  => "success",
                'emit'   => "Free Product Successfully Updated!",
                'btn'    => true
            );

            $msg = message($this->action->update("free_product",$data,array("id" => $id)),$msg);
            $this->session->set_flashdata("confirmation",$msg);
            redirect("free_product/free_product/all","refresh");
        }

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/free_product/nav', $this->data);
        $this->load->view('components/free_product/edit', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }

    public function delete($id = NULL){
        $where = array("id"  => $id);

        $options = array(
            "title"  => "delete",
            "emit"   => "Free Product Successfully Deleted!",
            "btn"    => true
        );

        $msg = message($this->action->deleteData("free_product",$where),$options);
        $this->session->set_flashdata("confirmation",$msg);
        redirect("free_product/free_product/all","refresh");
    }

    private function holder(){
        if($this->session->userdata('holder') == null){
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }


}
