<style>
    @media print{
        aside, nav, .none, .panel-heading, .panel-footer{
            display: none !important;
        }
        .panel{
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }
        .hide{
            display: block !important;
        }
    }
</style>

<div class="container-fluid" ng-controller="AllSaleCtrl" ng-cloak>
    <div class="row">

    <?php echo $this->session->flashdata('confirmation'); ?>

        <div class="panel panel-default none">
            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1>Search By</h1>
                </div>
            </div>

            <div class="panel-body">

                <?php
                $attr = array("class" => "form-horizontal");
                echo form_open("", $attr);
                ?>

                <div class="col-sm-7">
                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo caption('From'); ?> </label>
                        <div class="input-group date col-md-8" id="datetimepickerFrom">
                            <input type="text" name="date[from]" class="form-control" placeholder="YYYY-MM-DD">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label"><?php echo caption('To'); ?> </label>
                        <div class="input-group date col-md-8" id="datetimepickerTo">
                            <input type="text" name="date[to]" class="form-control" placeholder="YYYY-MM-DD">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="btn-group pull-right">
                        <input type="submit" name="show" value="<?php echo caption('Show'); ?>" class="btn btn-primary">
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>


        <?php if($result != null){ ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title ">
                    <h1 class="pull-left">All Due Collection</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print'); ?></a>
                </div>
            </div>

            <div class="panel-body">


                <div class="row hide">
                    <div class="view-profile">
                        <div class="institute">
                            <h2 class="text-center title" style="margin-top: 10px; font-weight: bold;">
                                <?php $print_header = config_item('heading'); echo $vheaderInfo[0]->name; ?>
                            </h2>
                            <h4 class="text-center" style="margin: 0;">
                                <?php $print_header = config_item('heading'); echo $vheaderInfo[0]->address; ?>
                            </h4>
                            <div class="col-md-12">&nbsp;</div>
                            <h5 class="text-center" style="margin: 0;">
                              Mobile: <?php $print_header = config_item('heading'); echo $vheaderInfo[0]->mobile; ?>
                            </h5>
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                    </div>
                </div>

                <hr class="hide" style="border-bottom: 2px solid #ccc; margin-top: 5px;">

                <h4 class="text-center hide" style="margin-top: -10px;"><?php echo caption('All_Sales'); ?></h4>

                <div class="table-responsive">
                <table class="table table-bordered table2">
                    <tr>
                        <th style="width: 50px;"><?php echo caption('SL'); ?></th>
                        <th width="100px"><?php echo caption('Date'); ?></th>
                        <th><?php echo caption('Voucher_number'); ?></th>
                        <th>Client Name</th>
                        <th>Mobile</th>
                        <th><?php echo caption('Grand_Total'); ?></th>
                        <th>Previous Paid</th>
                        <th>Amount</th>
                        <th><?php echo caption('Due'); ?></th>
                    </tr>

                    <?php
                    $total = $totalDiscount = $totalAmount = $totalGrandtotal =  $totalPaid = $totalDue = 0;
                    foreach($result as $key => $row){ ?>
                    <tr>
                        <td> <?php echo ($key + 1); ?> </td>
                        <td> <?php echo $row->date; ?> </td>
                        <td> <?php echo $row->voucher_number; ?> </td>
                        <td> <?php echo filter($row->name); ?> </td>
                        <td> <?php echo $row->mobile; ?> </td>
                        <td><?php echo $row->grand_total;  $totalGrandtotal += $row->grand_total; ?></td>
			            <td><?php echo $row->paid; $totalPaid +=$row->paid; ?></td>
			            <td><?php echo $row->amount; $totalAmount +=$row->amount; ?></td>
			            <td><?php echo $row->due;  $totalDue +=$row->due; ?></td>
                         
                    </tr>
                    <?php } ?>

                     <tr>
                      <th class="text-right" colspan="7">Total</th>
                      <!--<td><strong><?php echo $totalGrandtotal; ?>&nbsp; TK</strong></td>
                      <td><strong><?php echo $totalPaid; ?>&nbsp; TK</strong></td>-->
                      <td><strong><?php echo $totalAmount; ?>&nbsp; TK</strong></td>
                      <!--<td><strong><?php echo $totalDue; ?>&nbsp; TK</strong></td>-->
                      <td></td>
                    </tr>
                </table>
                </div>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
        <?php } ?>



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
