<?php
class Product extends Admin_Controller {

     function __construct() {
        parent::__construct();
        $this->load->model('action');
        $this->load->library('upload');
        $this->holder();
        //print_r($this->session->userdata('user_id'));
        //print_r($this->session->userdata('privilege'));
    }

    public function index() {
        $this->data['meta_title'] = 'Product';
        $this->data['active'] = 'data-target="product_menu"';
        $this->data['subMenu'] = 'data-target="add-new"';
        $this->data['confirmation'] = null;

        if ($this->input->post('product_add')) {
         if(!$this->action->exists("products",array("bar_code" => $this->input->post('bar_code')))){
            $data = array(
                'product_name'      =>  $this->input->post('product_name'),
                'product_cat'       =>  $this->input->post('product_cat'),
                'product_code'      =>  $this->input->post('bar_code'),
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
                'description'       =>  $this->input->post('description'),
                'user_id'           =>  $this->session->userdata('user_id'),
                'user_name'         =>  $this->session->userdata('user_name'),
                'privilege'         =>  $this->session->userdata('privilege'),
                'status'            =>  $this->input->post('available'),
            );

            if ($_FILES["attachFile"]["name"]!=null or $_FILES["attachFile"]["name"]!="" ) {

                $config['upload_path']   = './public/upload/product/';
                $config['allowed_types'] = 'png|jpeg|jpg|gif';
                $config['max_size']      = '4096';
                $config['max_width']     = '3000'; /* max width of the image file */
                $config['max_height']    = '3000';
                $config['file_name']     = 'product_'.rand(1111,99999).'_'.strtotime('now');
                $config['overwrite']     = true;

                $this->upload->initialize($config);

                if ($this->upload->do_upload("attachFile")){
                    $upload_data=$this->upload->data();
                    $data["img_path"] = "public/upload/product/".$upload_data['file_name'];
                }else{
                    echo $this->upload->display_errors();
                }

            }




       $files  = $_FILES;
       $gallery_image = array();

       if(isset($_FILES['gallery'])){
           $count  = count($_FILES['gallery']['name']);
           if ($count > 0) {
               $date = new DateTime();
               for($i = 0; $i < $count; $i++) {

                   $_FILES['gallery']['name']      = $files['gallery']['name'][$i];
                   $_FILES['gallery']['type']      = $files['gallery']['type'][$i];
                   $_FILES['gallery']['tmp_name']  = $files['gallery']['tmp_name'][$i];
                   $_FILES['gallery']['error']     = $files['gallery']['error'][$i];
                   $_FILES['gallery']['size']      = $files['gallery']['size'][$i];

                   $file_name = $date->getTimestamp() . "-" . $i . "." . pathinfo($_FILES['gallery']['name'], PATHINFO_EXTENSION);

                   $this->upload->initialize($this->set_upload_options($file_name));

                   if($this->upload->do_upload('gallery') == true) {
                       $gallery_image[] = "public/upload/product/" . $file_name;
                   }
               }

               $data["gallery_images"] = json_encode($gallery_image);
            }
        }




          $msg_array=array(
              "title"=>"Success",
              "emit" =>"Product Successfully Added!",
              "btn"  =>true
            );


            //add data into db and get Last inserted ID. products table
            $id = $this->action->addAndGetID('products',$data);


            //Generating Registration ID Start
              $pid = "GB-".str_pad($id, 4,0,STR_PAD_LEFT);
            //Generating Registration ID End


            $insertStatus = null;
            $insertStatus = $this->action->update('products',array("product_code" => $pid),array("id" => $id));



            $this->data['confirmation']=message("success",$msg_array);
          }else{
             $msg_array=array(
                 "title"=>"warning",
                 "emit"=>"This Product allready Exists!",
                 "btn"=>true
               );
           $this->data['confirmation']=message("warning",$msg_array);
          }
            $this->session->set_flashdata('confirmation', $this->data['confirmation']);
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

        $this->data['total_product'] = count($this->action->read("products"));

	if($this->input->get("id")){
            $options = array(
                'title' => 'delete',
                'emit'  => 'Product successfully Deleted!',
                'btn'   => true
            );

            $this->data['confirmation'] = message($this->action->deletedata('products', array('id' => $this->input->get("id"))), $options);
            $this->session->set_flashdata('confirmation', $this->data['confirmation']);

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

        $this->data['product_cats'] = $this->action->read('category');
        $this->data['subcategory'] = $this->action->read('subcategory');
        $this->data['brand'] = $this->action->read('brand');

        $where = array('id' => $id);

        if($this->input->post('update')){
            $data = array(
                'product_name'    =>  $this->input->post('product_name'),
                'product_cat'     =>  $this->input->post('product_cat'),
                'subcategory'     =>  $this->input->post('product_subcat'),
                'brand'             =>  $this->input->post('brand'),
                'vat'               =>  $this->input->post('vat'),
                'purchase_price'  =>  $this->input->post('purchase_price'),
                'regular_price'   =>  $this->input->post('regular_price'),
                'sale_price'      =>  $this->input->post('sale_price'),
                'unit'            =>  $this->input->post('unit'),
                'description'     =>  $this->input->post('description'),
                'status'          =>  $this->input->post('available')
            );






            if ($_FILES["attachFile"]["name"]!=null or $_FILES["attachFile"]["name"]!="" ) {

                $config['upload_path']   = './public/upload/product';
                $config['allowed_types'] = 'png|jpeg|jpg|gif';
                $config['max_size']      = '4096';
                $config['max_width']     = '3000'; /* max width of the image file */
                $config['max_height']    = '3000';
                $config['file_name']     = 'product_'.rand(1111,99999).'_'.strtotime('now');
                $config['overwrite']     = true;

                $this->upload->initialize($config);

                if ($this->upload->do_upload("attachFile")){

                    if(is_file("./".$this->input->post("old_image"))){
                        unlink("./".$this->input->post("old_image"));
                    }

                    $upload_data=$this->upload->data();
                    $data["img_path"] = "public/upload/product/".$upload_data['file_name'];
                }else{
                    echo $this->upload->display_errors();
                }

            }


            //get img one check
            if (isset($_FILES["gal_img0"]["name"]) && ($_FILES["gal_img0"]["name"]!=null or $_FILES["gal_img0"]["name"]!="")) {

                $config['upload_path']   = './public/upload/product';
                $config['allowed_types'] = 'png|jpeg|jpg|gif';
                $config['max_size']      = '4096';
                $config['max_width']     = '3000'; /* max width of the image file */
                $config['max_height']    = '3000';
                $config['file_name']     = 'product_'.rand(1111,99999).'_'.strtotime('now');
                $config['overwrite']     = true;

                $this->upload->initialize($config);

                if ($this->upload->do_upload("gal_img0")){

                    if(is_file("./".$this->input->post("old_gal_image0"))){
                        unlink("./".$this->input->post("old_gal_image0"));
                    }

                    $upload_data=$this->upload->data();
                    $gallery_image[] = "public/upload/product/".$upload_data['file_name'];
                }else{
                    echo $this->upload->display_errors();
                }

            }else{
                $gallery_image[] = $this->input->post("old_gal_image0");
            }


            //get img two check
            if (isset($_FILES["gal_img1"]["name"]) && ($_FILES["gal_img1"]["name"]!=null or $_FILES["gal_img1"]["name"]!="")) {

                $config['upload_path']   = './public/upload/product';
                $config['allowed_types'] = 'png|jpeg|jpg|gif';
                $config['max_size']      = '4096';
                $config['max_width']     = '3000'; /* max width of the image file */
                $config['max_height']    = '3000';
                $config['file_name']     = 'product_'.rand(1111,99999).'_'.strtotime('now');
                $config['overwrite']     = true;

                $this->upload->initialize($config);

                if ($this->upload->do_upload("gal_img1")){

                    if(is_file("./".$this->input->post("old_gal_image1"))){
                        unlink("./".$this->input->post("old_gal_image1"));
                    }

                    $upload_data=$this->upload->data();
                    $gallery_image[] = "public/upload/product/".$upload_data['file_name'];
                }else{
                    echo $this->upload->display_errors();
                }

            }else{
                $gallery_image[] = $this->input->post("old_gal_image1");
            }


            //get img three check
            if (isset($_FILES["gal_img2"]["name"]) && ($_FILES["gal_img2"]["name"]!=null or $_FILES["gal_img2"]["name"]!="")) {

                $config['upload_path']   = './public/upload/product';
                $config['allowed_types'] = 'png|jpeg|jpg|gif';
                $config['max_size']      = '4096';
                $config['max_width']     = '3000'; /* max width of the image file */
                $config['max_height']    = '3000';
                $config['file_name']     = 'product_'.rand(1111,99999).'_'.strtotime('now');
                $config['overwrite']     = true;

                $this->upload->initialize($config);

                if ($this->upload->do_upload("gal_img2")){

                    if(is_file("./".$this->input->post("old_gal_image2"))){
                        unlink("./".$this->input->post("old_gal_image2"));
                    }

                    $upload_data=$this->upload->data();
                    $gallery_image[] = "public/upload/product/".$upload_data['file_name'];
                }else{
                    echo $this->upload->display_errors();
                }

            }else{
                $gallery_image[] = $this->input->post("old_gal_image2");
            }


            //get img four check
            if (isset($_FILES["gal_img3"]["name"]) && ($_FILES["gal_img3"]["name"]!=null or $_FILES["gal_img3"]["name"]!="")) {

                $config['upload_path']   = './public/upload/product';
                $config['allowed_types'] = 'png|jpeg|jpg|gif';
                $config['max_size']      = '4096';
                $config['max_width']     = '3000'; /* max width of the image file */
                $config['max_height']    = '3000';
                $config['file_name']     = 'product_'.rand(1111,99999).'_'.strtotime('now');
                $config['overwrite']     = true;

                $this->upload->initialize($config);

                if ($this->upload->do_upload("gal_img3")){

                    if(is_file("./".$this->input->post("old_gal_image3"))){
                        unlink("./".$this->input->post("old_gal_image3"));
                    }

                    $upload_data=$this->upload->data();
                    $gallery_image[] = "public/upload/product/".$upload_data['file_name'];
                }else{
                    echo $this->upload->display_errors();
                }

            }else{
                $gallery_image[] = $this->input->post("old_gal_image3");
            }

            $data["gallery_images"] = json_encode($gallery_image);




            $msg_array = array(
                "title" => "Success",
                "emit"  => "Product successfully Updated!",
                "btn"   => true
            );

            //update stock table's sell price
            $cond = array( "code"  =>  $_POST['product_code']);            
            $info = array(
                'purchase_price'  =>  $this->input->post('purchase_price'),
                "sell_price" => $this->input->post('sale_price'),
                'category'   =>  $this->input->post('product_cat'),
                'subcategory'=>  $this->input->post('product_subcat')
            );
            $this->action->update("stock", $info, $cond);
            $this->data['confirmation'] = message($this->action->update("products", $data, $where), $msg_array);
            $this->session->set_flashdata('confirmation', $this->data['confirmation']);
        //    redirect("product/product/editProduct/".$id, "refresh");
        }






        $this->data['products'] = $this->action->read('products',$where);

        $this->load->view($this->data['privilege'] . '/includes/header', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/aside', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/headermenu', $this->data);
        $this->load->view('components/product/product-nav', $this->data);
        $this->load->view('components/product/editProduct', $this->data);
        $this->load->view($this->data['privilege'] . '/includes/footer');
    }


    public function img_del(){
        $id = $this->input->get('id');
        $imgIndex = $this->input->get('imgIndex');

        $data = $this->action->read('products',array('id'=>$id));
        $old_img_array = json_decode($data[0]->gallery_images);
        $old_img = $old_img_array[$imgIndex];
        if (is_file('./'.$old_img)) {
            unlink('./'.$old_img);
         }

        $old_img_array[$imgIndex]=null;
        $new_img_array = json_encode($old_img_array);
        $data1 = array('gallery_images'=>$new_img_array);
        if($this->action->update('products',$data1,array('id'=>$id))){
            echo 1;
        }

    }



    private function holder(){
        if($this->session->userdata('holder') == null){
            $this->membership_m->logout();
            redirect('access/users/login');
        }
    }


}
