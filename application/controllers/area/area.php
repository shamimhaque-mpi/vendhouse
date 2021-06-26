<?php
class Area extends Admin_Controller {

     function __construct() {
        parent::__construct();
        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title'] = 'Upazila';
        $this->data['active'] = 'data-target="upazila_menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;

        if(isset($_POST['save'])){
            if(isset($_POST['is_all'])){
                $this->action->update('upazilas', ['shipping_charge'=>$_POST['shipping_charge']], []);
                unset($_POST['is_all']);
            }
            unset($_POST['save']);
            
            $this->action->add('upazilas', $_POST);
            $this->session->set_flashdata('success', 'Area Successfully Saved!');
            redirect('area/area', 'refresh');
        }
        
        $this->data['districts'] = read('districts');
        $this->data['upazilas']  = read('upazilas');
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/area/addArea', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    public function edit($id){
        $this->data['meta_title'] = 'Category';
        $this->data['active'] = 'data-target="theme_menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;
        if(isset($_POST['update'])) {
            
            if(isset($_POST['is_all'])){
                $this->action->update('upazilas', ['shipping_charge'=>$_POST['shipping_charge']], []);
                unset($_POST['is_all']);
            }
            
            unset($_POST['update']);
            
            
            $this->action->update('upazilas', $_POST, ['id'=>$id]);
            $this->session->set_flashdata('success', 'Area Successfully Updated!');
            redirect('area/area', 'refresh');
        }
        $this->data['districts']    = read('districts');
        $this->data['edit']         = read('upazilas', ['id'=>$id])[0];

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/area/addArea', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    
    public function delete($id=NULL) {
        $this->data['confirmation'] = null;

        $this->action->deleteData('upazilas',array('id'=>$id));
        $this->session->set_flashdata('success', 'Area Successfully Deleted!');
        redirect('area/area','refresh');
    }

}
