<?php

// get dd
if (!function_exists('dd')) {
    function dd($value = null)
    {
        if (!empty($value)) {
            echo '<pre style="color: #fff; background: #000; padding: 10px; border-radius: 4px;">';
            print_r($value);
            die();
            echo '</pre>';
        }
        return false;
    }
}

// get encode
if (!function_exists('get_encode')) {
    function get_encode($value = null, $formate = '')
    {
        if (!empty($value)) {
            if (!empty($formate)) {
                return $formate(base64_encode($value));
            } else {
                return $encode = base64_encode($value);
            }
        }
        return false;
    }
}

// get decode
if (!function_exists('get_decode')) {
    function get_decode($value = null, $formate = '')
    {
        if (!empty($value)) {
            if (!empty($formate)) {
                return base64_decode($formate($value));
            } else {
                return $encode = base64_decode($value);
            }
        }
        return false;
    }
}

// get number formate
if (!function_exists('get_number_format')) {
    function get_number_format($number = null, $decimal = 2)
    {
        if (!empty($number)) {
            return number_format($number, $decimal);
        }
        return 0;
    }
}

// get date format
if (!function_exists('get_date_format')) {
    function get_date_format($date, $format = 'Y-m-d')
    {
        
        if (!empty($date)){
            return date($format, strtotime($date));
        }
        return false;
    }
}

// get date deferance
//////////////////////////////////////////////////////////////////////
//PARA: Date Should In YYYY-MM-DD Format
//RESULT FORMAT:
// '%y Year %m Month %d Day %h Hours %i Minute %s Seconds'      =>  1 Year 3 Month 14 Day 11 Hours 49 Minute 36 Seconds
// '%y Year %m Month %d Day'                                    =>  1 Year 3 Month 14 Days
// '%m Month %d Day'                                            =>  3 Month 14 Day
// '%d Day %h Hours'                                            =>  14 Day 11 Hours
// '%d Day'                                                     =>  14 Days
// '%h Hours %i Minute %s Seconds'                              =>  11 Hours 49 Minute 36 Seconds
// '%i Minute %s Seconds'                                       =>  49 Minute 36 Seconds
// '%h Hours                                                    =>  11 Hours
// '%a Days                                                     =>  468 Days
//////////////////////////////////////////////////////////////////////
if (!function_exists('date_difference')) {
    function date_difference($date_1, $date_2, $format = '%a')
    {
        if (!empty($date_1) && !empty($date_2)){
            $datetime1 = date_create($date_1);
            $datetime2 = date_create($date_2);

            $interval = date_diff($datetime1, $datetime2);

            return $interval->format($format);
        }
        return false;
    }
}

// get hour deferance
if (!function_exists('hour_difference')) {
    function hour_difference($date_1, $date_2)
    {
        //get main CodeIgniter object
        $ci =& get_instance();

        if (!empty($date_1) && !empty($date_2)) {

            $interval =  $ci->db->query("SELECT TIMESTAMPDIFF(hour, '$date_1', '$date_2') AS hour")->row();
            return $interval->hour;
        }
        return false;
    }
}


// get voucher no
if (!function_exists('get_voucher')) {
    function get_voucher($id, $digite = 6, $prefix = null)
    {
        if (!empty($id)) {
            if (!empty($prefix)) {
                $counter = $prefix . date('y') . date('m') . str_pad($id, $digite, 0, STR_PAD_LEFT);
                return $counter;
            } else {
                $counter = date('y') . date('m') . str_pad($id, $digite, 0, STR_PAD_LEFT);
                return $counter;
            }
        }
        return false;
    }
}


// get code
if (!function_exists('get_code')) {
    function get_code($id, $digite = 4, $prefix = null)
    {
        if (!empty($id)) {
            if (!empty($prefix)) {
                $counter = $prefix . str_pad($id, $digite, 0, STR_PAD_LEFT);
                return $counter;
            } else {
                $counter = str_pad($id, $digite, 0, STR_PAD_LEFT);
                return $counter;
            }
        }
        return false;
    }
}


// get code
if (!function_exists('get_code_table')) {
    function get_code_table($table, $digite = 3, $where = [])
    {
        //get main CodeIgniter object
        $ci =& get_instance();

        //get data from databasea
        if (!empty($table)) {

            if (!empty($where)) {
                $ci->db->where($where);
            }

            $total_row = $ci->db->count_all_results($table);

            $counter = str_pad(++$total_row, $digite, 0, STR_PAD_LEFT);
            return $counter;
        }
        return false;
    }
}

