<?php

class Godown extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
        $this->holder();
    }

    public function index() {
        $this->data['meta_title'] = 'Godown';
        $this->data['active'] = 'data-target="godown_menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;

        if(isset($_POST['save'])){
            $data = array(
                'place' => $this->input->post('place'),
                'supervisor' => $this->input->post('supervisor'),
                'contact_no' => $this->input->post('contact_number'),
                'address' => $this->input->post('address')
            );

            $options = array(
                'title' => 'SUCCESS',
                'emit' => '<p>Godown save successfully.</p>',
                'btn' => true
            );

            $confirmation = message($this->action->add('godowns', $data), $options);
            $this->session->set_flashdata('confirmation', $confirmation);

            redirect('godown/godown', 'refresh');
        }

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/godown/godown-nav', $this->data);
        $this->load->view('components/godown/add-godown', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function show_godown() {
        $this->data['meta_title'] = 'Godown';
        $this->data['active'] = 'data-target="godown_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/godown/godown-nav', $this->data);
        $this->load->view('components/godown/show-godown', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function edit_godown() {
        $this->data['meta_title'] = 'Godown';
        $this->data['active'] = 'data-target="godown_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

        $where = array('id' => $this->input->get('id'));
        if(isset($_POST['update'])){
            $data = array(
                'place'         => $this->input->post('place'),
                'supervisor'    => $this->input->post('supervisor'),
                'contact_no'    => $this->input->post('mobile'),
                'address'       => $this->input->post('address')
            );

            $msgOpt = array(
                "title" => "Updated",
                "emit"  => "<p>Information changed successfully!</p>",
                "btn"   => true
            ); 

            $confirmation = message($this->action->update('godowns', $data, $where), $msgOpt);
            $this->session->set_flashdata('confirmation', $confirmation, $msgOpt);
            redirect('godown/godown/edit_godown?id='.$this->input->get('id'), 'refresh');
        }

        $this->data['result'] = $this->action->read('godowns', $where); 

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/godown/godown-nav', $this->data);
        $this->load->view('components/godown/edit-godown', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function delete(){
        $where = array('id' => $this->input->get('id'));
        $msgOpt = array(
            "title" => "Warning",
            "emit"  => validation_errors('<p>', '</p>'),
            "btn"   => true
        ); 
        
        $this->session->set_flashdata('confirmation', message($this->action->deleteData('godowns', $where), $msgOpt));
        redirect('godown/godown', 'refresh');
    }

    private function holder(){  
        if($this->session->userdata('holder') == null){
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }


}