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

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title ">
                    <h1 class="pull-left">Today's Sale</h1>
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

                
                <h4 class="text-center hide" style="margin-top: -10px;">Today's Sale</h4>
                
                <!-- pre><?php // print_r($sales); ?></pre -->
                
                <div class="table-responsive">
                <table class="table table-bordered table2">
                    <tr>
                        <th style="width: 60px;">SI</th>
                        <th>Voucher No</th>
                        <th>Customer Name</th>
                        <th>Mobile No</th>      
                        <th>Total</th>
                        <th>Discount</th>
                        <th>Grand Total</th>
                        <th>Paid</th>
                        <th>Due</th>
                        <th>Profit</th>
                        <th>Action</th>
                    </tr>
                    
                    <?php 
                    $total = $totalDiscount = $totalGrandtotal =  $totalPaid = $totalDue = $totalProfit = 0; 
                    foreach($sales as $key => $row){
                        
                        $where = array('voucher_number' => $row->voucher_number);
                        $saleInfo = $this->action->read('sale',$where);
                        
                        foreach($saleInfo as $item) {
                            $profit = 0.00;
                            if($item->remark != 'free'){
	                            $purchaseTotal = $item->purchase_price * $item->quantity;
	                            $saleTotal    = $item->price * $item->quantity;
	                            $profit = $saleTotal - $purchaseTotal;
	                            $totalProfit +=  $profit;
                            }
                        }
                    ?>
                    <tr>
                        <td> <?php echo ($key + 1); ?> </td>
                        <td> <?php echo $row->voucher_number; ?> </td>
                        <td> <?php echo $row->name; ?> </td>
                        <td> <?php echo $row->mobile; ?> </td>  
                        <td> <?php echo $row->total; $total += $row->total; ?> </td> 
                        <td> <?php echo $row->discount; $totalDiscount += $row->discount; ?> </td>                       
                        <td> <?php echo $row->grand_total; $totalGrandtotal += $row->grand_total; ?> </td> 
                        <td> <?php echo $row->paid; $totalPaid += $row->paid; ?> </td>
                        <td> <?php echo $row->due; $totalDue += $row->due; ?> </td>
                        <td><?php printf("%.2f",$profit);?></td>
                        <td class="none" style="width: 157px;">
                        <?php if(ck_action("salse","view")){ ?>
                        	<a class="btn btn-primary" href="<?php echo site_url('sale/viewSale?vno='.$row->voucher_number); ?>"> <?php echo caption('View'); ?> </a>
                        	<a class="btn btn-success" href="<?php echo site_url('sale_return/full_sale_return?vno='.$row->voucher_number); ?>"> Return </a>
                        <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                    
                    <tr>
                        <td colspan="3"></td>
                        <td style="text-align:right;"> <b>Total</b> </td>                        
                        <td> <b><?php printf("%.2f", $total); ?> Tk</b> </td> 
                        <td> <b><?php printf("%.2f", $totalDiscount); ?> Tk</b> </td> 
                         <td> <b><?php printf("%.2f", $totalGrandtotal); ?> Tk</b> </td> 
                        <td> <b><?php printf("%.2f", $totalPaid); ?> Tk</b> </td> 
                        <td> <b><?php printf("%.2f", $totalDue); ?>Tk</b> </td>
                        <td> <b><?php printf("%.2f", $totalProfit); ?>Tk</b> </td>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                </table>
                </div>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>

    </div>
</div>