<?php
class District extends Admin_Controller {

     function __construct() {
        parent::__construct();
        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title'] = 'District';
        $this->data['active'] = 'data-target="district_menu"';
        $this->data['subMenu'] = 'data-target="district"';
        $this->data['confirmation'] = null;

        if(isset($_POST['save'])){
            unset($_POST['save']);
            
            $this->action->add('districts', $_POST);
            $this->session->set_flashdata('success', 'Area Successfully Saved!');
            redirect('district/district', 'refresh');
        }

        $this->data['districts'] = $this->action->read('districts');
        $this->data['divisions'] = $this->action->read('divisions');
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/district/district', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    public function edit($id){
        $this->data['meta_title'] = 'District';
        $this->data['active'] = 'data-target="district_menu"';
        $this->data['subMenu'] = 'data-target="district"';
        $this->data['confirmation'] = null;
        if(isset($_POST['update'])) {
            unset($_POST['update']);
            
            
            $this->action->update('districts', $_POST, ['id'=>$id]);
            $this->session->set_flashdata('success', 'Area Successfully Updated!');
            redirect('district/district', 'refresh');
        }
        $this->data['edit'] = $this->action->read('districts', ['id'=>$id])[0];
        $this->data['divisions'] = $this->action->read('divisions');
        
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/district/district', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    
    public function delete($id=NULL) {
        $this->data['confirmation'] = null;

        $this->action->deleteData('districts',array('id'=>$id));
        $this->session->set_flashdata('success', 'Area Successfully Deleted!');
        redirect('district/district','refresh');
    }

}
