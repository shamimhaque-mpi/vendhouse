<?php


// Save Data In The Table
if (!function_exists('save')) {
    function save($table, $data=[]){
        $ci =& get_instance();
        if (!empty($table) && !empty($data)) {
            $ci->db->insert($table, $data);
            return $ci->db->insert_id();
        }
        return false;
    }
}
// Save Data In The Table
if (!function_exists('update')) {
    function update($table, $data=[], $where){
        $ci =& get_instance();
        if (!empty($table) && !empty($data)) {
            $ci->db->where($where);
            $ci->db->update($table, $data);
            return true;
        }
        return false;
    }
}

// Read Sigle Table
if (!function_exists('read')) {
    function read($table, $where=[], $select=null, $groupBy=null){
        $ci =& get_instance();
        if (!empty($select)) {
            $ci->db->select($select);
        }
        // get group by
        if (!empty($groupBy)) {
            $ci->db->group_by($groupBy);
        }
        $query = $ci->db->where($where)->get($table);

        return $query->result();
    }
}

// Delete Data From Table
if (!function_exists('remove')) {
    function remove($table, $where=[]) {
        $ci =& get_instance();
        if (!empty($table) && !empty($where)) {
            $ci->db->where($where);
            $ci->db->delete($table);
            return true;
        }
        return false;
    }
}

if(!function_exists('getReview')){
    function getReview($product_id)
    {
        $ci =& get_instance();
        
        return $ci->db->query("
            SELECT 
                products.id as k,
                product_review.date,
                product_review.review,
                registration.name
            FROM 
                products 
            JOIN 
                product_review ON products.id=product_review.product_id
            JOIN
                registration ON product_review.user_id=registration.id
            WHERE 
                products.id={$product_id}
        
        ")->result();
    }
}












