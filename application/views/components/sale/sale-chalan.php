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

<div class="container-fluid">
    <div class="row">

    <?php echo $this->session->flashdata('confirmation'); ?>

        <div class="panel panel-default none">
            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1>Sale's Chalan</h1>
                </div>
            </div>

            <div class="panel-body">

                <?php
                $attr = array("class" => "form-horizontal");
                echo form_open("", $attr);
                ?>

                <div class="form-group">
                    <label class="col-md-2 control-label">Sale Type <span class="req"></span></label>
                    <div class="col-md-4">
                        <select  name="search[sale_type]"  tabindex="5" class="form-control">
                            <option value="">Select Sale Type</option>
                            <option value="Cash">Cash</option>
                            <option value="Credit">Credit</option>
                            <option value="Card">Card</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Voucher Number</label>
                    <div class="col-md-4">
                        <input type="text" name="search[voucher_number]" class="form-control" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Customer Name </label>
                    <div class="col-md-4">
                        <input type="text" name="search[name]" class="form-control" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo caption('Mobile'); ?> </label>
                    <div class="col-md-4">
                        <input type="text" name="search[mobile]" class="form-control" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo caption('From'); ?> </label>
                    <div class="input-group date col-md-4" id="datetimepickerFrom">
                        <input type="text" name="date[from]" class="form-control" placeholder="YYYY-MM-DD">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo caption('To'); ?> </label>
                    <div class="input-group date col-md-4" id="datetimepickerTo">
                        <input type="text" name="date[to]" class="form-control" placeholder="YYYY-MM-DD">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
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
                    <div class="pull-left">
                        <h1>
                            Show <?php echo caption('Result'); ?>
                        </h1>
                    </div>
                    <div class="pull-right">
                        <h1>
                            Total Voucher : <?php echo $total_voucher; ?>
                        </h1>
                    </div>
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

                <h4 class="text-center hide" style="margin-top: -10px;">Sale's Chalan</h4>

                <div class="table-responsive">
                <table class="table table-bordered table2">
                    <tr>
                        <th style="width: 50px;">SL</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                    </tr>

                    <?php
                       $total  = $totalQ = $totalQuantity = $totalAmount = $counter = 0;
                       foreach($result as $key => $row){ $counter++;
                           $info = $this->action->read("sale",array("code" => $row->code));
                           if($info != NULL){
                               foreach ($info as $key => $value) {
                                  $totalQuantity += $value->quantity;
                                  $total += ($value->quantity * $value->price);
                               }
                           }
                           $totalQ  += $totalQuantity;

                        $totalAmount += $total;
                    ?>
                    <tr>
                        <td> <?php echo $counter; ?> </td>
                        <td> <?php echo filter($row->product); ?> </td>
                        <td> <?php echo $totalQuantity; ?> </td>
                        <td> <?php echo $total; ?> </td>
                    </tr>
                     <?php
                         $total = $totalQuantity = 0;
                       }
                      ?>

                     <tr>
                      <th class="text-right" colspan="2">Total</th>
                      <td><strong><?php echo $totalQ; ?></strong></td>
                      <td><strong><?php echo $totalAmount; ?>&nbsp; TK</strong></td>
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
