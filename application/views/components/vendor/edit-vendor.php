<div class="container-fluid">
    <div class="row">
<?php //echo "<pre>"; print_r($emp_info); echo "</pre>"; ?>
<?php echo $confirmation; ?>

        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Edit_Supplier'); ?></h1>
                </div>
            </div>

            <div class="panel-body">
                <?php
                $attr=array(
                    "class"=>"form-horizontal"
                    );
                echo form_open_multipart("vendor/vendor/edit_vendor?id=".$this->input->get("id"),$attr);?>


                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Company_Name'); ?><span class="req">&nbsp;</span></label>
                        <div class="col-md-5">
                            <input type="text" name="company" value="<?php echo $vendor[0]->company; ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Contact_Person'); ?></label>
                        <div class="col-md-5">
                            <input type="text" name="name" value="<?php echo $vendor[0]->vendor_name; ?>" placeholder="Type Full Name" value="" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Mobile_Number'); ?> </label>
                        <div class="col-md-5">
                            <input type="text" name="mobile_number" value="<?php echo $vendor[0]->vendor_mobile; ?>" class="form-control" required>
                        </div>
                    </div>                    

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Address'); ?> </label>
                        <div class="col-md-5">
                            <textarea name="address" rows="4" class="form-control"><?php echo $vendor[0]->vendor_address; ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="btn-group pull-right">
                            <input type="submit" name="update_vendor" value="<?php echo caption('Update'); ?>" class="btn btn-success">
                        </div>
                    </div>
                    
                <?php echo form_close(); ?>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
