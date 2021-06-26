<?php
class ThemeSetting extends Admin_controller {
     function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title'] = 'Theme';
        $this->data['active'] = 'data-target="theme_menu"';
        $this->data['subMenu'] = 'data-target="basic"';
        $this->data['confirmation'] = null;

        $this->data["vheaderInfo"] = $this->action->read("voucher_header");
        $this->data["vfooterInfo"] = $this->action->read("voucher_footer");
        
//-----------------------------------------------------------------------------------------
//--------------------------------Changeing Feveicon start here----------------------------
//-----------------------------------------------------------------------------------------


        if ($this->input->post('update_fevicon')) {
            $where=array(
                'meta_key'  =>'logo'
            );

            if ($_FILES["attachFile"]["name"]!=null && $_FILES["attachFile"]["name"]!="" ) {

                $config['upload_path'] = './public/img';
                $config['allowed_types'] = 'png|jpeg|jpg|gif';
                //$config['max_size'] = '4096';
                //$config['max_width'] = '3000'; // max width of the image file
                //$config['max_height'] = '3000';
                $config['file_name'] ="favicon_".rand(111111,999999);
                $config['overwrite']=true;

                $this->upload->initialize($config);

                if ($this->upload->do_upload("attachFile")){

                    if (is_file('./'.$this->input->post('old_faveicon'))) {
                        unlink('./'.$this->input->post('old_faveicon'));
                    }

                    $upload_data=$this->upload->data();

                   //Encoding into json array start here
                    $logo_info=array(
                        'logo'=> $this->input->post('logo'),
                        'faveicon'=> "public/img/".$upload_data['file_name'],
                    );
                    $logo_data=json_encode($logo_info);
                    //Encoding into json array end here
                    $data=array(
                        'meta_value'=>$logo_data
                    );
                    
                    $this->action->update('site_meta', $data,$where);
                    $this->session->set_flashdata('success', 'Logo Successfully Saved !');
                }

            }else{
                
                $this->session->set_flashdata('success', 'Please try again !');
            }

        }

//--------------------------------------------------------------------------------------
//------------------------------Changeing Feveicon end here-----------------------------
//--------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------
//-------------------------------Language Change start here-----------------------------
//--------------------------------------------------------------------------------------

        if ($this->input->post('submit_language')) {
            $data=array(
                'meta_key' => 'language',
                'meta_value' => $this->input->post("language")

            );
            
            $this->action->add('site_meta', $data);
            $this->session->set_flashdata('success', 'Language Successfully Saved !');
        }

        if ($this->input->post('update_language')) {
            $where=array(
                'meta_key' => 'language',
            );
            $data=array(
                'meta_value' => $this->input->post("language")
            );

            $this->action->update('site_meta', $data,$where);
            $this->session->set_flashdata('success', 'Language successfully Updated !');
        }

//------------------------------------------------------------------------
//----------------------Language Change end here--------------------------
//------------------------------------------------------------------------



//------------------------------------------------------------------------------
//-----------------Header Information start here---------------------------
//------------------------------------------------------------------------------

        if ($this->input->post('submit_header')) {
            //Encoding into json array start here
            $h_info=array(
                'site_name'=> $this->input->post('site_name'),
                'place_name'=> $this->input->post('place_name')
            );
            $header_info=json_encode($h_info);
            //Encoding into json array end here
            $data=array(
                'meta_key' => 'header',
                'meta_value' => $header_info
            );
            
            $this->action->add('site_meta', $data);
            $this->session->set_flashdata('success', 'Theme Successfully Saved !');
        }

        //Insert end here
        //update start here

        if ($this->input->post('update_header')) {
            $where=array(
                'meta_key'   => 'header',
            );
            //Encoding into json array start here
            $h_info=array(
                'site_name'=> $this->input->post('site_name'),
                'place_name'=> $this->input->post('place_name')
            );
            $header_info=json_encode($h_info);
            //Encoding into json array end here
            $data=array(

                'meta_value' => $header_info
            );

            $this->session->set_flashdata('success', 'Theme Successfully Updated !');
        }

//------------------------------------------------------------------------------
//----------------------Header Information end here-----------------------------
//------------------------------------------------------------------------------


//------------------------------------------------------------------------------
//---------------------------------Last footer Text change Start ------------------
//------------------------------------------------------------------------------

