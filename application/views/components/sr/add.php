<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />
<div class="container-fluid" ng-controller="AddClientCtrl">
    <div class="row">
        <?php echo $confirmation; ?>

        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Add New SR</h1>
                </div>
            </div>

            <div class="panel-body">
                <!-- horizontal form -->
                <?php
                $attr = array("class" => "form-horizontal");
                echo form_open_multipart('', $attr); ?>
                <div class="form-group">
                    <label class="col-md-2 control-label">SR ID<span class="req">*</span></label>
                    <div class="col-md-6">
                        <input type="text" name="code" class="form-control" value="<?php echo $sr_id; ?>" readonly>
                    </div>
                </div>
 
                <div class="form-group">
                    <label class="col-md-2 control-label">SR Name <span class="req">*</span></label>
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
    
                <div class="form-group">
                    <label class="col-md-2 control-label">Username <span class="req">*</span></label>
                    <div class="col-md-6">
                        <input type="text" name="username" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Password <span class="req">*</span></label>
                    <div class="col-md-6">
                        <input type="text" name="pass" class="form-control" required>
                    </div>
                </div>



                <div class="form-group">
                    <label class="col-md-2 control-label">Mobile <span class="req">*</span></label>
                    <div class="col-md-6">
                        <input type="text" name="contact" class="form-control"  required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Field<span class="req">*</span></label>
                    <div class="col-md-6">
                         <select name="field" class="selectpicker form-control" data-show-subtext="true" data-live-search="true" required>
                            <option value="" selected>Select Field Name</option>
                            <?php foreach($fieldInfo as $value){?>
                            <option value="<?php echo $value->field_name; ?>"><?php echo $value->field_name; ?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>


                <!-- <div class="form-group">
                    <label class="col-md-2 control-label">Address &nbsp;</label>
                    <div class="col-md-6">
                        <textarea name="address" cols="15" rows="5" class="form-control"></textarea>
                    </div>
                </div> -->

                <div class="form-group">
                    <label class="col-md-2 control-label">Target  <span class="req">*</span></label>
                    <div class="col-md-6  input-group">
                        <input type="number" name="target" min="0" value="0" class="form-control" step="any" required>
                        <div class="input-group-addon">TK / month</div>
                    </div>
                </div>

                <div class="col-md-8">
	                    <div class="btn-group pull-right">
	                        <input type="submit" name="add" value="Save" class="btn btn-primary">
	                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js" ></script>