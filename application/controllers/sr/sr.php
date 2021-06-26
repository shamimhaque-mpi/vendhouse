<?php 
/**
* 
*/
class Sr extends Admin_Controller{
	  function __construct() {
        parent::__construct();

        $this->load->model('action');

    }
	
	public function index() {
        $this->data['meta_title']   = 'add';
        $this->data['active']       = 'data-target="sr_menu"';
        $this->data['subMenu']      = 'data-target="add"';
        $this->data['confirmation'] = null;

        $this->data['fieldInfo'] = $this->action->read('sr_field');

        if(isset($_POST['add'])) {
                $data = array(
                    'date'     => date('Y-m-d'),
                    'name'     => $this->input->post('name'),
                    'username' => $this->input->post('username'),
                    'password' => $this->input->post('pass'),
                    'code'     => $this->input->post('code'),
                    'mobile'   => $this->input->post('contact'),
                    'address'  => $this->input->post('address'),
                    'field'    => $this->input->post('field'),
                    'target'   => $this->input->post('target')
                );

                $empdata = array(
                    'date'                  => date('Y-m-d'),
                    'joining_date'          => date('Y-m-d'),
                    "designation"           => "SR",
                    'name'                  => $this->input->post('name'),
                    'emp_id'                => $this->input->post('code'),
                    'mobile'                => $this->input->post('contact'),
                    'permanent_address'     => $this->input->post('address'),
                    'target'                => $this->input->post('target')
                );
	            $options = array(
	                'title' => 'success',
	                'emit'  => 'Information Successfully Saved!',
	                'btn'   => true
	            );

	        // insert data into parties table
            $this->data['confirmation'] = message($this->action->add('sr', $data), $options);
        }
        $this->data['sr_id']      = srUniqueId('sr');

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/sr/nav', $this->data);
        $this->load->view('components/sr/add', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }

    public function view_all() {
        $this->data['meta_title']   = 'add';
        $this->data['active']       = 'data-target="sr_menu"';
        $this->data['subMenu']      = 'data-target="all"';
        $this->data['confirmation'] = null;

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/sr/nav', $this->data);
        $this->load->view('components/sr/view-all', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }

    public function edit() {
        $this->data['meta_title']   = 'add';
        $this->data['active']       = 'data-target="sr_menu"';
        $this->data['subMenu']      = 'data-target="all"';
        $this->data['confirmation'] = null;

        $this->data['fieldInfo'] = $this->action->read('sr_field');

        $where = array("id" => $this->input->get('id'));
        $empwhere = array("id" => $this->input->get('id'));

        if(isset($_POST['update'])){
        	 $data = array(
                    'name'     => $this->input->post('name'),
                    'username' => $this->input->post('username'),
                    'password' => $this->input->post('pass'),
                    'mobile'   => $this->input->post('contact'),
                    'field'    => $this->input->post('field'),
                    'address'  => $this->input->post('address'),
                    'target'   => $this->input->post('target')
                );
                $empdata = array(
                    'name'                  => $this->input->post('name'),
                    'mobile'                => $this->input->post('contact'),
                    'permanent_address'     => $this->input->post('address'),
                    'target'                => $this->input->post('target')
                );
	            $options = array(
	                'title' => 'Update',
	                'emit'  => 'Information Successfully Update!',
	                'btn'   => true
	            );

	        // insert data into employee table
            

            $update_query_of_sr = $this->action->update('sr', $data,$where);
            if($update_query_of_sr){
                $this->data['confirmation'] = message($update_query_of_sr, $options);
                $this->session->set_flashdata("confirmation",$this->data['confirmation']);
                redirect("sr/sr/view_all","refresh");
            }
        }
       
        $this->data['SrInfo'] = $this->action->read('sr', $where);

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/sr/nav', $this->data);
        $this->load->view('components/sr/upgrade', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }


    public function preview() {
        $this->data['meta_title']   = 'add';
        $this->data['active']       = 'data-target="sr_menu"';
        $this->data['subMenu']      = 'data-target="all"';
        $this->data['confirmation'] = null;

        $where = array("id" => $this->input->get('id'));
       
        $this->data['SrInfo'] = $this->action->read('sr', $where);

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/sr/nav', $this->data);
        $this->load->view('components/sr/preview', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }


    public function delete($id=NULL){

        $options= array(
            'title' => 'delete',
            'emit'  => 'Successfully Deleted!',
            'btn'   => true
        );

       $this->data['confirmation']=message($this->action->deletedata('sr', array('id' => $id)), $options);
       $this->session->set_flashdata("confirmation",$this->data['confirmation']);
       redirect("sr/sr/view_all","refresh");
    }


    public function field() {
        $this->data['meta_title']   = 'SR';
        $this->data['active']       = 'data-target="sr_menu"';
        $this->data['subMenu']      = 'data-target="field"';
        $this->data['confirmation'] = null;

        $this->data['fieldInfo'] = $this->action->read('sr_field');

        if(isset($_POST['add_field'])) {
                $data = array(
                    'date'       => date('Y-m-d'),
                    'field_name' => $this->input->post('field_name')
             
                );

                $options = array(
                    'title' => 'success',
                    'emit'  => 'SR Field Successfully Saved!',
                    'btn'   => true
                );

            // insert data into parties table
            $this->data['confirmation'] = message($this->action->add('sr_field', $data), $options);
            $this->session->set_flashdata("confirmation",$this->data['confirmation']);
            redirect("sr/sr/field","refresh");

        }

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/sr/nav', $this->data);
        $this->load->view('components/sr/field', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }

    public function delete_field($id=NULL){

        $options= array(
            'title' => 'delete',
            'emit'  => 'SR Field Successfully Deleted!',
            'btn'   => true
        );

       $this->data['confirmation']=message($this->action->deletedata('sr_field', array('id' => $id)), $options);
       $this->session->set_flashdata("confirmation",$this->data['confirmation']);
       redirect("sr/sr/field","refresh");
    }

}