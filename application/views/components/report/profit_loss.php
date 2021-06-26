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
                    <h1>Search Profit / Loss</h1>
                </div>
            </div>

            <div class="panel-body">
            
            <?php $attr = array("class" => "form-horizontal"); ?>
            <?php echo form_open("", $attr); ?>     
            
              <div class="form-group">
                    <label class="col-md-2 control-label">Voucher Number</label>
                    <div class="form-controll col-md-4">
                        <input type="text" name="search[voucher_number]" class="form-control" placeholder="Voucher Number">                        
                    </div>
                </div>        

                <div class="form-group">
                    <label class="col-md-2 control-label">From </label>
                    <div class="input-group date col-md-4" id="datetimepickerFrom">
                        <input type="text" name="date[from]" class="form-control" placeholder="YYYY-MM-DD">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">To </label>
                    <div class="input-group date col-md-4" id="datetimepickerTo">
                        <input type="text" name="date[to]" class="form-control" placeholder="YYYY-MM-DD">
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
                    <h1 class=" pull-left">Daily Profit / Loss</h1>
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
            <!--pre><?php // print_r($sales);?></pre-->  
                    
               <?php if($sales!= null){ ?>
               <div class="table-responsive">
		        <table class="table table-bordered">
		                <tr><th colspan="7" style="background: #ddd; text-align:center;">Profit / Loss</th> </tr>
			        <tr>
			            <th style="text-align:center;">Sl</th>
			            <th style="text-align:center;">Date</th>
			            <th style="text-align:center;">Voucher Number</th>
			            <th style="text-align:center;">Total Purchase</th>
			            <th style="text-align:center;">Total Sale</th>
			            <th style="text-align:center;">Balanced Amount</th>
			            <th style="text-align:center;">Status</th>
			        </tr>
			        
			        <?php 
			          $totalPurchase = $totalAmount = $grandPurchase = $grandSale = 0;			          
			          foreach($sales as $key => $row){
			          $info = $this->action->read("sale",array("voucher_number" => $row->voucher_number));
			          if($info){
			            foreach($info as $sl=>$value){
			              $purchaseInfo = $this->action->read("products",array("product_code" => $value->code));			              
			               $totalPurchase += ($purchaseInfo != NULL)?($purchaseInfo[0]->purchase_price * $value->quantity):0;
			            }
			          }
			         ?>			         
			         <tr>
			            <td style="text-align:center;"><?php echo ($key + 1); ?></td>
			            <td style="text-align:center;"><?php echo $row->date;?></td>
			            <td style="text-align:center;"><?php echo $row->voucher_number; ?></td>
			            <td style="text-align:center;"><?php printf("%.2f", $totalPurchase); $grandPurchase += $totalPurchase; ?> TK</td>
			            <td style="text-align:center;"><?php echo $totalSale = $row->grand_total; $grandSale += $totalSale;  ?> TK</td>
			            
			            <th style="text-align:center;  <?php if(($totalSale - $totalPurchase) >= 0){echo "color:green;";} else {echo "color:red;";} ?> ">
			              <?php $balance = $totalSale - $totalPurchase; $totalAmount +=$balance; printf("%.2f",$balance);?> TK
			            </th>
			            <th style="text-align:center;  <?php if($balance >= 0){echo "color:green;";} else {echo "color:red;";} ?> ">
			              <?php
			                  if($balance > 0){
			                   echo "Profit";
			                  }elseif($balance < 0){
			                   echo "Loss";
			                  }else{
			                   echo "Balanced";
			                  }			                 
			               ?> 
			            </th>			            
			        </tr>
			      <?php  $totalPurchase = 0; } ?>	
			      
			    <tr>
			      <th class="text-right" colspan="3">Total Amount</th>
			      <th class="text-center"><?php echo $grandPurchase;?> TK</th>
			      <th class="text-center"><?php echo $grandSale;?> TK</th>
			      <th class="text-center"><?php echo $totalAmount;?> TK</th>
			      <th>&nbsp;</th>
			   </tr>
			   
		        </table>
                </div>	
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
