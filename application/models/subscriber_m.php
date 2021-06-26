<?php

class Subscriber_m extends Lab_Model {

    protected $_table_name = 'registration';
    protected $_limit = '1';

    function __construct() {
        parent::__construct();
    }

    public function login($mobile = NULL, $password = NULL) {
        $where = [
            'mobile'    => $mobile,
            'password'  => $password,
            'status'    => 'active'
        ];

        $user = $this->retrieve_by($where);
        
        // set session data
        if(count($user)) {
            $data = array(
                'id'                        => $user[0]->id,
                'user_id'                   => $user[0]->id,
                'point'                     => $user[0]->point,
                'login_period'              => date('Y-m-d H:i:s a'),
                'name'                      => $user[0]->name,
                'mobile'                    => $user[0]->mobile,
                'address'                   => $user[0]->address,
                'status'                    => $user[0]->status,
                'subscriberLoggedin'        => TRUE
            );
            //active session data
            $this->session->set_userdata($data);

            // store access info
            $info = array(
                'user_id'       => $user[0]->id,
                'login_period'  => $this->session->userdata('login_period')
            );

            $this->db->insert("access_info", $info);
            return true;
        }else{
            return false;
        }
        return false;

    }

    // update into database
    public function update($table, $data, $conditions) {
        $this->_table_name = $table;
        return $this->save($data, $conditions);
    }

    public function logout() {
        // updates access info
        $where = array(
            'user_id'       => $this->session->userdata('user_id'),
            'login_period'  => $this->session->userdata('login_period')
        );

        $this->db->set(array('logout_period' => date('Y-m-d H:i:s a')));
        $this->db->where($where);
        $this->db->update("access_info");

        $this->session->sess_destroy();
    }

    public function loggedin() {
        return (bool) $this->session->userdata('subscriberLoggedin');
    }

}
