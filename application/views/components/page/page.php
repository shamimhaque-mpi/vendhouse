<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Add</h1>
                </div>
            </div>

            <div class="panel-body">


                <!-- horizontal form -->
                <?php echo $this->session->flashdata('confirmation'); ?>
                <?php
                $attr=array("class"=>"form-horizontal");
                echo form_open_multipart('', $attr);
                ?>

                <div class="form-group">
                    <label class="col-md-2 control-label"> Date <span class="req">*</span></label>
                    <div class="input-group date col-md-5" id="datetimepicker1">
                        <input type="text" name="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" <?php if($privilege == 'user'){ echo 'disabled'; } ?>  required>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Page<span class="req">*</span></label>
                    <div class="col-md-5">
                        <select class="form-control" name="page">
                        	<option value="about_us"><?php echo caption('About_us'); ?></option>
                            <option value="privacy_policy"><?php echo caption('Privacy_Policy'); ?></option>
                            <option value="faq"><?php echo caption('Questions_And_Answers'); ?></option>
                            <option value="order"><?php echo caption('Rules_Of_Order'); ?></option>
                            <option value="returns"><?php echo caption('Return_Policy'); ?></option>
                        	<option value="delivery"><?php echo caption('Delivery'); ?></option>
                        	<option value="terms_condition">Terms and Condition</option>
                        	<option value="our_service">Our Service</option>
                        	<option value="site_map">Site Map</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Description <span class="req">*</span></label>
                    <div class="col-md-10">
                        <textarea name="content" id="tinyTextarea" class="form-control" cols="30" rows="15"  style="font-size: 15px;"></textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="btn-group pull-right">
                        <input type="submit" name="save" value="Save" class="btn btn-primary">
                    </div>
                </div>

                <?php echo form_close(); ?>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
