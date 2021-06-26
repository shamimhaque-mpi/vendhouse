<style>
    .clearfix p{
        display: inline-block;
        float: right;
    }
    p span .sms{
        border: 1px solid transparent;
        width: 40px;
    }
</style>

<div class="container-fluid" ng-controller="CustomSMSCtrl">
    <div class="row">
	<?php echo $confirmation; ?>
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Custom_SMS'); ?></h1>
                </div>
            </div>

            <div class="panel-body">

                <?php 
                $attribute = array(
                    "class" => "form-horizontal",
                    "name" => ""
                );
                echo form_open("sale/due/send_custom_sms", $attribute); 
                ?>
                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo caption('Mobile'); ?> <span class="req">*</span></label>

                    <div class="col-md-9">
                        <textarea name="mobiles" class="form-control" cols="30" rows="4" required><?php echo $this->input->get('mob'); ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo caption('Message'); ?> <span class="req">*</span></label>

                    <div class="col-md-9">
                        <textarea 
                            name="message" class="form-control" 
                            placeholder="<?php echo caption('Type_your_Message_Maximum_1080_Characters'); ?>" 
                            cols="30" rows="4" ng-model="msgContant"
                            required></textarea>
                    </div>
                </div>

                <div class="clearfix">
                    <p>
                        <span>
                            <strong><?php echo caption('Total_characters'); ?></strong> 
                            <input name="total_characters" class="sms" type="text" ng-model="totalChar">
                        </span>
                        &nbsp;  
                        <span>
                            <strong><?php echo caption('SMS_Size'); ?></strong> 
                            <input class="sms" name="total_messages" type="text" ng-model="msgSize">
                        </span>
                    </p>
                </div>

                <div class="btn-group pull-right">
                    <input type="submit" value="<?php echo caption('Send'); ?>" name="sendSms" class="btn btn-primary">
                </div>
                <?php echo form_close(); ?>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

