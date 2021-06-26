<?php

class Signup extends Frontend_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('retrieve');

	 }

	 public function index(){
  	   $result = array();
  	   $flag1 = $flag2 = $flag3 = $flag4 = 1;

  	   $content = file_get_contents("php://input");
  	   $receive = json_decode($content, true);
  	   
  	   //print_r($receive);

	   if(empty($receive['name'])){
		  $result[0]['name_field'] = "The Name is required.";
		  $flag1 = 0;
	  }

  	   if(empty($receive['mobile'])){
  		   $result[0]['mobile_field'] = "The Mobile Number is required.";
  		   $flag2 = 0;
  	   }

  	   if(!is_numeric($receive['mobile'])){
  		   $result[0]['mobile_field'] = "The Mobile Number must be Numeric.";
  		   $flag2 = 0;
  	   }

  	   if(strlen($receive['mobile']) > 11){
  		   $result[0]['mobile_field'] = "The Mobile Number must be 11 Digits.";
  		   $flag2 = 0;
  	   }

  	   if(empty($receive['password'])){
  		   $result[0]['password_field'] = "The Password is required.";
  		   $flag3 = 0;
  	   }

	   if(empty($receive['confirm_password'])){
		  $result[0]['password_field'] = "The Confirm Password is required.";
		  $flag3 = 0;
	  }

	  if($receive['password'] != $receive['confirm_password']){
		  $result[0]['password_field'] = "The Password and Confirm Password don't Match.";
		  $flag3 = 0;
	  }

	  if(empty($receive['address'])){
		$result[0]['address_field'] = "The Address is required.";
		$flag4 = 0;
	}


  	   if($flag1 == 1 && $flag2 == 1 && $flag3 == 1 && $flag4 == 1) {
         $data = array(
			 "date"     => date("Y-m-d"),
			 "name"     => $receive['name'],
			 "mobile"   => $receive['mobile'],
			 "password" => $receive['password'],
			 //"sr"       => $receive['sr'],
			 "address"  => $receive['address']
		 );

		 $where = array("mobile"   => $receive['mobile']);

		 if($this->retrieve->exists("registration",$where)){
			 $result[0]['signup_warning'] = "This User all ready Exists!";
		 }else{
			 $status = $this->retrieve->add("registration", $data);
			 $result[0]['signup_success'] = "Your registration successfully Completed.Thank you!";
		 }

  	   }
  	   echo json_encode($result);
     }
}
