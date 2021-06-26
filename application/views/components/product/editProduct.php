<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>

<style>
    .img_update label{
        transition: all 0.3s ease-in-out;
        border-radius: 6px;
        position: relative;
        cursor: pointer;
    }
    .img_update label img{
        height:90px;
        width: 80px;
    }
    .img_update label:hover{
        transform: scale(1.2);
        box-shadow: 0 0 6px #555;
        z-index: 8;
    }
    
    .gel_label{
        position: relative;
        overflow: hidden;
    }
    .gel_label a{
        position: absolute;
        transform: scale(0) translate(-100px,-100px);
        transition:all 0.3s ease-in-out;
    }

    .gel_label:hover a{
        transform: scale(0.5) translate(0px,0px);
    }
</style>
<div class="container-fluid">
    <div class="row" ng-controller="editProductCtrl" ng-cloak >

        <?php
         echo $confirmation;
         echo $this->session->flashdata('confirmation');
          ?>
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Edit_Product') ;?> </h1>
                </div>
            </div>
            
            <?php  
                $supplier_privilege = $this->session->userdata('privilege'); 
                $user_id = $this->session->userdata('user_id'); 
                $user_name = $this->session->userdata('name'); 
                if($supplier_privilege != 'user'){
            ?>
            
            <?php }else{ ?>
            
            <?php } ?>
            

            <div class="panel-body" ng-model="product_id" ng-init="product_id='<?php echo $products[0]->id;?>';">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $attr = array('class' =>'form-horizontal');
                        echo form_open_multipart('', $attr);
                        ?>
                       

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo caption('Product_Name') ;?> </label>
                            <div class="col-md-5">
                                <input type="text" value="<?php echo $products[0]->product_name; ?>" name="product_name" placeholder="" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label">Product Code </label>
                            <div class="col-md-5">
                                <input type="text" value="<?php echo $products[0]->product_code; ?>" name="product_code" placeholder="" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Product Model</label>
                            <div class="col-md-5">
                                <input type="text" readonly name="product_code" value="<?php echo $products[0]->bar_code; ?>" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
    	                    <label class="col-md-2 control-label"><?php echo caption('Category') ;?> <span class="req">*</span></label>
    	                    <div class="col-md-5">
    	                        <select name="product_cat" ng-model="category" ng-init="category='<?php  echo $products[0]->product_cat; ?>';" ng-change="getSubCategoryFn();" class="form-control">
    	                            <option value="" selected disabled>&nbsp;</option>
    	                            <?php foreach ($product_cats as $key => $cat) { ?>
    	                            <option value="<?php echo $cat->category; ?>"><?php echo str_replace('_',' ', $cat->category); ?></option>>
    	                            <?php } ?>
    	                            <option value="global">Global</option>
    	                            <option value="affiliate_product">Affiliate Product</option>
    	                        </select>
    	                    </div>
    	                </div>

                        <div class="form-group">
    	                    <label class="col-md-2 control-label">Subcategory<span class="req">&nbsp; </span></label>
    	                    <div class="col-md-5">
    	                        <select name="product_subcat" class="form-control">
                                    <option ng-repeat="row in allSubCategory" ng-value="row.subcategory" ng-selected="row.subcategory == '<?php echo $products[0]->subcategory; ?>'">{{ row.subcategory | textBeautify }}</option>
    	                        </select>
    	                    </div>
    	                </div>
    
                        <div class="form-group">
                            <label class="col-md-2 control-label">Brand<span class="req">&nbsp;</span></label>
                            <div class="col-md-5">
                                <select name="brand" class="form-control">
                                    <option value="" selected>&nbsp;</option>
                                    <?php foreach ($brand as $key => $value) { ?>
                                    <option <?php if($value->brand == $products[0]->brand){echo 'selected';} ?> value="<?php echo $value->brand; ?>"><?php echo str_replace('_',' ', $value->brand); ?></option>>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                           
                        <input type="hidden" name="vat"  value="<?php echo $products[0]->vat; ?>" class="form-control">
    
    
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo caption('Purchase_price') ;?> </label>
                            <div class="col-md-5">
                                <input type="number" value="<?php echo $products[0]->purchase_price; ?>" step="any" name="purchase_price" class="form-control" required>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label class="col-md-2 control-label">Regular Price </label>
                            <div class="col-md-5">
                                <input type="number" value="<?php echo $products[0]->regular_price; ?>" step="any" name="regular_price" class="form-control" required >
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo caption('Sale_Price') ;?> </label>
                            <div class="col-md-5">
                                <input type="number" value="<?php echo $products[0]->sale_price; ?>" step="any" name="sale_price" class="form-control">
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo caption('Discount') ;?> </label>
                            <div class="col-md-5">
                                <input type="number" value="<?php echo $products[0]->discount; ?>" step="any" name="discount" class="form-control">
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo caption('Unit') ;?> <span class="req">*</span></label>
                            <div class="col-md-5">
                                <select name="unit" class="form-control">
                                    <?php
                                        $units = config_item('unit');
                                        foreach($units as $key => $value){
                                    ?>
                                    <option value="<?php echo $value; ?>" <?php if($products[0]->unit == $value){echo "selected";} ?>>
                                        <?php echo $value; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label">Color</label>
                            <div class="col-md-5">
                                <input type="text" name="color" id="color"  value="<?php echo $products[0]->color;?>" >
                            </div>
                        </div>
                            
                        <div class="form-group">
                            <label class="col-md-2 control-label">Size</label>
                            <div class="col-md-5">
                                <input type="text" name="size" id="size"  value="<?php echo $products[0]->size;?>" >
                            </div>
                        </div>
                
                        <div class="form-group">
                            <label class="col-md-2 control-label">Description </label>
                            <div class="col-md-10">
                                <textarea name="description" id="tinyTextarea" cols="30" rows="10" class="form-control" ><?php echo $products[0]->description; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="available"><?php echo caption('Status') ;?> <span class="req">*</span></label>
                            <div class="col-md-5 text-left">
                                <div class="checkbox">
                                    <label for="available"><input type="radio" <?php if($products[0]->status==1){ echo "checked"; } ?> name="available" id="available" value="1" required> <?php echo caption('Available') ;?> </label>
                                    <label for="notavailable"><input type="radio" <?php if($products[0]->status==0){ echo "checked";} ?> name="available" id="notavailable" value="0" required> <?php echo caption('Notavailable') ;?> </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group img_update">
                            <label class="col-md-2 control-label"></label>
                            <div class="col-md-5">
                                <div  style='float:left;cursor: pointer;width:80px'>
                                    <label>
                                        <img class="img-thumbnail" id="img_preview0" width="80" height="80" src="<?php echo site_url('/public/upload/product/thumbnail/'.$products[0]->img_path); ?>" alt="">
                                        <input style='opacity: 0;width:0;height:0;' type="file" onchange="encodeImageFileAsURL(this)" data-img="img_preview0" class="img_input" name="attachFile" id="fa_img">
                                    </label>
                                </div>
                                <input type="hidden" name="old_image" value="<?php echo $products[0]->img_path; ?>">

                                <?php
                                    $gel_img = json_decode($products[0]->gallery_images);
                                    // print_r($gel_img);
                                    if(is_array($gel_img)){
                                        foreach($gel_img as $key=>$value){
                                            ?>
                                            <div style='float:left;cursor: pointer;width:80px' class="img-parent">
                                                <label class="gel_label">
                                                    <a class="btn btn-danger" onclick="del_img(this, <?php echo $products[0]->id; ?>,`<?php echo $value;?>`)"><i class="fa fa-close"></i></a>
                                                    <img class="img-thumbnail" id="img_preview" src="<?php echo site_url('/public/upload/product/thumbnail/'.$value); ?>" alt="">
                                                </label>
                                            </div>
                                            <?php
                                        }
                                    }
                                ?>
                                <div id="img_gallery">
                                    <label class="gel_label">
                                        <a class="btn btn-danger" onclick="window.event.preventDefault(); (this.parentElement).remove()"><i class="fa fa-close"></i></a>
                                        <img class="img-thumbnail" src="http://via.placeholder.com/250x250" alt="">
                                        <input style='opacity: 0;width:0;height:0;' type="file" onchange="encodeImageFileAsURL(this)" class="img_input" name="gal_img[]">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="btn-group pull-right">
                            <input type="submit" value="<?php echo caption('Update') ;?>" name="update" class="btn btn-primary">
                        </div>

                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>


<script>
    function encodeImageFileAsURL(element) {
        var new_file_area = document.querySelector('#img_gallery');
        // var file    = window.event.target.files[0];
        var reader   = new FileReader();
        var new_element = document.createElement('label');
        new_element.classList.add('gel_label');
        new_element.innerHTML = 
            `<a class="btn btn-danger" onclick="window.event.preventDefault(); (this.parentElement).remove()"><i class="fa fa-close"></i></a>
            <img class="img-thumbnail" src="http://via.placeholder.com/250x250" alt="">
            <input style='opacity: 0;width:0;height:0;' type="file" onchange="encodeImageFileAsURL(this)" class="img_input" name="gal_img[]">`;
        console.log(new_element);
        reader.readAsDataURL(element.files[0]);
        reader.addEventListener("load", function () {
            if(element.closest('label')){
                element.closest('label').querySelector('img').src= reader.result;
                new_file_area.append(new_element);
            }
        }, false);
    }
    
    //delete img from file and update database to empty
    function del_img(obj, product_id,  det_path) {
        console.log(obj);
        var formData = new FormData();
        formData.append('path', det_path);
        formData.append('product_id', product_id);
        
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(this.responseText==1){
                    if(obj.closest('.img-parent')){
                        obj.closest('.img-parent').remove();
                    }
                }
            }
        };
        xhttp.open("POST", "<?php echo site_url('ajax/removeProductImg'); ?>", true);
        xhttp.send(formData);
    }

