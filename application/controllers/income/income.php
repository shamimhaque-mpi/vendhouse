<?php

class Income extends Admin_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->model('action');
        $this->data['meta_title'] = 'Incom';
    }
    
    public function index() {
        $this->data['active']  = 'data-target="incom_menu"';
        $this->data['subMenu'] = 'data-target="field"';        

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/income/nav', $this->data);
        $this->load->view('components/income/fieldcost', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    public function add(){
        $data=array("income_field"=>$this->input->post('income_field'));      

        $options1=array(
            'title' =>"update",
            'emit'  =>"Field of Income successfully update!",
            'btn'   =>true
        );

        $options2=array(
            'title' =>"success",
            'emit'  =>"Field of Income successfully saved!",
            'btn'   =>true
        );

        if($this->action->exists('income_field',$data)){
            $this->data['confirmation']=message($this->action->update("income_field",$data,$data),$options1);
        }else{
            $this->data['confirmation']=message($this->action->add("income_field",$data),$options2);
        }

        $this->session->set_flashdata("confirmation",$this->data['confirmation']);
        redirect("income/income","refresh");
    }

    public function newcost() {
        $this->data['active']  = 'data-target="income_menu"';
        $this->data['subMenu'] = 'data-target="new"';
        
        $this->data['income_fields']=$this->action->readDistinct('income_field',"income_field");

        

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/income/nav', $this->data);
        $this->load->view('components/income/new', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }


    public function add_new_cost(){
        $data=array(
         "date"        =>$this->input->post('date'),
         "income_field"  =>$this->input->post('income_field'),
         "description" =>$this->input->post('description'),
         "amount"      =>$this->input->post('amount'),
         "spend_by"    =>$this->input->post('spend_by')
        );      

        $options=array(
            'title' =>"success",
            'emit'  =>"successfully saved!",
            'btn'   =>true
        );
        
        $this->data['confirmation']=message($this->action->add("income",$data),$options);        

        $this->session->set_flashdata("confirmation",$this->data['confirmation']);
        redirect("income/income/newcost","refresh");
    }

    public function allcost() {
        $this->data['active']  = 'data-target="income_menu"';
        $this->data['subMenu'] = 'data-target="all"';

        $this->data['income_fields'] =$this->action->readDistinct('income_field',"income_field");

        $where=array('trash'=>0);

        if(isset($_POST['show'])){
            foreach ($_POST['search'] as $key => $value) {
                if($value != NULL){
                    $where[$key] = $value;
                }
            }

            foreach ($_POST['date'] as $key => $value) {
                if($value != NULL && $key == "from"){
                    $where['date >='] = $value;
                }
				
                if($value != NULL && $key == "to"){
                    $where['date <='] = $value;
                }
            }
            //print_r($where);
        }

        $this->data['costs']=$this->action->read('income', $where);

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/income/nav', $this->data);
        $this->load->view('components/income/all', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    public function edit($id=NULL) {
        $this->data['active']  = 'data-target="income_menu"';
        $this->data['subMenu'] = 'data-target="all"';

        $this->data['cost']=$this->action->read('income',array('id'=>$id));
        $this->data['income_fields']=$this->action->readDistinct('income_field',"income_field");

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/income/nav', $this->data);
        $this->load->view('components/income/edit', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function update_cost($id=NULL){
         $data=array(
             "date"        =>$this->input->post('date'),
             "income_field"  =>$this->input->post('income_field'),
             "description" =>$this->input->post('description'),
             "amount"      =>$this->input->post('amount'),
             "spend_by"    =>$this->input->post('spend_by')
        );      

        $options=array(
            'title' =>"update",
            'emit'  =>"successfully updated!",
            'btn'   =>true
        );
        
        $this->data['confirmation']=message($this->action->update("income",$data,array('id'=>$id)),$options);        

        $this->session->set_flashdata("confirmation",$this->data['confirmation']);
        redirect("income/income/allcost","refresh");

    }

    public function delete_field($id=NULL){
        $options=array(
            'title' =>'delete',
            'emit'  =>'This field of Income successfully Deleted!',
            'btn'   =>true
        );
        $where=array("id"=>$id);
        $this->data['confirmation']=message($this->action->deleteData('income_field',$where),$options);
        $this->session->set_flashdata('confirmation',$this->data['confirmation']);
        redirect('income/income','refresh');
    }

     public function delete_cost($id=NULL){
        $where = array("id"=>$id);
        $data =  array('trash'=>1);
        $options=array(
            'title' =>'delete',
            'emit'  =>'Successfully Deleted!',
            'btn'   =>true
        );

        $this->data['confirmation']=message($this->action->update('income',$data,$where),$options);
        $this->session->set_flashdata('confirmation',$this->data['confirmation']);
        redirect('income/income/allcost','refresh');
    }



}