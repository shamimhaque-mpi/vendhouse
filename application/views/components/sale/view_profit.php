<style>
    .topOfTable span{width: 35%; display: inline-block;}
    .tdNoBorder tr td{border-top: 1px solid transparent !important;}
    .v1 tr td{padding:2px 8px !important;}
    .table{margin-bottom: 0 !important; max-height: 528px !important;}
    .table > tbody > tr > td,.table > tbody > tr > th{padding: 4px;}
    .table-bordered, .table-bordered tr, .table-bordered tr th, .table-bordered tr td{border: 1px solid #ddd !important;}
    @media print{
        /*.tab1{max-width: 288px;}
        .tab2{max-width: 480px;}*/
        aside, nav, .none, .panel-heading, .panel-footer{display: none !important;}
        .panel{
            border: 1px solid transparent;
            left: 0px;
            position: absolute;
            top: 0px;
            width: 100%;
        }
        .table > tbody > tr > td,.table > tbody > tr > th{padding: 4px;}
        .hide{display: block !important;}
        .header_title {font-family: 'bremen';}
    }
    .wid-150{width: 150px;}
    table tr td, table tr th{vertical-align: middle !important;}
    
    .green{
        color: green;
    }
    .red{
        color: red;
    }
</style>

<div class="container-fluid">
    <div class="row">

        <div class="panel panel-default ">
            <div class="panel-heading none">
                <div class="panal-header-title">
                    <h1 class="pull-left">Profit & Details</h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print'); ?></a>
                </div>
            </div>

            <div class="panel-body">


                <div class="row hide">
                    <div class="view-profile">

                        <div class="institute">
                            <h2 class="text-center title header_title" style="margin-top: 10px; font-weight: bold;">
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

            	
            	<div class="col-xs-12">
            	    <div class="">
            	        <table class="table topOfTable tdNoBorder tab2" style="border: 1px solid #ddd; border-top: 2px solid #ddd;border-bottom: none;">
			    <tr>
			        <td><span><b>Name</b></span> :&nbsp; <?php echo $result[0]->name; ?></td>
			        <td><span><b>Voucher</b></span> :&nbsp; <?php echo $result[0]->voucher_number; ?></td>
			    </tr>
			    <tr>
			        <td><span><b>Mob</b></span> :&nbsp; <?php echo $result[0]->mobile; ?></td>
			        <td><span><b>Date</b></span> :&nbsp; <?php echo $result[0]->date; ?></td>
			    </tr>
			    <tr>
			        <td>
			            <?php $user_info = $this->action->read("users",array("username"=>$username)); ?>
			            <span><b>Sold By</b></span> :&nbsp; <?php echo $user_info[0]->name; ?>
			        </td>
			        <td><span><b>Time</b></span> :&nbsp; <?php echo $result[0]->time; ?></td>
			    </tr>
                <tr>
                     <td><span><b>Sale Type</b></span> :&nbsp; <?php echo $result[0]->sale_type; ?></td>
                </tr>
			</table>

			<!--<pre><?php //print_r($result); ?></pre>-->
			<table class="table table-bordered tab2">
	                    <tr>
	                        <!--<th class="text-center"><?php echo caption('SL'); ?></th>-->
	                        <th>Products</th>
	                        <th><?php echo caption('Price'); ?></th>
	                        <th>Profit</th>
	                        <th>Qty</th>
	                        <!-- <th>Vat</th> -->
	                        <th><?php echo caption('Amount'); ?></th>
	                    </tr>

	                    <?php 
	                    $totalProfit = 0.00;
	                    foreach($result as $key => $row){ ?>
	                    <tr>
	                        <!--<td class="text-center"><?php echo $key+1; ?></td>-->
	                        <td>
	                        <?php
	                        $where = array("bar_code" => $row->code);
	                        $productInfo = $this->action->read("products", $where);
	                        echo $productInfo[0]->product_name. " - " . $row->code;
	                        ?>
	                        </td>
	                        
	                        <td><?php echo $row->price; ?></td>
	                        <?php
	                            $profit = 0.00;
	                            if($row->remark != 'free'){
    	                            $purchaseTotal = $row->purchase_price * $row->quantity;
    	                            $saleTotal    = $row->price * $row->quantity;
    	                            $profit = $saleTotal - $purchaseTotal;
    	                            $totalProfit +=  $profit;
	                            }
	                        ?>
	                        <td class="<?php echo ($profit >= 0)? 'green':'red' ;?> " > <?php echo abs($profit); ?></td>
	                        <td><?php echo $row->quantity; ?></td>
	                        <!-- <td><?php echo $row->vat; ?></td> -->
	                        <td><?php echo $row->subtotal; ?></td>
	                    </tr>
	                    <?php } ?>
	                    <tr>
	                        <th rowspan="10" colspan="3"><?php echo caption('In_Word'); ?>: <span id="inword2"></span> Taka Only </th>
	                    </tr>
	                    <tr>
	                        <th class="text-right"><?php echo caption('Total'); ?></th>
	                        <td class="text-left"><?php echo $result[0]->total; ?></td>
	                    </tr>

	                    <tr>
	                        <th class="text-right">Total Vat</th>
	                        <td class="text-left"><?php echo $result[0]->vat_amount; ?></td>
	                    </tr>

	                    <tr>
	                        <th class="text-right"><?php echo caption('Discount'); ?></th>
	                        <td class="text-left"><?php echo $result[0]->discount; ?></td>
	                    </tr>

	                     <tr>
	                        <th class="text-right"><?php echo caption('Grand_Total'); ?></th>
	                        <td class="text-left"><?php echo $result[0]->grand_total; ?></td>
	                    </tr>
	                    
	                    <tr>
	                        <th class="text-right">Total Profit</th>
	                        <td class="text-left"><?php echo $totalProfit; ?></td>
	                    </tr>

	                     <tr>
	                        <th class="text-right">Received Amount</th>
	                        <td>
	                          <?php
	                            if($result[0]->received_amount >0){
	                              echo $result[0]->received_amount;
	                            }else{
	                              echo $result[0]->paid;
	                            }
	                           ?>
	                         </td>
	                    </tr>


	                     <tr>
	                        <th class="text-right">Paid</th>
	                        <td class="text-left"><?php echo $result[0]->paid; ?></td>
	                    </tr>

	                    <tr>
	                        <th class="text-right"><?php echo caption('Due'); ?></th>
	                        <td class="text-left"><?php echo $result[0]->due; ?></td>
	                    </tr>

	                     <tr>
	                        <th class="text-right">Return Amount</th>
	                        <td><?php echo $result[0]->return_amount; ?></td>
	                    </tr>
	                </table>

	                <address class="text-center hide" style="margin-top: 15px; font-size: 13px;">
	                	<?php $print_header = config_item('heading'); echo $vfooterInfo[0]->message; ?>
	                </address>
            	    </div>
            	</div>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo site_url('private/js/inworden.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#inword").html(inWorden(<?php echo $result[0]->grand_total; ?>));
        $("#inword2").html(inWorden(<?php echo $result[0]->grand_total; ?>));
    });
</script>
