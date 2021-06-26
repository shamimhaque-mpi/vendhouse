<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />
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
<?php
    $footer_info=json_decode($meta->footer,true);
?>
<div class="container-fluid" ng-controller="SearchOrderCtrl">
    <div class="row">
    <?php echo $confirmation; ?>
        <div class="panel panel-default none">

            <div class="panel-heading panal-header">
                <div class="panal-header-title">
                    <h1 class="pull-left"><?php echo('Search Order'); ?></h1>
                </div>
            </div>

            <div class="panel-body">
                <form class="form-horizontal" ng-submit="searchDataFn()">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label"><?php echo caption('Status'); ?><span class="req"></span></label>
                            <div class="col-md-8">
                                <select name="status" ng-model="search.status" class="selectpicker form-control" data-show-subtext="true" data-live-search="true" >
                                    <option></option>
                                    <option value="pending"><?php echo caption('Pending');?></option>
                                    <option value="received">Received</option>
                                    <option value="processing">Processing</option>
                                    <option value="on_the_way">On The Way</option>
                                    <option value="delivered">Delivered</option>
                                    <option value="complete"><?php echo caption('Completed');?></option>
                                    <option value="fake"><?php echo caption('Fake'); ?></option>
                                    <option value="cancel"><?php echo caption('Cancel');?></option>
                                    <option value="suspend"><?php echo caption('Suspend');?></option>
                                    <?php /*
                                    <option value="" selected disabled><?php echo caption('Select_Status'); ?></option>
                                    <option value="pending"><?php echo caption('Pending'); ?></option>
                                    <option value="complete"><?php echo caption('Completed'); ?></option>
                                    <option value="delivered"><?php echo caption('Delivery'); ?></option>
                                    <option value="cancel"><?php echo caption('Cancel'); ?></option>
                                    <option value="suspend"><?php echo caption('Suspend'); ?></option>
                                    <option value="fake"><?php echo caption('Fake'); ?></option>
                                    */?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label"><?php echo caption('Order_No'); ?></label>
                            <div class="input-group date col-md-8">
                                <input type="text" ng-model="search.order_no" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label"><?php echo caption('Mobile'); ?></label>
                            <div class="input-group date col-md-8">
                                <input type="text" ng-model="search.mobile" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label"><?php echo caption('Name'); ?></label>
                            <div class="input-group date col-md-8">
                                <select name="name" ng-model="search.name" class="selectpicker form-control" data-show-subtext="true" data-live-search="true" >
                                    <option value="" selected disabled><?php echo caption('Select_Status'); ?></option>
                                    <?php foreach($orders as $order){ ?> <option value="<?= $order->name ?>"><?= $order->name ?></option> <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <!--<div class="form-group">
                            <label class="col-md-4 control-label">Supplier</label>
                            <div class="input-group date col-md-8">
                                <select ng-model="search.user_id" class="form-control">
                                    <option value="">-- Select Supplier --</option>
                                    <?php foreach($userInfo as $key => $value){ ?>
                                        <option value="<?php echo $value->id; ?>"><?php echo filter($value->name); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>-->
                    </div>
                    
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label"><?php echo caption('Form'); ?></label>
                            <div class="input-group date col-md-8" id="datetimepickerSMSFrom">
                                <input type="text" ng-model="date.from" id="date_from" class="form-control" placeholder="YYYY-MM-DD">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label"><?php echo caption('To'); ?></label>
                            <div class="input-group date col-md-8" id="datetimepickerSMSTo">
                                <input type="text" ng-model="date.to" id="date_to" class="form-control" placeholder="YYYY-MM-DD">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">TrxId</label>
                            <div class="input-group date col-md-8">
                                <input type="text" ng-model="search.account" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">City</label>
                            <div class="input-group date col-md-8">
						    	<select ng-name="search.city" class="selectpicker form-control" data-show-subtext="true" data-live-search="true" >
							    	<option value="">--পদ্ধতি নির্বাচন করুন--</option>
							    	<!--<option value="308">Mymensingh</option>-->
							    	
									<?php foreach ($this->config->config['upazila'] as $key => $value) { ?>
										<option value="<?php echo $key; ?>"><?php echo filter($value); ?></option>
									<?php } ?>
									
							    </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10">
                        <div class="btn-group pull-right">
                            <input type="submit" value="দেখুন" name="show" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>


        <div  ng-cloak class="panel panel-default" ng-hide="active" ng-init="active=true;">

            <div class="panel-heading panal-header">
                <div class="panal-header-title">
                    <h1 class="pull-left"><?php echo caption('Show_Result'); ?></h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print'); ?></a>
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
                                <?php echo $footer_info['addr_address']; ?>
                            </h4>
                            <h4 class="text-center" style="margin: 0;">
                              Mobile: <?php echo $footer_info['admin_mobile'].', '.$footer_info['addr_moblile']; ?>
                            </h4>
                        </div>

                    </div>
                </div>


                <hr class="hide" style="border-bottom: 1px solid #ccc; margin-top: 5px;">

                <h4 class="hide text-center" style="margin-top: -10px;"><?php echo caption('All_Order'); ?></h4>

                <div class="table-responsive">
                <table class="table table-bordered order-table">
                    <tr>
                        <th style="width: 35px;"><?php echo caption('SL'); ?></th>
                        <th style="width: 80px;"><?php echo caption('Order_No'); ?></th>
                        <th style="width: 100px;"><?php echo caption('Date'); ?></th>
                        <th><?php echo caption('Name'); ?></th>
                        <th style="width: 100px;"><?php echo caption('Mobile'); ?></th>
                        <th><?php echo caption('Amount'); ?></th>
                        <th><?php echo caption('Discount'); ?></th>
                        <th class="none" style="width: 160px;"><?php echo caption('Status'); ?></th>
                        <th class="none"><?php echo caption('Action'); ?></th>
                    </tr>


                    <tr ng-cloak dir-paginate="order in orders|itemsPerPage:30">
                        <td>{{ order.sl }}</td>
                        <td>{{ order.order_no }}</td>
                        <td>{{ order.order_date }}</td>
                        <td>{{ order.name | textBeautify }}</td>
                        <td>{{ order.mobile }}</td>
                        <td>{{ order.grand_total }}</td>
                        <td>{{ order.discount }}</td>
                        <td class="none">
                            <select name="status" class="status form-control" ng-model="status" ng-change="updateStatusFn( order.order_no, status )" ng-init="status=order.status">
                                <option></option>
                                <option value="pending"><?php echo caption('Pending');?></option>
                                <option value="received">Received</option>
                                <option value="processing">Processing</option>
                                <option value="on_the_way">On The Way</option>
                                <option value="delivered">Delivered</option>
                                <option value="complete"><?php echo caption('Completed');?></option>
                                <option value="fake"><?php echo caption('Fake'); ?></option>
                                <option value="cancel"><?php echo caption('Cancel');?></option>
                                <option value="suspend"><?php echo caption('Suspend');?></option>
                                <?php /*
                                <option value="pending"><?php echo caption('Pending'); ?></option>
                                <option value="complete"><?php echo caption('Completed'); ?></option>
                                <option value="delivered"><?php echo caption('Deliverd'); ?></option>
                                <option value="cancel"><?php echo caption('Cancel'); ?></option>
                                <option value="suspend"><?php echo caption('Suspend'); ?></option>
                                <option value="fake"><?php echo caption('Fake'); ?></option>
                                */?>
                            </select>
                        </td>

                        <td class="none" style="width: 115px;">

                            <?php if(ck_action("order","view")){ ?>
                            <a title="View" class="btn btn-primary" href="<?php echo site_url('order/order/orderView?ono='); ?>{{ order.order_no }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <?php } ?>

                            <?php if(ck_action("order","delete")){ ?>
                            <a title="Delete" class="btn btn-danger" href="#" ng-click="deleteOrderFn(order.order_no)">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                            <?php } ?>

                        </td>
                    </tr>
                    <tr>
                        <th colspan="5" class="text-right">Total</th>
                        <th>{{ grand_totalFn() }}</th>
                        <th>{{ total_discountFn() }}</th>
                        <th class="none" colspan="2"></th>
                    </tr>
                </table>
                </div>

                <dir-pagination-controls
                    max-size="30"
                    direction-links="true"
                    boundary-links="true"
                    class="none">
                </dir-pagination-controls>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
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



<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
