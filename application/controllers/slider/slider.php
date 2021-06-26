<?php

class Slider extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
        $this->load->library('upload');
    }
    
    public function index($emit = NULL) {
        $this->data['meta_title'] = 'gallery';
        $this->data['active'] = 'data-target="slider"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = null;
        //Saving Slider Start here------------------*-----------------
        if ($this->input->post('slider_Save')) {

            $config['upload_path'] = './public/slider';
            $config['allowed_types'] = 'png|jpg|gif|jpeg';
            $config['max_size'] = '10240';
            //$config['max_width'] = '3000'; /* max width of the image file */
            //$config['max_height'] = '3000';
            $config['file_name'] ="slider".rand(1111,9999); 
            $config['overwrite']=false;   
            
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload("slider_image")){
                $upload_data=$this->upload->data();

                $data=array(
                    "slider_date"=>date('Y-m-d'),
                    "slider_path"=>"public/slider/".$upload_data['file_name'],
                    "slider_url"=>$this->input->post("sliderUrl")
                );
                
                $this->action->add("slider",$data);
                $this->session->set_flashdata('success', 'Image Save Successfully');
                redirect('slider/slider','refresh');
            }
            else{
                    $this->session->set_flashdata('warning', 'Please try again');
                    redirect('slider/slider','refresh');
                }
                
                
        }
        //Saving slider End here--------------------*----------------------------

        //Deleting slider start here-----------------------*---------------------
        if($this->input->get("delete_token")){//Deleting Message
            $this->action->deletedata('slider',array('id'=>$this->input->get("delete_token")));
            if (is_file("./".$this->input->get("img_url"))) {
                unlink("./".$this->input->get("img_url"));
            }
            $this->session->set_flashdata('success', 'Image deleted successfully');
            redirect('slider/slider','refresh');
        }
        //Deleting slider end here-----------------------*---------------------

        $this->data["slider_data"] = $this->action->readOrderby("slider","position");

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/slider/slider', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }


    public function ajax_slider_sort(){
        $receive_data=$this->input->post('finaldata'); 
        //echo $receive_data;
        $receive_array=json_decode($receive_data,true);

        foreach ($receive_array as $key => $value) {
            $where=array("id"=>$key);
            $data=array(
                "position"=>$value
                );
            $this->action->update("slider",$data,$where);
        }
    }



}