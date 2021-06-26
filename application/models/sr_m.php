<?php

class Sr_m extends Lab_Model {

    protected $_table_name = 'sr';
    protected $_limit = '1';

    function __construct() {
        parent::__construct();
    }

    public function login() {
        $where = array();

        $where['username']   = $_POST['username'];
        $where['password']   = $_POST['password'];


        $user = $this->retrieve_by($where);

        $where = array();

        // set session data
        if(count($user)) {
            $data = array(
                'id'                        => $user[0]->id,
                'login_period'              => date('Y-m-d H:i:s a'),
                'name'                      => $user[0]->name,
                'code'                      => $user[0]->code,
                'mobile'                    => $user[0]->mobile,
                'address'                   => $user[0]->address,
                'field'                     => $user[0]->field,
                'target'                    => $user[0]->target,
                'srLoggedin'                => TRUE
            );
            //active session data
            $this->session->set_userdata($data);
            return true;
        }else{
            return false;
        }

        return false;

    }



    public function logout() {

        $this->session->sess_destroy();
    }

    public function loggedin() {
        return (bool) $this->session->userdata('srLoggedin');
    }

}
