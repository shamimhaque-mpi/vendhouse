<div class="container-fluid">
    <div class="row">

        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('SMS_Report'); ?></h1>
                </div>
            </div>

            <div class="panel-body">


                <div>
                <?php 
                	$sent_sms=0;
                	foreach($all_sms as $sms){
                		$sent_sms+=$sms->total_messages;
                	}

                ?>
                    <p style="font-size: 16px; margin-bottom: 18px;" class="text-center"><?php echo caption('Total_SMS'); ?> <strong><?php echo $total_sms; ?></strong>, &nbsp; <?php echo caption('Total_Send_SMS'); ?> <strong><?php echo $sent_sms; ?></strong>, &nbsp; <?php echo caption('Remaining_SMS'); ?> <strong><?php echo $total_sms-$sent_sms; ?></strong></p>
                </div>

                <?php
	                $attr=array('class'=>'form-horizontal');
	                echo form_open('',$attr);
                ?>
                    
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo caption('Form'); ?></label>

                                <div class="input-group date col-md-9" id="datetimepickerSMSFrom">
                                    <input type="text" name="date_from" class="form-control" placeholder="YYYY-MM-DD">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo caption('To'); ?></label>

                                <div class="input-group date col-md-9" id="datetimepickerSMSTo">
                                    <input type="text" name="date_to" class="form-control" placeholder="YYYY-MM-DD">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>

                            </div>
                        </div>

                    </div>


                    <div class="btn-group pull-right">
                        <input type="submit" value="<?php echo caption('Show'); ?>" name="show_between" class="btn btn-primary">
                    </div> 

                <?php echo form_close(); ?>

            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>

        
        <?php if($sms_record!=null){?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Show_Result'); ?></h1>
                </div>
            </div>
		

            <div class="panel-body table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th><?php echo caption('SL'); ?></th>
                        <th><?php echo caption('Date'); ?></th>
                        <th><?php echo caption('Mobile'); ?></th>
                        <th><?php echo caption('Message'); ?></th>
                    </tr>
		<?php foreach($sms_record as $key=>$all_sms){?>
                    <tr>
                        <td><?php echo $key+1; ?></td>
                        <td><?php echo $all_sms->delivery_date; ?></td>
                        <td><?php echo $all_sms->mobile; ?></td>
                        <td><?php echo $all_sms->message; ?></td>
                    </tr>
                 <?php } ?>
                </table>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
        <?php } ?>
    </div>
</div>

<script>
    // linking between two date
    $('#datetimepickerSMSFrom').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
    });
    $('#datetimepickerSMSTo').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
    });
    $("#datetimepickerSMSFrom").on("dp.change", function (e) {
        $('#datetimepickerSMSTo').data("DateTimePicker").minDate(e.date);
    });
    $("#datetimepickerSMSTo").on("dp.change", function (e) {
        $('#datetimepickerSMSFrom').data("DateTimePicker").maxDate(e.date);
    });
</script>