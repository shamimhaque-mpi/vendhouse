<?php

class Page extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
        $this->data['meta_title'] = 'page';
        $this->data['active'] = 'data-target="page_menu"';
    }

    public function index() {
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;


		if(isset($_POST['save'])){

			$data = array(
				'date' => date('Y-m-d'),
				'page' => $this->input->post('page'),
				'content'=>$this->input->post('content')
			);
			
			$this->action->add('page', $data);
			$this->session->set_flashdata('success', 'Successfully Save!');
			redirect('page', 'refresh');
		}


        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/page/nav', $this->data);
        $this->load->view('components/page/page', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function all() {
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

	      $this->data['info'] = $this->action->read('page');

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/page/nav', $this->data);
        $this->load->view('components/page/all', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function edit($id=null) {
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

	$where = array('id' => $id);

		if(isset($_POST['update'])){

			$data = array(
				'date' => date('Y-m-d'),
				'page' => $this->input->post('page'),
				'content'=>$this->input->post('content')
			);

			
			$this->action->update('page', $data, $where);
			$this->session->set_flashdata('success', 'Successfully Update!');
			redirect('page/all', 'refresh');
		}

	    $this->data['info'] = $this->action->read('page', $where);
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/page/nav', $this->data);
        $this->load->view('components/page/edit', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function delete($id=null) {
		$where = array('id' => $id);

		$this->action->deleteData('page', $where);
		$this->session->set_flashdata('success', 'Deleted successfully!');
		redirect('page/all', 'refresh');
	}

}
