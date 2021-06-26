<div class="container-fluid">
    <div class="row">
     <?php  echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                   <h1><?php echo caption('Edit_Category');?></h1>
                </div>
            </div>

            <div class="panel-body">
                <!-- category form start -->
                <?php  $attr=array('class'=>"form-horizontal"); echo form_open(base_url('category/category/edit/'.$id), $attr);?>

                    <div class="form-group row">
                        <label class="col-md-2 control-label"><?php echo caption('Category_Name');?> <span class="req">&nbsp;*</span></label>
                        <div class="col-md-5">
                            <input type="text" name="category"  required value="<?php echo filter($category[0]->category); ?>" class="form-control">
                            <input type="hidden" name="oldCategory"  required value="<?php echo $category[0]->category; ?>" class="form-control">
                        </div>

                        <div class="col-md-2">
                            <div class="btn-group">
                                <input type="submit" value="<?php echo caption('Update');?>" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
               <?php  echo form_close();?>
                <!-- category form end -->
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
