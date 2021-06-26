<?php

class Member extends Admin_Controller {

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
        $this->data['active'] = 'data-target="member_menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;

        $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|required|min_length[11]|is_unique[members.member_mobile_number]');
        $this->form_validation->set_rules('member_id', 'Member ID', 'trim|required|min_length[4]|is_unique[members.member_id]');

        if ($this->input->post("add_member")) {         
            if($this->form_validation->run() == FALSE){
                $msg_array=array(
                    "title"=>"Error",
                    "emit"=>validation_errors(),
                    "btn"=>true
                );

                $this->data['confirmation']=message("warning",$msg_array);
            } else{
                //Image Upload Start here
                if ($_FILES["attachFile"]["name"]!=null or $_FILES["attachFile"]["name"]!="" ) {
                    $config['upload_path'] = './public/members';
                    $config['allowed_types'] = 'png|jpeg|jpg|gif';
                    $config['max_size'] = '4096';
                    $config['max_width'] = '3000'; /* max width of the image file */
                    $config['max_height'] = '3000';
                    $config['file_name'] ="member_".rand(1111,99999); //.$this->input->post("emp_id")
                    $config['overwrite']=true;   
                    
                    $this->upload->initialize($config);
                   
                    if ($this->upload->do_upload("attachFile")){
                        $upload_data=$this->upload->data();
                        $photo="public/members/".$upload_data['file_name'];
                    }
                }
                //Image Upload End here

                //Signature Upload start here
                if ($_FILES["signature"]["name"]!=null or $_FILES["signature"]["name"]!="" ) {
                    $config['upload_path'] = './public/signature';
                    $config['allowed_types'] = 'png|jpeg|jpg|gif';
                    $config['max_size'] = '1024';
                    $config['max_width'] = '3000'; /* max width of the image file */
                    $config['max_height'] = '3000';
                    $config['file_name'] ="member_signature_".rand(1111,99999); //.$this->input->post("member_id")
                    $config['overwrite']=true;   
                    
                    $this->upload->initialize($config);
                    
                    if ($this->upload->do_upload("signature")){
                        $upload_data=$this->upload->data();
                        $signature="public/signature/".$upload_data['file_name'];
                    }

                } 
                //Signature Upload end here

                $data=array(
                    "joining_date"=> date('Y-m-d'),
                    "member_id" => $this->input->post("member_id"),
                    "employee_id" => $this->input->post("employee"),
                    "member_full_name"=>$this->input->post("full_name"),
                    "member_profession"=>$this->input->post("profession"),
                    "member_father_name"=>$this->input->post("father_name"),
                    "member_thorp"=>$this->input->post("thorp"),
                    "member_village"=>$this->input->post("village"),
                    "member_police_station"=>$this->input->post("police_station"),
                    "member_district"=>$this->input->post("district"),
                    "member_mobile_number"=>$this->input->post("mobile_number"),
                    "member_photo"=>$photo,
                    "member_sign"=>$signature
                );

                $msg_array=array(
                    "title"=>"Success",
                    "emit"=>"New Member Successfully Saved",
                    "btn"=>true
                );

                $this->data['confirmation']=message($this->action->add("members",$data), $msg_array);
            }
        }

        // get all employee
        $this->data['employee'] = $this->action->read('employee');

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/member/member-nav', $this->data);
        $this->load->view('components/member/add-member', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }
    //----------------------------------------------------------------------------------------------
    //------------------------------------------Add Employee End here-------------------------------
    //----------------------------------------------------------------------------------------------

    //----------------------------------------------------------------------------------------------
    //------------------------------------------View Employee start here----------------------------
    //----------------------------------------------------------------------------------------------

