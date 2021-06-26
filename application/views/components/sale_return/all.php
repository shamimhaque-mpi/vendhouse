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
        .panel .hide{
            display: block !important;
        }
        .title{
            font-size: 25px;        
        }
    }
</style>

<div class="container-fluid" ng-controller="showcategoryCtrl" ng-cloak>
    <?php  echo $this->session->flashdata('confirmation'); ?>

   <div id="loading">
           <img src="<?php echo site_url('private/images/loading-bar.gif');?>" alt="Image Not found"/>
    </div>

    <div class="row loader-hide" id="data"> 
    <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title">
                    <h1 class="pull-left"> All Sale Returns </h1>
                   
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print');?></a>
                </div>
            </div>

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
                
                <hr class="hide" style="border-bottom: 2px solid #ccc; margin-top: 5px;">



                <table class="table table-bordered">
                    <tr>
                        <th style="width: 50px;"><?php echo caption('SL');?></th>
                        <th><?php echo caption('Date');?></th>
                        <th>Product Name</th>
						<th>Category</th>
						<th>Brand</th>
						<th>Return Quantity</th>
						<th>Amount</th>
                    </tr>
                    <?php
					$total = array();
					foreach($info as $key => $row){?>
                    <tr>
                        <td><?php echo $key+1; ?></td>
                        <td><?php echo $row->date; ?></td>
                        <td><?php echo $row->product_name; ?></td>
                        <td><?php echo $row->category; ?></td>
                        <td><?php echo $row->subcategory; ?></td>
                        <td><?php echo $row->quantity; ?></td>
                        <td><?php echo $total[] = $row->return_amount; ?></td>
                    </tr>
					<?php } ?>
                    <tr>
						<th colspan="6" class="text-right">Total</th>
						<th><?php echo array_sum($total); ?></th>
                    </tr>
                </table>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>       
    </div>
</div>

