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
</style>

<div class="container-fluid">
    <div class="row">

        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('Balance_Sheet') ;?></h1>
                </div>
            </div>

            <div class="panel-body none">

                <div class="row">
                    <?php $attr = array (
                        'class' => 'form-horizontal'
                    );
                    echo form_open('', $attr);
                    $totalCost = 0; ?>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('From') ;?></label>
                        <div class="input-group date col-md-5" id="datetimepickerFrom">
                            <input type="text" name="date[from]" class="form-control" placeholder="YYYY-MM-DD">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('To') ;?></label>
                        <div class="input-group date col-md-5" id="datetimepickerTo">
                            <input type="text" name="date[to]" class="form-control" placeholder="YYYY-MM-DD">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="col-xs-7">
                        <div class="btn-group pull-right">
                            <input type="submit" value="<?php echo caption('Show') ;?>" name="show" class="btn btn-primary">
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>

        <div class="panel-footer">&nbsp;</div>
        </div>

        <?php if($cost != NULL || $income != NULL || $purchase != NULL){ ?>
            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <div class="panal-header-title">
                        <h1 class=" pull-left"><?php echo caption('Result') ;?></h1>
                        <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i><?php echo caption('Print') ;?> </a>
                        <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;"><i class="fa fa-file-excel-o"></i></a>
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

                    <h4 class="hide text-center" style="margin-top: -10px;"><?php echo caption('Balance_Sheet') ;?></h4>
                   
                    <div class="row">
                      <?php if($cost != NULL) { ?>

                        <div class="col-md-12 box-width table-responsive">
                            <table class="table table-bordered ">
                                <tr>
                                    <th style="width: 50px;"><?php echo caption('SL') ;?></th>
                                    <th style="width: 48%;"><?php echo caption('Cost_Purpose') ;?></th>
                                    <th><?php echo caption('Date') ;?></th>
                                    <th><?php echo caption('Amount') ;?></th>
                                </tr>
                                <?php 
                                  $totalCost = 0;
                                    foreach ($cost as $key => $value) { 
                                      $totalCost += $value->amount; ?>
                                        <tr>
                                            <td><?php echo $key+1;?></td>
                                            <td><?php echo filter($value->purpose);?></td>
                                            <td><?php echo filter($value->date);?></td>
                                            <td><?php echo $value->amount;?></td>
                                        </tr>
                                <?php } ?>                               
                                <tr>
                                    <th colspan="3" class="text-right"><?php echo caption('Grand_Total') ;?></th>
                                    <th><?php echo $totalCost;?></th>
                                </tr>
                            </table>
                       </div>
                       <?php } ?>                       

                      <?php if($income != NULL) { ?>
                       <div class="col-md-12 box-width">
                        <div class="col-md-12 box-width table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 50px;"><?php echo caption('SL') ;?></th>
                                    <th style="width: 48%;"><?php echo caption('Income_Purpose') ;?></th>
                                    <th><?php echo caption('Payment') ;?></th>
                                    <th><?php echo caption('Due') ;?></th>
                                </tr>

                               <?php 
                                  $totalIncome=$totalDue=0;
                                    foreach ($income as $key => $value) { 
                                      $totalIncome += $value->paid; 
                                      $totalDue += $value->due; ?>
                                        <tr>
                                          <td><?php echo $key+1;?></td>
                                          <td><?php echo filter($value->status);?></td>
                                          <td><?php echo $value->paid;?></td>
                                          <td><?php echo $value->due;?></td>
                                        </tr>
                                <?php } ?>  

                                <tr>
                                    <th colspan="2" class="text-right"><?php echo caption('Grand_Total') ;?></th>
                                    <th><?php echo $totalIncome; ?></th>
                                    <th><?php echo $totalDue; ?></th>
                                </tr>
                            </table>
                       </div>
                    <?php } ?>

                     <?php if($purchase != NULL) { ?>
                        <div class="col-md-12 box-width">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 50px;"><?php echo caption('SL') ;?></th>
                                    <th style="width: 48%;"><?php echo caption('Product_Name') ;?> </th>
                                    <th><?php echo caption('Payment') ;?></th>
                                    <th><?php echo caption('Due') ;?></th>
                                </tr>
                                <?php 
                                  $totalPaid=$totalDue=0;
                                    foreach ($purchase as $key => $value) { 
                                       $totalPaid += $value->paid; 
                                       $totalDue += $value->due;
                                       ?>
                                        <tr>
                                          <td><?php echo $key+1;?></td>
                                          <td><?php echo filter($value->product_name);?></td>
                                          <td><?php echo $value->paid;?></td>
                                          <td><?php echo $value->due;?></td>
                                        </tr>
                                <?php } ?>                               
                                <tr>
                                    <th colspan="2" class="text-right"><?php echo caption('Grand_Total') ;?></th>
                                    <th><?php echo $totalPaid;?></th>
                                    <th><?php echo $totalDue;?></th>
                                </tr>
                            </table>
                       </div>
                       <?php } ?>
                    </div>
                 

                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th><?php echo caption('Total_Income') ;?></th>
                                    <th><?php echo caption('Total_Cost') ;?></th>
                                    <th><?php echo caption('Total_Balance') ;?></th>
                                    <th><?php echo caption('Status') ;?></th>
                                </tr>

                                <tr>
                                    <td><?php echo $totalIncome;?></td>
                                    <td><?php echo $totalCost + $totalPaid;?> </td>
                                    <td><?php echo $ballance=(($totalIncome)- ($totalCost + $totalPaid)); ?></td>
                                    <td>
                                     <?php $status=["Loss","Profit","Balanced"];?>
                                      <?php
                                        if($ballance < 0){
                                            echo $status[0];
                                        }else if($ballance > 0){
                                            echo $status[1];
                                        }else if($ballance == 0){
                                            echo $status[2];
                                        }else{
                                            echo "Unknown";
                                        }
                                      ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">&nbsp;</div>

            </div>
            <?php } ?>

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