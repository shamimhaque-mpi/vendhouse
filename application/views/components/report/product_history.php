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
        .title{
            font-size: 25px;
        }
    }
</style>

<div class="container-fluid" ng-controller="productHistoryCtrl" ng-cloak>
<div class="row">
        <div class="panel panel-default none">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1>Search Report</h1>
                </div>
            </div>

            <div class="panel-body">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />
            <?php $attr = array("class" => "form-horizontal"); ?>
            <?php echo form_open("", $attr); ?>             

                <div class="form-group">
                    <label class="col-md-2 control-label">Product Name </label>
                    <div class="input-group col-md-4">
                        <select name="product_code" class="selectpicker form-control" data-show-subtext="true" data-live-search="true" required>
                            <?php foreach ($products as $key => $value) {?>
                            <option value="<?php echo $value->bar_code; ?>"><?php echo $value->product_name;?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                   
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <input type="submit" name="show" value="Show" class="btn btn-primary">
                    </div>
                </div>
                    
                <?php echo form_close();?>           
             </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
            <div class="panel-footer">&nbsp;</div>
        </div>
     </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title">
                    <h1 class=" pull-left">Product History</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print'); ?></a>
                </div>
            </div>
            

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
                
                <hr class="hide" style="border-bottom: 2px solid #ccc; margin-top: 5px;">
    
                       
            <h4 class="text-center hide" style="margin-top: -8px;">Date : <?php echo date("Y-m-d");?></h4>
        
            <div class="panel-body">



            
            <div class="col-md-12">
                <?php if ($product_history != null) { ?>
            	<table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Product Code</th>
                        <th>Total Purchase</th>
                        <th>Total Plus</th>
                        <th>Total Minus</th>
                        <th>Total Sale</th>
                        <th>Current Stock</th>
                    </tr>
                    <?php 
                     $totalPurchase = $grandPurchase = $totalSale = $saleTotal = $grandSale = $totalStock = $total = $totalPlus = $totalMinus = 0;
                    foreach ($product_history as $key => $value) {
                        $stockInfo = $this->action->read("stock",array("code" => $value->bar_code));
                        $totalPlus += ($stockInfo) ? $stockInfo[0]->plus_quantity : 0;
                        $totalMinus += ($stockInfo) ? $stockInfo[0]->minus_quantity : 0;
                     ?>
            		<tr>
                        <td><?php echo $key+1;?></td>
                        <td><?php echo $value->product_name;?></td>
                        <td><?php echo $value->bar_code;?></td>
                        <td>
                            <?php 

                               $purchase = $this->action->read_sum("purchase","quantity",array("product_code"=> $value->bar_code));
                               
                                if ($purchase[0]->quantity != '') {
                                    echo  $purchase[0]->quantity;
                                }else{
                                    echo $total;
                                }
                                $grandPurchase += $purchase[0]->quantity;

                            ?>
                        </td>
                        <td><?php echo ($stockInfo) ?  $stockInfo[0]->plus_quantity : 0.00; ?></td>
                        <td><?php echo ($stockInfo) ?  $stockInfo[0]->minus_quantity : 0.00; ?></td>
                        <td>
                            <?php 

                               $sale = $this->action->read_sum("sale","quantity",array("code"=> $value->bar_code));
                               
                                if ($sale[0]->quantity != '') {
                                    echo $sale[0]->quantity;
                                }else{
                                    echo $saleTotal;
                                }
                                $grandSale += $sale[0]->quantity;

                            ?>
                            
                        </td>
                        <td><?php echo (($purchase[0]->quantity +$totalPlus - $totalMinus)  - $sale[0]->quantity) ?></td>
            		</tr>
                    <?php } ?>
                    <tr>
                        <th colspan="3" style="text-align: right;"> Total </th>
                        <th><?php echo $grandPurchase; ?></th>
                        <th><?php echo $totalPlus; ?></th>
                        <th><?php echo $totalMinus; ?></th>
                        <th><?php echo $grandSale; ?></th>
                        <th><?php echo (($grandPurchase+$totalPlus - $totalMinus)-$grandSale); ?></th>
                    </tr>
            	</table>
                <?php } ?>
                
            </div>
            


        </div>        
            <div class="panel-footer">&nbsp;</div>

    </div>
</div>

