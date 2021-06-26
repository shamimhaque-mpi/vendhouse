<style>
    @media print{
        aside{
            display: none !important;
        }
        nav{
            display: none;
        }
        .panel{
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }
        .none{
            display: none;
        }
        .panel-heading{
            display: none;
        }

        .panel-footer{
            display: none;
        }
        .panel .hide{
            display: block !important;
        }
        .title{
            font-size: 25px;
        }
        .order-table tr td select{
            border: 1px solid transparent !important;
        }
        table tr th,table tr td{
            font-size: 12px;
        }
    }
</style>

<div class="container-fluid">
    <div class="row">
	     <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title">
                    <h1>Supplier Report</h1>
                </div>
            </div>
            <?php
                $attribute = array('name' => '','class' => 'form-horizontal');
                echo form_open('', $attribute);
            ?>
            <div class="panel-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-5">
                            <label class="col-md-3 control-label"><?php echo caption('Form'); ?></label>
                            <div class="input-group date col-md-9" id="datetimepickerFrom">
                                <input type="text" name="date[from]" class="form-control" placeholder="YYYY-MM-DD">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-md-5">
                            <label class="col-md-3 control-label"><?php echo caption('To'); ?></label>
                            <div class="input-group date col-md-9" id="datetimepickerTo">
                                <input type="text" name="date[to]" class="form-control" placeholder="YYYY-MM-DD">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="btn-group">
                            <input type="submit" value="Show" name="show" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
            <?php echo form_close(); ?>
            <div class="panel-footer">&nbsp;</div>
        </div>
	    
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title">
                    <h1 class="pull-left">Supplier Report</h1>
                    <a class="btn btn-primery pull-right"
                        style="font-size: 14px; margin-top: 0;"
                        onclick="window.print()">
                        <i class="fa fa-print"></i> <?php echo caption('Print'); ?>
                    </a>
                </div>
            </div>

            <div class="panel-body">

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


                <hr class="hide" style="border-bottom: 1px solid #ccc; margin-top: 5px;">

                <h4 class="hide text-center" style="margin-top: -10px;"><?php echo caption('All_Order'); ?></h4>

                <table class="table table-bordered order-table" >
                    <tr>
                        <th style="width: 35px;"><?php echo caption('SL'); ?></th>
                        <th style="width: 100px;"><?php echo caption('Date'); ?></th>
                        <th>Supplier Name</th>
                        <th style="width: 90px;"><?php echo caption('Order_No'); ?></th>
                        <th><?php echo caption('Amount'); ?></th>
                        <th><?php echo caption('Discount'); ?></th>
                        <th>SR Commission</th>
                    </tr>

                    <?php
                    $totalAmount = 0.00;
                    $totalDiscount = 0.00;
                    $totalCommission = 0.00;
                    foreach($allOrder as $key => $value){
                        $productInfo = $this->action->read('products', array('product_code' => $value->code));
                        $supplierInfo = $this->action->read('users', array('id' => $productInfo[0]->user_id));
                        if($supplierInfo[0]->sr != null || $supplierInfo[0]->sr != ''){
                            $srCommission = $value->grand_total*.1;
                        }else{$srCommission = 0.00;}
                        $totalCommission += $srCommission;
                        $totalAmount += $value->grand_total;
                        $totalDiscount += $value->discount;
                    ?>
                    <tr>
                        <td><?php echo $key+1; ?></td>
                        <td><?php echo $value->order_date; ?></td>
                        <td><?php echo filter($supplierInfo[0]->name); ?></td>
                        <td><?php echo $value->order_no; ?></td>
                        <td><?php echo $value->grand_total; ?></td>
                        <td><?php echo $value->discount; ?></td>
                        <td><?php echo $srCommission; ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th colspan="4" class="text-right">Total = </th>
                        <th><?php echo $totalAmount.' Tk'; ?></th>
                        <th><?php echo $totalDiscount.' Tk'; ?></th>
                        <th><?php echo $totalCommission.' TK'; ?></th
                        <th class="none">&nbsp;</th>
                    </tr>

                </table>

            </div>

            <div class="panel-footer">&nbsp;</div>
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