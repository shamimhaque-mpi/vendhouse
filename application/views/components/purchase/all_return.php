<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />

<style type="text/css">
@media print{
    aside, nav, .none, .panel-heading, .panel-footer{display: none !important;}
    .panel{
        border: 1px solid transparent;
        left: 0px;
        position: absolute;
        top: 0px;
        width: 100%;
    }
    .hide{display: block !important;}
}
.table-title{
    font-size: 20px;
    color: #333;
    background: #f5f5f5;
    text-align:center;
    border-left: 1px solid #ddd;
    border-top: 1px solid #ddd;
    border-right: 1px solid #ddd;
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default none">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1>All Purchase Return</h1>
                </div>
            </div>

            <div class="panel-body">
                <?php
                echo $this->session->flashdata('deleted');
                $attr = array("class" => "form-horizontal");
                echo form_open("purchase/productReturn/allReturn", $attr);
                ?>
                <div class="form-group">
                    <!-- <label class="col-md-2 control-label">Voucher No </label> -->
                    <div class="col-md-3">
                        <input type="text" name="search[product_code]" class="form-control" placeholder="Product Code">
                    </div>

                    <!-- <label class="col-md-2 control-label">Supplier Name </label> -->
                    <!--<div class="col-md-3">
                        <select name="search[party_code]" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="" selected disabled>-- Select Supplier Name --</option>
                            <?php if($allParty != null){ foreach($allParty as $key => $row){ ?>
                            <option value="<?php echo $row->code; ?>">
                                <?php echo filter($row->name)." ( ".$row->address." ) "; ?>
                            </option>
                            <?php }} ?>
                        </select>
                    </div>-->

                    <!-- <label class="col-md-2 control-label">From </label> -->
                    <div class="col-md-3">
                        <div class="input-group date" id="datetimepickerFrom">
                            <input type="text" name="date[from]" class="form-control" placeholder="From">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <!-- <label class="col-md-2 control-label">To </label> -->
                    <div class="col-md-3">
                        <div class="input-group date" id="datetimepickerTo">
                            <input type="text" name="date[to]" class="form-control" placeholder="To">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="btn-group">
                        <input type="submit" name="show" value="Show" class="btn btn-primary">
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>

        <?php  if($result != null){ ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title ">
                    <h1 class="pull-left">Show Result</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>

            <div class="panel-body">
                <!-- Print banner -->
                <!--<img class="img-responsive print-banner hide" src="<?php echo site_url($banner_info[0]->path); ?>">-->

                <h4 class="text-center hide" style="margin-top: 0px;">All Purchase Return</h4>
                
                  <table class="table table-bordered table2">
                        <tr>
                            <th>SL</th>
                            <th>Date</th>
                            <th>Product Code</th>
                            <th>Quantity</th>
                            <th>Purchase Price (TK)</th>
                            <!--th>Previous Balance (TK)</th-->
                            <th>Return Amount</th>
                            <!--th>Current Balance (TK)</th-->
                            <th class="none">Action</th>
                        </tr>

                       <?php
                            $total_quantity = 0.00;
                            $total_purchase_price = 0.00;
                            $total_previous_balance = 0.00;
                            $total_grand_total = 0.00;
                            $total_current_balance = 0.00;
                          foreach($result as $key => $val){
                              $productInfo  = $this->action->read('stock',array('code' => $val->product_code));
                        ?>
                        <tr>
                            <td style="width: 40px;"><?php echo $key+1; ?></td>
                            <td><?php echo $val->date; ?></td>
                            <td><?php echo ($productInfo)? filter($productInfo[0]->name) : ""; ?></td>
                            <td><?php echo $val->quantity.' '.$val->unit;  $total_quantity += $val->quantity; ?></td>
                            <td><?php echo f_number($val->purchase_price); $total_purchase_price += $val->purchase_price; ?></td>
                            <!--td><?php echo f_number($val->previous_balance);  $total_previous_balance += $val->previous_balance; ?></td-->
                            <td><?php echo f_number($val->grand_total);  $total_grand_total += $val->grand_total; ?></td>
                            <!--td><?php echo f_number($val->current_balance);  $total_current_balance += $val->current_balance; ?></td-->

                            <td class="none" style="width: 60px;">
                                <?php if ($val->voucher_no != null){ ?>
                                <a title="View" class="btn btn-primary" href="<?php echo site_url('purchase/productReturn/view?vno=' . $val->voucher_no); ?>">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                <?php } ?>
                                <!--<a title="Edit" class="btn btn-warning" href="<?php echo site_url('purchase/editPurchase?vno=' . $val->voucher_no); ?>">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                <a title="Return" class="btn btn-info" href="<?php echo site_url('purchase/returnPurchase?vno=' . $val->voucher_no); ?>">
                                    <i class="fa fa-undo" aria-hidden="true"></i>
                                </a>
                                <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this Data?');" href="<?php echo site_url('purchase/purchase/delete_purchase?vno=' . $val->voucher_no); ?>">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>-->
                            </td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <th colspan="3" class="text-right">Total = </th>
                            <th><?php echo $total_quantity; ?></th>
                            <th><?php echo $total_purchase_price .' TK'; ?></th>
                            <!--th><?php echo $total_previous_balance.' TK'; ?></th-->
                            <th><?php echo $total_grand_total.' TK'; ?></th>
                            <!--th><?php echo $total_current_balance.' TK'; ?></th-->
                            <th>&nbsp;</th>
                        </tr>
                  </table>
                 </div>
              <div class="panel-footer">&nbsp;</div>
           </div>
        <?php } ?>
    </div>
</div>

<script type="text/javascript">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>