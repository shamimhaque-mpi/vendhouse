<style>
    @media print{
        aside, .none, .panel-heading, .panel-footer {display: none !important;}
        nav {display: none;}
        .panel{
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }
        .panel .hide{display: block !important;}
        .title {font-size: 25px;}
        .order-view {margin-top: 15px;}
        .order-view select{border: transparent !important;}
        table tr th,table tr td, p {font-size: 12px;}
        .print_width {display: flex;}
        .print_width .col-md-6 {width: 50% !important;}
        .page_break {min-height: 100vh;}
    }
    .print_width {margin-bottom: 12px;}
    .print_width {margin-top: 5px;}
    .order-view tr th {width: 20%;}
    .order-view tr th, .order-view tr td{
        border: 1px solid transparent !important;
        padding: 0 !important;
    }
    .signature {width: 100%;}
    .signature span {
        margin-top: 65px;
        float: right;
        display: block;
        width: 165px;
        padding: 6px 0;
        text-align: center;
        border-top: 1px dashed #000;
        letter-spacing: 2px;
        word-spacing: 4px;
        color: #000;
    }
</style>
<?php
    $footer_info=json_decode($meta->footer,true);
?>

<div class="container-fluid">
    <div class="row">
	<?php echo $confirmation; ?>
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title">
                    <h1 class="pull-left"><?php echo('Order View'); ?></h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print'); ?></a>
                </div>
            </div>
            <div class="panel-body page_break">
                <div class="row hide">
                    <div class="view-profile">
                        <div class="institute">
                            <h2 class="text-center title" style="margin-top: 10px; font-weight: bold;">
                                <?php $print_header = config_item('heading');echo $print_header['title']; ?>
                            </h2>
                            <h4 class="text-center" style="margin: 0 0 8px;">
                                <?php echo $footer_info['addr_address']; ?>
                            </h4>
                            <h5 class="text-center" style="margin: 0;">
                                Mobile: <?php echo $footer_info['admin_mobile'].', '.$footer_info['addr_moblile']; ?>
                            </h5>
                        </div>
                    </div>
                </div>
                <hr class="hide" style="border-bottom: 2px solid #ccc; margin: 15px 0;">

                <!--h4 class="hide text-center" style="margin-top: -10px;">সকল অর্ডার</h4-->

                <div class="row print_width">
                    <div class="col-md-6">
                        <div class="row">
                            <label class="control-label col-xs-6"><?php echo caption('Name'); ?></label>
                            <div class="col-xs-6">
                                <p><?php echo filter($records[0]->name); ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="control-label col-xs-6"><?php echo caption('Mobile_Number'); ?></label>
                            <div class="col-xs-6">
                                <p><?php echo $records[0]->mobile; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="control-label col-xs-6"><?php echo caption('Address'); ?></label>
                            <div class="col-xs-6">
                                <p><?php echo $records[0]->address; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="control-label col-xs-6">Payment Method</label>
                            <div class="col-xs-6">
                                <p><?php echo filter($records[0]->method); ?></p>
                            </div>
                        </div>
                        <?php if($records[0]->account != ''){ ?>
                        <div class="row">
                            <label class="control-label col-xs-6">Transaction Mobile</label>
                            <div class="col-xs-6">
                                <p><?php echo $records[0]->transaction_mobile; ?></p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <label class="control-label col-xs-6"><?php echo caption('Order_No'); ?></label>
                            <div class="col-xs-6">
                                <p><?php echo $records[0]->order_no; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="control-label col-xs-6"><?php echo caption('Date'); ?></label>
                            <div class="col-xs-6">
                                <p><?php echo $records[0]->order_date; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="control-label col-xs-6"><?php echo caption('Order') .' '. caption('Time'); ?></label>
                            <div class="col-xs-6">
                                <p><?php echo $records[0]->time; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="control-label col-xs-6"><?php echo caption('Delivery') .' '. caption('Time'); ?></label>
                            <div class="col-xs-6">
                                <p><?php echo $records[0]->delivery_time; ?></p>
                            </div>
                        </div>
                        
                        <?php if($records[0]->account != ''){ ?>
                        <div class="row">
                            <label class="control-label col-xs-6">Transaction ID</label>
                            <div class="col-xs-6">
                                <p><?php echo $records[0]->account; ?></p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <table class="table table-bordered order-table">
                    <tr>
                        <th style="width: 35px;"><?php echo caption('SL'); ?></th>
                        <th width="150"><?php echo caption('Product_Code'); ?></th>
                        <th><?php echo caption('Product_Name'); ?></th>
                        
                        <!--<th>Product Color</th>-->
                        <!--<th>Product Size</th>-->
                        <th>Sale Price</th>
                        <th>Discount</th>
                        <th><?php echo caption('Unit'); ?></th>
                        <th><?php echo caption('Amount'); ?></th>
                        <th><?php echo caption('Total'); ?></th>
                    </tr>

                    <?php
                    foreach($records as $key => $row){
                    ?>
                    <tr>
                        <td><?php echo ($key + 1); ?></td>
                        <td><?php echo $row->code; ?></td>
                        <td><?php echo $row->product; ?></td>
                        <!--<td><?php echo $row->color; ?></td>-->
                        <!--<td><?php echo $row->size; ?></td>-->
                        <td><?php echo $row->price; ?></td>
                        <td><?php echo $row->discount_product_wise; ?></td>
                        <td><?php echo $row->unit; ?></td>
                        <td><?php echo $row->quantity; ?></td>
                        <td> <?php echo $row->sub_total; ?></td>
                    </tr>

                    <?php } ?>

                    <tr>
                        <td colspan="7" class="text-right"><strong><?php echo caption('Shipping_Charge'); ?></strong></td>
                        <td><strong><?php echo $charge = $records[0]->delivery_charge; ?></strong></td>
                    </tr>

                    <tr>
                        <td colspan="7" class="text-right"><strong><?php echo caption('Discount'); ?></strong></td>
                        <td><strong><?php echo $records[0]->discount; ?></strong></td>
                    </tr>

                    <tr>
                        <td colspan="7" class="text-right"><strong><?php echo caption('Total_Amount'); ?></strong></td>
                        <td><strong><?php printf("%.2f",$records[0]->grand_total); ?></strong></td>
                    </tr>
                </table>
                <div class="signature">
                    <span>Authority Signature</span>
                </div>
            </div>
            
            
            <!--duplicate for print  start -->
            <div class="panel-body hide page_break">
                <div class="row hide">
                    <div class="view-profile">
                        <div class="institute">
                            <h2 class="text-center title" style="margin-top: 10px; font-weight: bold;">
                                <?php $print_header = config_item('heading');echo $print_header['title']; ?>
                            </h2>
                            <h4 class="text-center" style="margin: 0 0 8px;">
                                <?php echo $footer_info['addr_address']; ?>
                            </h4>
                            <h5 class="text-center" style="margin: 0;">
                                Mobile: <?php echo $footer_info['admin_mobile'].', '.$footer_info['addr_moblile']; ?>
                            </h5>
                        </div>
                    </div>
                </div>
                
                <hr class="hide" style="border-bottom: 2px solid #ccc; margin: 15px 0;">

                <!--h4 class="hide text-center" style="margin-top: -10px;">সকল অর্ডার</h4-->

                <div class="row print_width">
                    <div class="col-md-6">
                        <div class="row">
                            <label class="control-label col-xs-6"><?php echo caption('Name'); ?></label>
                            <div class="col-xs-6">
                                <p><?php echo $records[0]->name; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="control-label col-xs-6"><?php echo caption('Mobile_Number'); ?></label>
                            <div class="col-xs-6">
                                <p><?php echo $records[0]->mobile; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="control-label col-xs-6"><?php echo caption('Address'); ?></label>
                            <div class="col-xs-6">
                                <p><?php echo $records[0]->address; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="control-label col-xs-6">Payment Method</label>
                            <div class="col-xs-6">
                                <p><?php echo filter($records[0]->method); ?></p>
                            </div>
                        </div>
                        <?php if($records[0]->account != ''){ ?>
                        <div class="row">
                            <label class="control-label col-xs-6">Transaction Mobile</label>
                            <div class="col-xs-6">
                                <p><?php echo $records[0]->transaction_mobile; ?></p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <label class="control-label col-xs-6"><?php echo caption('Order_No'); ?></label>
                            <div class="col-xs-6">
                                <p><?php echo $records[0]->order_no; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="control-label col-xs-6"><?php echo caption('Date'); ?></label>
                            <div class="col-xs-6">
                                <p><?php echo $records[0]->order_date; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="control-label col-xs-6"><?php echo caption('Time'); ?></label>
                            <div class="col-xs-6">
                                <p><?php echo $records[0]->time; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="control-label col-xs-6"><?php echo caption('Delivery') .' '. caption('Time'); ?></label>
                            <div class="col-xs-6">
                                <p><?php echo $records[0]->delivery_time; ?></p>
                            </div>
                        </div>
                        <?php if($records[0]->account != ''){ ?>
                        <div class="row">
                            <label class="control-label col-xs-6">Transaction ID</label>
                            <div class="col-xs-6">
                                <p><?php echo $records[0]->account; ?></p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <table class="table table-bordered order-table">
                    <tr>
                        <th style="width: 35px;"><?php echo caption('SL'); ?></th>
                        <th><?php echo caption('Product_Name'); ?></th>
                        <th><?php echo caption('Product_Code'); ?></th>
                        <th>Product Color</th>
                        <th>Product Size</th>
                        <th>Sale Price</th>
                        <th><?php echo caption('Unit'); ?></th>
                        <th><?php echo caption('Amount'); ?></th>
                        <th><?php echo caption('Total'); ?></th>
                    </tr>

                    <?php
                    foreach($records as $key => $row){
                    ?>
                    <tr>
                        <td><?php echo ($key + 1); ?></td>
                        <td><?php echo $row->product; ?></td>
                        <td><?php echo $row->code; ?></td>
                        <td><?php echo $row->color; ?></td>
                        <td><?php echo $row->size; ?></td>
                        <td><?php echo $row->price; ?></td>
                        <td><?php echo $row->unit; ?></td>
                        <td><?php echo $row->quantity; ?></td>
                        <td> <?php echo $row->sub_total; ?></td>
                    </tr>

                    <?php } ?>

                    <tr>
                        <td colspan="8" class="text-right"><strong><?php echo caption('Shipping_Charge'); ?></strong></td>
                        <td><strong><?php echo $charge = $records[0]->delivery_charge; ?></strong></td>
                    </tr>

                    <tr>
                        <td colspan="8" class="text-right"><strong><?php echo caption('Discount'); ?></strong></td>
                        <td><strong><?php echo $records[0]->discount; ?></strong></td>
                    </tr>

                    <tr>
                        <td colspan="8" class="text-right"><strong><?php echo caption('Total_Amount'); ?></strong></td>
                        <td><strong><?php printf("%.2f",$records[0]->grand_total); ?></strong></td>
                    </tr>
                </table>
                <div class="signature">
                    <span>Authority Signature</span>
                </div>
            </div>
            <!--duplicate copy for print end -->
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
