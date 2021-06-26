<div class="container-fluid">
    <div class="row">
    <?php echo $confirmation;
     ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Add_Supplier'); ?></h1>
                </div>
            </div>

            <div class="panel-body">


                <!-- horizontal form -->
                <?php
                    $attr=array("class"=>"form-horizontal");
                    echo form_open_multipart('', $attr);
                ?>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Company_Name'); ?><span class="req"> *</span></label>
                        <div class="col-md-5">
                            <input type="text" name="company" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Contact_Person'); ?><span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Mobile_Number'); ?> <span class="req">*</span></label>
                        <div class="col-md-5">
                            <input type="text" name="mobile" class="form-control" required>
                        </div>
                    </div>

                    

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Address'); ?> <span class="req">*</span></label>
                        <div class="col-md-5">
                            <textarea name="address" rows="4" class="form-control" required></textarea>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="btn-group pull-right">
                            <input type="submit" name="add_vendor" value="<?php echo caption('Save'); ?>" class="btn btn-primary">
                        </div>
                    </div>
                    
                <?php echo form_close(); ?>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
           
        $("#permanent_address").on("click",function(){
            
            if ($(this).is(":checked")) {
                $("#per_addr").val($("#pre_addr").val());
            }
            else{
                $("#per_addr").val("");
            }
        });
    });
</script>