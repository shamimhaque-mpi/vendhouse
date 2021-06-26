
<style>
    @media screen and (max-width: 768px){
        .no-mobile{display: none;}
    }
</style>


<div class="container-fluid">
    <div class="row">
        <?php echo $this->session->flashdata('error'); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="text-center"><?php echo caption('Welcome_To_Dashboard');?></h2>
            </div>
            
            
            <div class="panel-body">
                <div class="row">
                    <?php if(ck_action("dashboard","total_order")){ ?>
                    <div class="col-md-4">
                        <div class="dash-box dash-box-1">
                            <span>Total Order</span>
                            <h1><?php if(isset($total_order)){ echo $total_order;}?></h1>
                        </div>
                    </div>
                    <?php } ?>
                    
                    <?php if(ck_action("dashboard","total_pending_order")){ ?>
                    <div class="col-md-4">
                        <div class="dash-box dash-box-2">
                            <span>Total Pending Order</span>
                            <h1><?php if(isset($total_pending_order)){ echo $total_pending_order;}?></h1>
                        </div>
                    </div>
                    <?php } ?>
                    
                    <?php if(ck_action("dashboard","total_approved_order")){ ?>
                    <div class="col-md-4">
                        <div class="dash-box dash-box-3">
                            <span>Total Approved Order</span>
                            <h1><?php if(isset($total_approved_order)){ echo $total_approved_order;}?></h1>
                        </div>
                    </div>
                    <?php } ?>
                    
                    <?php if(ck_action("dashboard","totay_order_amount")){ ?>
                    <div class="col-md-4">
                        <div class="dash-box dash-box-4">
                            <span>Today's Order</span>
                            <h1><?php echo isset($today_order_amount[0]->amount) ? $today_order_amount[0]->amount.' TK' : '0 TK'; ?></h1>
                        </div>
                    </div>
                    <?php } ?>
                    
                    <?php if(ck_action("dashboard","totay_cost_amount")){ ?>
                    <div class="col-md-4">
                        <div class="dash-box dash-box-5">
                            <span>Today's Cost</span>
                            <h1><?php echo isset($today_cost_amount[0]->amount) ? $today_cost_amount[0]->amount.' TK' : '0 TK'; ?></h1>
                        </div>
                    </div>
                    <?php } ?>
                    
                    <?php if(ck_action("dashboard","today_order_amount")){ ?>
                    <div class="col-md-4">
                        <div class="dash-box dash-box-4">
                            <span>Today's Order</span>
                            <h1><?php echo (isset($today_order) ? $today_order : '0'); ?></h1>
                        </div>
                    </div>
                    <?php } ?>
                    
                    <?php if(ck_action("dashboard","today_cost_amount")){ ?>
                    <div class="col-md-4">
                        <div class="dash-box dash-box-5">
                            <span>Today's Cost</span>
                            <h1><?php echo isset($today_cost_amount[0]->amount) ? $today_cost_amount[0]->amount.' TK' : '0 TK'; ?></h1>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

            
            
            <?php
               /* $sell_total = $sell_totalPaid = $sell_totalDue = 0;
                foreach ( $sale as $key => $row) {
                  $sell_total += $row->total;
                  $sell_totalPaid += $row->paid;
                  $sell_totalDue += $row->due;
                }*/
            ?>


            <!--<div class="panel-body">
                <div class="row">
                   <div class="col-md-3">
                        <div class="dash-box dash-box-1">
                            <span><?php echo caption('Todays_Sale');?></span>
                            <h1><?php echo count($sale); ?></h1>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="dash-box dash-box-2">
                            <span><?php echo caption('Total_Amount');?></span>
                            <h1><?php echo $sell_total; ?></h1>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="dash-box dash-box-3">
                            <span><?php echo caption('Total_Paid');?></span>
                            <h1><?php echo $sell_totalPaid;?></h1>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="dash-box dash-box-4">
                            <span><?php echo caption('Total_Due');?></span>
                            <h1><?php echo $sell_totalDue;?></h1>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="dash-box dash-box-5">
                            <span><?php echo caption('Todays_Purchase');?></span>
                            <h1><?php $pur_total = $purchase[0]->amount; if($pur_total != null){echo $pur_total;}else{echo 0;} ?></h1>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="dash-box dash-box-6">
                            <span><?php echo caption('Bank_deposit');?></span>
                            <h1><?php $bank_total = $bank[0]->amount; if($bank_total != null){echo $bank_total ;}else{echo 0;} ?></h1>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="dash-box dash-box-7">
                            <span><?php echo caption('Todays_Cost');?></span>
                            <h1><?php $cost_total = $cost[0]->amount; if($cost_total != null){echo $cost_total ;}else{echo 0;} ?></h1>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="dash-box dash-box-8">
                            <span><?php echo caption('Cash');?></span>
                            <h1>
                                <?php
                                   $grand_total = 0;
                                   $total_cost = $pur_total +  $bank_total + $cost_total;
                                   $grand_total = $sell_totalPaid - $total_cost;
                                ?>
                                <?php if($grand_total < 0){?>
                                   <span style="font-size: 35px;"><?php echo $grand_total; ?></span>
                                <?php }else{ ?>
                                    <span style="font-size: 35px;"><?php echo $grand_total; ?></span>
                                <?php  } ?>
                            </h1>
                        </div>
                    </div>
                </div>-->

                <!--div class="row no-mobile">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b><?php// echo caption('Top_10_Products'); ?></b></div>

                            <div class="panel-body">
                                <div id="piechart_3d"></div>
                            </div>

                            <div class="panel-footer"></div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading"><b><?php //echo caption('Stock_Alert');?></b></div>

                            <div class="panel-body" style="padding:0;">
                                <?php // if($stock != NULL){ ?>
                                    <table class="table table-bordered" style="margin:0;">
                                        <tr>
                                            <th><?php// echo caption('SL');?></th>
                                            <th><?php// echo caption('Category');?></th>
                                            <th><?php// echo caption('Sub_Category');?></th>
                                            <th><?php// echo caption('Product_Name');?></th>
                                            <th><?php// echo caption('Quantity');?></th>
                                        </tr>
                                         <?php// foreach ($stock as $key => $row) { ?>
                                            <tr>
                                                <td style="width: 35px;"><?php// echo $key+1; ?></td>
                                                <td><?php// echo filter($row->category); ?></td>
                                                <td><?php// echo $row->subcategory; ?></td>
                                                <td><?php// echo $row->product_name; ?></td>
                                                <td><?php// echo $row->quantity; ?></td>
                                            </tr>
                                         <?php// } ?>
                                    </table>
                                <?php// } ?>
                            </div>

                            <div class="panel-footer"></div>
                        </div>
                    <?php // if($stock != NULL){ ?>
                    <table class="table table-bordered" style="margin-bottom: 0;">
                        <caption class="ds-title"><?php// echo caption('Stock_Alert');?></caption>
                        <tr>
                            <th><?php // echo caption('SL');?></th>
                            <th><?php // echo caption('Category');?></th>
                            <th><?php // echo caption('Sub_Category');?></th>
                            <th><?php // echo caption('Product_Name');?></th>
                            <th><?php // echo caption('Quantity');?></th>
                        </tr>
                         <?php // foreach ($stock as $key => $row) { ?>
                            <tr>
                                <td style="width: 35px;"><?php// echo $key+1; ?></td>
                                <td><?php // echo filter($row->category); ?></td>
                                <td><?php // echo $row->subcategory; ?></td>
                                <td><?php // echo $row->product_name; ?></td>
                                <td><?php // echo $row->quantity; ?></td>
                            </tr>
                         <?php // } ?>
                     </table>
                     </div>
                     <?php // } ?>

                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b><?php// echo caption('Last_6_Day_Sell'); ?></b></div>

                            <div class="panel-body">
                                <div id="piechart_3d2"></div>
                            </div>

                            <div class="panel-footer"></div>
                        </div>
                    </div>
                </div>


                <div class="row no-mobile">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b><?php// echo caption('Last_6_Day_purchase'); ?></b></div>

                            <div class="panel-body">
                                <div id="piechart_3d3"></div>
                            </div>

                            <div class="panel-footer"></div>
                        </div>
                     </div>

                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b><?php// echo caption('Last_6_Day_cost'); ?></b></div>

                            <div class="panel-body">
                                <div id="piechart_3d4"></div>
                            </div>

                            <div class="panel-footer"></div>
                        </div>
                    </div>
                </div>

                <div class="row no-mobile">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b><?php// echo caption('Best_3_Supplyer'); ?></b></div>

                            <div class="panel-body">
                                <div id="piechart_3d5"></div>
                            </div>

                            <div class="panel-footer"></div>
                        </div>
                     </div>

                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b><?php// echo caption('Best_5_Customer'); ?></b></div>

                            <div class="panel-body">
                                <div id="piechart_3d6"></div>
                            </div>

                            <div class="panel-footer"></div>
                        </div>
                    </div>
                </div>
            </div-->



            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>


</div>
<!-- /#page-content-wrapper -->