    public function show_member() {
        $this->data['meta_title'] = '';
        $this->data['active'] = 'data-target="member_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null; 

        $this->data['employee']= $this->action->read('employee');
        $this->data['upazilla']= $this->action->readDistinct('members','member_police_station');
        $this->data['zilla']= $this->action->readDistinct('members','member_district');


        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/member/member-nav', $this->data);
        $this->load->view('components/member/show-member', $this->data);
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
        $this->data['active'] = 'data-target="member_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

        $this->data['member']= $this->action->read('members', array('id'=> $this->input->get("id")));

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/member/member-nav', $this->data);
        $this->load->view('components/member/profile', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    //----------------------------------------------------------------------------------------------
    //------------------------------------------View profile end here-------------------------------
    //----------------------------------------------------------------------------------------------

    public function edit_member() {
        $this->data['meta_title'] = '';
        $this->data['active'] = 'data-target="member_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

        //-------------------------------------------------------------------------------------------
        //-----------------------------------update member Start here-------------------------------------
        $where = array("id"=> $this->input->get('id'));
        

        $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|required|min_length[11]');
        $this->form_validation->set_rules('member_id', 'Member ID', 'trim|required|min_length[4]');


        if ($this->input->post("update_member")) {         

            if($this->form_validation->run() == FALSE){
                $msg_array=array(
                    "title"=>"Error",
                    "emit"=>validation_errors(),
                    "btn"=>true
                );
                $this->data['confirmation']=message("warning",$msg_array);
            } else{
                  $photo=$signature=NULL;
                //Image Upload Start here
                if ($_FILES["attachFile"]["name"]!=null or $_FILES["attachFile"]["name"]!="" ) {

                    $config['upload_path'] = './public/members';
                    $config['allowed_types'] = 'png|jpeg|jpg|gif';
                    $config['max_size'] = '4096';
                    $config['max_width'] = '3000'; /* max width of the image file */
                    $config['max_height'] = '3000';
                    $config['file_name'] ="member_".rand(1111,99999); //.$this->input->post("emp_id")
                    $config['overwrite']=true;   
                    
                    $this->upload->initialize($config);
                   
                    
                    if ($this->upload->do_upload("attachFile")){
                        $upload_data=$this->upload->data();
                        $photo="public/members/".$upload_data['file_name'];
                    }

                }
                //Image Upload End here
                //Signature Upload start here
                if ($_FILES["signature"]["name"]!=null or $_FILES["signature"]["name"]!="" ) {

                    $config['upload_path'] = './public/signature';
                    $config['allowed_types'] = 'png|jpeg|jpg|gif';
                    $config['max_size'] = '1024';
                    $config['max_width'] = '3000'; /* max width of the image file */
                    $config['max_height'] = '3000';
                    $config['file_name'] ="member_signature_".rand(1111,99999); //.$this->input->post("member_id")
                    $config['overwrite']=true;   
                    
                    $this->upload->initialize($config);
                    
                    if ($this->upload->do_upload("signature")){
                        $upload_data=$this->upload->data();
                        $signature="public/signature/".$upload_data['file_name'];
                    }

                } 
                //Signature Upload end here
      
           if($photo != NULL && $signature != NULL){
                $data=array(
                    "joining_date"=> date('Y-m-d'),
                    "member_id" => $this->input->post("member_id"),
                    "employee_id"=>$this->input->post("employee"),
                    "member_full_name"=>$this->input->post("full_name"),
                    "member_profession"=>$this->input->post("profession"),
                    "member_father_name"=>$this->input->post("father_name"),
                    "member_thorp"=>$this->input->post("thorp"),
                    "member_village"=>$this->input->post("village"),
                    "member_police_station"=>$this->input->post("police_station"),
                    "member_district"=>$this->input->post("district"),
                    "member_mobile_number"=>$this->input->post("mobile_number"),
                    "member_photo"=>$photo ,
                    "member_sign"=>$signature                  
                );

              } else if($photo != NULL){
                   $data=array(
                    "joining_date"=> date('Y-m-d'),
                    "member_id" => $this->input->post("member_id"),
                    "employee_id"=>$this->input->post("employee"),
                    "member_full_name"=>$this->input->post("full_name"),
                    "member_profession"=>$this->input->post("profession"),
                    "member_father_name"=>$this->input->post("father_name"),
                    "member_thorp"=>$this->input->post("thorp"),
                    "member_village"=>$this->input->post("village"),
                    "member_police_station"=>$this->input->post("police_station"),
                    "member_district"=>$this->input->post("district"),
                    "member_mobile_number"=>$this->input->post("mobile_number"),
                    "member_photo"=>$photo                   
                );

              }else if($signature != NULL){
                $data=array(
                    "joining_date"=> date('Y-m-d'),
                    "member_id" => $this->input->post("member_id"),
                    "employee_id"=>$this->input->post("employee"),
                    "member_full_name"=>$this->input->post("full_name"),
                    "member_profession"=>$this->input->post("profession"),
                    "member_father_name"=>$this->input->post("father_name"),
                    "member_thorp"=>$this->input->post("thorp"),
                    "member_village"=>$this->input->post("village"),
                    "member_police_station"=>$this->input->post("police_station"),
                    "member_district"=>$this->input->post("district"),
                    "member_mobile_number"=>$this->input->post("mobile_number"),                   
                    "member_sign"=>$signature
                );
              }else{
                $data=array(
                    "joining_date"=> date('Y-m-d'),
                    "member_id" => $this->input->post("member_id"),
                    "employee_id"=>$this->input->post("employee"),
                    "member_full_name"=>$this->input->post("full_name"),
                    "member_profession"=>$this->input->post("profession"),
                    "member_father_name"=>$this->input->post("father_name"),
                    "member_thorp"=>$this->input->post("thorp"),
                    "member_village"=>$this->input->post("village"),
                    "member_police_station"=>$this->input->post("police_station"),
                    "member_district"=>$this->input->post("district"),
                    "member_mobile_number"=>$this->input->post("mobile_number")
                   
                );
            }

                 $msg_array=array(
                    "title"=>"Success",
                    "emit"=>"New Member Successfully Updated",
                    "btn"=>true
                );

                $this->data['confirmation']=message($this->action->update("members",$data, $where), $msg_array);  
                $this->session->set_flashdata("confirmation", $this->data['confirmation']);
                redirect("member/member/show_member","refresh"); 

            }
        }

        // get all employee
        $this->data['employee'] = $this->action->read('employee');
        $this->data['member']= $this->action->read('members', $where);
        
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/member/member-nav', $this->data);
        $this->load->view('components/member/edit-member', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function delete($id = NULL){ 

        $info = $this->action->read('members',array('id'=>$id));
        if($info != NULL){
            unlink($info[0]->member_photo);
            unlink($info[0]->member_sign);
        }   
        $options= array(
            'title' => 'delete',
            'emit'  => 'Member Successfully Deleted!',
            'btn'   => true
        );

       $this->data['confirmation']=message($this->action->deletedata('members', array('id' => $id)), $options);
       $this->session->set_flashdata("confirmation",$this->data['confirmation']);
       redirect("member/member/show_member","refresh");
    }

    public function salary($emit = NULL) {
        $this->data['meta_title'] = '';
        $this->data['active'] = 'data-target="member_menu"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = null;

        if($this->input->get('delete') == 1){
            $this->data['confirmation'] = message($this->deleteProfile());
        }

        $this->data['profiles']=$this->action->read("users");

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/member/salary', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function salary_history($emit = NULL) {
        $this->data['meta_title'] = '';
        $this->data['active'] = 'data-target="employee_menu"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = null;

        if($this->input->get('delete') == 1){
            $this->data['confirmation'] = message($this->deleteProfile());
        }

        $this->data['profiles']=$this->action->read("users");

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/member/history', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
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