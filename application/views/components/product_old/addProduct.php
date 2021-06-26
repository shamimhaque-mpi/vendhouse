<link rel="stylesheet" href="<?php echo site_url('private/css/tag_editor/tag-editor.css');?>">
<div class="container-fluid" ng-controller="addProductCtrl" ng-cloak>
    <div class="row">
	    <?php echo $this->session->flashdata('confirmation'); ?>

        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Add_Product') ;?></h1>
                </div>
            </div>

            <div class="panel-body">
                <?php
                $attr = array('class' => 'form-horizontal');
	            echo form_open_multipart('', $attr);
                ?>

                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo caption('Product_Name') ;?> <span class="req">*</span></label>
                    <div class="col-md-5">
                        <input type="text" name="product_name" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo caption('Product_Code');?> <span class="req">*</span> </label>
                    <div class="col-md-5">
                        <input type="text" name="bar_code" ng-model="bar_code" ng-change="checkExists();" class="form-control" required>
                        <span style="color:red;font-weight:bold;"> {{ message }} </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo caption('Category') ;?> <span class="req">*</span></label>
                    <div class="col-md-5">
                        <select name="product_cat" ng-model="category" ng-change="getSubCategoryFn();" class="form-control">
                            <option value="" selected disabled>&nbsp;</option>
                            <?php foreach ($product_cats as $key => $cat) { ?>
                            <option value="<?php echo $cat->category; ?>"><?php echo str_replace('_',' ', $cat->category); ?></option>
                            <?php } ?>
                            <option value="global">Global</option>
                            <option value="affiliate_product">Affiliate Product</option>
                        </select>
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-md-2 control-label">Subcategory<span class="req">&nbsp;</span></label>
                    <div class="col-md-5">
                        <select name="product_subcat" class="form-control">
                            <option value="" selected disabled>&nbsp;</option>
                            <option ng-repeat="row in allSubCategory" ng-value="row.subcategory">{{ row.subcategory | textBeautify }}</option>                            
                        </select>
                    </div>
                </div>

                <div class="form-group">
                   <label class="col-md-2 control-label">Brand<span class="req">&nbsp;</span></label>
                   <div class="col-md-5">
                       <select name="brand" class="form-control">
                           <option value="" selected>&nbsp;</option>
                           <?php foreach ($brand as $key => $value) { ?>
                           <option value="<?php echo $value->brand; ?>"><?php echo str_replace('_',' ', $value->brand); ?></option>>
                           <?php } ?>
                       </select>
                   </div>
               </div>

                <div class="form-group">
                  <label class="col-md-2 control-label">VAT<span class="req">&nbsp;</span></label>
                  <div class="col-md-5 input-group">
                      <input type="text" name="vat"  value="0" class="form-control">
                      <div class="input-group-addon">%</div>
                  </div>
              </div>

                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo caption('Purchase_price') ;?> <span class="req">*</span></label>
                    <div class="col-md-5">
                        <input type="number" name="purchase_price" min="0" value="0" class="form-control" step="any" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Regular Price <span class="req">*</span></label>
                    <div class="col-md-5">
                        <input type="number" name="regular_price" min="0" value="0" class="form-control" step="any" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo caption('Sale_Price') ;?> <span class="req">*</span></label>
                    <div class="col-md-5">
                        <input type="number" name="sale_price" min="0" value="0" class="form-control" step="any">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo caption('Unit') ;?> <span class="req">*</span></label>
                    <div class="col-md-5">
                        <select name="unit" class="form-control" required>
                            <option value="">&nbsp;</option>
                            <?php
                            $units = config_item('unit');
                            foreach($units as $key => $value){
                            ?>
                            <option value="<?php echo $value; ?>">
                                <?php echo $value; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-2 control-label">Color</label>
                    <div class="col-md-5">
                        <input type="text" name="color" class="form-control" list="all_color" id="hero-demo">
                        <datalist id="all_color">
                           <?php
                            $colors = config_item('color');
                            foreach($colors as $key => $value){
                            ?>
                            <option value="<?php echo $value; ?>">
                            <?php } ?>
                        </datalist>
                    </div>
                </div>
                
                
                <div class="form-group">
                    <label class="col-md-2 control-label">Size</label>
                    <div class="col-md-5">
                        <input type="text" name="size" class="form-control" list="all_size" id="hero-demo1">
                        <datalist id="all_size">
                           <?php
                            $sizes = config_item('size');
                            foreach($sizes as $key => $value){
                            ?>
                            <option value="<?php echo $value; ?>">
                            <?php } ?>
                        </datalist>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Description <span class="req">&nbsp;</span></label>
                    <div class="col-md-5">
                        <textarea name="description" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Feature <?php echo caption('Image') ;?> (700x700)  <span class="req">*</span></label>
                    <div class="col-md-5">
                        <input id="input-test" type="file" name="attachFile" class="form-control file" data-show-preview="true" data-show-upload="false" data-show-remove="false">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">
                        Gallery Images <span class="req">*</span>
                        <p>(Maximum {{ imgLimit }} Images) (700x700)</p>
                    </label>

                    <div class="col-md-5">
                        <p ng-repeat="field in gallery">
                            <input id="input-test" type="file" name="gallery[]"  class="form-control file" data-show-preview="true" data-show-upload="false" data-show-remove="false">
                        </p>

                        <a class="btn btn-info" ng-click="addFieldsFn()">ADD</a>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="available"><?php echo caption('Status') ;?> <span class="req">*</span></label>
                    <div class="col-md-5 text-left">
                        <div class="checkbox">
                            <label for="available">
                                <input type="radio" checked name="available" id="available" value="1" required>
                                <?php echo caption('Available') ;?>
                            </label>

                            <label for="notavailable">
                                <input type="radio" name="available" id="notavailable" value="0" required>
                                <?php echo caption('Notavailable') ;?>
                            </label>
                        </div>
                    </div>
                </div>


                <div class="col-md-7">
                    <div class="btn-group pull-right">
                        <input type="submit" value="<?php echo caption('Save') ;?>" name="product_add" class="btn btn-primary">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

 <script src="<?php echo site_url('private/js/tag_editor/tag-editor.min.js');?>"></script>   
<script  src="<?php echo site_url('private/js/tag_editor/tag-editor-script.js');?>"></script> 


