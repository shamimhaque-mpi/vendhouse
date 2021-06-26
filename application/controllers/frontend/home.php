<?php

class Home extends Frontend_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('retrieve');
		$this->load->model('action');
		$this->load->helper('form');
		$this->load->helper('sms');
		$this->load->helper('custom');
		$this->load->library('session');


		$this->data['zilla'] = $this->action->read("districts");

		//Converting array to object
        $meta = $this->retrieve->read("site_meta");
        $meta_info=array();
        
        
        foreach ($meta as $meta_value) {
            $meta_info[$meta_value->meta_key] = $meta_value->meta_value;
        }
        
        
        $meta_data = (object) $meta_info;
        $this->data["meta"] = $meta_data;
        //Converting array to object
        
        $footer_info = json_decode($meta_info['footer'], true);
    	$this->data['admin_mobile'] = explode(" ", $footer_info['admin_mobile'])[0]; 
    	//echo $this->data['admin_mobile'];

        $todays_where = array("date" => date("Y-m-d"));
        $this->data['todays_visitor']=$this->retrieve->read('visitors',$todays_where);
        $this->data['total_visitor']=$this->retrieve->readDistinct('visitors','ip');


		$this->data["categories"] = $this->action->active_category();
		
		$this->data["top_most_categories"] = $this->action->read_limit_rang("category",array("position >" => 0),"position","asc",3,0);

		if(!empty($this->data["categories"])){
		    
			foreach ($this->data["categories"] as $key => $cat) {
				$where=[
				    'product_cat'	=>	$cat->category,
					'status'		=>	1
				];
				
				$this->data['products'][] = get_result('products', $where, ['id', 'product_code', 'img_path', 'product_cat', 'sale_price', 'regular_price']);
			}	
		}

		$this->data['coupon'] = $this->action->read("coupon");
		$limit_amount = $this->action->read("purchase_limit");
		$this->data['limit_amount'] = ($limit_amount) ? $limit_amount[0]->amount : 0.00;

	 }

    public function index() {
		$this->load->helper('ip');
		$this->data['meta_title'] = 'Home';
		$this->data['products'] = $this->data['orderNo']= $this->data['adsInfo'] = NULL;
		$this->data['orderNo']=generateOrderNn('orders');

		$this->data['slider'] = $this->action->readOrderby("slider","position");


		$ip=get_client_ip();
		$date=date("Y-m-d");

		$data=array(
		    "date"=>$date,
		    "ip"=>$ip
		);

		if ($this->action->exists('visitors', $data)==false) {
		    $this->action->add('visitors',$data);
		}


		$this->data["categories"] = $this->action->active_category();

		if( $this->data["categories"] != NULL){
			foreach ($this->data["categories"] as $key => $cat) {
				$where=array(
					'product_cat'	=>	$cat->category,
					'permission'	=>	'yes',
					'status'		=>	1
				);
				$this->data['products'][] = $this->action->read('products',$where);
			}
		}
		
		
		/* Latest Products */
		$this->data['latest_products'] = get_result('products', ['status'=>1], null, null, 'id', 'DESC', 12);
		
		
		/* Latest Products */
		$this->data['popular_products'] = get_result('products', ['status'=>1], null, null, 'total_visit', 'DESC', 12);
		
		
		// read pop up ads start
		   $ads_session_data = $this->session->userdata('adsInfo');
			if($ads_session_data == NULL){
				 $adsWhere = array(
					"page"          => "home",
		  			"from_date <="  => date("Y-m-d"),
		  			"to_date >="	=> date("Y-m-d")
		  		);

		  		$this->data['adsInfo'] = $this->action->read_limit_rand("ads",$adsWhere);

				if($this->data['adsInfo'] != NULL){
					$ads_data = array(
		    		     "date" =>   date("Y-m-d"),
		    		      "ip"  =>   $ip,
					      "ads" =>   $this->data['adsInfo'][0]->id
		    		  );

					$this->session->set_userdata('adsInfo',$ads_data);
					$this->action->add("visit_ads",$ads_data);
				}

			}
		  // read pop up ads end


		$this->load->view('frontend/include/header', $this->data);
		$this->load->view('frontend/include/navbar', $this->data);
		$this->load->view('frontend/include/order_modal', $this->data);
		$this->load->view('frontend/home', $this->data);
		$this->load->view('frontend/include/footer', $this->data);
	}
	
	
	// all new functions
    public function get_all_product(){
        
        $this->load->library('product');
        
        $results = $this->product->products();
        
        echo json_encode($results);
    }

    public function see_more() {
        $this->data['meta_title'] = 'home';


		$this->load->view('frontend/include/header', $this->data);
		$this->load->view('frontend/include/navbar', $this->data);
		$this->load->view('frontend/include/order_modal', $this->data);
		$this->load->view('frontend/see_more', $this->data);
		$this->load->view('frontend/include/footer', $this->data);
    }

    public function global_method() {
        $this->data['meta_title'] = 'Global';

		$this->data['global'] = $this->action->read("theme_setting");

		$this->load->view('frontend/include/header', $this->data);
		$this->load->view('frontend/include/navbar', $this->data);
		$this->load->view('frontend/include/order_modal', $this->data);
		$this->load->view('frontend/global', $this->data);
		$this->load->view('frontend/include/footer', $this->data);
    }
    
    
     public function affiliate_product() {
        $this->data['meta_title'] = 'affiliate_product';

		$this->data['affiliate_product'] = $this->action->read("affiliate_product");

		$this->load->view('frontend/include/header', $this->data);
		$this->load->view('frontend/include/navbar', $this->data);
		$this->load->view('frontend/include/order_modal', $this->data);
		$this->load->view('frontend/affiliate_product', $this->data);
		$this->load->view('frontend/include/footer', $this->data);
    }
    

    public function brandAll() {
        $this->data['meta_title'] = 'All Brands';


		$this->load->view('frontend/include/header', $this->data);
		$this->load->view('frontend/include/navbar', $this->data);
		$this->load->view('frontend/include/order_modal', $this->data);
		$this->load->view('frontend/brandAll', $this->data);
		$this->load->view('frontend/include/footer', $this->data);
    }

    public function brand() {
        $this->data['meta_title'] = 'Brands';


		$this->load->view('frontend/include/header', $this->data);
		$this->load->view('frontend/include/navbar', $this->data);
		$this->load->view('frontend/include/order_modal', $this->data);
		$this->load->view('frontend/brand', $this->data);
		$this->load->view('frontend/include/footer', $this->data);
    }



    public function categoryAll() {
        $this->data['meta_title'] = 'All Category';



        $this->load->view('frontend/include/header', $this->data);
		$this->load->view('frontend/include/navbar', $this->data);
		$this->load->view('frontend/include/order_modal', $this->data);
		$this->load->view('frontend/categoryAll', $this->data);
		$this->load->view('frontend/include/footer', $this->data);
    }


    public function singlePage() {
        $this->data['meta_title'] = 'Products';

        $this->data['brand'] = str_replace(' ','+',trim($_GET['brand']));
        
        $this->data['type'] = $_GET['type'];
        
        $this->load->view('frontend/include/header', $this->data);
		$this->load->view('frontend/include/navbar', $this->data);
		$this->load->view('frontend/include/order_modal', $this->data);
		$this->load->view('frontend/bcWiseProduct', $this->data);
		$this->load->view('frontend/include/footer', $this->data);
    }


    public function updatePass() {
        $this->data['meta_title'] = 'Update Password';

        // send data
        if(isset($_POST['sendSms'])){
        	$where = array('mobile' => $this->input->post('mobile'));
        	$userData = $this->action->read('registration',$where);

       		if ($userData != null) {

       		$content = "Your Mobile No: ".$userData[0]->mobile." and Password: " .$userData[0]->password;
       		$num = $this->input->post('mobile');
       		
            $message = send_sms($num, $content);
            $insert = array(
             	'delivery_date'     => date('Y-m-d'),
             	'delivery_time'     => date('H:i:s'),
                'message'           => $content,
             	'mobile'            => $num,
             	'delivery_report'   => $message
            );
            $this->action->add('sms_record', $insert);

			 if($message){
						   $options = array(
							   "title"  => "success",
							   "emit"   => "Your Password has been Successfully Sent! Please Check Your Mobile SMS.",
							   "btn"    => true
						   );
					       $this->data['confirmation'] = message('success', $options);
			               $this->session->set_flashdata('confirmation', $this->data['confirmation']);
			               redirect('frontend/home/updatePass','refresh');
					   } else{
						   $options = array(
							 "title"  => "warning",
							 "emit"   => "Oops! Something went Wrong!Try again Please.",
							 "btn"    => true
						 );
					       $this->data['confirmation'] = message('warning', $options);
			               $this->session->set_flashdata('confirmation',$this->data['confirmation']);
			               redirect('frontend/home/updatePass','refresh');
					   }

        	}else{
			   $options = array(
				 "title"  => "warning",
				 "emit"   => "No account found!",
				 "btn"    => true
			 );
		       $this->data['confirmation'] = message('warning', $options);
               $this->session->set_flashdata('confirmation',$this->data['confirmation']);
               redirect('frontend/home/updatePass','refresh');
        	}

        }
		$this->load->view('frontend/include/header', $this->data);
		$this->load->view('frontend/include/navbar', $this->data);
		$this->load->view('frontend/include/order_modal', $this->data);
		$this->load->view('frontend/updatePass', $this->data);
		$this->load->view('frontend/include/footer', $this->data);
    }

    public function ajax_load_more(){
        $limit = $this->input->post("limit");
        $offset = $this->input->post("offset");
        $result = $this->action->read_limit_rang("gallery",array(),"id","asc",$limit,$offset);
        //    echo json_encode($result);
        if (count($result)) {

        foreach ($result as $key => $value) {

        echo '<div class="col-md-3">
                <a class="example-image-link" href="'.site_url($value->gallery_path).'" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
                    <img style="width: 100%;height: auto;height: 180px; overflow-x: hidden; margin-bottom: 20px;" class="example-image img-thumbnail" src="'.site_url($value->gallery_path).'" />
                </a>
              </div>';
            }
        }else echo "empty";
    }


	public function products_details($id){
        $this->data['meta_title'] = 'Details';

		$adsWhere = array(
		   "page"          => "single_page",
		   "from_date <="  => date("Y-m-d"),
		   "to_date >="	   => date("Y-m-d")
	    );

	    $this->data['adsInfo'] = $this->action->read_limit_rand("ads",$adsWhere);


        $where = ["id"=>$id];
        $this->data['product_info'] = $product = $this->action->read("products",$where);
        $this->data["id"] = $id;
        
        if($product){
            $total_visit = ($product[0]->total_visit + 1);
            update('products', ['total_visit'=>$total_visit], $where);
        }
        
        /*meta information for facebook start*/
	    $this->data['meta_path']        = $this->data['product_info'][0]->img_path;
	    $this->data['meta_title']       = $this->data['product_info'][0]->product_name;
	    $this->data['meta_description'] = strip_tags($this->data['product_info'][0]->description);
        /*meta information for facebook end*/

		$this->load->view('frontend/include/header', $this->data);
		$this->load->view('frontend/include/navbar', $this->data);
		$this->load->view('frontend/include/order_modal', $this->data);
		$this->load->view('frontend/products_details', $this->data);
		$this->load->view('frontend/include/footer', $this->data);
	}

	public function search(){
		$this->data['meta_title'] = 'Details';
		$this->data['product_info'] = NULL;

		$name = $this->input->post('search');
		$category = str_replace(" ","_",$this->input->post('search'));
		$subcategory = str_replace(" ","-",$this->input->post('search'));
        $this->data['product_info'] = $this->action->readlike("products",$name,$category,$subcategory);



		$this->load->view('frontend/include/header', $this->data);
		$this->load->view('frontend/include/navbar', $this->data);
		$this->load->view('frontend/include/order_modal', $this->data);
		$this->load->view('frontend/products_search', $this->data);
		$this->load->view('frontend/include/footer', $this->data);
	}


		public function add_order(){
		    $varificaton_code   = json_decode(base64_decode($this->input->post('_token')));
		    $order_proccess     = "0";
		    
		    if(!empty($_POST['product_name']))
		    {
    			$this->data['confirmation']=NULL;
    			// working with order number
    			$order_no = generateUniqueId('orders', 'id', 'date');
    
    			$point = 0;
    
    			// Check whether the user has already defined as Fake or not
    			$where = array(
    				'status' => 'fake',
    				'mobile' => $this->input->post('mobile')
    			 );
    
    			if ($this->action->exists("orders", $where)) {
    				$this->data['confirmtion'] = "You are listed as a Fake Customer.For Details call to the Helpline.Thank you.";
    			}else{
    				foreach ($_POST['product_name'] as $key => $value) {
    					$data = array(
    						'order_no'			=> $order_no,
    						'order_date'		=> $_POST['order_date'],
    						'transaction_mobile'=> (isset($_POST['transition_mobile']) ? $_POST['transition_mobile'] : null),
    						'product'		    => $value,
    						'code'				=> $_POST['product_code'][$key],
    						'price'				=> $_POST['price'][$key],
    						'discount'			=> $_POST['discount'][$key],
    						'color'				=> $_POST['color'][$key],
    						'size'				=> $_POST['size'][$key],
    						'unit'				=> $_POST['unit'][$key],
    						'quantity'			=> $_POST['quantity'][$key],
    						'sub_total'			=> $_POST['sub_total'][$key],
    						'total'		        => $_POST['total_amount'],
    						'coupon'            => (isset($_POST['coupon'])) ? $_POST['coupon'] : "",
    						'delivery_charge'   => $_POST['delivery_charge'],
    						'grand_total'		=> $_POST['grand_total'],
    						'name'				=> $_POST['name'],
    						'mobile'			=> $_POST['mobile'],
    						'address'			=> $_POST['address'],
    						'city'			    => $_POST['city'],
    						'discount_product_wise' => $_POST['discount_product_wise'][$key],
    						//'area'			    => $_POST['area'],
    						//'zip_code'			=> $_POST['zip_code'],
    						'shipping_address'	=> $_POST['shipping_address'],
    						'sr_name'	        => (isset($_POST['sr_name'])) ? $_POST['sr_name'] : "",
    						'sr_code'	        => (isset($_POST['sr_code'])) ? $_POST['sr_code'] : "",
    						'method'	        => (isset($_POST['method'])) ? $_POST['method'] : "",
    						'account'	        => (isset($_POST['account'])) ? $_POST['account'] : "",
    						'time'				=> date("h:i:s a"),
    						'delivery_time'		=> (isset($_POST['delivary_time'])) ? $_POST['delivary_time'] : ''
    					 );
    					 
    					 $stock     = read('products', ['product_code'=>$_POST['product_code'][$key]]);
    					 $stock_qty = ($stock[0]->stock_qty - $_POST['quantity'][$key]);
    					 // Stock Update
    					 update('products', ['stock_qty'=>$stock_qty], ['product_code'=>$_POST['product_code'][$key]]);
    
    					 $status = $this->retrieve->add('orders', $data);
    					 if($status == "success"){
    					    $this->data['confirmtion'] = "Dear ".$_POST['name'].", Your order have been received successfully. ";
    					 }
    				 }
    
    				 $password = rand(11111,99999);
    				 $reg_data = array(
    					 'date'         => date("Y-m-d"),
    					 'name'		    => $_POST['name'],
    					 'mobile'	    => $_POST['mobile'],
    					 'password'     => $password,
    					 'address'	    => $_POST['address']
    				 );
    
    				 $where = array('mobile' => $_POST['mobile']);
    				 // calculate cash point
    				 $point = $this->calculatePoint($_POST['total_amount']);
    
    				 if($this->retrieve->exists("registration",$where)){
    					 $info = $this->retrieve->read("registration",$where);
    
    					 if($info != NULL){
    						$point = $info[0]->point + $point;
    					 }
    
    					 $data_point = array("point" => $point);
    					 $this->retrieve->update("registration",$data_point,$where);
    					 $text = "Dear ".$_POST['name'].", Your order have been received successfully. Your order no is " . $order_no . ". Thank you. Regards: vendhouse.com.bd";
    					 
    				 }else{
    					 $reg_data["point"] =  $point;
    					 $this->retrieve->add('registration', $reg_data);
    					 $text = "Dear ".$_POST['name'].", Your order have been received successfully. Your order no is " . $order_no . " and Password is ". $password ." Thank you. Regards: vendhouse.com.bd";
    					 
    				 }
    
    				$message = send_sms($_POST['mobile'], $text);
    				$insert = array(
    	             	'delivery_date'     => date('Y-m-d'),
    	             	'delivery_time'     => date('H:i:s'),
    	             	'mobile'            => $_POST['mobile'],
    	             	'message'           => $text,
    	             	'total_characters'  => strlen($text),
    	             	'total_messages'    => 1,
    	             	'delivery_report'   => $message
    	            );
    	            $this->retrieve->add('sms_record', $insert);
    
    
    
    	            //send sms to admin
        			//$admin_mobile = json_decode($this->data["meta"]->footer,true)['admin_mobile'];
        			//echo $this->data['admin_mobile'];
        			
    				$content = "You have got an order. Order no is " . $order_no;
    				$message = send_sms($this->data['admin_mobile'], $content);
    				
    				$insert = array(
    	             	'delivery_date'     => date('Y-m-d'),
    	             	'delivery_time'     => date('H:i:s'),
    	             	'mobile'            => $this->data['admin_mobile'],
    	             	'message'           => $content,
    	             	'total_characters'  => strlen($content),
    	             	'total_messages'    => 1,
    	             	'delivery_report'   => $message
    	              );
    	              //print_r($insert);
    	              $this->retrieve->add('sms_record', $insert);
              }
                $order_proccess = "1";
		    }
		    else{
		        $this->data['confirmtion'] = "Your order has not complated! , Please try again...";
		        $order_proccess = "0";
		    }
		    
			$this->session->set_flashdata('confirmation', $this->data['confirmtion']);
			$this->session->set_flashdata('complete', $order_proccess);
			redirect('frontend/home', 'refresh');
		}
		
		
		/*
		
		    public function add_order(){
		    
		    $varificaton_code   = json_decode(base64_decode($this->input->post('_token')));
		    $order_proccess     = "0";
		    
		    if($varificaton_code->mobileVarified == "true" && $varificaton_code->number_varified == "true")
		    {
    			$this->data['confirmation']=NULL;
    			// working with order number
    			$order_no = generateUniqueId('orders', 'id', 'date');
    
    			$point = 0;
    
    			// Check whether the user has already defined as Fake or not
    			$where = array(
    				'status' => 'fake',
    				'mobile' => $this->input->post('mobile')
    			 );
    
    			if ($this->action->exists("orders",$where)) {
    				$this->data['confirmtion'] = "You are listed as a Fake Customer.For Details call to the Helpline.Thank you.";
    			}else{
    				foreach ($_POST['product_name'] as $key => $value) {
    					$data = array(
    						'order_no'			=> $order_no,
    						'order_date'		=> $_POST['order_date'],
    						'product'		    => $value,
    						'code'				=> $_POST['product_code'][$key],
    						'price'				=> $_POST['price'][$key],
    						'color'				=> $_POST['color'][$key],
    						'size'				=> $_POST['size'][$key],
    						'unit'				=> $_POST['unit'][$key],
    						'quantity'			=> $_POST['quantity'][$key],
    						'sub_total'			=> $_POST['sub_total'][$key],
    						'total'		        => $_POST['total_amount'],
    						'coupon'            => (isset($_POST['coupon'])) ? $_POST['coupon'] : "",
    						'discount'          => (isset($_POST['discount'])) ? $_POST['discount'] : "",
    						'delivery_charge'   => $_POST['delivery_charge'],
    						'grand_total'		=> $_POST['grand_total'],
    						'name'				=> $_POST['name'],
    						'mobile'			=> $_POST['mobile'],
    						'address'			=> $_POST['address'],
    						'city'			    => $_POST['city'],
    						//'area'			    => $_POST['area'],
    						//'zip_code'			=> $_POST['zip_code'],
    						'shipping_address'	=> $_POST['shipping_address'],
    						'sr_name'	        => (isset($_POST['sr_name'])) ? $_POST['sr_name'] : "",
    						'sr_code'	        => (isset($_POST['sr_code'])) ? $_POST['sr_code'] : "",
    						'method'	        => (isset($_POST['method'])) ? $_POST['method'] : "",
    						'account'	        => (isset($_POST['account'])) ? $_POST['account'] : "",
    						'time'				=> date("h:i:s a"),
    						'delivery_time'		=> (isset($_POST['delivary_time'])) ? $_POST['delivary_time'] : ''
    					 );
    
    					 $status = $this->retrieve->add('orders', $data);
    					 if($status == "success"){
    					    $this->data['confirmtion'] = "আপনার অর্ডার সফল ভাবে গ্রহণ করা হয়েছে! ধন্যবাদ ।";
    					 }
    				 }
    
    				 $password = rand(11111,99999);
    				 $reg_data = array(
    					 'date'         => date("Y-m-d"),
    					 'name'		    => $_POST['name'],
    					 'mobile'	    => $_POST['mobile'],
    					 'password'     => $password,
    					 'address'	    => $_POST['address']
    				 );
    
    				 $where = array('mobile' => $_POST['mobile']);
    				 // calculate cash point
    				 $point = $this->calculatePoint($_POST['total_amount']);
    
    				 if($this->retrieve->exists("registration",$where)){
    					 $info = $this->retrieve->read("registration",$where);
    
    					 if($info != NULL){
    						$point = $info[0]->point + $point;
    					 }
    
    					 $data_point = array("point" => $point);
    					 $this->retrieve->update("registration",$data_point,$where);
    
    					 $text = "Your orders have been sucessfully received. Your order no is " . $order_no . ". Thank you. Regards: ovoybd.com";
    				 }else{
    					 $reg_data["point"] =  $point;
    					 $this->retrieve->add('registration', $reg_data);
    					 $text = "Your orders have been sucessfully received. Your order no is " . $order_no . " and Password is ". $password ." Thank you. Regards: ovoybd.com";
    				 }
    
    				$message = send_sms($_POST['mobile'], $text);
    				$insert = array(
    	             	'delivery_date'     => date('Y-m-d'),
    	             	'delivery_time'     => date('H:i:s'),
    	             	'mobile'            => $_POST['mobile'],
    	             	'message'           => $text,
    	             	'total_characters'  => strlen($text),
    	             	'total_messages'    => 1,
    	             	'delivery_report'   => $message
    	            );
    	            $this->retrieve->add('sms_record', $insert);
    
    
    
    	            //send sms to admin
        			//$admin_mobile = json_decode($this->data["meta"]->footer,true)['admin_mobile'];
        			//echo $this->data['admin_mobile'];
        			
    				$content = "You have got an order. Order no is " . $order_no;
    				$message = send_sms($this->data['admin_mobile'], $content);
    				
    				$insert = array(
    	             	'delivery_date'     => date('Y-m-d'),
    	             	'delivery_time'     => date('H:i:s'),
    	             	'mobile'            => $this->data['admin_mobile'],
    	             	'message'           => $content,
    	             	'total_characters'  => strlen($content),
    	             	'total_messages'    => 1,
    	             	'delivery_report'   => $message
    	              );
    	              //print_r($insert);
    	              $this->retrieve->add('sms_record', $insert);
              }
                $order_proccess = "1";
		    }
		    else{
		        $this->data['confirmtion'] = "Your order has not complated! , Please try again...";
		        $order_proccess = "0";
		    }
		    
			$this->session->set_flashdata('confirmation', $this->data['confirmtion']);
			$this->session->set_flashdata('complete', $order_proccess);
			redirect('frontend/home', 'refresh');
		}
		
		*/


		private function calculatePoint($amount = NULL){
			$point = 0;
			$rate = $this->action->read("point_value");
			$rate = ($rate) ? $rate[0]->point : 0.00;
			$point = ($rate * $amount)/100;
			return $point;
		}



		public function about() {
			$this->data['meta_title'] = 'About';


			$this->data['aboutInfo'] = $this->action->read('page', array('page' => 'about_us'),'DESC');
			$this->load->view('frontend/include/header', $this->data);
			$this->load->view('frontend/include/navbar', $this->data);
			$this->load->view('frontend/include/order_modal', $this->data);
			$this->load->view('frontend/about', $this->data);
			$this->load->view('frontend/include/footer', $this->data);
		}

		public function contact() {
			$this->data['meta_title'] = 'Contact';


			$this->load->view('frontend/include/header', $this->data);
			$this->load->view('frontend/include/navbar', $this->data);
			$this->load->view('frontend/include/order_modal', $this->data);
			$this->load->view('frontend/contact', $this->data);
			$this->load->view('frontend/include/footer', $this->data);
		}
		public function returns() {
			$this->data['meta_title'] = 'return';

			// Get Returns Information
			$this->data['returnInfo'] = $this->action->read('page', array('page' => 'returns'),'DESC');
			$this->load->view('frontend/include/header', $this->data);
			$this->load->view('frontend/include/navbar', $this->data);
			$this->load->view('frontend/include/order_modal', $this->data);
			$this->load->view('frontend/return', $this->data);
			$this->load->view('frontend/include/footer', $this->data);
		}
		public function delivery() {
			$this->data['meta_title'] = 'return';

			// Get Returns Information
			$this->data['deliveryInfo'] = $this->action->read('page', array('page' => 'delivery'),'DESC');

			$this->load->view('frontend/include/header', $this->data);
			$this->load->view('frontend/include/navbar', $this->data);
			$this->load->view('frontend/include/order_modal', $this->data);
			$this->load->view('frontend/delivery', $this->data);
			$this->load->view('frontend/include/footer', $this->data);
		}
	    public function faq() {
			$this->data['meta_title'] = 'return';

			// Get Returns Information
			$this->data['faqInfo'] = $this->action->read('page', array('page' => 'faq'),'DESC');
			$this->load->view('frontend/include/header', $this->data);
			$this->load->view('frontend/include/navbar', $this->data);
			$this->load->view('frontend/include/order_modal', $this->data);
			$this->load->view('frontend/faq', $this->data);
			$this->load->view('frontend/include/footer', $this->data);
		}
		public function pp() {
			$this->data['meta_title'] = 'return';

			// Get Returns Information
			$this->data['ppInfo'] = $this->action->read('page', array('page' => 'privacy_policy'),'DESC');

			$this->load->view('frontend/include/header', $this->data);
			$this->load->view('frontend/include/navbar', $this->data);
			$this->load->view('frontend/include/order_modal', $this->data);
			$this->load->view('frontend/pp', $this->data);
			$this->load->view('frontend/include/footer', $this->data);
		}

		public function order() {
			$this->data['meta_title'] = 'return';

			// Get Returns Information
			$this->data['orderInfo'] = $this->action->read('page', array('page' => 'order'),'DESC');

			$this->load->view('frontend/include/header', $this->data);
			$this->load->view('frontend/include/navbar', $this->data);
			$this->load->view('frontend/include/order_modal', $this->data);
			$this->load->view('frontend/order', $this->data);
			$this->load->view('frontend/include/footer', $this->data);
		}


		public function page($page) {
			$this->data['meta_title'] = 'page';
			$where=array('page_page'=>$page);
			$this->data['page_data']=$this->retrieve->read("pages",$where);

			$this->load->view('single-page', $this->data);
		}
		
		
		public function pages($page) {
			$this->data['meta_title'] = 'page';
			$where=array('page'=>$page);
			$this->data['page_data']=$this->retrieve->read("page",$where);
            
            $this->load->view('frontend/include/header', $this->data);
			$this->load->view('frontend/include/navbar', $this->data);
			$this->load->view('frontend/include/order_modal', $this->data);
			$this->load->view('frontend/pages', $this->data);
			$this->load->view('frontend/include/footer', $this->data);
		}


		public function test() {
	        $this->data['meta_title'] = 'home';

			$this->load->view('frontend/include/header', $this->data);
			$this->load->view('frontend/include/navbar', $this->data);
			$this->load->view('frontend/include/order_modal', $this->data);
			$this->load->view('frontend/include/order_modal', $this->data);
			$this->load->view('frontend/include/test', $this->data);
			$this->load->view('frontend/include/footer', $this->data);
	    }
	    
	    public function review(){
	        if($_POST){
	            $data         = $_POST;
	            $data['date'] = date('Y-m-d');
	            save('product_review', $_POST);
	            
	            $options = array(
				   "title"  => "success",
				   "emit"   => "Your Review Successfully Archived. Thank You For This Review",
				   "btn"    => true
			   );
			   
                $this->session->set_flashdata('confirmation', message('success', $options));
               
	            redirect("frontend/home/products_details/{$_POST['product_id']}", "refresh");
	        }
	    }

	}
