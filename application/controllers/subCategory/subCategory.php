<?php
class SubCategory extends Admin_Controller {

     function __construct() {
        parent::__construct();
        $this->holder();
        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title'] = 'Subcategory';
        $this->data['active'] = 'data-target="subCategory_menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;

        $this->data['product_cats']=$this->action->read('category');

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/subCategory/subCategory-nav', $this->data);
        $this->load->view('components/subCategory/addsubCategory', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    public function addsubCategory() {
         $this->data['confirmation'] = null;
         $data=array(
            'date'=>date('Y-m-d'),
            'category'=>$this->input->post('category'),
            'user_id'           =>  $this->data['user_id'],
            'user_name'         =>  $this->data['name'],
            'privilege'         =>  $this->data['privilege'],
            'subcategory'=> str_replace(' ',"-", $this->input->post('subcategory'))
           );

            $where = array(
                'category'=>$this->input->post('category'),
                'subcategory'=>str_replace(' ',"-", $this->input->post('subcategory'))
            );


        //chack sub category table
        if(!$this->action->exists('subcategory',$where)){
            $this->action->add('subcategory',$data);
            $this->session->set_flashdata('success', 'Subcategory Successfully Saved!');
        }else{
            $this->session->set_flashdata('warning', 'This Subcategory already exists. Try another');
        }

        redirect('subCategory/subCategory','refresh');

    }


    public function allsubCategory() {
        $this->data['meta_title'] = 'Subcategory';
        $this->data['active'] = 'data-target="subCategory_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

        $this->data['total_categori']=count($this->action->read('subcategory'));

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/subCategory/subCategory-nav', $this->data);
        $this->load->view('components/subCategory/allsubCategory', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

     public function editsubCategory() {
        $this->data['active'] = 'data-target="subCategory_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['category'] = null;

        $this->data['categories'] = $this->action->read('category');
        $this->data['subcategory'] = $this->action->read('subcategory', array('id'=>$this->input->get('id')));

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/subCategory/subCategory-nav', $this->data);
        $this->load->view('components/subCategory/edit', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

  public function edit() {
     $this->data['confirmation'] = null;
        $data=array(
          'category'=>$this->input->post('category'),
          'subcategory'=> str_replace(' ',"-",$this->input->post('subcategory'))
        );


        //subcategory table
        $exist_cond = array(
            'category'   =>$this->input->post('category'),
            'subcategory'=>str_replace(' ',"-", $this->input->post('subcategory'))
        );
        if(!$this->action->exists('subcategory',$exist_cond)){
            $this->action->update('subcategory', $data, array('id'=>$this->input->get('id')));
            $this->session->set_flashdata('success', 'Subcategory Successfully Updated!');
        }else{
            $this->session->set_flashdata('warning', 'This Subcategory already exists. Try another');
        }


        //update stock table
        $stock_cond = array(
              'category'    => $this->input->post('oldCategory'),
              'subcategory' => $this->input->post('oldSubcategory')
            );

        if(!$this->action->exists('stock',$exist_cond)){
            $this->action->update('stock', $data, $stock_cond);
            $this->session->set_flashdata('success', 'Subcategory Successfully Updated!');
        }



        //update products table
        $product_cond = array(
              'product_cat' => $this->input->post('oldCategory'),
              'subcategory' => $this->input->post('oldSubcategory')
            );

        $data = array(
              'product_cat' => $this->input->post('category'),
              'subcategory' => str_replace(' ',"-",$this->input->post('subcategory'))
            );

        if(!$this->action->exists('products',$data)){
            $this->action->update('products', $data, $product_cond);
            $this->session->set_flashdata('success', 'Subcategory Successfully Updated!');
        }
        
        redirect('subCategory/subCategory/allsubCategory','refresh');

    }


   public function deletesubCategory($id=NULL) {
        $this->data['confirmation'] = null;
        $this->action->deleteData('subcategory',array('id'=>$id));
        $this->session->set_flashdata('success', 'Subcategory deleted Successfully!');
        redirect('subCategory/subCategory/allsubCategory','refresh');

    }
    private function holder(){
        if($this->session->userdata('holder') == null){
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }

}
