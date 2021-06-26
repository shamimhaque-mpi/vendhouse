<?php
class Brand extends Admin_Controller {

     function __construct() {
        parent::__construct();
        $this->holder();
        $this->load->model('action');
    }
    
    public function index() {
        $this->data['meta_title'] = 'Brand';
        $this->data['active'] = 'data-target="brand_menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;


        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/brand/nav', $this->data);
        $this->load->view('components/brand/add', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    public function add() {  
         $this->data['confirmation'] = null;     
         $data=array(
            'date'=>date('Y-m-d'),  
            'user_id'           =>  $this->data['user_id'],
            'user_name'         =>  $this->data['name'],
            'privilege'         =>  $this->data['privilege'],
            'brand'=> str_replace(' ',"-", $this->input->post('brand'))
        );
        $this->action->add('brand',$data);
        $this->session->set_flashdata('success', 'Brand Successfully Saved!');
        redirect('brand/brand','refresh');

    }


    public function all() {
        $this->data['meta_title'] = 'Brand';
        $this->data['active'] = 'data-target="brand_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

        $this->data['total_brand'] = count($this->action->read("brand"));

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/brand/nav', $this->data);
        $this->load->view('components/brand/all', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

     public function edit() {       
        $this->data['active'] = 'data-target="brand_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['brand'] = null;

        $this->data['brand'] = $this->action->read('brand', array('id'=>$this->input->get('id')));    

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/brand/nav', $this->data);
        $this->load->view('components/brand/edit', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

  public function editbrand() {  
     $this->data['confirmation'] = null;     
        $data=array(
          // 'category'=>$this->input->post('category'),      
          'brand'=> str_replace(' ',"-",$this->input->post('brand'))
        );
        $this->action->update('brand', $data, array('id'=>$this->input->get('id')));
        $this->session->set_flashdata('success', 'Brand Successfully Updated!');
        redirect('brand/brand/all','refresh');
    }


   public function delete($id=NULL) {  
      $this->data['confirmation'] = null;     

        $this->action->deleteData('brand',array('id'=>$id));
        $this->session->set_flashdata('success', 'Brand Successfully Deleted!');
        redirect('brand/brand/all','refresh');

    }
  private function holder(){  
        if($this->session->userdata('holder') == null){
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }

}
