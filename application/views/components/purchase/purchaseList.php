<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />
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
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default none">

            <div class="panel-heading">
                <div class="panal-header-title pull-left">
                    <h1><?php echo caption('All_Purchase'); ?></h1>
                </div>
            </div>

            <div class="panel-body">

                <?php
                echo $this->session->flashdata('deleted');

                $attr = array("class" => "form-horizontal");
                echo form_open("", $attr);
                ?>

 
                <div class="form-group">
                    <label class="col-md-2 control-label">Product Code</label>
                    <div class="col-md-4">
                        <select name="product_code" class="form-control selectpicker"  data-show-subtext="true" data-live-search="true">
                            <option value="" disabled selected>&nbsp;</option>
                            <?php if($allProduct != null){ foreach($allProduct as $key => $row){ ?>
                            <option value="<?php echo $row->product_code; ?>">
                                <?php echo $row->product_code; ?>
                            </option>
                            <?php }} ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <input type="submit" name="show" value="<?php echo caption('Show'); ?>" class="btn btn-primary">
                    </div>
                </div>
                    
                <?php echo form_close(); ?>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>

        <?php if($result != null){ ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title ">
                    <h1 class="pull-left"><?php echo caption('Result'); ?></h1>
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print'); ?></a>
                </div>
            </div>

            <div class="panel-body">
                <!-- Print Banner -->
 
                <div class="row hide">
                    <div class="view-profile">

                        <div class="institute">
                            <h2 class="text-center title" style="margin-top: 10px; font-weight: bold;">
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

                <h4 class="text-center hide" style="margin-top: -10px;"><?php echo caption('All_Purchase'); ?></h4>
                
                <div class="table-responsive">
                <table class="table table-bordered table2">
                    <tr>
                        <th><?php echo caption('SL'); ?></th>
                        <th><?php echo caption('Date'); ?></th>
                        <th><?php echo caption('Voucher_number'); ?></th>
                        <th><?php echo caption('Supplier_Name'); ?></th>
			            <th>Product Code</th>	
                        <th>Product Name</th>
            			<th>Quantity</th>
            			<th>Purchase Price</th>
            			<th><?php echo caption('Grand_Total'); ?></th>	
                    </tr>
                    
                    <?php 
                        $total_paid = 0;
                        $total_due = 0;
                        $total_grand_total = 0;
            			$transport_total = 0;
            			$totalQuantity = $toalPurchase = 0.00;
                        foreach($result as $key => $val){ 
                    ?>
                    <tr>
                        <td style="width: 50px;"><?php echo ($key + 1); ?></td>
                        <td><?php echo $val->date; ?></td>
                        <td><?php echo $val->voucher_no; ?></td>

                        <td>
                        <?php 
                        $where = array('id' => $val->vendor_id); 
                        $info = $this->action->read('vendor', $where);
                        if(count($info)>0){
                        	 echo $info[0]->vendor_name;
                        }else{
                        	echo "N/A";
                        }
                        
                        ?>
                        </td>
			            <td><?php echo $val->product_code; ?></td>
                        <td><?php echo $val->product_name; ?></td>
                        <td><?php echo $val->quantity; ?></td>
                        <td><?php echo $val->purchase_price; ?></td>
                        <td><?php echo $val->grand_total; ?></td>
                    </tr>

                    <?php 
                    	$totalQuantity += $val->quantity; 
                    	$toalPurchase +=  $val->purchase_price;
                        $total_grand_total += $val->grand_total;

                    } ?>

                    <tr>
                        <td colspan="6" class="text-right"><strong>Grand Total</strong></td>
                        <td colspan="1"><strong><?php echo $totalQuantity; ?> </strong></td>
                        <td colspan="1"><strong><?php echo $toalPurchase; ?> TK</strong></td>
                        <td colspan="1"><strong><?php echo $total_grand_total; ?> TK</strong></td>
                    </tr>
                    
                </table>
                </div>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
        <?php } ?>

    </div>
</div>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>