// save data
if (!function_exists('save_data')) {
    function save_data($table, $data = [], $where = [], $action = false)
    {
        //get main CodeIgniter object
        $ci =& get_instance();

        //get data from databasea
        if (!empty($table) && !empty($data)) {
            if (!empty($where)) {
                $ci->db->where($where);
                $ci->db->update($table, $data);
                return true;
            } else {
                if ($action) {
                    $ci->db->insert($table, $data);
                    return $ci->db->insert_id();
                } else {
                    $ci->db->insert($table, $data);
                    return true;
                }
            }
        }
        return false;
    }
}


// delete data
if (!function_exists('delete_data')) {
    function delete_data($table, $where = [])
    {
        //get main CodeIgniter object
        $ci =& get_instance();
        if (!empty($table) && !empty($where)) {
            $ci->db->where($where);
            $ci->db->delete($table);
            return true;
        }
        return false;
    }
}


// convert number
if (!function_exists('convert_number')) {
    function convert_number($input_number, $convert_language = 'en')
    {
        $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

        if ($convert_language == 'bn') {
            return str_replace($en, $bn, $input_number);
        } else {
            return str_replace($bn, $en, $input_number);
        }
        return false;
    }
}


// get row
if (!function_exists('get_row')) {
    function get_row($table, $where = [], $select = null)
    {
        //get main CodeIgniter object
        $ci =& get_instance();

        //get data from databasea
        if (!empty($where)) {

            // get select column
            if (!empty($select)) {
                $ci->db->select($select);
            }

            $query = $ci->db->where($where)->get($table);

            return $query->row();
        }
        return false;
    }
}


// get name
if (!function_exists('get_name')) {
    function get_name($table, $select_column = null, $where = [])
    {
        //get main CodeIgniter object
        $ci =& get_instance();

        //get data from databasea
        if (!empty($table) && !empty($select_column) && !empty($where)) {

            // get select column
            $ci->db->select($select_column);
            $ci->db->where($where);

            $query = $ci->db->get($table);

            if ($query->num_rows() > 0) {
                $result = $query->row();
                return $result->$select_column;
            }

            return false;
        }

        return false;
    }
}


// get all data
if (!function_exists('get_result')) {
    function get_result($table, $where = null, $select = null, $groupBy = null, $order_col = null, $order_by = 'ASC', $limit = null, $limit_offset = null, $where_in = null)
    {
        //get main CodeIgniter object
        $ci =& get_instance();

        if (!empty($table)) {
            // select column
            if (!empty($select)) {
                $ci->db->select($select);
            }

            //get where
            if (!empty($where)) {
                $ci->db->where($where);
            }

            //get where in
            if (!empty($where_in)) {
                if (is_array($where_in)) {
                    foreach ($where_in as $value) {
                        $ci->db->where_in($value[0], $value[1]);
                    }
                }
            }

            // get group by
            if (!empty($groupBy)) {
                $ci->db->group_by($groupBy);
            }

            // order by
            if (!empty($order_col) && !empty($order_by)) {
                $ci->db->order_by($order_col, $order_by);
            }

            // get limit
            if (!empty($limit) && !empty($limit_offset)) {
                $ci->db->limit($limit_offset, $limit);
            } elseif (!empty($limit)) {
                $ci->db->limit($limit);
            }

            // get query
            $query = $ci->db->get($table);
            return $query->result();
        }
        return false;
    }
}


