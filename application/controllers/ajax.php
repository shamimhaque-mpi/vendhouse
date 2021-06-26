<?php

class Ajax extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('action');
    }

    public function retrieveBy($table) {
        $receive = filter_input(INPUT_POST, 'condition');
        $condition = json_decode($receive, TRUE); // json object to array

        $result = $this->action->read($table, $condition);
        echo json_encode($result);
    }

    public function deleteInfo($table) {
        // for database
        $receiveCond = filter_input(INPUT_POST, 'condition');
        $condArray = json_decode($receiveCond, TRUE); // json object to array

        // delete from database
        $confirm = $this->action->deleteData($table, $condArray);
        // show message
        echo $this->data[$confirm];
    }

    public function deleteWithFile($table) {
        // for database
        $receiveCond = filter_input(INPUT_POST, 'condition');
        $condArray = json_decode($receiveCond, TRUE); // json object to array
        // for files
        $receiveFile = filter_input(INPUT_POST, 'file');

        //check file exists or not
        if( !empty($receiveFile) ){
            $fileArray = explode(',', $receiveFile); // create an array
            // delete file from dir
            for($i=0;$i<count($fileArray);$i++){
                $path = './public/attachment/'.$fileArray[$i];
                unlink($path);
            }
        }

        // delete from database
        $confirm = $this->action->deleteData($table, $condArray);
        // show message
        echo $this->data[$confirm];
    }










    public function readJoinData(){
        // get the incoming object
        $content = file_get_contents("php://input");

        // convart object to array
        $receive = json_decode($content, true);

        // take table name from the array
        $form = $receive['from'];
        $join = $receive['join'];

        // take the condition
        $joinCond = $receive['cond'];

        // check and set where condition exists or not
        $where = array();
        if(array_key_exists('where', $receive)){
            foreach ($receive['where'] as $key => $val) {
                if($val != ""){
                    $where[$key] = $val;
                }
            }
        }

        // get information from database
        $result = $this->action->joinAndRead($form, $join, $joinCond, $where);

        // convart the information array to JSON string
        echo json_encode($result);
    }

    //join two table with group by
     public function readJoinGroupByData(){
        // get the incoming object
        $content = file_get_contents("php://input");

        // convart object to array
        $receive = json_decode($content, true);

        // take table name from the array
        $form = $receive['from'];
        $join = $receive['join'];
        $groupBy = $receive['group_by'];

        // take the condition
        $joinCond = $receive['cond'];

        // check and set where condition exists or not
        $where = array();
        if(array_key_exists('where', $receive)){
            foreach ($receive['where'] as $key => $val) {
                if($val != ""){
                    $where[$key] = $val;
                }
            }
        }

        // get information from database
        $result = $this->action->join_Read_GroupBy($form, $join, $joinCond, $where,$groupBy);

        // convart the information array to JSON string
        echo json_encode($result);
    }


    public function readJoinDataFromMultipleTable(){
        // get the incoming object
        $content = file_get_contents("php://input");

        // convart object to array
        $receive = json_decode($content, true);

        // take table name from the array
        $form = $receive['from'];
        $join = $receive['join'];

        // check and set where condition exists or not
        $where = array();
        if(array_key_exists('where', $receive)){
            foreach ($receive['where'] as $key => $val) {
                if($val != ""){
                    $where[$key] = $val;
                }
            }
        }

        // get information from databas
        $result = $this->action->multipleJoinAndRead($form, $join, $where);

        // convart the information array to JSON string
        echo json_encode($result);
    }


    // all new functions
    public function read(){
        // get the incoming object
        $content = file_get_contents("php://input");

        // convart object to array
        $receive = json_decode($content, true);

        // take table name from the array
        $table = $receive['table'];

        // set a default condition
        $condition = array();

        // check the condition exists into the array
        if(array_key_exists('cond', $receive)){
            $condition = $receive['cond'];
        }

        // get information from database
        $result = $this->action->read($table, $condition);

        // convart the information array to JSON string
        echo json_encode($result);
    }

    public function readDistinct(){
        // get the incoming object
        $content = file_get_contents("php://input");
        // convart object to array
        $receive = json_decode($content, true);
        // take table name from the array
        $table = $receive['table'];
        // set a default condition
        $condition = array();
        // check the condition exists into the array
        if(array_key_exists('cond', $receive)){
            $condition = $receive['cond'];
        }
        // get information from database
        $result = $this->action->read_distinct($table, $condition, $receive['column']);

        // convart the information array to JSON string
        echo json_encode($result);
    }
    
    
    
        
    public function readGroupBy(){
        // get the incoming object
        $content = file_get_contents("php://input");
        // convart object to array
        $receive = json_decode($content, true);
        // take table name from the array
        $table = $receive['table'];
        $column = $receive['column'];
        // set a default condition
        $condition = array();
        // check the condition exists into the array
        if(array_key_exists('cond', $receive)){
            $condition = $receive['cond'];
        }
        // get information from database
        $result = $this->action->readGroupBy($table, $column,$condition);

        // convart the information array to JSON string
        echo json_encode($result);
    }


    public function delete(){
        // get the incoming object
        $content = file_get_contents("php://input");

        // convart object to array
        $receive = json_decode($content, true);

        // take table name from the array
        $table = $receive['table'];

        // set a default condition
        $condition = array();

        // check the condition exists into the array
        if(array_key_exists('cond', $receive)){
            $condition = $receive['cond'];
        }

        // check and delete file from folder
        if(array_key_exists('file', $receive)){
            if($receive['file'] == true){
                // get information from database
                $result = $this->action->read($table, $condition);
                $this->deleteFile($result[0]->path);
            }
        }

        // delete from database
        $confirm = $this->action->deleteData($table, $condition);

        // show message
        echo $confirm;
    }

    public function deleteFileJS(){
        // get the incoming object
        $content = file_get_contents("php://input");

        // convart object to array
        $receive = json_decode($content, true);

        // call the deleteFile function
        $this->deleteFile($receive);
    }

    public function deleteFile($files=array()) {
        foreach($files as $key => $file) {
            $path = './'.$file;
            unlink($path);
        }
    }

    public function save(){
        $result = null;

        // get the incoming object
        $content = file_get_contents("php://input");

        // convart object to array
        $receive = json_decode($content, true);

        // take table name from the array
        $table = $receive['table'];

        // take data from the array
        $data = $receive['data'];

        // set a default condition
        $condition = array();

        // check the condition exists into the array
        if(array_key_exists('cond', $receive)){
            $condition = $receive['cond'];
            $result = $this->action->update($table, $data, $condition);
        } else {
            $result = $this->action->add($table, $data);
        }

        // convart the information array to JSON string
        echo $result;
    }

    public function memberId(){
        // get the incoming object
        $content = file_get_contents("php://input");

        // convart object to array
        $receive = json_decode($content, true);
        $branch = $receive["branch"];
        $team = $receive["team"];

        // get id no
        $memberId = memberId('members', $branch, $team);
        echo $memberId;
    }

    public function calculateAge(){
        echo age($_POST["dob"]);
    }

    public function getTransactionDescription(){
        // get the incoming object
        $content = file_get_contents("php://input");

        // convart object to array
        $receive = json_decode($content, true);
        $key = $receive["key"];

        echo json_encode(config_item($key));
    }
    
    public function status_change(){
        
        $result = null;

        // get the incoming object
        $content = file_get_contents("php://input");

        // convart object to array
        $receive = json_decode($content, true);

        // take table name from the array
        $table = $receive['table'];

        // take data from the array
        $data = $receive['data'];

        // set a default condition
        $condition = array();

        // check the condition exists into the array
        $message = false;
        $content = '';
        $num     = '';
        if(array_key_exists('cond', $receive)){
            $condition = $receive['cond'];
            $result = $this->action->read('orders', $condition);
            $num    = ($result ? $result[0]->mobile : false);
            
            if(isset($data['status']) && $data['status'] == "received"){
                $content = "Your order has been successfully received";
                $message = send_sms($num, $content); 
            }
            else if(isset($data['status']) && $data['status'] == "on_the_way"){
                $content = "Your Product Is On The Way..";
                $message = send_sms($num, $content); 
            }
            else if(isset($data['status']) && $data['status'] == "delivered"){
                $content = "Your Product Is Delivered Naw..";
                $message = send_sms($num, $content); 
            }
             		
            $insert = array(
             	'delivery_date'     => date('Y-m-d'),
             	'delivery_time'     => date('H:i:s'),
             	'mobile'            => $num,
             	'message'           => $content,
             	'total_characters'  => strlen($content),
             	'total_messages'    => 1,
             	'delivery_report'   => $message
            );
            $this->action->add('sms_record', $insert);
            
            $result = $this->action->update('orders', $data, $condition);
        }

        // convart the information array to JSON string
        echo $result;
        
    }
    
    public function removeProductImg(){
        if(isset($_POST['path']) && isset($_POST['product_id'])){
            if(file_exists('public/upload/product/thumbnail/'.$_POST['path'])){
                unlink('public/upload/product/thumbnail/'.$_POST['path']);
                unlink('public/upload/product/medium/'.$_POST['path']);
                unlink('public/upload/product/medium_large/'.$_POST['path']);
                unlink('public/upload/product/large/'.$_POST['path']);
            }
            $product = read('products', ['id'=>$_POST['product_id']]);
            if($product){
                $images = json_decode($product[0]->gallery_images, true);
                $gallery = [];
                foreach($images as $value){
                    if($value!='' && $value!=$_POST['path']){
                        $gallery[] = $value;
                    }
                }
                update('products', ['gallery_images'=>json_encode($gallery)], ['id'=>$_POST['product_id']]);
                echo 1;
            }
        }
    }

}