        if ($this->input->post('submit_footer')) {

            //Encoding into json array start here
            $f_info=array(
                'l_footer_text' => $this->input->post('l_footer_text'),
                'header_txt'    => $this->input->post('header_txt'),
                'addr_moblile'  => $this->input->post('addr_moblile'),
                'admin_mobile'  => $this->input->post('admin_mobile'),
                'addr_email'    => $this->input->post('addr_email'),
                'addr_address'  => $this->input->post('addr_address')
            );

            //Uploading Footer Image Start here
            if ($_FILES["fImage"]["name"]!=null && $_FILES["fImage"]["name"]!="" ) {
                $config['upload_path'] = './public/img';
                $config['allowed_types'] = 'png|jpeg|jpg|gif';
                //$config['max_size'] = '4096';
                //$config['max_width'] = '3000'; /* max width of the image file */
               // $config['max_height'] = '3000';
                $config['file_name'] ="footer_".rand(111111,999999);
                $config['overwrite']=true;

                $this->upload->initialize($config);

                if ($this->upload->do_upload("fImage")){
                    /*
                    if (is_file('./'.$this->input->post('old_faveicon'))) {
                        unlink('./'.$this->input->post('old_faveicon'));
                    }*/

                    $upload_data=$this->upload->data();
                   //Encoding into json array start here
                    $f_info['footer_img']= "public/img/".$upload_data['file_name'];
                }
                else{
                    
                    $this->session->set_flashdata('success', 'Please try again !');
                }
            }
            else{
                $f_info['footer_img']=$this->input->post('footer_img');
            }
            //Uploading Footer Image End here

            $footer_info=json_encode($f_info);
            //Encoding into json array end here

            $data=array(
                'meta_key'   => 'footer',
                'meta_value' => $footer_info
            );

            $this->action->add('site_meta', $data);
            $this->session->set_flashdata('success', 'Theme Successfully Saved !');
        }


        //Edit Start here----------------------------------
        if ($this->input->post('update_footer')) {
            $where=array(
                'meta_key'=>'footer',
            );
            //Encoding into json array start here
            $f_info=array(
                'l_footer_text' => $this->input->post('l_footer_text'),
                'header_txt'    => $this->input->post('header_txt'),
                'addr_moblile'  => $this->input->post('addr_moblile'),
                'admin_mobile'  => $this->input->post('admin_mobile'),
                'addr_email'    => $this->input->post('addr_email'),
                'addr_address'  => $this->input->post('addr_address'),
            );

            //Uploading Footer Image Start here
            if ($_FILES["fImage"]["name"]!=null && $_FILES["fImage"]["name"]!="" ) {
                $config['upload_path'] = './public/img';
                $config['file_name'] ="footer_".rand(111111,999999);
                $config['allowed_types'] = 'PNG|png|jpeg|jpg|gif';
                //$config['max_size'] = '4096';
                //$config['max_width'] = '3000'; // max width of the image file
                //$config['max_height'] = '3000';
                $config['overwrite']=true;

                $this->upload->initialize($config);

                if ($this->upload->do_upload("fImage")){
                    if (is_file('./'.$this->input->post('footer_img'))) {
                        unlink('./'.$this->input->post('footer_img'));
                    }

                    $upload_data=$this->upload->data();
                   //Encoding into json array start here
                    $f_info['footer_img']= "public/img/".$upload_data['file_name'];
                     //print_r($f_info);
                }
                else{
                    $this->session->set_flashdata('success', 'Please try again !');
                }
            }
            else{
                $f_info['footer_img']=$this->input->post('footer_img');
            }
            //Uploading Footer Image End here
            $footer_info=json_encode($f_info);
            //Encoding into json array end here


            $data=array(
                'meta_value' => $footer_info
            );
            //print_r($data);

            
            
            $this->action->update('site_meta', $data,$where);
            $this->session->set_flashdata('success', 'Theme successfully Updated !');
        }
//-------------------------------------------------------------------------------------
//---------------------------------Last footer Text change end ------------------------
//-------------------------------------------------------------------------------------


//-------------------------------------------------------------------------------------
//-----------------------------Social Icon end Start-------------------------------
//-------------------------------------------------------------------------------------

        if ($this->input->post('submit_social')) {

            //Encoding into json array start here
            $s_icon=array(
                's_facebook'   => $this->input->post('s_facebook'),
                's_twitter'    => $this->input->post('s_twitter'),
                's_gplus'      => $this->input->post('s_gplus'),
                's_pinterest'  => $this->input->post('s_pinterest')
            );
            $social_link=json_encode($s_icon);
            //Encoding into json array end here
            $data=array(
                'meta_key' => 'social_icon',
                'meta_value' => $social_link
            );
            
            $this->action->add('site_meta', $data);
            $this->session->set_flashdata('success', 'Theme successfully Saved !');
        }

        if ($this->input->post('update_social')) {
            $where=array(
                'meta_key' => 'social_icon',
            );
            //Encoding into json array start here
            $s_icon=array(
                's_facebook'   => $this->input->post('s_facebook'),
                's_twitter'    => $this->input->post('s_twitter'),
                's_gplus'      => $this->input->post('s_gplus'),
                's_pinterest'  => $this->input->post('s_pinterest')
            );
            $social_link=json_encode($s_icon);
            //Encoding into json array end here
            $data=array(
                'meta_value' => $social_link
            );
            
            $this->action->update('site_meta', $data,$where);
            $this->session->set_flashdata('success', 'Theme successfully Updated !');
        }

//-------------------------------------------------------------------------------------
//-----------------------------Social Icon end here-------------------------------
//-------------------------------------------------------------------------------------


