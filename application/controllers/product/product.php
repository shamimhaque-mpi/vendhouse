<?php
class Product extends Admin_Controller {

     function __construct() {
        parent::__construct();
        $this->load->model('action');
        $this->load->library('upload');
        $this->holder();
    }

    public function index() {
        $this->data['meta_title'] = 'Product';
        $this->data['active'] = 'data-target="product_menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;
        
        $this->data['usersInfo'] = $this->action->read('users');

        if ($this->input->post('product_add')) {
         if(!$this->action->exists("products", array("product_code" => $this->input->post('product_code')))){
            
            $data = array(
                'product_name'      =>  $this->input->post('product_name'),
                'product_code'      =>  $this->input->post('product_code'),
                'product_cat'       =>  $this->input->post('product_cat'),
                'bar_code'          =>  $this->input->post('bar_code'),
                'subcategory'       =>  $this->input->post('product_subcat'),
                'brand'             =>  $this->input->post('brand'),
                'vat'               =>  $this->input->post('vat'),
                'purchase_price'    =>  $this->input->post('purchase_price'),
                'regular_price'     =>  $this->input->post('regular_price'),
                'sale_price'        =>  $this->input->post('sale_price'),
                'unit'              =>  $this->input->post('unit'),
                'color'             =>  $this->input->post('color'),
                'size'              =>  $this->input->post('size'),
                'discount'          =>  $this->input->post('discount'),
                'description'       =>  $this->input->post('description'),
                //'user_id'           =>  $this->data['user_id'],
                //'user_name'         =>  $this->data['name'],
                //'user_id'           =>  $this->input->post('user_id'),
                //'user_name'         =>  $this->input->post('user_name'),
                'privilege'         =>  $this->data['privilege'],
                'status'            =>  $this->input->post('available'),
            );


            if ($_FILES["attachFile"]["name"]!=null or $_FILES["attachFile"]["name"]!="" ) {

                resize_image('attachFile', 200, 200, 'public/upload/product/thumbnail');
                resize_image('attachFile', 500, 500, 'public/upload/product/medium');
                resize_image('attachFile', 768, 768, 'public/upload/product/medium_large');
                $path = resize_image('attachFile', 1024, 1024, 'public/upload/product/large');

                $data["img_path"] = $path;
            }

           $gallery_image = [];

            if(isset($_FILES['gallery'])){
                foreach($_FILES['gallery']['name'] as $_key => $value){

                    if(!empty($value)){
                        
                        $time = time();
                        
                        resize_image('gallery', 150, 150, 'public/upload/product/thumbnail', $_key, '', $time);
                        resize_image('gallery', 300, 300, 'public/upload/product/medium', $_key, '', $time);
                        resize_image('gallery', 768, 768, 'public/upload/product/medium_large', $_key, '', $time);
                        $image_name = resize_image('gallery', 1024, 1024, 'public/upload/product/large', $_key, '', $time);

                        $gallery_image[] = $image_name;
                    }
                }

                $data["gallery_images"] = json_encode($gallery_image);
            }
                

            //add data into db and get Last inserted ID. products table
            $id = $this->action->addAndGetID('products',$data);

            //Generating Registration ID Start
             // $pid = "AS-".str_pad($id, 4,0,STR_PAD_LEFT);
              $pid = $this->input->post('product_code');
            //Generating Registration ID End

            $insertStatus = null;
            $insertStatus = $this->action->update('products',array("product_code" => $pid),array("id" => $id));
            $this->session->set_flashdata('success', 'Product Successfully Added!');
          }else{
           $this->session->set_flashdata('warning', 'This Product allready Exists!');
          }
            redirect("product/product","refresh");
        }

        $this->data['product_cats'] = $this->action->read('category');
        $this->data['subcategory'] = $this->action->read('subcategory');
        $this->data['brand'] = $this->action->read('brand');

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/product/product-nav', $this->data);
        $this->load->view('components/product/addProduct', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }


    private function set_upload_options($file_name) {
        $config = array();

        $config['upload_path']      = './public/upload/product/';
        $config['allowed_types']    = 'png|jpg|gif';
        $config['file_name']        = $file_name;
        $config['overwrite']        = true;

        return $config;
   }

    public function allProduct() {
        $this->data['meta_title'] = 'Product';
        $this->data['active'] = 'data-target="product_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;

        $user_id   = $this->session->userdata('user_id');
        $this->data['users_info'] = $this->action->read('users', array('id' => $user_id));

	    if($this->input->get("id")){
	        
            $this->action->deletedata('products', array('id' => $this->input->get("id")));
            $this->session->set_flashdata('success', 'Product successfully Deleted!');
            redirect('product/product/allProduct', 'refresh');
        }

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/product/product-nav', $this->data);
        $this->load->view('components/product/allProduct', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer',$this->data);

    }

    public function editProduct($id=null) {
        $this->data['meta_title'] = 'Product';
        $this->data['active'] = 'data-target="product_menu"';
        $this->data['subMenu'] = 'data-target="all"';
        $this->data['confirmation'] = null;
        
        $this->data['usersInfo'] = $this->action->read('users');

        $this->data['product_cats'] = $this->action->read('category');
        $this->data['subcategory'] = $this->action->read('subcategory');
        $this->data['brand'] = $this->action->read('brand');

        $where = array('id' => $id);
        
        if($this->input->post('update')){
            
            $product    = $this->action->read("products", $where);
            $old_images = json_decode($product[0]->gallery_images, true);
            $gallery_image = [];
            
            if(isset($_FILES['gal_img'])){
                $index = 0;
                foreach($_FILES['gal_img']['name'] as $key=>$file){
                    if($file!=''){
                        resize_image('gal_img', 200, 200, 'public/upload/product/thumbnail', $key, null, time());
                        resize_image('gal_img', 500, 500, 'public/upload/product/medium', $key, null, time());
                        resize_image('gal_img', 768, 768, 'public/upload/product/medium_large', $key, null, time());
                        $gallery_image[] = resize_image('gal_img', 1024, 1024, 'public/upload/product/large', $key, null, time());
                    }
                }
                
            }
            
            $data = array(
                'product_name'    =>  $this->input->post('product_name'),
                'product_cat'     =>  $this->input->post('product_cat'),
                'subcategory'     =>  $this->input->post('product_subcat'),
                'brand'           =>  $this->input->post('brand'),
                'vat'             =>  $this->input->post('vat'),
                'purchase_price'  =>  $this->input->post('purchase_price'),
                'regular_price'   =>  $this->input->post('regular_price'),
                'sale_price'      =>  $this->input->post('sale_price'),
                'unit'            =>  $this->input->post('unit'),
                //'user_id'         =>  $this->input->post('user_id'),
                //'user_name'       =>  $this->input->post('user_name'),
                'color'           =>  $this->input->post('color'),
                'size'            =>  $this->input->post('size'),
                'description'     =>  $this->input->post('description'),
                'discount'          =>  $this->input->post('discount'),
                'status'          =>  $this->input->post('available')
            );

            $gallery_image = array_merge($old_images, $gallery_image);
            $data["gallery_images"] = json_encode($gallery_image);
            
            if ($_FILES["attachFile"]["name"]!=null or $_FILES["attachFile"]["name"]!="" ) {
                if(is_file("./".$this->input->post("old_image"))){
                    unlink("./".$this->input->post("old_image"));
                }
                resize_image('attachFile', 200, 200, 'public/upload/product/thumbnail');
                resize_image('attachFile', 500, 500, 'public/upload/product/medium');
                resize_image('attachFile', 768, 768, 'public/upload/product/medium_large');
                $path = resize_image('attachFile', 1024, 1024, 'public/upload/product/large');
                $data["img_path"] = $path;
            }

            //update stock table's sell price
            $cond = array( "code"  =>  $_POST['product_code']);            
            $info = array(
                'purchase_price'  =>  $this->input->post('purchase_price'),
                "sell_price" => $this->input->post('sale_price'),
                'category'   =>  $this->input->post('product_cat'),
                'subcategory'=>  $this->input->post('product_subcat')
            );
            $this->action->update("stock", $info, $cond);
            
            $this->action->update("products", $data, $where);
            $this->session->set_flashdata('success', 'Product successfully Updated!');
            redirect("product/product/editProduct/".$id, "refresh");
        }

        $this->data['products'] = $this->action->read('products',$where);

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/product/product-nav', $this->data);
        $this->load->view('components/product/editProduct', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }


    public function delete($id = null){
        
        
        if(!empty($id)){
            
            $this->action->update("products", ['status'=>'notavailable'], ['id'=>$id]);
            $this->session->set_flashdata('success', 'Product successfully Deleted!');
        }
        
        redirect('product/product/allProduct', 'refresh');

    }


    private function holder(){
        if($this->session->userdata('holder') == null){
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }


}