// get join all data
if (!function_exists('get_join')) {
    function get_join($tableFrom, $tableTo, $joinCond, $where = [], $select = null, $groupBy = null, $order_col = null, $order_by = 'desc', $limit = null, $limit_offset = null, $where_in = null)
    {
        //get main CodeIgniter object
        $ci =& get_instance();

        if (!empty($tableFrom) && !empty($tableTo) && !empty($joinCond)) {

            // get all query
            if (!empty($select)) {
                $ci->db->select($select);
            }

            $ci->db->from($tableFrom);

            if (!empty($tableTo) && !empty($joinCond)) {
                if (is_array($tableTo) && is_array($tableTo)) {
                    foreach ($tableTo as $_key => $to_value) {
                        $ci->db->join($to_value, $joinCond[$_key]);
                    }
                } else {
                    $ci->db->join($tableTo, $joinCond);
                }
            }

            // get where
            if (!empty($where)) {
                $ci->db->where($where);
            }

            //get where in
            if (!empty($where_in)) {
                if (is_array($where_in)) {
                    foreach ($where_in as $value) {
                        $ci->db->where_in($value[0], $value[1]);
                    }
                }
            }

            // get group by
            if (!empty($groupBy)) {
                $ci->db->group_by($groupBy);
            }

            // get order by
            if (!empty($order_col) && !empty($order_by)) {
                $ci->db->order_by($order_col, $order_by);
            }

            // get limit
            if (!empty($limit) && !empty($limit_offset)) {
                $ci->db->limit($limit_offset, $limit);
            } elseif (!empty($limit)) {
                $ci->db->limit($limit);
            }

            // get query
            $query = $ci->db->get();
            return $query->result();

        } else {
            return false;
        }
    }
}


// get row join
if (!function_exists('get_row_join')) {
    function get_row_join($tableFrom, $tableTo, $joinCond, $where = [], $select = [])
    {
        //get main CodeIgniter object
        $ci =& get_instance();


        if (!empty($tableFrom) && !empty($tableTo) && !empty($joinCond) && !empty($where)) {

            // get all query
            if (!empty($select)) {
                $ci->db->select($select);
            }

            $ci->db->from($tableFrom);

            if (!empty($tableTo) && !empty($joinCond)) {
                if (is_array($tableTo) && is_array($tableTo)) {
                    foreach ($tableTo as $_key => $to_value) {
                        $ci->db->join($to_value, $joinCond[$_key]);
                    }
                } else {
                    $ci->db->join($tableTo, $joinCond);
                }
            }

            $ci->db->where($where);

            // get query
            $query = $ci->db->get();
            return $query->row();
        }
        return false;
    }
}


// get pagination
if (!function_exists('get_pagination')) {
    function get_pagination($pag_query = [])
    {
        //get main CodeIgniter object
        $CI =& get_instance();

        if (array_key_exists('select', $pag_query)) {
            $CI->db->select($pag_query['select']);
        }

        if (array_key_exists('where', $pag_query)) {
            $CI->db->where($pag_query['where']);
        }

        $search = '';
        if (!empty($_GET)) {
            $CI->db->where($_GET);

            $search .= '?';

            $i     = 1;
            $count = count($_GET);
            foreach ($_GET as $_key => $s_value) {
                if ($count == 1) {
                    $search .= $_key . '=' . $s_value;
                } else {
                    if ($i != $count) {
                        $search .= $_key . '=' . $s_value . '&';
                    } else {
                        $search .= $_key . '=' . $s_value;
                    }
                    $i++;
                }
            }
        }

        $total_row = $CI->db->count_all_results($pag_query['table']);

        if (array_key_exists('per_page', $pag_query)) {
            $per_page = $pag_query['per_page'];
        } else {
            $per_page = 10;
        }

        // pagination config
        $config               = [];
        $config["base_url"]   = base_url() . $pag_query['url'] . '/';
        $config["total_rows"] = $total_row;
        $config["per_page"]   = $per_page;
        $config['suffix']     = $search;

        // initialize pagination
        $CI->pagination->initialize($config);

        $page = ($CI->uri->segment($pag_query['segment'])) ? $CI->uri->segment($pag_query['segment']) : 0;

        $return_data["links"] = $CI->pagination->create_links();


        if (array_key_exists('where', $pag_query)) {
            $CI->db->where($pag_query['where']);
        }

        if (!empty($_GET)) {
            $CI->db->where($_GET);
        }

        $CI->db->limit($per_page, $page);

        $query = $CI->db->get($pag_query['table']);

        if ($query->num_rows() > 0) {
            $return_data['results'] = $query->result();
            return $return_data;
        }

        return false;
    }
}


