<?php

class EditProfile extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
        $this->load->library('upload');
    }
    
    public function index() {
        $this->data['meta_title'] = 'edit_profile';
        $this->data['active'] = 'data-target="edit-profile"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = null;
        
        $this->data['allSR'] = $this->action->read('sr');

        $where = array('id' => $this->input->get('id'));
    
        if(isset($_POST['profileEditBtn'])){

        $msg_array=array(
            "title"=>"success",
            "emit"=>"Profile Updated Successfully",
            "btn"=>true
        );
            $this->data['confirmation'] = message($this->profileUpdate($where),$msg_array);
        }
        $this->data['profile']=$this->action->read("users", $where);

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/settings/edit-profile', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function profileUpdate($where){

        $data=null;

        if ($this->handle_upload()) {

            $upload_data = $this->upload->data();
            $file = $upload_data['file_name'];
            $data = array(
                'opening'   => date('Y-m-d h:i:s'),
                'name'      => $this->input->post('f_name'),
                'mobile'    => $this->input->post('mobile'),
                'email'     => $this->input->post('email'),
                'username'  => $this->input->post('username'),
                'password'  => $this->hash($this->input->post('password')),
                'sr'        => $this->input->post('sr'),
                'privilege' => $this->input->post('privilege'),
                'image'     => 'public/profiles/'.$file
                
            );            
        }else{
            $data = array(
                'opening'   => date('Y-m-d h:i:s'),
                'name'      => $this->input->post('f_name'),
                'mobile'    => $this->input->post('mobile'),
                'email'     => $this->input->post('email'),
                'username'  => $this->input->post('username'),
                'sr'        => $this->input->post('sr'),
                'privilege' => $this->input->post('privilege')
            ); 
        }


        return $this->action->update('users', $data, $where);
    }
    function handle_upload() {
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {

                $img="./".$_POST['img_url'];
                if (is_file($img)) {
                    unlink($img);
                }

                $config['upload_path'] = './public/profiles/';
                $config['allowed_types'] = 'jpeg|jpg|png|gif';
                $config['max_size'] = '1024';
                $config['file_name'] = $this->input->post('username');
                $config['overwrite'] = true;

                // $this->load->library('upload', $config);
                $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {
                
                return true;
            } else {
                // possibly do some clean up ... then throw an error
                $msg_array=array(
                    "title"=>"Warning",
                    "emit"=>$this->upload->display_errors(),
                    "btn"=>true
                );
                $this->data['confirmation']=message('warning',$msg_array);
                return false;
            }
        }
    }
	
	public function hash($string) {
        return hash('md5', $string . config_item('encryption_key'));
    }


}

