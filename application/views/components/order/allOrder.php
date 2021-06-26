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
<div class="container-fluid" ng-controller="AllOrderCtrl" ng-cloak >
    <div class="row">
	  <?php echo $this->session->flashdata('confirmation'); ?>
	
	     <!--<div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title">
                    <h1>Search Order</h1>
                </div>
            </div>

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

            <div class="panel-footer">&nbsp;</div>
        </div>-->
	    
	    
        <div class="panel panel-default">

            <div class="panel-heading panal-header">
                <div class="panal-header-title">
                    <h1 class="pull-left"><?php echo('All Order'); ?></h1>
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

                <table class="table table-bordered order-table" >
                    <tr>
                        <th style="width: 35px;"><?php echo caption('SL'); ?></th>
                        <th style="width: 90px;"><?php echo caption('Order_No'); ?></th>
                        <th style="width: 100px;"><?php echo caption('Date'); ?></th>
                        <th><?php echo caption('Name'); ?></th>
                        <th style="width: 100px;">Mobile</th>
                        <th><?php echo caption('Amount'); ?></th>
                        <th><?php echo caption('Discount'); ?></th>
                        <th><?php echo caption('Address'); ?></th>
                        <!--<th>SR Commission</th>-->
                        <!--<th style="width: 160px;">Supplier</th>-->
                        <th style="width: 160px;"><?php echo caption('Status'); ?></th>
                        <th class="none"><?php echo caption('Action'); ?></th>
                    </tr>
                    
                    
                    <input type="hidden" ng-init="username='<?php echo $this->data['username']; ?>'" value="<?php echo $this->data['username']; ?>">
                    <input type="hidden" ng-init="privilege='<?php echo $this->data['privilege']; ?>'" value="<?php echo $this->data['privilege']; ?>">

                    <tr ng-cloak dir-paginate="order in orders|filter:search|itemsPerPage:30|orderBy:sortField:reverse">
                        <td>{{ order.sl }}</td>
                        <td>{{ order.order_no }}</td>
                        <td>{{ order.order_date }}</td>
                        <td>{{ order.name | textBeautify }}</td>
                        <td>{{ order.mobile }}</td>
                        <td>{{ order.grand_total }}</td>
                        <td>{{ order.discount }}</td>
                        <td>{{ order.address }}</td>
                        <!--<td>{{ order.srCommission }}</td>-->
                        <!--<td>
                            <?php 
                                $privilege = $this->session->userdata('privilege');
                                if($privilege != 'user'){ ?>
                                <select name="supplier" class="status form-control" ng-model="user_id" ng-change="setSupplierFn( order.order_no, user_id )" ng-init="user_id=order.supplier_id" >
                                    <option value="" Selected disabled>Select Supplier </option >
                                    <?php foreach($allProfile as $profile){ ?>
                                    <option value="<?php echo $profile->id;?>"><?php echo filter($profile->name) ;?></option>
                                    <?php } ?>
                                </select>
                            <?php }else{ ?>
                                <?php echo $this->data['username'] ; ?>
                            <?php } ?>
                        </td>-->
                        
                        <?php 
                            $privilege = $this->session->userdata('privilege');
                            if($privilege != 'user'){
                        ?>
                        <td>
                            <select name="status" class="status form-control" ng-model="status" ng-change="updateStatusFn( order.order_no, status )" ng-init="status=status" >
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
                                    <option value="pending"><?php echo caption('Pending'); ?> </option >
                                    <option value="suspend"><?php echo caption('Suspend'); ?></option>
                                    <option value="cancel"><?php echo caption('Cancel'); ?></option>
                                    <option value="complete"><?php echo caption('Completed'); ?></option>
                                    <option value="delivered"><?php echo caption('Delivery'); ?></option>
                                    <option value="fake"<?php echo caption('Fake'); ?>></option>
                                */?>
                            </select>
                        </td>
                        <?php }else{ ?>
                        <style>
                            .color-yellow1{ color: #fada5e; }
                            .color-yellow2{ color: yellow; }
                            .color-red1{ color: red; }
                            .color-blue{ color: blue; }
                            .color-green{ color: green; }
                            .color-red2{ color: #860111; }
                        </style>
                        <td class="text-center" ng-class="{'color-yellow1': order.status == 'pending', 
                                                            'color-yellow2': order.status == 'suspend', 
                                                            'color-red1': order.status == 'cancel', 
                                                            'color-blue': order.status == 'complete', 
                                                            'color-green': order.status == 'delivered', 
                                                            'color-red2': order.status == 'fake'}">
                            <b>{{ order.status | textBeautify }}</b>
                        </td>
                        <?php } ?>

                        <td class="none" style="width: 115px;">
                            <a title="View" class="btn btn-primary" href="<?php echo site_url('order/order/orderView?ono='); ?>{{ order.order_no }}" target="_blank">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>

                            <a title="Delete" class="btn btn-danger" data-id="{{ order.order_no }}" href="" onclick="deleteAlert('order/delete/'+this.dataset.id);" >
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="5" class="text-right">Total</th>
                        <th>{{ grand_totalFn() }}</th>
                        <th>{{ total_discountFn() }}</th>
                        <th class="none">&nbsp;</th>
                        <th class="none" colspan="3"></th>
                    </tr>

                </table>

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
    var privil = '<?php echo $this->data['privilege']; ?>';
    var supplier_id = <?php echo $this->data['user_id']; ?> ;
    
    
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