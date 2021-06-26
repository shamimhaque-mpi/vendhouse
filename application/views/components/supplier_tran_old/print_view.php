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

<div class="container-fluid" ng-controller="showAllSupplierTransactionCtrl" ng-cloak>

    <div id="loading">
           <img src="<?php echo site_url('private/images/loading-bar.gif');?>" alt="Image Not found"/>
    </div> 

    <div class="row loader-hide" id="data">    
    <?php echo $this->session->flashdata('confirmation'); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panal-header-title ">
                    <h1 class="pull-left">Supplier Transaction</h1>
                    
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print'); ?></a>
                </div>
            </div>

            <div class="panel-body">
                <!-- Print Banner -->
                <img class="img-responsive hide print-banner" src="<?php echo site_url('private/images/banner.jpg'); ?>">
                            	<div class="col-md-12 text-center hide" style="border: 1px dotted #ddd; border-top: 2px dotted #ddd; border-bottom: 1px dotted transparent; margin: 0 15px !important;">
            	 <h1 style="font-size:14px;">Allahar Dan Bostraloy </h1>
            	 <h3 style="font-size:12px;margin-top:-8px;">Sher-e Bangla Public Library Complex (1st floor)<br/>
		Club Road, Pirojpur</h3>
		<p style="font-size:12px;margin-top:-8px;">Mobile: 01779-825498, 01985-190072</p>
            	</div>
                <h4 class="text-center hide" style="margin-top: -10px;">Supplier Transaction</h4>
                 
                 <div class="row none" style="margin-bottom:15px;">
                    <div class="col-md-5">&nbsp;</div>
                    <div class="col-md-3">
                        <!--div>
                             <span style="margin-left: 55px;line-height: 2.4;font-weight: bold;"><?php echo caption('Per_Page'); ?>&nbsp;:&nbsp;</span>
                             <select ng-model="perPage" class="form-control" style="width:92px;float:right;">
                             <option value="2">2</option>
                             <option value="3">3</option>
                             <option value="10">10</option>
                             <option value="20">20</option>
                             <option value="30">30</option>
                             <option value="50">50</option>
                             <option value="100">100</option>
                             </select>
                         </div-->
                    </div>
                </div>
                <table class="table table-bordered" ng-cloak>
                    <tr>
                        <th><?php echo caption('SL'); ?></th>
                        <th><?php echo caption('Date'); ?></th>
                        <th><?php echo caption('Supplier_Name'); ?></th>
                        <th><?php echo caption('Company_Name'); ?></th>     
                        <th><?php echo caption('Mobile'); ?></th>                            
                        <th><?php echo caption('Payment'); ?></th>
                        <th><?php echo caption('Type_of_Payment'); ?></th>
                        <th><?php echo caption('Net_Balance'); ?></th>
                    </tr>                    
                    <tr>
                        <td><?php echo '1';?></td>
                        <td><?php echo $info[0]->date;?></td>
                        <td><?php echo $supplierInfo[0]->vendor_name;?></td>
                        <td><?php echo $info[0]->company_name;?></td>
                        <td> <?php echo $info[0]->mobile;?> </td>      
                        <td><?php echo $info[0]->payment;?></td>
                        <td><?php echo $info[0]->payment_type;?></td>
                        <td><?php echo $info[0]->net_balance;?></td>
                    </tr>  
                    <!--tr>
                        <th colspan="5" class="text-right"><?php echo caption('Total'); ?></th>
                        <th></th>
                        <td>&nbsp;</td>
                    </tr-->                  
                </table>
            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

