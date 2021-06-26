<?php

class Lab_Controller extends CI_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();

        $this->data['errors'] = array();
        $this->data['site_name'] = config_item('site_name');
        $this->data['description'] = NULL;
    }
}

// for fornend
class Frontend_Controller extends Lab_Controller {

    function __construct() {
        parent::__construct();

        // Set default meta title
        $this->data['meta_title'] = 'Frontend meta title';
        $this->load->helper("frontend");
        $this->load->helper("io");
        $this->load->helper("confirmation");
    }

}

// for backend
class Admin_Controller extends Lab_Controller {

    function __construct() {
        parent::__construct();

        // Set default meta title
        $this->data['meta_title'] = 'Backend meta title';

        // Load helpers
        $this->load->helper('form');
        $this->load->helper("file");
        $this->load->helper("admin");
        $this->load->helper("io");
        $this->load->helper("custom");
        $this->load->helper("sms");
        $this->load->helper("confirmation");

        // Load libraties
        $this->load->library('form_validation');
        $this->load->library('session');

        // Load models
        $this->load->model('action');
        $this->load->model('membership_m');

        // Login check
        $exception_uris = array(
            'access/users/login',
            'access/users/logout'
        );

        if(in_array(uri_string(), $exception_uris) == FALSE) {
            if($this->membership_m->loggedin() == FALSE) {
                redirect('access/users/login');
            } else {
                // set profile image
                // $status               = json_decode($this->session->userdata('status'));
                $this->data['user_id']   = $this->session->userdata('user_id');
                $this->data['image']     = $this->session->userdata('image');
                $this->data['username']  = $this->session->userdata('username');
                $this->data['name']      = $this->session->userdata('name');
                $this->data['email']     = $this->session->userdata('email');
                $this->data['mobile']    = $this->session->userdata('mobile');
                $this->data['branch']    = $this->session->userdata('branch');

                $list_of_privilege       = config_item('privilege');
                $this->data['privilege'] = $this->session->userdata('privilege');
                $this->data['user_id'] = $this->session->userdata('user_id');
            }
        }

        $this->data["vheaderInfo"] = $this->action->read("voucher_header");
        $this->data["vfooterInfo"] = $this->action->read("voucher_footer");


    }

}

// for subscriber
class Subscriber_Controller extends Lab_Controller {

    function __construct() {
        parent::__construct();

        
        $this->load->helper("io");
        // Set default meta title
        $this->data['meta_title'] = 'Subscriber meta title';
        // Load libraties
        $this->load->library('session');
        $this->load->helper("admin");
        $this->load->helper("sms");
        // Load models
        $this->load->model('subscriber_m');
        $this->load->model('retrieve');
        // Login check
        $exception_uris = array(
            'access/subscriber/login',
            'access/subscriber/codeVerify',
            'access/subscriber/login_form',
            'reset_password',
            'subscriber/wishList',
            'login',
            'signup',
        );

        if (in_array(uri_string(), $exception_uris) == FALSE) {
            if ($this->subscriber_m->loggedin() == FALSE) {
                redirect('frontend/home');
            } else {
                $this->data['id']                   = $this->session->userdata('id');
                $this->data['name']                 = $this->session->userdata('name');
                $this->data['mobile']               = $this->session->userdata('mobile');
                $this->data['address']              = $this->session->userdata('address');
                $this->data['subscriberLoggedin']   = $this->session->userdata('subscriberLoggedin');
          }
        }
    }

}


// for SR Controller
class SR_Controller extends Lab_Controller {

    function __construct() {
        parent::__construct();

        // Set default meta title
        $this->data['meta_title'] = 'SR meta title';

        // Load helpers
        $this->load->helper('form');
        $this->load->helper("file");
        $this->load->helper("custom");
        $this->load->helper("sms");
        $this->load->helper("confirmation");
        $this->load->helper("io");
        
        // Load libraties
        $this->load->library('form_validation');
        $this->load->library('session');
        // Load models
        $this->load->model('sr_m');
        $this->load->model('retrieve');
        // Login check
        $exception_uris = array(
            'access/sr/login',
            'access/sr/logout'
        );
        
        
        if (in_array(uri_string(), $exception_uris) == FALSE) {
            if ($this->sr_m->loggedin() == FALSE) {
                redirect('access/sr/login');
            } else {
                $this->data['id']                   = $this->session->userdata('id');
                $this->data['name']                 = $this->session->userdata('name');
                $this->data['code']                 = $this->session->userdata('code');
                $this->data['mobile']               = $this->session->userdata('mobile');
                $this->data['address']              = $this->session->userdata('address');
                $this->data['field']                = $this->session->userdata('field');
                $this->data['srLoggedin']           = $this->session->userdata('srLoggedin');
          }
        }
    }

}


// for api
class APIController extends Lab_Controller {
	protected $dataset = array();
    	function __construct() {
        	parent::__construct();

	      //load the action model
             $this->load->model("action");

              // Load libraties
            $this->load->library('form_validation');

    	}

}
