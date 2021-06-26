<?php
class Category extends Admin_Controller {

     function __construct() {
        parent::__construct();
        $this->holder();
        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title'] = 'Category';
        $this->data['active'] = 'data-target="category_menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;


        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/category/category-nav', $this->data);
        $this->load->view('components/category/addCategory', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    public function addCategory() {
         $this->data['confirmation'] = null;
         $data=array(
            'datetime'=>date('Y-m-d'),
            'user_id'           =>  $this->data['user_id'],
            'user_name'         =>  $this->data['name'],
            'privilege'         =>  $this->data['privilege'],
            'category'=>str_replace(' ','_',$this->input->post('category'))
        );


         if(!$this->action->exists('category',array('category'=>str_replace(' ','_',$this->input->post('category'))))){
                $this->action->add('category', $data);
                $this->session->set_flashdata('success', 'Category Successfully Saved!');
           } else{
            $this->session->set_flashdata('warning', 'This category already exists. Try another');
         }
        redirect('category/category','refresh');

    }


    public function allCategory() {
        $this->data['meta_title'] = 'Category';
        $this->data['active'] = 'data-target="category_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

        $this->data['total_categori']=count($this->action->read('category'));

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/category/category-nav', $this->data);
        $this->load->view('components/category/allCategory', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    public function alignCategory() {
        $this->data['meta_title'] = 'Category';
        $this->data['active'] = 'data-target="category_menu"';
        $this->data['subMenu'] = 'data-target="align"';
        $this->data['confirmation'] = null;

       // $this->data['categories']=$this->action->active_category();
        $this->data['categories']=get_result('category');

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/category/category-nav', $this->data);
        $this->load->view('components/category/alignCategory', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    public function ajax_category_sort(){
        $receive_data=$this->input->post('finaldata');
        //echo $receive_data;
        $receive_array=json_decode($receive_data,true);

        foreach ($receive_array as $key => $value) {
            $where=array("id"=>$key);
            $data=array(
                "position"=>$value
                );
            $this->action->update("category",$data,$where);
        }
    }

     public function editCategory($id = NULL) {
        $this->data['active'] = 'data-target="category_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['category'] = null;

        $this->data['id']=$id;
        $this->data['category']=$this->action->read("category",array('id'=>$id));

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/category/category-nav', $this->data);
        $this->load->view('components/category/edit', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

  public function edit($id=NULL) {
     $this->data['confirmation'] = null;
        $data=array('category'=>str_replace(' ','_',$this->input->post('category')));

       
        //category updat
        if(!$this->action->exists('category',array('category'=>str_replace(' ','_',$this->input->post('category'))))){
            $this->action->update('category',$data,array('id'=>$id));
            $this->session->set_flashdata('success', 'Category Successfully Updated!');
        }else{
            $this->session->set_flashdata('warning', 'This category already exists. Try another');
        }

        //update subcategory table
        if(!$this->action->exists('subcategory',array('category'=>str_replace(' ','_',$this->input->post('category'))))){
            $this->action->update('subcategory',$data,array('category'=>$this->input->post('oldCategory')));
        }else{
            $this->session->set_flashdata('warning', 'This category already exists. Try another');
        }


        //update stock table
        if(!$this->action->exists('stock',array('category'=>str_replace(' ','_',$this->input->post('category'))))){
            $this->action->update('stock',$data,array('category'=>$this->input->post('oldCategory')));
        }else{
            $this->session->set_flashdata('warning', 'This category already exists. Try another');
        }

        //update product
        if(!$this->action->exists('products',array('product_cat'=>str_replace(' ','_',$this->input->post('category'))))){
            $data = array('product_cat'=>str_replace(' ','_',$this->input->post('category')));
            $this->action->update('products',$data,array('product_cat'=>$this->input->post('oldCategory')));
        }else{
            $this->session->set_flashdata('warning', 'This category already exists. Try another');
        }


        redirect('category/category/allCategory','refresh');

    }


   public function deleteCategory($id=NULL) {
        $this->data['confirmation'] = null;
        $this->action->deleteData('category',array('id'=>$id));
        $this->session->set_flashdata('success', 'Category Successfully Deleted!');
        redirect('category/category/allCategory','refresh');

    }
  private function holder(){
        if($this->session->userdata('holder') == null){
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }

}