 /*Global Images Start Here*/
        if ($this->input->post("save")=='Save') {
            if ($_FILES["attachFile"]["name"]!=null or $_FILES["attachFile"]["name"]!="" ) {
                   
                    $config['upload_path']   = './public/images';
                    if(!is_dir($config['upload_path'])){
                        mkdir($config['upload_path']);
                    }
                    $config['allowed_types'] = 'png|jpeg|jpg|gif|svg';
                    /*$config['max_size']      = '4096';
                    $config['max_width']     = '3000'; // max width of the image file 
                    $config['max_height']    = '3000';*/
                    $config['file_name']     =str_shuffle("global".rand(1111,99999));
                    $config['overwrite']     =true;   
                    
                    $this->upload->initialize($config);
                   
                    if ($this->upload->do_upload("attachFile")){
                        $upload_data =$this->upload->data();
                        $photo_path  ="public/images/".$upload_data['file_name'];
                        if(is_file('./'.$this->input->post('old'))){
                            unlink('./'.$this->input->post('old'));
                        }
                    }
                }else{
                    $photo_path  = $this->input->post('old');
                }


                $x = array(
                        'path'=> $photo_path
                    );
                $info = json_encode($x);
                //echo $info;

                $data=array(
                    "global" => $info
                );

                $this->action->update("theme_setting",$data,array('id' =>1));
                $this->session->set_flashdata('success', 'Global Image Successfully added !');
            }

            $this->data['global'] = $this->action->read("theme_setting");
        /*Global Images End Here*/
        
        

        //Converting array to object
        $meta = $this->action->read("site_meta");
        $meta_info=array();
        foreach ($meta as $meta_value) {
            $meta_info[$meta_value->meta_key] = $meta_value->meta_value;
        }
        $meta_data = (object) $meta_info;
        $this->data["meta"] = $meta_data;
        //Converting array to object

        if(isset($_POST['app'])){
            $app    = $this->action->read('site_meta', ['meta_key'=>'app']);
            $path = '';
            if(isset($_FILES['application']) && $_FILES['application']['name']!=''){
                $name = $_FILES['application']['name'];
                $path = "public/app/".$name;
                copy($_FILES['application']['tmp_name'], $path);
            }
            
            
            if($app){
                if(file_exists($app[0]->meta_value)){
                    unlink($app[0]->meta_value);
                }
                $this->action->update('site_meta', ['meta_value'=>$path], ['meta_key'=>'app']);
            }
            else{
                $this->action->add('site_meta', ['meta_key'=>'app', 'meta_value'=>$path]);
            }
            $this->session->set_flashdata('success', 'Global Image Successfully added !');
        }


        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/theme/nav', $this->data);
        $this->load->view('components/theme/changeLogo', $this->data);
        //$this->load->view('components/theme/global_images', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }






    public function theme_tools() {
        $this->data['meta_title'] = 'Themt';
        $this->data['active'] = 'data-target="theme_menu"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = null;



        // $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        // $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        // $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        // $this->load->view('components/theme/changeLogo', $this->data);
        // $this->load->view($this->data['privilege'].'/includes/footer');
    }


    public function theme_basic() {
        $this->data['meta_title'] = 'Themt';
        $this->data['active'] = 'data-target="theme_menu"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = null;

    }







    /*public function edit($id = null){

        $this->data['meta_title'] = 'Theme';
        $this->data['active'] = 'data-target="theme_menu"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = null;

        $where = array("id"=>$id);
        $this->data["records"] = $this->action->read("voucher_header",$where);

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/theme/changeLogo', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');

    }*/

    public function editVheader(){

        $this->data['confirmation'] = null;

        if ($this->input->post("update_vo_header")) {
            $data=array(
                "name"    =>$this->input->post("name"),
                "mobile"  =>$this->input->post("mobile"),
                "address" =>$this->input->post("address")
            );

            $msg_array=array(
                "title" =>"Success",
                "emit"  =>"Voucher Successfully Updated!",
                "btn"   =>true
            );

            $where = array('id' => $this->input->post('id'));

            if ($this->action->exists('voucher_header',$where)) {
                $this->action->update("voucher_header",$data, $where);
                $this->session->set_flashdata('success', 'Voucher Successfully Updated!!');

            }else{
                $this->action->add("voucher_header",$data);
                $this->session->set_flashdata('success', 'Voucher Successfully Added!!');

            }
            
            redirect("theme/themeSetting/","refresh");
        }
    }



    public function editVfooter(){

        $this->data['confirmation'] = null;

        if ($this->input->post("update_vo_footer")) {
            $data=array(
                "message"    =>$this->input->post("message")
            );

            $where = array('id' => $this->input->post('id'));

            if ($this->action->exists('voucher_header',$where)) {
                $this->action->update("voucher_footer",$data, $where);
                $this->session->set_flashdata('success', 'Voucher Successfully Updated!');

            }else{
                $this->action->add("voucher_footer",$data);
                $this->session->set_flashdata('success', 'Voucher Successfully Updated!');

            }
            redirect("theme/themeSetting/","refresh");
        }
    }
}