// get sum
if (!function_exists('get_sum')) {
    function get_sum($table, $column, $where = null, $groupBy = null)
    {
        //get main CodeIgniter object
        $ci =& get_instance();

        //get data from databasea
        if (!empty($where) && $ci->db->field_exists($column, $table)) {
            //get data from databasea
            $ci->db->select_sum($column);
            $ci->db->where($where);
            //get group by
            if (!empty($groupBy)) {
                $ci->db->group_by($groupBy);
            }
            $query = $ci->db->get($table);

            if ($query->num_rows > 0) {
                $result = $query->row();
                return $result->$column;
            } else {
                return 0;
            }
        } else {
            return false;
        }
    }
}


// get join sum
if (!function_exists('get_join_sum')) {
    function get_join_sum($tableFrom, $tableTo, $joinCond, $column, $where = [], $groupBy = null)
    {
        //get main CodeIgniter object
        $ci =& get_instance();

        if (!empty($tableFrom) && !empty($tableTo) && !empty($joinCond) && !empty($column) && !empty($where)) {

            // get all query
            if (!empty($column)) {
                $ci->db->select_sum($column);
            }

            $ci->db->from($tableFrom);

            if (!empty($tableTo) && !empty($joinCond)) {
                if (is_array($tableTo) && is_array($tableTo)) {
                    foreach ($tableTo as $_key => $to_value) {
                        $ci->db->join($to_value, $joinCond[$_key]);
                    }
                } else {
                    $ci->db->join($tableTo, $joinCond);
                }
            }

            $ci->db->where($where);

            //get group by
            if (!empty($groupBy)) {
                $ci->db->group_by($groupBy);
            }

            // get column name
            $column = explode('.', $column);
            if (count($column) > 1) {
                $column = $column[1];
            } else {
                $column = $column;
            }

            // get query
            $query = $ci->db->get();
            if ($query->num_rows > 0) {
                $result = $query->row();
                return $result->$column;
            } else {
                return 0;
            }

        }
        return false;
    }
}


// custom query
if (!function_exists('custom_query')) {
    function custom_query($query = null)
    {
        //get main CodeIgniter object
        $ci =& get_instance();
        //get data from databasea
        if (!empty($query)) {
            $query = $ci->db->query($query);
            return $query->result();
        }
        return false;
    }
}


// get max value
if (!function_exists('get_max')) {
    function get_max($table, $column, $where = [])
    {
        //get main CodeIgniter object
        $ci =& get_instance();

        //get data from databasea
        if (!empty($where) && $ci->db->field_exists($column, $table)) {
            //get data from databasea
            $ci->db->select_max($column);
            $ci->db->where($where);
            $query = $ci->db->get($table);

            if ($query->num_rows() > 0) {
                $result = $query->row();
                return $result->$column;
            } else {
                return 0.00;
            }
        } else {
            return false;
        }
    }
}


// file upload
if (!function_exists('file_upload')) {
    function file_upload($fileName, $dir_path = "public/upload", $file_type = null, $prefix = "img")
    {
        if ($_FILES[$fileName]["name"] != null or $_FILES[$fileName]["name"] != "") {

            // check directory
            if(!is_dir($dir_path)){
                if (!mkdir($dir_path, 0777, true)) {
                    die('Failed to create folders...');
                }
            }

            if (!empty($file_type)) {
                $f_type = $file_type;
            } else {
                $f_type = 'png|jpeg|jpg|gif';
            }
            $config                  = [];
            $config['upload_path']   = './public/' . $dir_path;
            $config['allowed_types'] = $f_type;
            $config['max_size']      = '5120';
            $config['max_width']     = '2560';
            $config['max_height']    = '2045';
            $config['file_name']     = $prefix . '-' . time() . rand();
            $config['overwrite']     = true;

            $ci = &get_instance();
            $ci->upload->initialize($config);

            if ($ci->upload->do_upload($fileName)) {
                $upload_data = $ci->upload->data();

                $filePath = $dir_path . '/' . $upload_data['file_name'];

                return $filePath;
            } else {
                return false;
            }
        }
    }
}

