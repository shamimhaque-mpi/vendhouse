<style>
    @media print{
        aside, nav, .none, .panel-footer{
            display: none !important;
        }
       /*.panel{
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }*/
        .hide{
            display: block !important;
        }
        .none{
            display: none;
        }
        .balance_sheet label{
            padding-right: 15px;
            padding-left: 15px;
        }
        .print-border-none {
            border: none;
        }
        .form-group {
            margin-bottom: 0;
        }
        .form-control {
            border: none;
            padding: 0;
        }
        .view-profile {
            margin-top: -100px;
        }
    }

    .balance_sheet label{
        /*text-align: right;*/
        padding: 0 ;    
        color: #777;
    }
    .upertext{
        text-transform: uppercase;
    }
    .balance_report .panel-heading{
        font-weight: bold;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default none">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1>Search Balance</h1>
                </div>
            </div>

            <div class="panel-body">

                <?php
                echo $this->session->flashdata('deleted');

                $attr = array("class" => "form-horizontal");
                echo form_open("", $attr);
                ?>


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
                        <input type="submit" name="search" value="<?php echo caption('Show'); ?>" class="btn btn-primary">
                    </div>
                </div>
                    
                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
        
        <!--pre><?php //print_r($result);?></pre-->


        <div class="panel panel-default print-border-none print-panel">
            <div class="panel-heading none">
                <div class="panal-header-title">
                    <h1 class="pull-left">Balance Sheet 
                    <span style="display: block;"><b>Required Print Setting:</b> Layout:Landscape, Paper Size:A4, Margins:None, Scale:79</span> </h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print'); ?></a>                    
                </div>                
            </div>            

            <div class="panel-body">
                <!-- Print Banner -->
    
                <div class="row hide">
                    <div class="view-profile">

                        <div class="institute">
                            <h2 class="text-center title" style="font-weight: bold;">
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
                <div class="balance_report">
                    <div class="col-sm-4">

                            <div class="panel panel-default">
                              <div class="panel-heading upertext">Sales Section</div>
                                <div class="panel-body">   

                                    <!--div class="form-group balance_sheet">
                                        <label class="col-sm-5 control-label">Sales Income </label>
                                        <div class="input-group  col-sm-7" >
                                            <input type="number"  class="form-control" value="0.00">
                                        </div>
                                    </div-->

                                    <div class="form-group balance_sheet">
                                        <label class="col-sm-5 control-label">Discount </label>
                                        <div class="input-group  col-sm-7" >
                                            <input type="number"  class="form-control" value="<?php echo $discount; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group balance_sheet">
                                        <label class="col-sm-5 control-label">Vat </label>
                                        <div class="input-group  col-sm-7" >
                                            <input type="number"  class="form-control" value="<?php echo $vat; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group balance_sheet">
                                        <label class="col-sm-5 control-label">Dues </label>
                                        <div class="input-group  col-sm-7" >
                                            <input type="number"  class="form-control" value="<?php echo $due; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group balance_sheet">
                                        <label class="col-sm-5 control-label">Sales Paid </label>
                                        <div class="input-group  col-sm-7" >
                                            <input type="number"  class="form-control" value="<?php echo $paid;  ?>">
                                        </div>
                                    </div>

                                    <!--div class="form-group balance_sheet">
                                        <label class="col-sm-5 control-label">S.P </label>
                                        <div class="input-group  col-sm-7" >
                                            <input type="number"  class="form-control" value="0.00">
                                        </div>
                                    </div-->

                                    <div class="form-group balance_sheet">
                                        <label class="col-sm-5 control-label">Sales Return </label>
                                        <div class="input-group  col-sm-7" >
                                            <input type="number"  class="form-control" value="<?php echo $return; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group balance_sheet">
                                        <label class="col-sm-5 control-label">Due Collection </label>
                                        <div class="input-group  col-sm-7" >
                                            <input type="number"  class="form-control" value="<?php echo $due_collection; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group balance_sheet">
                                        <label class="col-sm-5 control-label">Item Less</label>
                                        <div class="input-group  col-sm-7" >
                                            <input type="number"  class="form-control" value="0.00">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="panel panel-default">
                              <div class="panel-heading upertext">Purchase Section</div>
                                <div class="panel-body">   

                                    <div class="form-group balance_sheet">
                                        <label class="col-sm-5 control-label">Purchase </label>
                                        <div class="input-group  col-sm-7" >
                                            <input type="number"  class="form-control" value="<?php echo $purchase_total; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group balance_sheet">
                                        <label class="col-sm-5 control-label">Purchase Paid</label>
                                        <div class="input-group  col-sm-7" >
                                            <input type="number"  class="form-control" value="<?php echo $purchase_paid; ?>">
                                        </div>
                                    </div>
                                    <!--div class="form-group balance_sheet">
                                        <label class="col-sm-5 control-label">Paid To Supplier </label>
                                        <div class="input-group  col-sm-7" >
                                            <input type="number"  class="form-control" value="0.00">
                                        </div>
                                    </div>
                                    <div class="form-group balance_sheet">
                                        <label class="col-sm-5 control-label">Purchase Rutern</label>
                                        <div class="input-group  col-sm-7" >
                                            <input type="number"  class="form-control" value="0.00">
                                        </div>
                                    </div-->
                                </div>
                            </div>


                            <div class="panel panel-default">
                              <div class="panel-heading upertext">Expenditure</div>
                                <div class="panel-body">   

                                    <div class="form-group balance_sheet">
                                        <label class="col-sm-5 control-label">Expenditure </label>
                                        <div class="input-group  col-sm-7" >
                                            <input type="number"  class="form-control" value="<?php echo $expenditure; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group balance_sheet">
                                        <label class="col-sm-5 control-label">Return Profit</label>
                                        <div class="input-group  col-sm-7" >
                                            <input type="number"  class="form-control" value="0.00">
                                        </div>
                                    </div>
                                    <div class="form-group balance_sheet">
                                        <label class="col-sm-5 control-label">Salary </label>
                                        <div class="input-group  col-sm-7" >
                                            <input type="number"  class="form-control" value="0.00">
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                          <div class="panel-heading upertext">Other Income</div>
                            <div class="panel-body">   

                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">Income</label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="<?php echo $other_income; ?>">
                                    </div>
                                </div>
                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">Transaction (+)</label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="0.00">
                                    </div>
                                </div>
                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">Transaction (-)</label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="0.00">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                          <div class="panel-heading upertext">Busniess Status</div>
                            <div class="panel-body">   

                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">Stock Value </label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="<?php echo $stock_value; ?>">
                                    </div>
                                </div>
                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">Customer b/s</label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="0.00">
                                    </div>
                                </div>
                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">Supplier b/s </label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="0.00">
                                    </div>
                                </div>
                                <!-- <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">Stock Value </label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="0.00">
                                    </div>
                                </div> -->
                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">Borow /+ row </label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="0.00">
                                    </div>
                                </div>
                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">Bank Balance</label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="0.00">
                                    </div>
                                </div>
                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">Opening Balance</label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="0.00">
                                    </div>
                                </div>
                                <div class="form-group balance_sheet">
                                    <div class="input-group  col-sm-12" style="text-align: center;" >
                                        <input type="submit"  class="btn btn-primary none" style="width: 100px;margin-right: 10px;" value="Balance">
                                        <input type="submit"  class="btn btn-primary none" style="width: 100px; " value="Balance">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="panel panel-default">
                          <div class="panel-heading upertext">Balance</div>
                            <div class="panel-body">   

                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">N.P </label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="0.00">
                                    </div>
                                </div>
                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">Cash </label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="0.00">
                                    </div>
                                </div>
                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">Balance </label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="0.00">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                          <div class="panel-heading upertext">Admin Use Only</div>
                            <div class="panel-body">   

                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">Date </label>
                                   <div class="input-group date  col-sm-7" id="datetimepickeradmin">
                                        <input type="text" name="date[to]" class="form-control" value="<?php echo date('Y-m-d'); ?>" placeholder="YYYY-MM-DD" <?php if($privilege == 'user'){ echo 'disabled'; } ?> >
                                        <span class="input-group-addon none">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label"> - Rcv'd / + Paid </label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="0.00" <?php if($privilege == 'user'){ echo 'disabled'; } ?>>
                                    </div>
                                </div>

                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">Sales Income </label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="0.00" <?php if($privilege == 'user'){ echo 'disabled'; } ?> >
                                    </div>
                                </div>

                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">Description</label>
                                    <div class="col-sm-7">
                                        <select  class="form-control" <?php if($privilege == 'user'){ echo 'disabled'; } ?>>
                                            <option value="" selected disabled>Select Option</option>
                                            <option value="">One</option>>
                                            <option value="">One</option>>
                                            <option value="">One</option>>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label"></label>
                                    <div class="col-sm-7">
                                        <input type="submit" name="" class="btn btn-primary none" style="font-size: 12px;width: 100%;margin: 10px 0; " value="Admin Receive/Paid">
                                    </div>
                                </div>

                                <div class="form-group balance_sheet">
                                    <div class="input-group  col-sm-12" style="text-align: center;" >
                                        <input type="submit"  class="btn btn-primary none" style="margin-right: 10px;" value="Close Balance">
                                        <input type="submit"  class="btn btn-primary none"  value="Re Balance">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                          <div class="panel-heading upertext">Admin</div>
                            <div class="panel-body">   

                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">Admin Paid </label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="0.00" <?php if($privilege == 'user'){ echo 'disabled'; } ?>>
                                    </div>
                                </div>

                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">Admin Received </label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="0.00" <?php if($privilege == 'user'){ echo 'disabled'; } ?>>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="panel panel-default">
                          <div class="panel-heading upertext">Lone And Borow</div>
                            <div class="panel-body">   

                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">Borow </label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="0.00">
                                    </div>
                                </div>
                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">row </label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="0.00">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="panel panel-default">
                          <div class="panel-heading upertext">Transaction</div>
                            <div class="panel-body">   

                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label"> -----</label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="0.00">
                                    </div>
                                </div>

                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">Withdraw </label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="0.00">
                                    </div>
                                </div>

                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">Bank To Cash</label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="0.00">
                                    </div>
                                </div>

                                <div class="form-group balance_sheet">
                                    <label class="col-sm-5 control-label">Cash To Cash </label>
                                    <div class="input-group  col-sm-7" >
                                        <input type="number"  class="form-control" value="0.00">
                                    </div>
                                </div>

                            </div>
                        </div>

                       </div>
                </div>

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
    $('#datetimepickeradmin').datetimepicker({
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