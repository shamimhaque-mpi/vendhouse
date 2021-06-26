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
                        <input type="text" name="date[from]" class="form-control" value="<?php echo date("Y-m-d");?>" >
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">To </label>
                    <div class="input-group date col-md-4" id="datetimepickerTo">
                        <input type="text" name="date[to]" class="form-control" value="<?php echo date("Y-m-d");?>">
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
                
                       
            <h4 class="text-center hide" style="margin-top: -8px;">Date : <?php echo date("Y-m-d");?></h4>
		
            <div class="panel-body">
               <!-- Print Banner -->
                
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
                
        <?php $total_income = 0; ?>
		<div class="row">
    		<div class="col-md-6">
    		
                <div class="table-responsive">
            		<table class="table table-bordered">
            		        <tr>
            		            <th>Income Source</th>
            		            <th>Amount</th>
            		        </tr>
            			<?php if($md_receive != null){
            			$total_income += $md_receive[0]->amount;
            			?>
            		        <tr>
            		            <td>Collect From MD</td>
            		            <td><?php echo $md_receive[0]->amount; ?> TK</td>
            		        </tr>
            		        <?php }?>
            		        
            			<?php if($total_sale != null){
            			$total_income += ($total_sale- $sale_return);
            			?>
            		        <tr>
            		            <td>Total Sale</td>
            		            <td><?php echo $total_sale - $sale_return; ?> TK</td>
            		        </tr>
            		        <?php }?>
            		</table>
                </div>
    		</div>
		</div>
		
		    <?php $totalCost = 0; if($cost!= null){ ?>
            <div class="table-responsive">
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
			        
			        <?php  foreach($cost as $key => $row){ ?>
			        <tr>
			            <td><?php echo ($key + 1); ?></td>
			            <td>
			            <?php
			            /*
			            $date = new DateTime($row->date);
				    echo $date->format('jS F, y');
				    */
				    echo $row->date;
			            ?>
			            </td>
			            <td><?php echo str_replace("_", " ", $row->purpose); ?></td>
			            <td><?php echo ucwords($row->spender); ?></td>
			            <td width="150px"><?php echo $row->amount; ?> TK</td>
			        </tr>
			        <?php $totalCost += $row->amount; } ?>	
		        </table>
            </div>	
		    <?php } ?>	    
		
		
	
		    
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
	     
            <table class="table table-bordered">
	        <tr>
	            <th class="text-right" style="width:85%; <?php echo $color; ?>"><?php echo $status; ?></th>
	            <th style="<?php echo $color;?>"><?php echo $totalAmount; ?> TK</th>
	        </tr>		        
	    </table>
		    
	<!-- Profit Loss Calculation end-->
		
		
		    <table class="table table-bordered">
		        <tr>
		            <th class="text-right" style="width:85%;">Total Cost</th>
		            <th><?php echo $totalCost; ?> Tk</th>
		        </tr>
		        <tr>
		            <th class="text-right" style="width:85%;">Total Cash</th>
		            <th><?php echo $total_income; ?>Tk</th>
		        </tr>
		        <tr>
		            <th class="text-right" style="width:85%;">Net Cash</th>
		            <th><?php echo $total_income - $totalCost; ?> Tk</th>
		        </tr>
		        <!-- tr>
		            <th class="text-right" style="width:85%;">Permanent Cash</th>
		            <th>5000 Tk</th>
		        </tr -->
		        <tr>
		            <th class="text-right" style="width:85%;">Give to MD</th>
		            <th><?php echo ($total_income - $totalCost); ?> Tk</th>
		        </tr>
		    </table>
		    
		   
		 <?php if($todayDueCollction != NULL ) { ?>  
		 <table class="table table-bordered">
                    <tr>
                        <th colspan="5" style="background: #ddd; text-align:center;">Today's Due Collction</th>
                    </tr>
                    <tr>
                        <th width="40">Sl</th>
                        <th>Date</th>
                        <th>Voucher No</th>
                        <th width="150px">Amount</th>
                    </tr>
                    <?php 
                    	$total = 0.00;  
                    	 foreach ($todayDueCollction as  $key => $row) { 
                    	 $total  += $row->paid;
                       ?>
                    <tr>
                        <td><?php echo ($key+1); ?></td>
                        <td><?php echo $row->date; ?></td>
                        <td><?php echo $row->voucher_no; ?></td>
                        <td><?php echo $row->paid; ?></td>
                    </tr>
                    <?php }?>
                    <tr>
                    	<td colspan="3" class="text-right"><b>Total</b></td>
                    	<td><b><?php echo $total; ?> TK </b></td>
                    </tr>
                    
                </table>  
		    
		 <?php } ?> 
		 
		 <?php if($todaySalesReturn != null){ ?>
		 
		  <table class="table table-bordered">
                    <tr>
                        <th colspan="5" style="background: #ddd; text-align:center;">Tody's Sales Return </th>
                    </tr>
                    <tr>
                        <th width="40">Sl</th>
                        <th>Date</th>
                        <th>Voucher No</th>
                        <th>Quantity</th>
                        <th width="150px">Amount</th>
                    </tr>
                    <?php 
                        $total = 0.00;  
                         foreach ($todaySalesReturn as  $key => $row) { 
                         $where = array('product_code'=>$row->code);
                         $returnAmount = $this->action->read('products', $where);
                         
                         $totalPrice = ($row->quantity * $returnAmount[0]->sale_price);
                         
                         $total  += $totalPrice;
                         
                       ?>
                       
                    <tr>
                        <td><?php echo ($key+1); ?></td>
                        <td><?php echo $row->date; ?></td>
                        <td><?php echo $row->voucher_no; ?></td>
                        <td><?php echo $row->quantity; ?></td>
                        <td><?php echo ($row->quantity * $returnAmount[0]->sale_price); ?></td>
                    </tr>
                    <?php }?>
                    <tr>
                        <td colspan="4" class="text-right"><b>Total</b></td>
                        <td><b><?php echo $total; ?> TK </b></td>
                    </tr>
                    
                </table>  
                
                <?php } ?>
                
  		<?php if($todayDueSaleInfo != null ) {?>
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
	    
               <?php } ?>
                
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