// get resize image
if (!function_exists('resize_image')) {
    function resize_image($input_field_name, $max_width, $max_height, $upload_path = 'public/upload', $index = null, $prefix = null, $time = null)
    {
        if(!empty($_FILES["$input_field_name"]) && !empty($max_width) && !empty($max_width)){
            
            if(!is_dir($upload_path)){
                if (!mkdir($upload_path, 0777, true)) {
                    die('Failed to create folders...');
                }
            }
            
            if(!is_array($_FILES["$input_field_name"]['name'])){
                $filePath = $_FILES["$input_field_name"]["tmp_name"];
                $fileName = strtolower(pathinfo($_FILES["$input_field_name"]["name"], PATHINFO_FILENAME));
                $fileExtension = strtolower(pathinfo($_FILES["$input_field_name"]["name"], PATHINFO_EXTENSION));
            }else{
                $filePath = $_FILES["$input_field_name"]["tmp_name"][$index];
                $fileName = strtolower(pathinfo($_FILES["$input_field_name"]["name"][$index], PATHINFO_FILENAME));
                $fileExtension = strtolower(pathinfo($_FILES["$input_field_name"]["name"][$index], PATHINFO_EXTENSION));
            };
            
            list($orig_width, $orig_height) = getimagesize($filePath);

            $width = $orig_width;
            $height = $orig_height;

            # taller
            if ($height > $max_height) {
                $width = ($max_height / $height) * $width;
                $height = $max_height;
            }

            # wider
            if ($width > $max_width) {
                $height = ($max_width / $width) * $height;
                $width = $max_width;
            }

            // allowed file extension
            $allowedExtension = ['gif', 'jpg', 'jpeg', 'png'];  

            if (!in_array($fileExtension, $allowedExtension)) {
                return false;
            } 
        
            // convert image
            switch ($fileExtension) {
                case 'gif' :
            $image = imageCreateFromGif($filePath);
                break;
                case 'png' :
            $image = imageCreateFromPng($filePath);
                break;
                case 'jpg':
                case 'jpeg':
            $image = imageCreateFromJpeg($filePath);
                break;
            }

            // resize image
            $image_p = imagecreatetruecolor($width, $height);

            imagepalettetotruecolor($image_p);
            imagealphablending($image_p, true);
            imagesavealpha($image_p, true);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);

            // create file name
            $image_name = (!empty($prefix) ? "$prefix-" : "") . clean_text($fileName) .'-'. date('Ymd') . (!empty($time) ? $time : time()) .'.webp';

            // upload file
            imagewebp($image_p, "./$upload_path/$image_name", 50);
            //imagedestroy($image_p);

            return $image_name;
        }

        return false;
    }
}

// clean text
if (!function_exists('clean_text')) {
    function clean_text($string, $replace='-') {
        if(!empty($string)){
            $string = str_replace(' ', $replace, $string);
            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
            return preg_replace('/-+/', '-', $string);
        }

        return false;
    }
}


// get input data
if (!function_exists('input_data')) {
    function input_data($input_name = null)
    {
        if (!empty($input_name)) {
            if (is_array($input_name)) {
                $new_data = [];
                foreach ($input_name as $val) {
                    $new_data[$val] = htmlspecialchars(trim($_POST[$val]));
                }
                return $new_data;
            } else {
                return htmlspecialchars(trim($_POST[$input_name]));
            }
        } else {
            return false;
        }
    }
}

// create slug
if (!function_exists('get_slug')) {
    function get_slug($input_data = null, $replace = '-')
    {
        if (!empty($input_data)) {
            return str_replace(' ', $replace, strtolower($input_data));
        } else {
            return false;
        }
    }
}


