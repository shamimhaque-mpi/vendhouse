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
                    <h1 class="pull-left"><?php echo caption('All_Supplier_Transaction'); ?></h1>
                    
                    <a class="btn btn-primery pull-right" style="font-size: 14px; margin-top: 0;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo caption('Print'); ?></a>
                </div>
            </div>

            <div class="panel-body">
                <!-- Print Banner -->
                <img class="img-responsive hide print-banner" src="<?php echo site_url('private/images/banner.jpg'); ?>">
                
                <h4 class="text-center hide" style="margin-top: -10px;"><?php echo caption('All_Supplier_Transaction'); ?></h4>
                 
                 <div class="row none" style="margin-bottom:15px;">
                     <div class="col-md-4">
                         <input type="text" ng-model="search" placeholder="<?php echo caption('Search'); ?>" class="form-control">
                    </div>
                    <div class="col-md-5">&nbsp;</div>
                    <div class="col-md-3">
                        <div>
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
                         </div>
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
                        <th class="none"><?php echo caption('Action'); ?></th>
                    </tr>                    
                    <tr dir-paginate="transaction in allTransactions|filter:search|itemsPerPage:perPage|orderBy:sortField:reverse">
                        <td style="width: 50px;"> {{$index+1}} </td>
                        <td> {{transaction.date}} </td>
                        <td> {{transaction.vendor_name}} </td>
                        <td> {{transaction.company_name}} </td> 
                        <td> {{transaction.mobile}} </td>                        
                        <td> {{transaction.payment}} </td>
                        <td> {{transaction.payment_type}} </td>
                        <td> {{transaction.net_balance | net_balance_sign}} {{transaction.net_balance | netBalanceFilter}} </td>
                        <td class="none" style="width: 110px;">
                            <a title="Edit" class="btn btn-warning" href="<?php echo site_url('supplier_tran/supplier_tran/edit_supplier_tran/{{transaction.id}}') ;?>" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this Data?');" href="<?php echo site_url('supplier_tran/supplier_tran/delete/{{transaction.id}}') ;?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </td>
                    </tr>  
                    <tr>
                        <th colspan="4" class="text-right"><?php echo caption('Total'); ?></th>
                        <th>{{ getTotalBalanceFn(); }}</th>
                        <th>{{ getTotalNetBalanceFn(); }}</th>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>                  
                </table>
                <dir-pagination-controls max-size="perPage" direction-links="true" boundary-links="true" class="none"></dir-pagination-controls>

            </div>

            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>

