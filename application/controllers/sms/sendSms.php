<?php

class SendSms extends Admin_Controller{
	  function __construct() {
        parent::__construct();

        $this->load->model('action');
       	$this->data['total_sms'] = config_item('total_sms');
    	$this->data['all_sms'] = $this->action->read("sms_record",array("delivery_report"=>1));
        $this->load->model("retrieve");
    }
    
    public function index() {
        $this->data['meta_title'] = 'Mobile SMS';
        $this->data['active'] = 'data-target="sms_menu"';
        $this->data['subMenu'] = 'data-target="send-sms"';
        $this->data['confirmation']=$this->data["allCustomer"]= null;


        if(isset($_POST["viewQuery"])){
        	$where = array();
        	foreach($_POST["date"] as $key => $value){
        	
	        	if($value != NULL && $key == "from"){
	        		$where["date >="] = $value;
	        	}
	        	if($value != NULL && $key == "to"){
	        		$where["date <="] = $value;
	        	}
        	}
        	$where["status"] = 'active';
            //$this->data["allCustomer"] = $this->action->read_distinct("sale", $where, "mobile");
            $this->data["allCustomer"] = $this->action->read("registration", $where);
        }
        
        
        // send data
        if(isset($_POST['sendSms'])){
           $mobile_no = explode(",", $this->input->post('mobiles'));
           $content = $this->input->post('message');  
        	
           foreach($_POST['mobile'] as $key => $num) {
                 $message = send_sms($num, $content);  		
                 $insert = array(
                 	'delivery_date'     => date('Y-m-d'),
                 	'delivery_time'     => date('H:i:s'),
                 	'mobile'            => $num,
                 	'message'           => $this->input->post('message'),
                 	'total_characters'  => $this->input->post('total_characters'),
                 	'total_messages'    => $this->input->post('total_messages'),
                 	'delivery_report'   => $message
                 );
                 $this->action->add('sms_record', $insert);
           }  
	
	       if($message){
                 $this->session->set_flashdata('success', 'SMS Sent Successfully');
              } else {
                 $this->session->set_flashdata('success', 'Could not send this SMS!');
              }         
        }
        
        

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/sms/sms-nev', $this->data);
        $this->load->view('components/sms/send-sms', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }


    public function send_custom_sms() {
        $this->data['meta_title'] = 'Mobile SMS';
        $this->data['active'] = 'data-target="sms_menu"';
        $this->data['subMenu'] = 'data-target="custom-sms"';
        $this->data['confirmation'] = null;


        if(isset($_POST['sendSms'])){
        	$mobile_no = explode(",", $this->input->post('mobiles'));
        	$content = $this->input->post('message');  
        	
           foreach($mobile_no as $key=>$num) {
                 $message = send_sms($num, $content);  		
                 $insert = array(
                 	'delivery_date'     => date('Y-m-d'),
                 	'delivery_time'     => date('H:i:s'),
                 	'mobile'            => $num,
                 	'message'           => $this->input->post('message'),
                 	'total_characters'  => $this->input->post('total_characters'),
                 	'total_messages'    => $this->input->post('total_messages'),
                 	'delivery_report'   => $message
                 );
                 $this->action->add('sms_record', $insert);
              }  

              if($message){
      	        
                $this->session->set_flashdata('success', 'SMS Sent Successfully !');
              } else {
                $this->session->set_flashdata('success', 'Could not send this SMS!');
              }     
              
              redirect('sms/sendSms/send_custom_sms', 'refresh');
        }

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/sms/sms-nev', $this->data);
        $this->load->view('components/sms/send-custom-sms', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

     public function sms_report() {
        $this->data['meta_title'] = 'Mobile SMS';
        $this->data['active'] = 'data-target="sms_menu"';
        $this->data['subMenu'] = 'data-target="sms-report"';
        $this->data['confirmation']= $this->data['sms_record'] = null;

	if($this->input->post('show_between')){
		$fromDate=$this->input->post('date_from');
		$toDate=$this->input->post('date_to');
		$this->data['sms_record']=$this->action->sms_between("sms_record",$fromDate,$toDate);
	}

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/sms/sms-nev', $this->data);
        $this->load->view('components/sms/sms-report', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }
    

}