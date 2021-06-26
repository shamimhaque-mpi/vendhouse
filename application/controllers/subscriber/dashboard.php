<?php

class Dashboard extends Subscriber_Controller {

	function __construct() {
		parent::__construct();
		$this->holder();
	 }

   public function index() {
	   redirect("/");
	}


    private function holder() {
            if($this->uri->segment(1) != "subscriber"){
                $this->subscriber_m->logout();
                redirect('frontend/home');
            }
        }

	}
