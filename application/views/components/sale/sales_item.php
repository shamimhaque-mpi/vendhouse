<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />
<div class="container-fluid">
    <div class="row">
        <?php echo $this->session->flashdata('confirmation'); ?>

        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Sale Items</h1>
                </div>
            </div>

            <div class="panel-body">
                <!-- horizontal form -->
                <?php
                $attr = array("class" => "form-horizontal");
                echo form_open('', $attr);
                ?>

                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo caption('Product_Name'); ?> <span class="req">*</span></label>
                    <div class="col-md-5">
			 <select class="selectpicker form-control" name="productName" style="float:right;" data-show-subtext="true" data-live-search="true">
				 <option value="" disabled selected>&nbsp;</option>
				 <?php   foreach ($info as $key => $value) { ?>
				   <option value="<?php echo $value->product;?>"><?php echo $value->product;?></option>
				 <?php } ?>                                                                
			 </select>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="btn-group pull-right">
                        <input type="submit" name="submit" value="<?php echo caption('View'); ?>" class="btn btn-primary">
                    </div>
                </div>
                    
                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>

			
			
        </div>
		<?php if($result != null){?>
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1> Sale Items </h1>
                </div>
            </div>

            <div class="panel-body">
				
				  <table ng-cloak class="table table-bordered">
                    <tr>
                        <th style="width: 40px;"><?php echo caption('SL') ;?></th>
                        <th style="cursor:pointer;">Date</th>
                        <th style="cursor:pointer;">Voucher No</th>
                        <th style="cursor:pointer;">Client's Name</th>
                        <th style="cursor:pointer;"><?php echo caption('Product_Name') ;?></th>              
                        <th style="cursor:pointer;">Price</th> 
                        <th style="min-width: 90px;">Qty</th> 
                        <th style="min-width: 90px;">Total Balance</th> 
                    </tr>
			<?php
				$totalQty = $totalAmount = 0;
				foreach($result as $key=> $row){
				$totalQty += $row->quantity;
				$totalAmount += $row->subtotal;
			?>
						
                    <tr>
                        <td><?php echo $key+1; ?></td>
                        <td><?php echo $row->date; ?></td>
                        <td><?php echo $row->voucher_number; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo $row->product; ?></td>
                        <td><?php echo $row->price; ?></td>
                        <td><?php echo $row->quantity; ?></td>
                        <td><?php echo $row->subtotal; ?></td>
                    </tr>
					<?php }?>

                    <tr>
                        <th colspan="6" class="text-right"><?php echo caption('Grand_Total') ;?></th>
                        <th width="130"><?php echo $totalQty;?></th>
                        <th><?php echo $totalAmount;?>  TK</th>
                    </tr>
                </table> 
			</div>

            <div class="panel-footer">&nbsp;</div>

			
			
        </div>
		<?php }?>
    </div>
</div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
 