<?php

class Cost extends Admin_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->model('action');
        $this->data['meta_title'] = 'Cost';
    }
    
    public function index() {
        $this->data['active']  = 'data-target="cost_menu"';
        $this->data['subMenu'] = 'data-target="field"';        

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/cost/nav', $this->data);
        $this->load->view('components/cost/fieldcost', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    public function add(){
        $data=array("cost_field"=> str_replace(" ","_",$this->input->post('field_cost')));      

        if($this->action->exists('cost_field',$data)){
            $this->action->update("cost_field",$data,$data);
            $this->session->set_flashdata('success', 'Field of Cost successfully update!');
            
        }else{
            $this->action->add("cost_field",$data);
            $this->session->set_flashdata('success', 'Field of Cost successfully saved!');
        }
        
        redirect("cost/cost","refresh");
    }

    public function newcost() {
        $this->data['active']  = 'data-target="cost_menu"';
        $this->data['subMenu'] = 'data-target="new"';
        
        $this->data['cost_fields']=$this->action->readDistinct('cost_field',"cost_field");

        // print_r($this->data['cost_fields']);

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/cost/nav', $this->data);
        $this->load->view('components/cost/new', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }


    public function add_new_cost(){
        $data=array(
         "date"        =>$this->input->post('date'),
         "cost_field"  => str_replace(" ","_",$this->input->post('cost_field')),
         "description" =>$this->input->post('description'),
         "amount"      =>$this->input->post('amount'),
         "spend_by"    =>$this->input->post('spend_by')
        );      
       
        $this->action->add("cost",$data);
        $this->session->set_flashdata('success', 'Cost successfully saved!');

        redirect("cost/cost/newcost","refresh");
    }

    public function allcost() {
        $this->data['active']  = 'data-target="cost_menu"';
        $this->data['subMenu'] = 'data-target="all"';

        $this->data['cost_fields'] =$this->action->readDistinct('cost_field',"cost_field");

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

        $this->data['costs']=$this->action->read('cost', $where);

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/cost/nav', $this->data);
        $this->load->view('components/cost/all', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    public function edit($id=NULL) {
        $this->data['active']  = 'data-target="cost_menu"';
        $this->data['subMenu'] = 'data-target="all"';

        $this->data['cost']=$this->action->read('cost',array('id'=>$id));
        $this->data['cost_fields']=$this->action->readDistinct('cost_field',"cost_field");

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/cost/nav', $this->data);
        $this->load->view('components/cost/edit', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function update_cost($id=NULL){
         $data=array(
             "date"        =>$this->input->post('date'),
             "cost_field"  =>str_replace(" ","_",$this->input->post('cost_field')),
             "description" =>$this->input->post('description'),
             "amount"      =>$this->input->post('amount'),
             "spend_by"    =>$this->input->post('spend_by')
        );      
  
        $this->action->update("cost",$data,array('id'=>$id));
        $this->session->set_flashdata('success', 'Cost successfully updated!');
        
        redirect("cost/cost/allcost","refresh");

    }

    public function delete_field($id=NULL){
        
        $where=array("id"=>$id);
        $this->action->deleteData('cost_field',$where);
        $this->session->set_flashdata('success', 'This field of cost successfully Deleted!');
        
        redirect('cost/cost','refresh');
    }

     public function delete_cost($id=NULL){
        $where = array("id"=>$id);
        $data =  array('trash'=>1);
        $options=array(
            'title' =>'delete',
            'emit'  =>'Cost successfully Deleted!',
            'btn'   =>true
        );
        
        $this->action->update('cost',$data,$where);
        $this->session->set_flashdata('success', 'Cost successfully Deleted!');
        redirect('cost/cost/allcost','refresh');
    }



}