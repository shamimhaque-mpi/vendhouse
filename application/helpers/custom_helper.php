<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// genetate tender code
function generator($table, $prefix = '') {
    $code = '';
    // get codeigniter instanse
    $CI = & get_instance();
    // load model
    $CI->load->model('action');
    // use model method
    $val = $CI->action->forIdGenerator($table);

    if(!empty($val)){
        $id = intval($val[0]->id) + 1;
    } else {
        $id = 1;
    }

    if($prefix != ''){
        $code = $prefix.$id;
    } else {
        $code = $id;
    }

    return $code;
}
// genetate invoice no
function generate_invoice($table, $where=array()) {
    $code = '';
    $counter = 1;
    $CI = & get_instance();
    $CI->load->model('action');
    // use model method
    $val = $CI->action->read($table, $where, 'desc');
    
    
   if($val != null){
        $counter =  count($val) + 1; //intval($val[0]->id) + 1;
    }

    if(strlen($counter) == 1) {
        $counter ='0000' . $counter;
    } elseif(strlen($counter) == 2) {
        $counter ='000' . $counter;
    } elseif(strlen($counter) == 3) {
        $counter ='00' . $counter;
    } elseif(strlen($counter) == 4) {
        $counter ='0' . $counter;
    }else {
         $counter = $counter;
    }

    $code = $counter;
    return $code;
}
// genetate tender code
function generateUniqueId($table) {
    $code = '';
    $counter = 1;

    // get codeigniter instanse
    $CI = & get_instance();

    // load model
    $CI->load->model('action');

    // use model method
    $val = $CI->action->maxId($table);


    if(is_array($val)){
        $counter = intval($val[0]->maxId) + 1;
    } else {
        $counter = 1;
    }

    if(strlen($counter) == 2) {
        $counter = '00' . $counter;
    } elseif(strlen($counter) == 3) {
        $counter = '0' . $counter;
    } else {
        $counter = '000' . $counter;
    }
    return $counter;
}

// genetate tender code
function memberId($table, $b, $t) {
    $branch = $b;
    $year = date('y');
    $team = $t;
    $id = generateUniqueId($table);

    $memberId = $branch . $year . $team . $id;
    return $memberId;
}

function unique_voucher_id($table,$digit = 4) {
    $code = '';
    $counter = 1;

    // get codeigniter instanse
    $CI = & get_instance();

    // load model
    $CI->load->model('action');

    // use model method
    $val = $CI->action->maxId($table);


    if(is_array($val)){
        $counter = intval($val[0]->maxId) + 1;
    } else {
        $counter = 1;
    }
    $counter = str_pad($counter,$digit,0,STR_PAD_LEFT);
    return $counter;
}

// Generate supplier code
//
function supplierUniqueId($table) {
    $counter = 1;

    $CI = & get_instance();
    $CI->load->model('action');

    // use model method
    $length = 3;
    $sql = $CI->action->get_max_value($table,"code",$length);
    $val = $sql[0]->last_code;

    if($val!=null){

        $counter =$val+1;
    }
    $counter =str_pad($counter,3,0, STR_PAD_LEFT);
    return $counter;

}

function f_number($data){
    return number_format($data, 2);
}

// genetate SR unique ID
function srUniqueId($table) {
    $counter = 1;

    $CI = & get_instance();
    $CI->load->model('action');

    $length = 4;
    $sql = $CI->action->get_max_value($table,"code",$length);
    $val = $sql[0]->last_code;

    // use model method

    if($val!=null){
        $counter =$val+1;
    }

    $counter =str_pad($counter,4,0, STR_PAD_LEFT);
    return $counter;
}


// genetate voucher no
function generate_voucher($table, $where=array(), $prefix = '') {
    $code = '';
    $counter = 1;

    // get codeigniter instanse
    $CI = & get_instance();

    // load model
    $CI->load->model('action');

    // use model method
    $val = $CI->action->read($table, $where, 'desc');

    if($val != null){
        $counter = intval($val[0]->id) + 1;
    }

    if(strlen($counter) == 1) {
        $counter ='000' . $counter;
     }elseif(strlen($counter) == 2) {
        $counter ='00'.$counter;
     }elseif(strlen($counter) == 3) {
        $counter ='0'.$counter;
     }else {
         $counter =$counter;
    }

    $code = date('y') . date('m') . date('d') . $prefix . $counter;
    return $code;
}

function age($date){
    list($year, $month, $day) = explode("-", $date);

    $doy = date('Y') - $year;
    $dom = date('m') - $month;
    $dod = date('d') - $day;

    if($dod < 0 || $dom < 0) $doy--;

    return $doy;
}

