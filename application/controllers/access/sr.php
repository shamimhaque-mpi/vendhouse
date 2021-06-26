<?php
class Sr extends SR_Controller {

    function __construct(){
        parent::__construct();
        $this->data['meta_title']  = "SR Login";
    }

    public function login() {
    if($this->sr_m->loggedin() == TRUE){
            redirect('sr/dashboard');
        }

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|xss_clean');

        if($this->form_validation->run() == TRUE) {
            if($this->sr_m->login() == TRUE) {
                redirect('sr/dashboard');
            } else {
                $messArr = array(
                    "title" => "warning",
                    "icon" => "home",
                    "emit" => "Wrong Username or Password!",
                    "btn" => false
                );
                $this->session->set_flashdata('error', message('warning-login', $messArr));

                redirect('access/sr/login', 'refresh');
            }
        }

      $this->load->view('access/sr-login', $this->data);
    }

    public function logout() {
        $this->sr_m->logout();
         redirect('/',"refresh");
    }
}
