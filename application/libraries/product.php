<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Frontend_Controller {

	/*function __construct() {
		parent::__construct();
		
	}*/

    public function products()
    {
        
        $data = [];
        
        $allCategory = custom_query("SELECT category FROM category WHERE category IN (SELECT DISTINCT product_cat FROM products) ORDER BY position ASC");
        
        if(!empty($allCategory)){
            
            foreach($allCategory as $c_key =>  $c_value){
                
                
                $data[$c_key]['category'] =  '<h1>'. $c_value->category .'</h1>';
                    	
            }
        }
        
        return $data;
    }
}