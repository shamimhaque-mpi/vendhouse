<style>
    @media print{
        aside, nav, .panel-heading, .none, .panel-footer{
            display: none !important;
        }
        .panel{
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }
        .panel .box-width{
            width: 100%;
            float: left;
        }
        .hide{
            display: block !important;
        }
       
    }
    table tr td:nth-child(3), table tr td:nth-child(4), table tr td:nth-child(5), table tr td:nth-child(6), table tr td:nth-child(7){
        text-align: center;
    }
</style>

<div class="container-fluid">
    <div class="row">

        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Salary_Staement'); ?></h1>
                </div>
            </div>

            <div class="panel-body none">

                <div class="row">
                    <?php $attr = array (
                        'class' => 'form-horizontal'
                    );
                    echo form_open('', $attr); ?>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Year'); ?><span class="req">*</span></label>
                        <div class="col-md-3">
                            <select name="payment_year" class="form-control" required>
                                <option value="">-- <?php echo caption('Year'); ?> --</option>
                                <?php 
                                   for($i=date('Y')-1; $i <= date('Y')+2; $i++ ) { ?>
                                       <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                                   
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="payment_month" class="form-control" required>
                                <option value="">-- <?php echo caption('Month'); ?> --</option>
                                <?php  $months = config_item('months');
                                    foreach ($months as $key => $value) { ?>
                                    <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                <?php } ?>                                   
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('From'); ?></label>
                        <div class="input-group date col-md-5" id="datetimepickerFrom">
                            <input type="text" name="date[from]" class="form-control" placeholder="YYYY-MM-DD">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('To'); ?></label>
                        <div class="input-group date col-md-5" id="datetimepickerTo">
                            <input type="text" name="date[to]" class="form-control" placeholder="YYYY-MM-DD">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="col-xs-7">
                        <div class="btn-group pull-right">
                            <input type="submit" value="<?php echo caption('Show'); ?>" name="show" class="btn btn-primary">
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>

        <div class="panel-footer">&nbsp;</div>
        </div>

            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <div class="panal-header-title">
                        <h1 class=" pull-left"><?php echo caption('Result'); ?></h1>
                        <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print'); ?></a>
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
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <caption style="background: rgba(189, 187, 187, 0.1);text-align: center;color: #111;border: 1px solid #ddd;border-bottom: none;font-size: 18px;padding: 10px;">
                               <?php echo caption('Salary_Staement'); ?><br> January 26,2017 - July 26,2017 
                            </caption>
                            <tr>
                                <th width="45"><?php echo caption('SL'); ?></th>
                                <th width="260"><?php echo caption('Name'); ?></th>
                                <th class="text-center"><?php echo caption('Post'); ?></th>
                                <th class="text-center"><?php echo caption('Salary'); ?></th>
                                <th class="text-center"><?php echo caption('Bonus'); ?></th>
                            </tr>
                            <tr>
                                <td>01</td>
                                <td>Mustafizur Rahman</td>
                                <td>CTO</td>
                                <td>200000</td>
                                <td>6000</td>

                            </tr>
                            <tr>
                                <td>01</td>
                                <td>Mustafizur Rahman</td>
                                <td>CTO</td>
                                <td>200000</td>
                                <td>6000</td>

                            </tr>
                            <tr>
                                <td>01</td>
                                <td>Mustafizur Rahman</td>
                                <td>CTO</td>
                                <td>200000</td>
                                <td>6000</td>

                            </tr>
                            <tr>
                                <td>01</td>
                                <td>Mustafizur Rahman</td>
                                <td>CTO</td>
                                <td>200000</td>
                                <td>6000</td>

                            </tr>
                            
                            <tr>
                                <th colspan="3" class="text-right"><?php echo caption('Total'); ?></th>
                                <th class="text-center">200000</th>
                                <th class="text-center">200000</th>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="panel-footer">&nbsp;</div>

            </div>

        </div>
    </div>
</div>

<script>
    // linking between two date
    $('#datetimepickerFrom').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
    });
    $('#datetimepickerTo').datetimepicker({
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
