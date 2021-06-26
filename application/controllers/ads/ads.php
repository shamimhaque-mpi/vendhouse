<?php

class Ads extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
        $this->load->library('upload');
    }
    
    public function index($emit = NULL) {
        $this->data['active'] = 'data-target="ads_menu"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = null;

        //Saving Slider Start here------------------*-----------------
        if ($this->input->post('ads_Save')) {

            $config['upload_path'] = './public/ads';
            $config['allowed_types'] = 'png|jpg|gif|jpeg';
            $config['max_size'] = '1024';
            $config['file_name'] ="ads".rand(1111,9999); 
            $config['overwrite']=false;   
            
            // set image size
            if ($this->input->post('page') == "home") {
                $config['max_width'] = '450';
                $config['max_height'] = '300';
            }elseif($this->input->post('page') == "single_page"){
                $config['max_width'] = '160';
                $config['max_height'] = '600';
            }
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload("ads_image")){
                $upload_data=$this->upload->data();

                $data=array(
                    "date"  => date("Y:m:d"),
                    "from_date"  => $this->input->post("from"),
                    "to_date"    => $this->input->post("to"),
                    "path"  => "public/ads/".$upload_data['file_name'],
                    'page' => $this->input->post('page'),
                    'url' => $this->input->post('url')
                    );
                    
                
                $this->action->add("ads",$data);
                $this->session->set_flashdata('success', 'Ads Create Successfully!');
                redirect('ads/ads','refresh');
            }else{

                $this->session->set_flashdata('success', 'Please try again!');
                redirect('ads/ads','refresh');
            }
        }
        //Saving slider End here--------------------*----------------------------

        //Deleting slider start here-----------------------*---------------------
        if($this->input->get("delete_token")){//Deleting Message
            $this->action->deletedata('ads',array('id'=>$this->input->get("delete_token")));
            if (is_file("./".$this->input->get("img_url"))) {
                unlink("./".$this->input->get("img_url"));
            }   
                
            $this->session->set_flashdata('success', 'Data Successfully Deleted!');
            redirect('ads/ads','refresh');
        }
        //Deleting slider end here-----------------------*---------------------

        $this->data["ads_data"]=$this->action->read("ads");

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/ads/ads', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }
}