//<!-- Scripts for Tag It -->
    $(function(){
        var sampleTags = [
            <?php
               $colors = config_item('color');
               foreach($colors as $key => $value){
                 echo "'".$value."',"; 
               }
            ?>
        ];
        var sampleTags2 = [
             <?php
               $colors = config_item('size');
               foreach($colors as $key => $value){
                 echo "'".$value."',"; 
               }
            ?>
        ];
		
		//-------------------------------
        // Input field
        //-------------------------------
        $('#singleFieldTags').tagit({
            availableTags: sampleTags,
            // This will make Tag-it submit a single form value, as a comma-delimited field.
            singleField: true,
            singleFieldNode: $('#mySingleField'),
			allowSpaces: true
        });
        
        $('#singleFieldTags2').tagit({
            availableTags: sampleTags2,
            // This will make Tag-it submit a single form value, as a comma-delimited field.
            singleField: true,
            singleFieldNode: $('#mySingleField2'),
			allowSpaces: true
        });
	});

 //<!--token field-->

$(document).ready(function(){
 
 $('#size').tokenfield({
  autocomplete:{
    source: [<?php
        $colors = config_item('size');
           foreach($colors as $key => $value){
             echo "'".$value."',"; 
           }
    ?>],
    delay:100
  },
  showAutocompleteOnFocus: true
 });
 
     $('#color').tokenfield({
      autocomplete:{
       source: [<?php
                   $size = config_item('color');
                   foreach($size as $key => $value){
                     echo "'".$value."',"; 
                   }
                ?>],
       delay:100
      },
      showAutocompleteOnFocus: true
     });

 
});
</script>