<?php

class Client extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }
    
    public function index() {
        $this->data['meta_title'] = '';
        $this->data['active'] = 'data-target="party-menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;

        $this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required|min_length[11]|max_length[11]|is_unique[clients.mobile]');

        if($this->input->post('save')) {
            if($this->form_validation->run() == FALSE) {
                $options = array(
                    "title" => "Error",
                    "emit"  => validation_errors(),
                    "btn"   => true
                );

                $this->data['confirmation'] = message("warning", $options);
            } else {
                $where = array(
                    'name'     => $this->input->post('name'),
                    'mobile'   => $this->input->post('mobile'),
                );

                $data = array(
                    'date'      => date('Y-m-d'),
                    'cid'       => '',
                    'name'      => $this->input->post('name'),
                    'address'   => $this->input->post('address'),
                    'mobile'    => $this->input->post('mobile'),
                    'status'    => $this->input->post('type')
                );

                if($this->action->exists('clients', $where)){
                    $options = array(
                        'title' => 'warning',
                        'emit'  => 'This Supplier already exists!',
                        'btn'   => true
                    );

                    $this->data['confirmation'] = message('warning', $options);
                } else {
                    $options = array(
                        'title' => 'success',
                        'emit'  => 'Supplier Successfully Saved!',
                        'btn'   => true
                    );                

                    $this->data['confirmation'] = message($this->action->add('clients', $data), $options);
                }  
            }
        }

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/party/client-nav', $this->data);
        $this->load->view('components/party/add-client', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function allClient() {
        $this->data['meta_title'] = '';
        $this->data['active'] = 'data-target="party-menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

        $this->data['resultset'] = $this->action->read('clients');
        
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/party/client-nav', $this->data);
        $this->load->view('components/party/all-client', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function edit() {
        $this->data['meta_title'] = '';
        $this->data['active'] = 'data-target="party-menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

        $this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required|min_length[11]|max_length[11]');

        $where = array('id' => $this->input->get("id"));

       if($this->input->post('change')) {
            if($this->form_validation->run() == FALSE){
                $options = array(
                    "title" => "Error",
                    "emit"  => validation_errors(),
                    "btn"   => true
                );

                $this->data['confirmation'] = message("warning", $options);
            } else {
                $data = array(
                    'date'      => date('Y-m-d'),
                    'cid'       => '',
                    'name'      => $this->input->post('name'),
                    'address'   => $this->input->post('address'),
                    'mobile'    => $this->input->post('mobile'),
                    'status'    => $this->input->post('type')
                );

                $options = array(
                    'title' => 'update',
                    'emit'  => 'Supplier Successfully Updated!',
                    'btn'   => true
                 );

                $this->data['confirmation'] = message($this->action->update('clients', $data, $where), $options);
            }
        }

        $this->data['resultset'] = $this->action->read('clients', $where);

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/party/client-nav', $this->data);
        $this->load->view('components/party/edit-client', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function delete() {  
        $this->data['confirmation'] = null;

        $where = array('id' => $this->input->get('id'));

        $options = array(
            'title' => 'delete',
            'emit'  => 'Clients Successfully Deleted!',
            'btn'   => true
        );

        $this->data['confirmation'] = message($this->action->deleteData('clients', $where), $options);
        $this->session->set_flashdata('confirmation', $this->data['confirmation']);
        redirect('party/client/allClient', 'refresh');
    }

    public function transaction() {
        $this->data['meta_title'] = '';
        $this->data['active'] = 'data-target="party-menu"';
        $this->data['subMenu'] = 'data-target="transaction"';
        $this->data['confirmation'] = null;

        $this->data['resultset'] = $this->action->read('clients');
        
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/party/client-nav', $this->data);
        $this->load->view('components/party/transaction-client', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }


}