// check exists
if (!function_exists('check_exists')) {
    function check_exists($table, $where = [])
    {
        //get main CodeIgniter object
        $ci =& get_instance();

        if (!empty($table) && !empty($where)) {

            $ci->db->where($where);
            $query = $ci->db->get($table);
            if ($query->num_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}


// check null
if (!function_exists('check_null')) {
    function check_null($input_data = null)
    {
        if (!empty($input_data)) {
            return $input_data;
        } else {
            return 'N/A';
        }
    }
}


// get filter
if (!function_exists('get_filter')) {
    function get_filter($input_string = null)
    {
        if (!empty($input_string)) {
            $input_string = str_replace("_", " ", $input_string);
            if (mb_detect_encoding($input_string) != 'UTF-8') {
                $result = ucwords($input_string);
            } else {
                $result = $input_string;
            }

            return $result;
        }
        return false;
    }
}


// get supplier balance
if (!function_exists('get_supplier_balance')) {
    function get_supplier_balance($party_code = '')
    {
        //get main CodeIgniter object
        $ci =& get_instance();

        if (!empty($party_code)) {

            // define default variable
            $debit = $credit = $initial_balance = $balance = 0;

            // get party info
            $party_info = $ci->db->query("SELECT parties.code, parties.name, parties.initial_balance, partytransaction.credit, partytransaction.debit FROM ( SELECT code, name, initial_balance FROM parties WHERE code='$party_code' AND type='supplier' AND trash=0 )parties LEFT JOIN ( SELECT party_code, SUM(credit) AS credit, SUM(debit + remission) AS debit FROM partytransaction WHERE trash=0 GROUP BY party_code )partytransaction ON parties.code=partytransaction.party_code")->row();

            $debit           = (!empty($party_info->debit) ? $party_info->debit : 0);
            $credit          = (!empty($party_info->credit) ? $party_info->credit : 0);
            $initial_balance = (!empty($party_info->initial_balance) ? $party_info->initial_balance : 0);

            // calculate supplier balance
            if ($initial_balance < 0) {
                $balance = $credit - (abs($initial_balance) + $debit);
            } else {
                $balance = ($credit + $initial_balance) - $debit;
            }

            // set data
            $data['code']            = $party_info->code;
            $data['name']            = $party_info->name;
            $data['debit']           = $debit;
            $data['credit']          = $credit;
            $data['balance']         = $balance;
            $data['status']          = ($balance < 0 ? "Payable" : "Receivable");
            $data['initial_balance'] = $initial_balance;

            return $data;
        } else {
            $data['code']            = '';
            $data['name']            = '';
            $data['debit']           = 0;
            $data['credit']          = 0;
            $data['balance']         = 0;
            $data['status']          = "Payable";
            $data['initial_balance'] = 0;

            return $data;
        }
    }
}

// get supplier balance
if (!function_exists('get_client_balance')) {
    function get_client_balance($party_code = '')
    {
        //get main CodeIgniter object
        $ci =& get_instance();

        if (!empty($party_code)) {

            // define default variable
            $debit = $credit = $initial_balance = $balance = 0;

            // get party info
            $party_info = $ci->db->query("SELECT parties.code, parties.name, parties.initial_balance, partytransaction.credit, partytransaction.debit FROM ( SELECT code, name, initial_balance FROM parties WHERE code='$party_code' AND type='client' AND trash=0 )parties LEFT JOIN ( SELECT party_code, SUM(debit) AS debit, SUM(credit + remission) AS credit FROM partytransaction WHERE trash=0 GROUP BY party_code )partytransaction ON parties.code=partytransaction.party_code")->row();

            $debit           = (!empty($party_info->debit) ? $party_info->debit : 0);
            $credit          = (!empty($party_info->credit) ? $party_info->credit : 0);
            $initial_balance = (!empty($party_info->initial_balance) ? $party_info->initial_balance : 0);

            // calculate client balance
            if ($initial_balance < 0) {
                $balance = $debit - ($credit + abs($initial_balance));
            } else {
                $balance = ($debit + $initial_balance) - $credit;
            }

            // set data
            $data['code']            = $party_info->code;
            $data['name']            = $party_info->name;
            $data['debit']           = $debit;
            $data['credit']          = $credit;
            $data['balance']         = $balance;
            $data['status']          = ($balance < 0 ? "Payable" : "Receivable");
            $data['initial_balance'] = $initial_balance;

            return $data;
        } else {
            $data['code']            = 'N/A';
            $data['name']            = 'N/A';
            $data['debit']           = 0;
            $data['credit']          = 0;
            $data['balance']         = 0;
            $data['status']          = "Payable";
            $data['initial_balance'] = 0;

            return $data;
        }
    }
}

// set site config file
//$config_data = get_result('tbl_config');
//if(!empty($config_data)){
//    foreach($config_data as $c_value){
//        $this->config->set_item($c_value->config_key, $c_value->config_value);
//    }
//}
// get left join all data
if (!function_exists('sms')) {
    function sms($number, $text){
        $ci =& get_instance();
        
        $message = send_sms($number, $text);
        $insert = array(
            'delivery_date'     => date('Y-m-d'),
            'delivery_time'     => date('H:i:s'),
            'mobile'            => $number,
            'message'           => $text,
            'total_characters'  => strlen($text),
            'total_messages'    => ceil(strlen($text)/140),
            'delivery_report'   => $message
        );
        $ci->db->insert('sms_record', $insert);
        return $message;
    }
}
