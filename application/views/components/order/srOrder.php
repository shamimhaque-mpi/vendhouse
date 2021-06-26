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

<div class="container-fluid" ng-controller="SrOrderCtrl" ng-cloak >
    <div class="row">
        <div class="panel panel-default none">

            <div class="panel-heading panal-header">
                <div class="panal-header-title">
                    <h1 class="pull-left">Search by SR</h1>
                </div>
            </div>

            <div class="panel-body">
                <form class="form-horizontal" ng-submit="searchDataFn()">
                    <div class="form-group">
                        <label class="col-md-2 control-label">SR Name<span class="req">*</span></label>
                        <div class="col-md-5">
                            <select name="status" ng-model="search.sr_code" class="form-control">
                               <option value="" selected disabled>Select</option>
                               <?php if ($allsr != null) { foreach ($allsr as $value) { ?>
                               <option value="<?php echo $value->code ;?>" > <?php echo filter($value->name);?></option>
                               <?php } } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Status'); ?><span class="req">*</span></label>
                        <div class="col-md-5">
                            <select name="status" ng-model="search.status" class="form-control">
                                <option value="" selected disabled><?php echo caption('Select_Status'); ?></option>
                                <option value="pending"><?php echo caption('Pending'); ?></option>
                                <option value="complete"><?php echo caption('Completed'); ?></option>
                                <option value="delivered"><?php echo caption('Delivery'); ?></option>
                                <option value="cancel"><?php echo caption('Cancel'); ?></option>
                                <option value="suspend"><?php echo caption('Suspend'); ?></option>
                                <option value="fake"><?php echo caption('Fake'); ?></option>
                            </select>
                        </div>
                    </div>

                    <!--div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Form'); ?></label>
                        <div class="input-group date col-md-5">
                            <input type="text" ng-model="date.from" class="form-control" placeholder="YYYY-MM-DD">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('To'); ?></label>
                        <div class="input-group date col-md-5">
                            <input type="text" ng-model="date.to" class="form-control" placeholder="YYYY-MM-DD">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div-->

                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo caption('Order_No'); ?></label>
                        <div class="input-group date col-md-5">
                            <input type="text" ng-model="search.order_no" class="form-control">
                        </div>
                    </div>

                    <!--div class="col-md-7">
                        <div class="btn-group pull-right">
                            <input type="submit" value="Show" name="show" class="btn btn-primary">
                        </div>
                    </div-->
                </form>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>

	   <?php echo $confirmation; ?>
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
                        <th style="width: 80px;"><?php echo caption('Order_No'); ?></th>
                        <th style="width: 100px;"><?php echo caption('Date'); ?></th>
                        <th><?php echo caption('Name'); ?></th>
                        <th style="width: 100px;"><?php echo caption('Mobile'); ?></th>
                        <th><?php echo caption('Amount'); ?></th>
                        <th><?php echo caption('Discount'); ?></th>
                        <th>SR Name</th>
                        <th style="width: 160px;"><?php echo caption('Status'); ?></th>
                        <th class="none"><?php echo caption('Action'); ?></th>
                    </tr>

                    <tr ng-cloak dir-paginate="order in orders|filter:search|itemsPerPage:30|orderBy:sortField:reverse">
                        <td>{{ order.sl }}</td>
                        <td>{{ order.order_no }}</td>
                        <td>{{ order.order_date }}</td>
                        <td>{{ order.name | textBeautify }}</td>
                        <td>{{ order.mobile }}</td>
                        <td>{{ order.grand_total }}</td>
                        <td>{{ order.discount }}</td>
                        <td>{{ order.sr_name | textBeautify }}</td>

                        <td>
                            <select name="status" class="status form-control" ng-model="status" ng-change="updateStatusFn( order.order_no, status )" ng-init="status=order.status" >
                                <option value="" selected disabled>&nbsp;</option>
                                <option ng-selected="status=='pending' " value="pending"><?php echo caption('Pending'); ?> </option >
                                <option ng-selected="status=='complete' " value="complete"><?php echo caption('Completed'); ?></option>
                                <option ng-selected="status=='delivered' " value="delivered"><?php echo caption('Delivery'); ?></option>
                                <option ng-selected="status=='cancel' " value="cancel"><?php echo caption('Cancel'); ?></option>
                                <option ng-selected="status=='suspend' " value="suspend"><?php echo caption('Suspend'); ?></option>
                                <option ng-selected="status=='fake' " value="fake"<?php echo caption('Fake'); ?> ></option>
                            </select>
                        </td>

                        <td class="none" style="width: 115px;">

                            <?php if(ck_action("order","view")){ ?>
                            <a title="View" class="btn btn-primary" href="<?php echo site_url('order/order/orderView?ono='); ?>{{ order.order_no }}" target="_blank">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
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
