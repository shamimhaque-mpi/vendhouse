<div class="container-fluid">
    <div class="row">
     <?php  echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                   <h1>Edit Brand Information </h1>
                </div>
            </div>

            <div class="panel-body">
                <!-- category form start -->
                <?php  $attr=array('class'=>"form-horizontal");
                echo form_open('subCategory/subCategory/edit'.'?id='.$this->input->get('id'), $attr); ?>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Category Name <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="hidden" name="oldCategory" value="<?php echo $subcategory[0]->category; ?>">
                            <select name="category" class="form-control" required>
                                <?php 
                                if($categories != null){
                                    foreach ($categories as $key => $value) {
                                ?>
                                <option value="<?php echo $value->category; ?>" <?php if($subcategory[0]->category == $value->category){echo "selected";} ?> >
                                    <?php echo $value->category; ?>
                                </option>
                                <?php } ?>
                                <option <?php if("global" == $subcategory[0]->category){echo "selected";} ?> value="global">Global</option>
                                <?php } ?>

                            </select>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Sub Category Name <span class="req">&nbsp;*</span></label>
                        <div class="col-md-5">
                            <input type="hidden" name="oldSubcategory" value="<?php echo $subcategory[0]->subcategory; ?>">
                            <input 
                                type="text" 
                                name="subcategory"  
                                value="<?php echo $subcategory[0]->subcategory; ?>" 
                                class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="btn-group pull-right">
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                       
                    </div>
               <?php  echo form_close();?>
                <!-- category form end -->
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

