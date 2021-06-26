<?php

class Ajax extends Frontend_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('action');
    }

    public function retrieve($table) {
        $result = $this->action->read($table);
        echo json_encode($result);
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
        $content = file_get_contents('php://input');
        // convart object to array
        $receive = json_decode($content, true);
        // take table name from the array
        $table = $receive['table'];
        // set a default condition
        $condition = array();
        // check the condition exists into the array
        if(is_array($receive) && array_key_exists('cond', $receive)){
            // $condition = $receive['cond'];
            foreach($receive['cond'] as $key => $val){
                if($val != null){
                    $condition[$key] = $val;
                }
            }
        }
        // get information from database
        $result = $this->action->read($table, $condition);
        // convart the information array to JSON string
        echo json_encode($result);
    }
    
    
    
     //table with group by
     public function readGroupByData(){
        // get the incoming object
        $content = file_get_contents("php://input");

        // convart object to array
        $receive = json_decode($content, true);

        // take table name from the array
        $table = $receive['table'];
        $groupBy = $receive['group_by'];

        // check and set where condition exists or not
        $where = array();
        if(array_key_exists('cond', $receive)){
            $where = $receive['cond'];
        }

        $result = $this->action->readGroupBy($table, $groupBy, $where);

        // convart the information array to JSON string
        echo json_encode($result);
    }
    



    public function readlike(){
        $content = file_get_contents('php://input');
        $receive = json_decode($content, true);

        $table = $receive['table'];
        $name       = "";   
        $category   = "";
        
        if(isset($receive['category'])){
            $category    = str_replace(" ","_", $receive['category']);
        }
        if(isset($receive['data'])){
            $name = $receive['data'];
        }
        
        $result = $this->action->readlike($table, $name, $category);
        echo json_encode($result);
    }



    // all new functions
    public function read_limit_rang(){
        // get the incoming object
        $content = file_get_contents('php://input');
        // convart object to array
        $receive = json_decode($content, true);
        // take table name from the array
        $table = $receive['table'];
        $limit = $receive['limit'];
        $offset = $receive['offset'];
        $orderBy="id";
        $sort="asc";
        //set default order type
        if(array_key_exists('sort', $receive)){
            $sort = $receive['sort'];
        }

        //set default order by
        if(array_key_exists('orderBy', $receive)){
            $orderBy = $receive['orderBy'];
        }

        // set a default condition
        $condition = array();
        // check the condition exists into the array
        if(is_array($receive) && array_key_exists('cond', $receive)){
            // $condition = $receive['cond'];
            foreach($receive['cond'] as $key => $val){
                if($val != null){
                    $condition[$key] = $val;
                }
            }
        }
        // get information from database
        $result = $this->action->read_limit_rang($table, $condition, $orderBy, $sort, $limit,$offset);
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
        echo $this->data[$confirm];
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
    public function addToWish(){
        if($_POST && $_POST['user_id']!='' && $_POST['product_id']!=''){
            $item = read('wish_list', $_POST);
            if($item){
                remove('wish_list', $_POST);
                $ids=$this->ids($_POST['user_id']);
                echo json_encode(
                [
                    'type'  =>'remove',
                    'count' =>count($ids),
                    'ids'   =>$ids
                ]);
            }
            else{
                save('wish_list', $_POST);
                $ids=$this->ids($_POST['user_id']);
                echo json_encode(
                [
                    'type'  =>'add',
                    'count' =>count($ids),
                    'ids'   =>$ids
                ]);
            }
        }
    }
    
    public function wishListids(){
        if($_POST && $_POST['user_id']!=''){
            $ids = $this->ids($_POST['user_id']);
            echo json_encode(
                [
                    'type'  =>'all',
                    'count' =>count($ids),
                    'ids'   =>$ids
                ]);
        }
    }
    
    protected function ids($user_id){
        $items = read('wish_list', ['user_id'=>$user_id]);
        $ids = [];
        if($items){
            foreach($items as $item){
                $ids[] = $item->product_id;
            }
        }
        return $ids;
    }
    
    public function removeFromWish(){
        $content = file_get_contents("php://input");
        $receive = json_decode($content, true);
        if(isset($receive['user_id']) && isset($receive['product_id'])){
            remove('wish_list', $receive);
            $result = get_join('wish_list', 'products', 'wish_list.product_id=products.id', ['wish_list.user_id'=>$receive['user_id']]);
            echo json_encode($result);
        }
    }

}
