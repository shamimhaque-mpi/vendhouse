<?php

class Action extends Lab_Model {

    function __construct() {
        parent::__construct();
    }

    // for custom helper
    public function maxId($table) {
        $sql = "SELECT id AS maxId FROM $table ORDER BY id DESC LIMIT 1";

        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result();
        }
        return 0;
    }

    public function max_value($table, $column, $where = array()) {
        $this->db->select_max($column);
        $this->db->where($where);

        $result = $this->db->get($table)->row();

        return $result->$column;
    }


    public function get_max_value($table,$column,$length){
        $sql = "SELECT max(code) as last_code FROM $table WHERE length($column)='$length' " ;
        $query = $this->db->query($sql);
        return $query->result();
    }


    // for custom helper
    public function forIdGenerator($table) {
        $this->_table_name = $table;
        $this->_order_type = 'desc';
        $this->_limit = '1';

        return $this->retrieve();
    }

    // retrieve unic value from database
    public function read_distinct($table, $where = array(), $column) {
        $this->db->distinct();
        $this->db->select($column);
        $this->db->where($where);

        return $this->db->get($table)->result();
    }

    public function read_sum($table, $column, $where=array()){
        $this->db->select_sum($column);
        $this->db->where($where);
        $result = $this->db->get($table);
        return $result->result();
    }

    // check existance
    public function exists($table, $where) {
        return $this->existance($table, $where);
    }

    // save into database
    public function add($table, $data) {
        $this->_table_name = $table;
        return $this->save($data);
    }

    // update into database
    public function update($table, $data, $where) {
        $this->_table_name = $table;
        return $this->save($data, $where);
    }

    // retrieve from database
    public function read($table, $where = array(), $by="asc") {
        $this->_table_name = $table;
        $this->_order_type = $by;

        if(count($where) > 0){
            return $this->retrieve_by($where);
        } else {
            return $this->retrieve();
        }
    }

    public function read_limit_rang($table, $where = array(), $orderBy="id", $sort="asc", $limit,$offset) {
        $this->db->select('*');
        $this->db->order_by($orderBy, $sort);
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $result = $this->db->get($table);
        return $result->result();
    }

    public function read_limit_rand($table, $where = array(), $orderBy="RAND()", $limit="1") {
        $this->db->select('*');
        $this->db->order_by($orderBy);
        $this->db->where($where);
        $this->db->limit($limit);
        $result = $this->db->get($table);
        return $result->result();
    }

	public function read_col($table,$col = "*", $where=array(),$type='asc',$field='id'){
		$this->db->select($col);
		$this->db->where($where);
		$this->db->order_by($field,$type);
		$query=$this->db->get($table);
		return $query->result();
	}

    public function readOrderby($table,$order_by,$where=array(),$sort='asc'){
        $this->db->order_by($order_by,$sort);
        $this->db->where($where);
        $query = $this->db->get($table);

        return $query->result();
    }

    public function read_limit($table, $where = array(), $by="asc",$limit) {
        $this->_table_name = $table;
        $this->_order_type = $by;
        if (isset($limit)) {
            $this->_limit = $limit;
        }

        if(count($where) > 0){
            return $this->retrieve_by($where);
        } else {
            return $this->retrieve();
        }
    }

    public function readGroupBy($table, $groupBy, $where=array(), $orderBy="id", $sort="desc"){
        $this->db->select('*');
        $this->db->group_by($groupBy);
        $this->db->order_by($orderBy, $sort);
        $this->db->where($where);
        $result = $this->db->get($table);

        return $result->result();
    }

	// retrieve from database using two table
    public function joinAndRead($from, $join, $joinCond, $where=array()){
        $this->db->select('*');
        $this->db->from($from);
        $this->db->join($join, $joinCond);
        $this->db->where($where);

        $query = $this->db->get();

		return $query->result();
    }

        // retrieve from database using two table with group by
    public function join_Read_GroupBy($from, $join,$joinCond, $where=array(),$groupBy){
        $this->db->select('*');
        $this->db->from($from);
        $this->db->join($join, $joinCond);
        $this->db->group_by($groupBy);
        $this->db->where($where);

        $query = $this->db->get();

        return $query->result();
    }

    // retrieve from database using multiple table
    public function multipleJoinAndRead($from, $details=array(), $where=array()){
        $this->db->select('*');
        $this->db->from($from);

        // check type exists or not
        foreach ($details as $key => $val) {
            if(array_key_exists("type", $val)){
                $this->db->join($key, $val["condition"], $val["type"]);
            } else {
                $this->db->join($key, $val["condition"]);
            }
        }

        // appling condition
        $this->db->where($where);
        // get the result set
        $query = $this->db->get();


        // return the set
        return $query->result();
    }
    
    // retrieve from database using two table
    public function joinAndReadPurchase($from, $join, $joinCond, $where=array(),$orderbye="id", $ordertype="asc"){
        $this->db->select('*');
        $this->db->from($from);
        $this->db->join($join, $joinCond);
        $this->db->order_by($orderbye, $ordertype);
        $this->db->where($where);

        $query = $this->db->get();

        return $query->result();
    }

    public function searchTransaction($table) {
        $bank= $this->input->post('bank_name');
        $account= $this->input->post('account_no');
        $fromDate= $this->input->post('date_from');
        $toDate= $this->input->post('date_to');

        $sql = "SELECT * FROM $table WHERE bank='$bank' AND account_number='$account' AND transaction_date BETWEEN   '$fromDate' AND  '$toDate' ";

		$query = $this->db->query($sql);
		return $query->result();
    }

	public function searchCost($table){
        $fromDate= $this->input->post('date_from');
        $toDate= $this->input->post('date_to');

        $sql = "SELECT * FROM $table WHERE  datetime BETWEEN   '$fromDate' AND  '$toDate' order by datetime asc";

		$query = $this->db->query($sql);
		return $query->result();
    }

	// retrieve from database
    public function show($table){
        $this->_table_name = $table;
		$this->_limit = '10';
        $this->_order_type = 'desc';
        return $this->retrieve();
    }

	// retrieve from database
    public function showbyDesc($table){
        $this->_table_name = $table;
        $this->_order_type = 'desc';
        return $this->retrieve();
    }

    // delete information from table
    public function deleteData($table, $where) {
        $this->_table_name = $table;

        if($this->delete($where)){
            return 'danger';
        }
    }

	public function getAllItems($table) {
        return $this->db->distinct('account_number')->from($table)->get()->result();
    }// for distinct value


    public function retrieve_cond($table, $where = array(), $order = 'asc') {
        $this->db->where($where);
        $this->db->order_by("id", $order);
        $query = $this->db->get($table);

        if($query->num_rows() > 0){
            return $query->result();
        } else {
            return FALSE;
        }
    }

    // retrieve from database
    public function readDistinct($table, $field_name){
        $sql = "select distinct $field_name from $table";
        $query = $this->db->query($sql);
        return $query->result();
    }

	// retrieve from database
    public function stock_amount($where){
        $this->db->select("sum(`purchase_price`*`quantity`) as stock_amount FROM `stock`");
        $this->db->where($where);
        $result = $this->db->get();
        return $result->result();
    }

    public function read_leftJoin($leftTable,$leftField,$rightTable,$rightField){
        $sql= "select * from $leftTable LEFT JOIN users ON $leftTable.$leftField=$rightTable.$rightField";
        $query=$this->db->query($sql);
        return $query->result();
    }

    public function check_existance($table, $where) {
        return $this->existance($table, $where);
    }

    public function update_profile($info, $where) {
        $this->_table_name = 'users';
        return $this->save($info, $where);
    }

    public function sms_between($table,$fromDate,$toDate) {
        $sql = "SELECT * FROM $table WHERE delivery_date BETWEEN   '$fromDate' AND  '$toDate' ";
        $query = $this->db->query($sql);
        return $query->result();
    }

        // retrieve from database
    public function attendance_DISTINCT($session,$class,$shift,$section,$group){
        $sql = "SELECT DISTINCT attendance_roll,attendance_class,attendance_section,attendance_session,attendance_group,attendance_shift FROM attendance where `attendance_session`='$session' and `attendance_class`='$class' and `attendance_shift`='$shift' and `attendance_section`='$section' and `attendance_group`='$group' ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    // Active Product Category Start here
    public function active_category(){
        $sql = "SELECT category FROM `category` WHERE `category` IN (SELECT DISTINCT `product_cat` FROM `products`) ORDER BY `position` ASC";
        $query = $this->db->query($sql);
        return $query->result();
    }
    // Active Product Category End here

    public function sum($table, $column, $where=array()){
        $this->db->select("SUM($column) AS amount", FALSE);
        $this->db->where($where);
        $query = $this->db->get($table);

        return $query->result();
    }

    public function getTodaysInstallment($day, $date){
        $this->db->where('status', 'opened');
        $this->db->where("(installment_day='$day' OR installment_date='$date')", NULL, FALSE);

        $query = $this->db->get('loan');
        return $query->result();
    }

    public function readStock($table,$quantity){
        $sql="select * from $table WHERE (quantity <= '$quantity')";
        $query=$this->db->query($sql);
        return $query->result();
    }

    public function readProductRange($table,$column,$from, $to){
       $sql = "SELECT *
	FROM $table
	WHERE $column BETWEEN $from AND $to";

	$query = $this->db->query($sql);
	return $query->result();
    }

/*
    public function read_leftJoin(){
        $sql= "select * from employee LEFT JOIN users ON employee.employee_mobile=users.mobile where employee_mobile='01735189237' ";
        $query=$this->db->query($sql);
        return $query->result();
    }*/

    //save data into db and return auto increment ID
    public function addAndGetID($table, $data){
       $this->db->insert($table,$data);
       $insert_id = $this->db->insert_id();
       return  $insert_id;
    }


 //get data from db using like

 public function readlike($table = NULL, $name = NULL, $catgegory = NULL){
    $result = array();
        $this->db->select('*');
        $this->db->from($table);
        if($name!=''){
            $this->db->like('product_name', $name);
        }
        if($catgegory){
            $this->db->where('product_cat', $catgegory);
        }
        // $this->db->or_like('subcategory', $subcategory);
        $query = $this->db->get();
        $result = $query->result();
    return $result;
 }

 //read all table from database
 public function readAllTable($database = NULL){
     $sql = "show tables from ".$database;
     $query = $this->db->query($sql);
     $result = $query->result();
     return $result;
 }



}
