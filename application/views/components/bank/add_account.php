<div class="container-fluid">
    <div class="row">
	<?php echo $confirmation; ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Add_Account') ;?></h1>
                </div>
            </div>

            <div class="panel-body">
                <!-- horizontal form -->
                
                <?php
	                $attr=array('class'=>'form-horizontal');
	                echo form_open('',$attr);
                ?>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Date') ;?> <span class="req">*</span></label>
                        
                        <div class="input-group date col-md-5" id="datetimepicker1">
                            <input type="text" name="date" placeholder="YYYY-MM-YY" class="form-control" value="<?php echo date("Y-m-d");?>" <?php if($privilege == 'user'){ echo 'disabled'; } ?> required>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Bank_Name') ;?> <span class="req">*</span></label>
                        
                        <div class="col-md-5">
                            <select name="bank_name" class="form-control" required>
                                <option value="">-- <?php echo caption('Select') ;?> --</option>
                                <?php foreach($all_bank as $key => $bank){?>
                                    <option value="<?php echo $bank->bank_name; ?>"><?php echo $bank->bank_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Account_Holder_Name') ;?><span class="req">*</span></label>
                        
                        <div class="col-md-5">
                            <input type="text" name="account_holder_name" placeholder="<?php echo caption('Type_Account_Holder_Name') ;?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Account_Number') ;?> <span class="req">*</span></label>
                        
                        <div class="col-md-5">
                            <input type="text" name="account_number" placeholder="<?php echo caption('Maximum') ;?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Previous_Balance') ;?> <span class="req">*</span></label>
                        
                        <div class="col-md-5">
                            <input type="text" name="previous_balance" placeholder="<?php echo caption('BDT') ;?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="btn-group pull-right">
                            <input type="submit" value="<?php echo caption('Save') ;?>" name="add_account" class="btn btn-primary">
                        </div>
                    </div>

                <?php echo form_close(); ?>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