// Limited Word Print For En & Bn
function crop($x, $len=150) {
    $str    = substr($x , 0, $len);
    $string =  (substr($str, 0, strripos($str, ' ')));
    return (strlen($x) > $len ? $string.'...' : $string);
}
/*
// set default CRUD message
function message($type, $emit = '<p>Undefine warning ! Error not detected.</p>') {
    $message = '';

    switch ($type) {
        case 'success':
            $message = '<div class="alert alert-info" style="margin-top:15px;">'
            . '<h3><i class="fa fa-check-circle"></i> Success message</h3>'
            . '<p>Data saved successfully completed ! Message confirm.</p>'
            . '</div>';

            break;
        case 'update':
            $message = '<div class="alert alert-success" style="margin-top:15px;">'
            . '<h3><i class="fa fa-pencil-square-o"></i> Update message</h3>'
            . '<p>Data update successfully completed ! Message confirm.</p>'
            . '</div>';

            break;
        case 'delete':
            $message = '<div class="alert alert-danger" style="margin-top:15px;">'
            . '<h3><i class="fa fa-times-circle"></i> Delete message</h3>'
            . '<p>Data remove successfully completed ! Message confirm.</p>'
            . '</div>';

            break;
        case 'warning':
            $message = '<div class="alert alert-warning" style="margin-top:15px;">'
            . '<h3><i class="fa fa-exclamation-triangle"></i> Warning message</h3>'
            . $emit
            . '</div>';

            break;

			 case 'warning_login':
             $message = $emit;

            break;
        case 'operation':
            $message = '<div class="alert alert-primary" style="margin-top:15px;">'
            . '<h3><i class="fa fa-certificate"></i> Operation confirmation</h3>'
            . $emit
            . '</div>';

            break;
        default:
            $message = '<div class="alert alert-primary" style="margin-top:15px;">'
            . '<h3><i class="fa fa-bolt"></i> Default message</h3>'
            . '<p>Unknown message confirmation!</p>'
            . '</div>';

            break;
    }

    return $message;
}
*/
/*Maruf hasan's Helper*/
    function custom_fetch($var,$field){
        if (count($var)) {
            return $var[0]->$field;
        }
    }

    function v_check($value){
        if ($value!=null) {
            return $value;
        }else{
            return "N/A";
        }
    }

    function filter($value){
        $capitalize="";
        $rmv_scor=str_replace("_"," ", $value);

        if (mb_detect_encoding($rmv_scor)!='UTF-8') {
            $capitalize=ucwords($rmv_scor);
        }else{
            $capitalize=str_replace("-"," ", $rmv_scor);
        }

        return $capitalize;
    }

	//Function for Dynamic Language Start
	function caption($index){
		$CI = & get_instance();
		// load model
		$CI->load->model('action');
		// use model method
		$val = $CI->action->read('theme_setting');

		$label_lang = config_item('label_lang');


		return $label_lang[$index][$val[0]->language];

	}
	//Function for Dynamic Language End


function message_length($strlength, $message = NULL){
	$messLen = 0;
	
	if (strlen($message) != strlen(utf8_decode($message))) {
        if( $strlength <= 63){ $messLen = 1; }
		else if( $strlength <= 126){ $messLen = 2; }
		else if( $strlength <= 189){ $messLen = 3; }
		else if( $strlength <= 252){ $messLen = 4; }
		else if( $strlength <= 315){ $messLen = 5; }
		else if( $strlength <= 378){ $messLen = 6; }
		else if( $strlength <= 441){ $messLen = 7; }
		else if( $strlength <= 504){ $messLen = 8; }
		else { $messLen = "Equal to an MMS."; }		
        }else{
		if( $strlength <= 160){ $messLen = 1; }
		else if( $strlength <= 306){ $messLen = 2; }
		else if( $strlength <= 459){ $messLen = 3; }
		else if( $strlength <= 612){ $messLen = 4; }
		else if( $strlength <= 765){ $messLen = 5; }
		else if( $strlength <= 918){ $messLen = 6; }
		else if( $strlength <= 1071){ $messLen = 7; }
		else if( $strlength <= 1080){ $messLen = 8; }
		else { $messLen = "Equal to an MMS."; }
		
        }
        
        return $messLen;
	
}


function generateOrderNn($table){
    $today = date("Y.m.d") . ".";
    return uniqid($today);
}


//Privilege Related functions Start here

function ck_menu($menu){
    $CI = & get_instance();
    $CI->load->model('action');
    $privilege = $CI->data["privilege"];
    $user_id = $CI->data["user_id"];

    if($privilege=="super"){
        return true;
    }

    $where = array(
        "privilege_name" => $privilege,
        "user_id" => $user_id
    );

    $data = $CI->action->read("privileges",$where);
    if($data==null){
        return false;
    }

    $access_array = json_decode($data[0]->access,true);
    $access_array = array_keys($access_array);

    if(in_array($menu,$access_array)){
        return true;
        //echo "Matched";
    }
    //return false;
}


function ck_action($menu,$action){
    $CI = & get_instance();
    $CI->load->model('action');
    $privilege = $CI->data["privilege"];

    if($privilege=="super"){
        return true;
    }

    $where = array(
        "user_id" => $CI->data["user_id"]
    );

    $data = $CI->action->read("privileges",$where);
    if($data==null){
        return false;
    }

    $access_array = json_decode($data[0]->access,true);
    //return $access_array;

    if(!array_key_exists($menu,$access_array)){
        return false;
    }

    if(in_array($action,$access_array[$menu])){
        return true;
    }
    return false;
}

function check_stock($code){
    $CI = & get_instance();
    $CI->load->model('retrieve');

    $where = array(
        "code" => $code
    );

    $data = $CI->retrieve->read("stock",$where);

    if($data==null){
        return "empty";
    }

    if($data[0]->quantity < 1){
        return "empty";
    }else if($data[0]->quantity <= 3){
        return "limited";
    }
    return "available";
}

