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

<div class="container-fluid">


<div class="row">
        <div class="panel panel-default none">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1>Search Report</h1>
                </div>
            </div>

            <div class="panel-body">
            
            <?php $attr = array("class" => "form-horizontal"); ?>
            <?php echo form_open("", $attr); ?>             

                <div class="form-group">
                    <label class="col-md-2 control-label">From </label>
                    <div class="input-group date col-md-4" id="datetimepickerFrom">
                        <input type="text" name="date[from]" class="form-control" value="<?php echo date("Y-m-d");?>">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">To </label>
                    <div class="input-group date col-md-4" id="datetimepickerTo">
                        <input type="text" name="date[to]" class="form-control" value="<?php echo date("Y-m-d");?>" <?php if($privilege == 'user'){ echo 'disabled'; } ?> >
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                   
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <input type="submit" name="show" value="Show" class="btn btn-primary">
                    </div>
                </div>
                    
                <?php echo form_close();?>           
             </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
     </div>
    
    
    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title">
                    <h1 class=" pull-left">Daily Report</h1>
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
               <!-- Print Banner -->
                <!-- img class="img-responsive hide print-banner" src="<?php //echo site_url('private/images/banner.jpg'); ?>" -->
        <?php //$total_income = 0; ?>
      
        <!-- div class="row">
        <div class="col-md-6">
        
            <table class="table table-bordered">
                <tr>
                    <th>Income Source</th>
                    <th>Amount</th>
                </tr>
            <?php //if($md_receive != null){
            //$total_income += $md_receive[0]->amount;
            ?>
                <tr>
                    <td>Collect From MD</td>
                    <td><?php //echo $md_receive[0]->amount; ?> TK</td>
                </tr>
                <?php //}?>
                
            <?php //if($total_sale != null){
            //$total_income += ($total_sale- $sale_return);
	    $total_income += $total_sale;
            ?>
                <tr>
                    <td>Total Sale</td>
                    <td><?php //echo $total_sale - $sale_return; ?> TK</td>
                    <td><?php //echo $total_sale; ?> TK</td>
                </tr>
                <?php //}?>
            </table>
        </div>
        </div-->
        
            
            

            <!-- table class="table table-bordered">
                <tr>
                    <th colspan="2" style="background: #ddd; text-align:center;">Total Sale</th>
                </tr>
                <tr>
                    <th>Date</th>
                    <th width="150px">Amount</th>
                </tr>
                <?php 
                    //$total = 0.00;  
                     //foreach ($todaySales as  $key => $row) { 
                     //$total  += $row->grand_total;
                   //}?>
                <tr>
                    <td><strong> <?php //if(count($todaySales)>0){echo $todaySales[0]->date;}else{echo date('Y-m-d');} ?> </strong></td>
                    <td><strong><?php //echo $total; ?>TK</strong></td>
                </tr>
                
            </table> 
            
            <table class="table table-bordered">
                <tr>
                    <th colspan="2" style="background: #ddd; text-align:center;">Total Paid</th>
                </tr>
                <tr>
                    <th>Date</th>
                    <th width="150px">Amount</th>
                </tr>
                <?php 
                    //$total = 0.00;  
                     //foreach ($todaySales as  $key => $row) { 
                     //$total  += $row->paid;
                   //}?>
                <tr>
                    <td><strong> <?php //if(count($todaySales)>0){echo $todaySales[0]->date;}else{echo date('Y-m-d');} ?></strong></td>
                    <td><strong><?php //echo $total; ?>TK</strong></td>
                </tr>
                
            </table>
            
            <table class="table table-bordered">
                <tr>
                    <th colspan="2" style="background: #ddd; text-align:center;">Total Due</th>
                </tr>
                <tr>
                    <th>Date</th>
                    <th width="150px">Amount</th>
                </tr>
                <?php 
                    //$total = 0.00;  
                     //foreach ($todaySales as  $key => $row) { 
                     //$total  += $row->due;
                   //}?>
                <tr>
                    <td><strong><?php //if(count($todaySales)>0){echo $todaySales[0]->date;}else{echo date('Y-m-d');} ?></strong></td>
                    <td><strong><?php //echo $total; ?>TK</strong></td>
                </tr>
                
            </table>
            
            <table class="table table-bordered">
                <tr>
                    <th colspan="2" style="background: #ddd; text-align:center;">Total Purchase</th>
                </tr>
                <tr>
                    <th>Date</th>
                    <th width="150px">Amount</th>
                </tr>
                <?php 
                     //$total = 0.00;  
                     //foreach ($todayPurchase as  $key => $row) { 
                     //$total  += $row->grand_total;
                   //}?>
                <tr>
                    <td><strong><?php //if(count($todayPurchase)>0){echo $todayPurchase[0]->date;}else{echo date('Y-m-d');} ?></strong></td>
                    <td><strong><?php //echo $total; ?>TK</strong></td>
                </tr>
                
            </table>

             <table class="table table-bordered">
                <tr>
                    <th colspan="2" style="background: #ddd; text-align:center;">Total Due Collction </th>
                </tr>
                <tr>
                    <th>Date</th>
                    <th width="150px">Amount</th>
                </tr>
                <?php 
                   //$total = 0.00;  
                   //foreach ($todayDueCollction as  $key => $row) { 
                     //$total  += $row->paid;
                   //}
                   //$total_income += $total;
                ?>
                <tr>
                    <td><strong><?php //if(count($todayDueCollction )>0){echo $todayDueCollction [0]->date;}else{echo date('Y-m-d');} ?></strong></td>
                    <td><strong><?php //echo $total; ?>TK</strong></td>
                </tr>
                
            </table>
            
            
            
             <table class="table table-bordered">
                <tr>
                    <th colspan="2" style="background: #ddd; text-align:center;">Total Sales Return </th>
                </tr>
                <tr>
                    <th>Date</th>
                    <th width="150px">Amount</th>
                </tr>
                <?php 
                     //$total = 0.00;  
                         //foreach ($todaySalesReturn as  $key => $row) { 
                        /* $where = array('product_code'=>$row->code);
                         $returnAmount = $this->action->read('products', $where);
                         
                         $totalPrice = ($row->quantity * $returnAmount[0]->sale_price);*/
                         
                         $total  += $row->return_amount;
                   //}?>
                <tr>
                    <td><strong><?php //if(count($todaySalesReturn )>0){echo $todaySalesReturn [0]->date;}else{echo date('Y-m-d');} ?></strong></td>
                    <td><strong><?php //echo $total; ?>TK</strong></td>
                </tr>
                
            </table>
            
            <?php //$totalCost = 0; if($cost!= null){ ?>
                <table class="table table-bordered">
                    <tr>
                        <th colspan="5" style="background: #ddd; text-align:center;">Cost </th>
                    </tr>
                    <tr>
                        <th>Sl</th>
                        <th>Date</th>
                        <th>Cost Purpose</th>
                        <th>Spender</th>
                        <th>Amount</th>
                    </tr>
                    
                    <?php  //foreach($cost as $key => $row){ ?>
                    <tr>
                        <td><?php //echo ($key + 1); ?></td>
                        <td>
                        <?php
                        /*
                        $date = new DateTime($row->date);
                    echo $date->format('jS F, y');
                    */ //echo $row->date;
                        ?>
                        </td>
                        <td><?php //echo str_replace("_", " ", $row->purpose); ?></td>
                        <td><?php //echo ucwords($row->spender); ?></td>
                        <td width="150px"><?php //echo $row->amount; ?> TK</td>
                    </tr>
                    <?php //$totalCost += $row->amount; } ?>  
                </table-->    
            <?php //} ?>      
        
                   
        
            <!--table class="table table-bordered">
                <tr>
                    <th class="text-right" style="width:85%;">Total Cost</th>
                    <th><?php //echo $totalCost; ?> Tk</th>
                </tr>
                <tr>
                    <th class="text-right" style="width:85%;">Total Cash</th>
                    <th><?php //echo $total_income; ?>Tk</th>
                </tr>
                <tr>
                    <th class="text-right" style="width:85%;">Net Cash</th>
                    <th><?php //echo $total_income - $totalCost; ?> Tk</th>
                </tr>
                <!-- tr>
                    <th class="text-right" style="width:85%;">Permanent Cash</th>
                    <th>5000 Tk</th>
                </tr --><!--
                <tr>
                    <th class="text-right" style="width:85%;">Give to MD</th>
                    <th><?php //echo ($total_income - $totalCost); ?> Tk</th>
                </tr>
            </table-->
            
         
                
        <?php /* if($todayDueSaleInfo != null ) {?>
                <table class="table table-bordered">
                    <tr>
                        <th colspan="5" style="background: #ddd; text-align:center;">Today's Due Sales</th>
                    </tr>
                    <tr>
                        <th width="40">Sl</th>
                        <th>Date</th>
                        <th>Voucher No</th>
                        <th width="150px">Amount</th>
                    </tr>
                    <?php 
                        $total = 0.00;  
                         foreach ($todayDueSaleInfo as  $key => $row) { 
                         $total  += $row->due;
                       ?>
                    <tr>
                        <td><?php echo ($key+1); ?></td>
                        <td><?php echo $row->date; ?></td>
                        <td><?php echo $row->voucher_number; ?></td>
                        <td><?php echo $row->due; ?></td>
                    </tr>
                    <?php }?>
                    <tr>
                        <td colspan="3" class="text-right"><b>Total</b></td>
                        <td><b><?php echo $total; ?> TK </b></td>
                    </tr>
                    
                </table> 
                
                 <table class="table table-bordered">
                    <?php 
                        $total = $amount = 0.00;  
                         foreach ($todaySales as  $key => $row) { 
                         
                         $where = array('product_code'=>$row->code);
                         $saleAmount = $this->action->read('products', $where);
                         
                         $totalPrice = ($row->quantity * $saleAmount[0]->sale_price);
                         
                         $amount  += $totalPrice;
                         
                         $total  += $row->grand_total; 
                         
                         $totalSale =  ($total - $amount);
                         

                       }?>
                       
                    
                     <tr>
                            <th colspan="2" style="background: #ddd; text-align:center;">Today's Total Profit</th>
                        </tr>
                <tr>
                    <th class="text-right" style="color: green; ">Total Profit </th>
                    <th width="150px"> <?php echo $totalSale; ?> TK</th>
                </tr>               
        </table>
        
               <?php } */ ?>
               
               
            
            <div class="col-md-4">
            <?php 
            	$all_income = array();
            	
		$due_collection = 0.00;  
		foreach ($todayDueCollction as  $key => $row) {
			$due_collection += $row->paid;
		}
		
		$totalSale = $totalDue = 0.00;
		foreach($sale as $key => $row){
			$totalSale +=$row->grand_total;
			$totalDue  +=$row->due;
		}
		
		$mdReceive = 0.00;
		if($md_receive != null){
			$mdReceive = $md_receive[0]->amount;
		}
		
	        $bankDR = $this->action->sum('transaction', 'amount', array('transaction_date' => date('Y-m-d'), 'transaction_type' => 'Debit'));
            ?>
            <div class="table-responsive">
            	<table class="table table-bordered">
            		<tr>
            			<th colspan="2" style="text-align:center">All Income</th>
            		</tr>
            		<tr>
            			<th>Total Sale</th>
            			<td><?php echo $totalSale; ?></td>
            		</tr>
            		<tr>
            			<th>Cash Sale</th>
            			<td><?php echo $all_income[] = $total_sale; ?></td>
            		</tr>
            		<tr>
            			<th>Total Due</th>
            			<td><?php echo $totalDue; ?></td>
            		</tr>
            		<tr>
            			<th>Due Collection</th>
            			<td><?php echo $all_income[] = $due_collection; ?></td>
            		</tr>
            		<tr>
            			<th>Received From MD</th>
            			<td><?php echo $all_income[] = $mdReceive; ?></td>
            		</tr>
            		<tr>
            			<th>Bank Withdraw</th>
            			<td><?php echo $all_income[] = $bankDR[0]->amount+0;?></td>
            		</tr>
            	</table>
            </div>
            </div>
            
            
            <div class="col-md-4">
            <?php
            	    $all_cost = array();
                    $saleReturn = 0.00;  
                    foreach ($todaySalesReturn as  $key => $row) { 
                        $saleReturn += $row->return_amount;
                    }

	            $Totalcost = $this->action->read_sum('cost','amount',array("date"=>date("Y-m-d")));
		    $bankCR = $this->action->sum('transaction', 'amount', array('transaction_date' => date('Y-m-d'), 'transaction_type' => 'Credit'));
            ?>
            	<table class="table table-bordered">
            		<tr>
            			<th colspan="2" style="text-align:center">All Cost</th>
            		</tr>
            		<tr>
            			<th>Sale Return</th>
            			<td><?php echo $all_cost[] = $saleReturn+0; ?> </td>
            		</tr>
            		<tr>
            			<th>Cost</th>
            			<td><?php echo $all_cost[] = $Totalcost[0]->amount+0; ?></td>
            		</tr>
            		<tr>
            			<th>Bank Diposit</th>
            			<td><?php echo $all_cost[] = $bankCR[0]->amount+0; ?></td>
            		</tr>
            	</table>
            </div>
            
            
            <!-- Profit Loss Calculation start -->  
       <?php
        $color = "color:#000;";
        $status = "";
        $totalPurchase = $totalAmount = $grandPurchase = $grandSale = 0;    
         if($todaySales!= null){
                          
           foreach($todaySales as $key => $row){
           $info = $this->action->read("sale",array("voucher_number" => $row->voucher_number));
           if($info){
            foreach($info as $sl=>$value){
              $purchaseInfo = $this->action->read("products",array("product_code" => $value->code));                          
               $totalPurchase += ($purchaseInfo != NULL)?($purchaseInfo[0]->purchase_price * $value->quantity):0;
             }
           }                             
        
          $grandPurchase += $totalPurchase; 
          $totalSale = $row->grand_total;
          $grandSale += $totalSale; 
          $totalAmount += ($totalSale - $totalPurchase);
          $totalPurchase = 0;
             }           
             
             
             if($totalAmount > 0){
              $status = "Profit";
              $color = "color:green;";
             }elseif($totalAmount < 0){
              $status = "Loss";
              $color = "color:red;";
             }else{          
              $status = "Balanced";
              $color = "color:green;";
             }  
            
           }           
         ?>
    <!-- Profit Loss Calculation end-->
            
            
            <div class="col-md-4">
            	<table class="table table-bordered">
            		<tr>
            			<th>Total Cash</th>
            			<td><?php echo array_sum($all_income);?></td>
            		</tr>
            		<tr>
            			<th>Total Cost</th>
            			<td><?php echo array_sum($all_cost);?></td>
            		</tr>
            		<tr>
            			<th>Net Cash</th>
            			<td><?php echo array_sum($all_income) - array_sum($all_cost); ?></td>
            		</tr>
            		<!--tr>
            			<th><?php echo $status; ?></th>
            			<td><?php echo $totalAmount; ?></td>
            		</tr-->
            	</table>
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
    $("#datetimepickerSMSFrom").on("dp.change", function (e) {
        $('#datetimepickerSMSTo').data("DateTimePicker").minDate(e.date);
    });
    $("#datetimepickerSMSTo").on("dp.change", function (e) {
        $('#datetimepickerSMSFrom').data("DateTimePicker").maxDate(e.date);
    });
</script> 
