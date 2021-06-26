<?php

class Vendor extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
        $this->load->library('upload');
    }
    //----------------------------------------------------------------------------------------------
    //------------------------------------------Add Employee Start here-----------------------------
    //----------------------------------------------------------------------------------------------
    public function index() {
        $this->data['meta_title'] = '';
        $this->data['active'] = 'data-target="vendor_menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;

        $this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required|min_length[11]|max_length[11]|is_unique[vendor.vendor_mobile]');

        if($this->input->post('add_vendor')){

            if($this->form_validation->run() == FALSE){
                    $msg_array=array(
                        "title"=>"Error",
                        "emit"=>validation_errors(),
                        "btn"=>true
                    );
                    $this->data['confirmation']=message("warning",$msg_array);
            }else{

               $where=array(
                    'company'=> $this->input->post('company'),
                    'vendor_name'=> $this->input->post('name'),
                );

                $data=array(
                'company'=> $this->input->post('company'),
                'vendor_name'=> $this->input->post('name'),
                'vendor_mobile' => $this->input->post('mobile'),
                'vendor_address' => $this->input->post('address')
                );

                if($this->action->exists('vendor',$where)){
                    $msg_array=array(
                      'title'=>'warning',
                      'emit'=>'This Supplier already exists!',
                      'btn'=>true
                   );
                 $this->data['confirmation']=message('warning',$msg_array);
                }else{
                    $msg_array=array(
                    'title'=>'success',
                    'emit'=>'Supplier Successfully Saved!',
                    'btn'=>true
                 );                

                $this->data['confirmation']=message($this->action->add('vendor',$data),$msg_array);
              }  
            }
        }


        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/vendor/vendor-nav', $this->data);
        $this->load->view('components/vendor/add-vendor', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }
    //----------------------------------------------------------------------------------------------
    //------------------------------------------Add Employee End here-------------------------------
    //----------------------------------------------------------------------------------------------


    public function show_vendor() {
        $this->data['meta_title'] = '';
        $this->data['active'] = 'data-target="vendor_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

        $this->data['vendor']= $this->action->read('vendor');
        
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/vendor/vendor-nav', $this->data);
        $this->load->view('components/vendor/show-vendor', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    //----------------------------------------------------------------------------------------------
    //------------------------------------------View Employee end here------------------------------
    //----------------------------------------------------------------------------------------------

    //----------------------------------------------------------------------------------------------
    //------------------------------------------View profile start here-----------------------------
    //----------------------------------------------------------------------------------------------

    public function profile() {
        $this->data['meta_title'] = '';
        $this->data['active'] = 'data-target="vendor_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

        

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/vendor/vendor-nav', $this->data);
        $this->load->view('components/vendor/profile', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    //----------------------------------------------------------------------------------------------
    //------------------------------------------View profile end here-------------------------------
    //----------------------------------------------------------------------------------------------

    public function edit_vendor() {
        $this->data['meta_title'] = '';
        $this->data['active'] = 'data-target="vendor_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

        $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|required|min_length[11]|max_length[11]');

        $where = array('id' => $this->input->get("id"));

       if ($this->input->post('update_vendor')) {
            if($this->form_validation->run() == FALSE){
                    $msg_array=array(
                        "title"=>"Error",
                        "emit"=>validation_errors(),
                        "btn"=>true
                    );
                    $this->data['confirmation']=message("warning",$msg_array);
            }else{
                $data=array(
                 'company'=> $this->input->post('company'),
                 'vendor_name'=> $this->input->post('name'),
                 'vendor_mobile' => $this->input->post('mobile_number'),
                 'vendor_address' => $this->input->post('address')
                );

                $msg_array=array(
                    'title'=>'update',
                    'emit'=>'Supplier Successfully Updated!',
                    'btn'=>true
                 );

                $this->data['confirmation']=message($this->action->update('vendor',$data, $where),$msg_array);
            }
        }


        $this->data['vendor']= $this->action->read('vendor', $where);

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/vendor/vendor-nav', $this->data);
        $this->load->view('components/vendor/edit-vendor', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }


    public function delete() {  
      $this->data['confirmation'] = null;

      $where = array('id' => $this->input->get('id'));

       $msg_array=array(
            'title'=>'delete',
            'emit'=>'Vendor Successfully Deleted!',
            'btn'=>true
         );

        $this->data['confirmation']=message($this->action->deleteData('vendor', $where),$msg_array);
        $this->session->set_flashdata('confirmation',$this->data['confirmation']);
        redirect('vendor/vendor/show_vendor','refresh');
    }
    
    public function hash($string) {
        return hash('md5', $string . config_item('encryption_key'));
    }

    public function read_leftJoin_profile($val){
        $sql= "select * from employee LEFT JOIN users ON employee.employee_mobile=users.mobile where employee_mobile='$val' ";
        $query=$this->db->query($sql);
        return $query->result();
    }

    public function read_leftJoin_teacher($val){
        $sql= "select * from employee LEFT JOIN users ON employee.employee_mobile=users.mobile where employee_type='$val' ";
        $query=$this->db->query($sql);
        return $query->result();
    }



}