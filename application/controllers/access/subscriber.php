<?php
class Subscriber extends Subscriber_Controller {

    function __construct(){
        parent::__construct();
        
        $this->load->model('action');
        $this->load->model('Subscriber_m');
        $this->load->helper('form');
        $this->load->helper('custom');
        $this->load->helper('msg');
        $this->load->model('action');
        $this->data['coupon'] = $this->action->read("coupon");
        
        $meta = $this->retrieve->read("site_meta");
        $meta_info=[];
        foreach ($meta as $meta_value) {
            $meta_info[$meta_value->meta_key] = $meta_value->meta_value;
        }
        $meta_data = (object) $meta_info;
        $this->data["meta"] = $meta_data;
    }

    public function login_form(){
        $this->data['meta_title'] = 'User Login';
        $this->isLogin();
        
        
        $this->load->view('frontend/include/header', $this->data);
        $this->load->view('frontend/include/navbar', $this->data);
		$this->load->view('frontend/include/order_modal', $this->data);
        $this->load->view('subscriber/login', $this->data);
        $this->load->view('frontend/include/footer', $this->data);
    }

    public function signup_form(){
        $this->data['meta_title'] = 'User Login';
        $this->isLogin();
        
        $this->load->view('frontend/include/header', $this->data);
        $this->load->view('frontend/include/navbar', $this->data);
        $this->load->view('subscriber/signup', $this->data);
        $this->load->view('frontend/include/footer', $this->data);
    }

    public function login(){
        $content = file_get_contents("php://input");
        $receive = json_decode($content, true);

        $access = [
            'mobile'    => $receive['mobile'],    
            'password'  => $receive['password'],    
        ];
        
        $user = read('registration', $access);
        
        if($user){
            $code    = rand(111111, 999999);
            $content = "Your OTP Code is {$code}\nVendhouse.com";
            
            $message = send_sms($user[0]->mobile, $content);
            $insert  = array(
             	'delivery_date'     => date('Y-m-d'),
             	'delivery_time'     => date('H:i:s'),
                'message'           => $content,
             	'mobile'            => $user[0]->mobile,
             	'delivery_report'   => $message
            );
            $this->action->add('sms_record', $insert);
            
            echo $code;
        }else {
            echo "denied";
        }
            
    }
    
    public function codeVerify(){
        $content = file_get_contents("php://input");
        $receive = json_decode($content, true);
        
        if($this->Subscriber_m->login($receive['mobile'], $receive['password']) == TRUE) {
            echo "subscriber/dashboard";
        }
        else {
            echo "error";
        }
    }

    protected function isLogin(){
        if($this->session->userdata('srLoggedin')==1 || $this->session->userdata('subscriberLoggedin') == 1){
            redirect('/');
        }
    }

    public function logout() {
        $this->subscriber_m->logout();
        redirect('/');
    }
    
    public function reset_password()
    {
        if($_POST){ 
            $this->resetCode($_POST);
        }else{
            $this->data['meta_title'] = 'Reset Password';
            
            $this->load->view('frontend/include/header', $this->data);
            $this->load->view('frontend/include/navbar', $this->data);
    		$this->load->view('frontend/include/order_modal', $this->data);
            $this->load->view('subscriber/reset_password', $this->data);
            $this->load->view('frontend/include/footer', $this->data);
        }
    }
    
    private function resetCode($request){
        if(isset($request['mobile']) && isset($request['password'])){
            $user = get_result('registration', ['mobile'=>$request['mobile']]);
            if($user){
                save_data('registration', ['password'=>$request['password']] ,['mobile'=>$request['mobile']]);
                echo 'success';
            }
        }
        else if(isset($request['code']) && isset($request['mobile'])){
            $user = get_result('registration', ['mobile'=>$request['mobile']]);
            if($user){
                $reset_code = get_result('reset_code', ['user_id'=>$user[0]->id, 'status'=>'unused']);
                if($reset_code && $reset_code[0]->code==$request['code']){
                    echo "password";
                }else{
                    echo "Invalid Code, Please Try Again";
                }
            }
        }
        else if(isset($request['mobile'])){
            $user = get_result('registration', ['mobile'=>$request['mobile']]);
            if($user){
                $code = rand(111111,999999);
                $reset_code = get_result('reset_code', ['user_id'=>$user[0]->id]);
                if(!$reset_code){
                    save_data('reset_code', [
                        'user_id'=> $user[0]->id,
                        'code'   => $code,
                        'status' => 'unused',
                        'date'   => date('Y-m-d')
                    ]);
                }else{
                    save_data('reset_code', [
                        'user_id'=> $user[0]->id,
                        'code'   => $code,
                        'status' => 'unused',
                        'date'   => date('Y-m-d')
                    ], ['user_id'=> $user[0]->id]);
                }
                sms($user[0]->mobile, "Your Reset Code Is {$code} \nRegards, vendhouse.com.bd");
                echo "code";
            }else
                echo "Mobile No Is Not Valide!!!";
        }
        else
            echo 'Something is Wrog!!!';
    }
}
