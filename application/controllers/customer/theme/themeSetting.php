<?php
class ThemeSetting extends Admin_controller {
     function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->model('action');
    }
    
    public function index() {
        $this->data['meta_title'] = 'Themt';
        $this->data['active'] = 'data-target="theme_menu"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = null;

        $this->data['theme_data']=$this->action->read('theme_setting');

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/theme/changeLogo', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function theme_tools() {
        $this->data['meta_title'] = 'Themt';
        $this->data['active'] = 'data-target="theme_menu"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = null;

        //--------------------------------------------------------------------------------------
        //----------------------------Language Change start here--------------------------------
        //--------------------------------------------------------------------------------------
        if ($this->input->post('submit_language')) {
            $data=array(
                'language'=>$this->input->post("language")
            );
            $msg_array = array(
                "title" => "Success",
                "emit"  => "Language successfully Saved",
                "btn"   => true
            );
            $this->data['confirmation'] = message($this->action->add('theme_setting', $data), $msg_array);
        }

        if ($this->input->post('update_language')) {
            $where=array(
                'id'=>$this->input->post('theme_id')
            );
            $data=array(
                'language'=>$this->input->post("language")
            );

            $msg_array = array(
                "title" => "Success",
                "emit"  => "Language successfully Updated",
                "btn"   => true
            );
            $this->data['confirmation'] = message($this->action->update('theme_setting', $data,$where), $msg_array);
        }
        //----------------------------------------------------------------------------------------------
        //----------------------------------Language Change end here------------------------------------
        //----------------------------------------------------------------------------------------------


        $this->data['theme_data']=$this->action->read('theme_setting');

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/theme/theme_tools', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    public function theme_basic() {
        $this->data['meta_title'] = 'Themt';
        $this->data['active'] = 'data-target="theme_menu"';
        $this->data['subMenu'] = 'data-target=""';
        $this->data['confirmation'] = null;

        $this->data['theme_data']=$this->action->read('theme_setting');

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/theme/themeColor', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }
}
       