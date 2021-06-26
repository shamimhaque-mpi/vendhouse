<style>
    @media print{
        aside, nav, .none, .panel-heading, .panel-footer {
            display: none !important;
        }
        .panel{
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }
        .panel .hide{
            display: block !important;
        }
        .title{
            font-size: 25px;        
        }
    }
</style>

<div class="container-fluid">
    <div class="row">

        <div class="panel panel-default none">

            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Custom_Search') ;?></h1>
                </div>
            </div>

            <div class="panel-body">
                <?php
                $attr=array("class"=>"form-horizontal");
               	echo  form_open('',$attr);
                ?>

                <div class="col-sm-5">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo caption('Bank_Name') ;?> </label>
                        <div class="col-md-8">
                            <select name="search[bank]" class="form-control">
                                <option value="">-- <?php echo caption('Select') ;?> --</option>
                               <?php foreach ($bank_list as $key => $value) { ?>
                               <option value="<?php echo $value->bank_name; ?>"><?php echo str_replace("_"," ",$value->bank_name); ?></option>
                               <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo caption('Account_Number') ;?> </label>
                        <div class="col-md-8">
                            <input type="text" name="search[account_number]" placeholder="Maximum 15 Digit" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo caption('From') ;?> <span class="req">*</span></label>
                        <div class="input-group date col-md-8" id="datetimepickerSMSFrom">
                            <input type="text" name="date[from]" class="form-control" placeholder="YYYY-MM-DD">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo caption('To') ;?> <span class="req">*</span></label>
                        <div class="input-group date col-md-8" id="datetimepickerSMSTo">
                            <input type="text" name="date[to]" class="form-control" placeholder="YYYY-MM-DD">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="btn-group pull-right">
                        <input type="submit" value="<?php echo caption('Show') ;?>" name="custom_show" class="btn btn-primary">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>

	    <?php if($bank_record!=null){?>
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title">
                    <h1 class="pull-left"><?php echo caption('Result') ;?></h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print') ;?> </a>
                </div>
            </div>

            <div class="panel-body">
                <!-- Print Banner -->
         
                <div class="row hide">
                    <div class="view-profile">

                        <div class="institute">
                            <h2 class="text-center title" style="margin-top: 10px; font-weight: bold;">
                                <?php $print_header = config_item('heading');echo $print_header['title']; ?>
                            </h2>
                            <h4 class="text-center" style="margin: 0;">
                                <?php $print_header = config_item('heading');echo $print_header['place']; ?>
                            </h4>
                            <h4 class="text-center" style="margin: 0;">
                              Mobile: <?php $print_header = config_item('heading');echo $print_header['mobile']; ?>
                            </h4>
                        </div>                          
                      
                    </div>
                </div>
                <hr class="hide" style="border-bottom: 2px solid #ccc; margin-top: 5px;">

                <h4 class="hide text-center"  style="margin-top: -10px;"><?php echo caption('Transaction') ;?></h4>
                
                <table class="table table-bordered">
                    <tr>
                        <th><?php echo caption('SL') ;?></th>
                        <th><?php echo caption('Date') ;?></th>
                        <th><?php echo caption('Transaction_Type') ;?></th>
                        <th><?php echo caption('Bank_Name') ;?></th>
                        <th><?php echo caption('Account_Number') ;?></th>
                        <th><?php echo caption('Transaction_By') ;?></th>
                        <th><?php echo caption('Amount') ;?></th>
                    </tr>

                    <?php foreach ($bank_record as $key => $transaction) { ?>
                    <tr>
                        <td><?php echo $key+1; ?></td>
                        <td><?php echo $transaction->transaction_date; ?></td>
                        <td><?php echo $transaction->transaction_type; ?></td>
                        <td><?php echo str_replace("_", " ", $transaction->bank); ?></td>
                        <td><?php echo $transaction->account_number; ?></td>
                        <td><?php echo $transaction->transaction_by; ?></td>
                        <td><?php echo $transaction->amount; ?></td>
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

