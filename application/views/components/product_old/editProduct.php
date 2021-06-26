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

            <div class="panel-body" ng-model="product_id" ng-init="product_id='<?php echo $products[0]->id;?>';">
                <div class="row">
                    <div class="col-md-7">
                        <?php
                        $attr = array('class' =>'form-horizontal');
                        echo form_open_multipart('', $attr);
                        ?>
                        <!-- <input type="hidden" name="old_image" value="<?php //echo $products[0]->img_path; ?>">

                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-9">
                                <img class="img-thumbnail" width="150" src="<?php //echo site_url($products[0]->img_path); ?>" alt="">
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo caption('Product_Name') ;?> </label>
                            <div class="col-md-9">
                                <input type="text" value="<?php echo $products[0]->product_name; ?>" name="product_name" placeholder="" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo caption('Product_Code') ;?> </label>
                            <div class="col-md-9">
                                <input type="text" readonly name="product_code" value="<?php echo $products[0]->bar_code; ?>" class="form-control">
                            </div>
                        </div>

                         <div class="form-group">
	                    <label class="col-md-3 control-label"><?php echo caption('Category') ;?> <span class="req">*</span></label>
	                    <div class="col-md-9">
	                        <select name="product_cat" ng-model="category" ng-change="getSubCategoryFn();" class="form-control">
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
	                    <label class="col-md-3 control-label">Subcategory<span class="req">&nbsp; </span></label>
	                    <div class="col-md-9">
	                        <select name="product_subcat" class="form-control" ng-model="subcategory" ng-init="subcategory='<?php  echo $products[0]->subcategory; ?>';">
                                <option ng-repeat="row in allSubCategory" ng-value="row.subcategory">{{ row.subcategory | textBeautify }}</option>
	                        </select>
	                    </div>
	                </div>

                        <div class="form-group">
                           <label class="col-md-3 control-label">Brand<span class="req">&nbsp;</span></label>
                           <div class="col-md-9">
                               <select name="brand" class="form-control">
                                   <option value="" selected>&nbsp;</option>
                                   <?php foreach ($brand as $key => $value) { ?>
                                   <option <?php if($value->brand == $products[0]->brand){echo 'selected';} ?> value="<?php echo $value->brand; ?>"><?php echo str_replace('_',' ', $value->brand); ?></option>>
                                   <?php } ?>
                               </select>
                           </div>
                       </div>

                        <div class="form-group">
                          <label class="col-md-3 control-label">VAT<span class="req">&nbsp;</span></label>
                          <div class="col-md-9 input-group">
                              <input type="text" name="vat"  value="<?php echo $products[0]->vat; ?>" class="form-control">
                              <div class="input-group-addon">%</div>
                          </div>
                      </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo caption('Purchase_price') ;?> </label>
                            <div class="col-md-9">
                                <input type="number" value="<?php echo $products[0]->purchase_price; ?>" step="any" name="purchase_price" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Regular Price </label>
                            <div class="col-md-9">
                                <input type="number" value="<?php echo $products[0]->regular_price; ?>" step="any" name="regular_price" class="form-control" required >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo caption('Sale_Price') ;?> </label>
                            <div class="col-md-9">
                                <input type="number" value="<?php echo $products[0]->sale_price; ?>" step="any" name="sale_price" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo caption('Unit') ;?> <span class="req">*</span></label>
                            <div class="col-md-9">
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
                            <label class="col-md-3 control-label">Description </label>
                            <div class="col-md-9">
                                <textarea name="description" cols="30" rows="10" class="form-control" ><?php echo $products[0]->description; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="available"><?php echo caption('Status') ;?> <span class="req">*</span></label>
                            <div class="col-md-9 text-left">
                                <div class="checkbox">
                                    <label for="available"><input type="radio" <?php if($products[0]->status==1){ echo "checked"; } ?> name="available" id="available" value="1" required> <?php echo caption('Available') ;?> </label>
                                    <label for="notavailable"><input type="radio" <?php if($products[0]->status==0){ echo "checked";} ?> name="available" id="notavailable" value="0" required> <?php echo caption('Notavailable') ;?> </label>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label class="col-md-3 control-label"><?php //echo caption('Image') ;?>  <span class="req">*</span></label>
                            <div class="col-md-9">
                                <input id="input-test" type="file" name="attachFile" class="form-control file" data-show-preview="true" data-show-upload="false" data-show-remove="false">
                            </div>
                        </div> -->
                        
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
                        </style>

                        <div class="form-group img_update">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-9">
                                <div  style='float:left;cursor: pointer;width:80px'>
                                <label>
                                    <img class="img-thumbnail" id="img_preview0" width="80" height="80" src="<?php echo site_url($products[0]->img_path); ?>" alt="">
                                    <input style='opacity: 0;width:0;height:0;' type="file" onchange="encodeImageFileAsURL(this)" data-img="img_preview0" class="img_input" name="attachFile" id="fa_img">
                                </label>
                                </div>
                                <input type="hidden" name="old_image" value="<?php echo $products[0]->img_path; ?>">

                                <style>
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

                                <?php
                                    $gel_img = json_decode($products[0]->gallery_images);
                                    for($i=0; $i<=3; $i++) { ?>
                                        <div  style='float:left;cursor: pointer;width:80px'>
                                            <?php if($gel_img?array_key_exists($i,$gel_img):1==2){ ?>
                                            <label class="gel_label">

                                                <!-- if image present show this close btn -->
                                                <?php   if(!empty($gel_img[$i])){ ?>
                                                <a class="btn btn-danger" onclick="del_img(this,<?php echo $i; ?>,<?php echo $products[0]->id; ?>)"><i class="fa fa-close"></i></a>
                                                <?php } ?>

                                                <img class="img-thumbnail" id="img_preview<?php echo $i+1; ?>" src="<?php echo site_url($gel_img[$i]); ?>" alt="">
                                                <input style='opacity: 0;width:0;height:0;' type="file" onchange="encodeImageFileAsURL(this)" data-img="img_preview<?php echo $i+1; ?>" class="img_input" name="gal_img<?php echo $i; ?>">
                                                <input type="hidden" name="old_gal_image<?php echo $i; ?>" value="<?php echo $gel_img[$i]; ?>">
                                            </label>
                                            <?php }else{ ?>
                                            <label>
                                                <img class="img-thumbnail" id="img_preview<?php echo $i+1; ?>" src="http://via.placeholder.com/250x250" alt="">
                                                <input style='opacity: 0;width:0;height:0;' type="file" onchange="encodeImageFileAsURL(this)" data-img="img_preview<?php echo $i+1; ?>" class="img_input" name="gal_img<?php echo $i; ?>">
                                            </label>
                                            <?php } ?>
                                        </div>
                                <?php }?>
                            </div>
                        </div>

                        <script>
                            function encodeImageFileAsURL(element) {
                                var preview = $("#"+element.dataset.img)[0];
                                var file    = element.files[0];
                                var reader  = new FileReader();

                                reader.readAsDataURL(file);
                                reader.addEventListener("load", function () {
                                    preview.src = reader.result;
                                }, false);
                            }

                        </script>



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
    //delete img from file and update database to empty
    function del_img(x=null,imgIndex=null,id=null) {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText==1) {
                    alert("Image successfully removed!");
                    location.reload();
                }
            }
        };
        xhttp.open("GET", "<?php echo site_url('product/product/img_del/?id='); ?>"+id+"&imgIndex="+imgIndex, true);
        xhttp.send();
    }
</script>
